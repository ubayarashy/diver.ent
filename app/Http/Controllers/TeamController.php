<?php

namespace App\Http\Controllers;

use App\Models\Task;
use App\Models\Brief;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TeamController extends Controller
{
    // Dashboard Team
    public function dashboard()
    {
        $userId = Auth::id();
        
        // Hitung statistik
        $totalTasks = Task::where('assigned_to', $userId)->count();
        $pendingTasks = Task::where('assigned_to', $userId)->where('status', 'pending')->count();
        $inProgressTasks = Task::where('assigned_to', $userId)->where('status', 'in_progress')->count();
        $reviewTasks = Task::where('assigned_to', $userId)->where('status', 'review')->count();
        $completedTasks = Task::where('assigned_to', $userId)->where('status', 'completed')->count();
        
        // Buat array stats untuk memudahkan di view
        $stats = [
            'total' => $totalTasks,
            'pending' => $pendingTasks,
            'in_progress' => $inProgressTasks,
            'review' => $reviewTasks,
            'completed' => $completedTasks,
        ];
        
        // Recent tasks
        $recentTasks = Task::with('brief.user')
            ->where('assigned_to', $userId)
            ->orderBy('created_at', 'desc')
            ->limit(5)
            ->get();
        
        return view('team.dashboard', compact('stats', 'recentTasks', 'totalTasks', 'pendingTasks', 'inProgressTasks', 'completedTasks'));
    }

    // Daftar semua task
    public function tasks()
    {
        $tasks = Task::with('brief.user')
            ->where('assigned_to', Auth::id())
            ->orderBy('deadline', 'asc')
            ->paginate(10);
        
        return view('team.tasks', compact('tasks'));
    }

    // Detail task
    public function showTask($id)
    {
        $task = Task::with('brief.user')
            ->where('assigned_to', Auth::id())
            ->findOrFail($id);
        
        return view('team.task-detail', compact('task'));
    }

    // Update status task
    public function updateTaskStatus(Request $request, $id)
    {
        $task = Task::where('assigned_to', Auth::id())->findOrFail($id);
        
        $request->validate([
            'status' => 'required|in:pending,in_progress,review,revision,completed'
        ]);
        
        $task->status = $request->status;
        $task->save();
        
        return response()->json([
            'success' => true,
            'message' => 'Status task berhasil diperbarui',
            'status' => $task->status
        ]);
    }

    // Update progress task
    public function updateProgress(Request $request, $id)
    {
        $task = Task::where('assigned_to', Auth::id())->findOrFail($id);
        
        $request->validate([
            'progress' => 'required|integer|min:0|max:100'
        ]);
        
        $task->progress = $request->progress;
        
        if ($task->progress == 100 && $task->status != 'completed') {
            $task->status = 'review';
        }
        
        $task->save();
        
        return response()->json([
            'success' => true,
            'message' => 'Progress berhasil diperbarui',
            'progress' => $task->progress
        ]);
    }

    // Upload hasil task
    public function uploadResult(Request $request, $id)
    {
        $task = Task::where('assigned_to', Auth::id())->findOrFail($id);
        
        $request->validate([
            'thumbnail' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
            'youtube_link' => 'nullable|url',
            'social_link' => 'nullable|url',
            'drive_link' => 'nullable|url',
            'team_notes' => 'nullable|string',
        ]);
        
        $result = $task->result ?? [];
        
        if ($request->hasFile('thumbnail')) {
            $thumbnail = $request->file('thumbnail');
            $filename = time() . '_' . $thumbnail->getClientOriginalName();
            $thumbnail->storeAs('task-results', $filename, 'public');
            $result['thumbnail'] = 'task-results/' . $filename;
        }
        
        if ($request->filled('youtube_link')) {
            $result['youtube_link'] = $request->youtube_link;
        }
        
        if ($request->filled('social_link')) {
            $result['social_link'] = $request->social_link;
        }
        
        if ($request->filled('drive_link')) {
            $result['drive_link'] = $request->drive_link;
        }
        
        $task->result = $result;
        $task->team_notes = $request->team_notes;
        $task->status = 'review';
        $task->save();
        
        return redirect()->back()->with('success', 'Hasil task berhasil diupload');
    }

    // Calendar Team - Menampilkan BRIEF DATES dan DEADLINE otomatis 2 minggu setelah brief
   // Calendar Team - Menampilkan Brief Date & Update Status Date
public function calendar()
{
    $userId = Auth::id();
    
    // Ambil semua tasks dengan brief
    $tasks = Task::with('brief')
        ->where('assigned_to', $userId)
        ->get();
    
    $events = [];
    
    foreach ($tasks as $task) {
        // Ambil tanggal brief
        $briefDate = $task->brief ? $task->brief->created_at : $task->created_at;
        
        if ($briefDate) {
            // Warna berdasarkan status
            $statusColors = [
                'pending' => '#F59E0B',
                'in_progress' => '#3B82F6',
                'review' => '#8B5CF6',
                'revision' => '#F59E0B',
                'completed' => '#10B981',
            ];
            
            $color = $statusColors[$task->status] ?? '#6B7280';
            
            // 1. EVENT BRIEF TERKIRIM
            $events[] = [
                'id' => 'brief_' . $task->id,
                'title' => '📋 ' . ($task->brief->title ?? $task->title),
                'start' => $briefDate->format('Y-m-d'),
                'backgroundColor' => '#00D2FF',
                'borderColor' => '#00D2FF',
                'textColor' => '#0A192F',
                'type' => 'brief',
                'status' => $task->status,
                'client' => $task->brief->user->name ?? 'Client',
                'task_id' => $task->id,
                'url' => route('team.task.detail', $task->id),
            ];
            
            // 2. EVENT UPDATE STATUS (2 minggu setelah brief)
            $updateDate = clone $briefDate;
            $updateDate->addDays(14);
            
            $events[] = [
                'id' => 'update_' . $task->id,
                'title' => '🔄 Update Status: ' . ($task->brief->title ?? $task->title),
                'start' => $updateDate->format('Y-m-d'),
                'backgroundColor' => $color,
                'borderColor' => $color,
                'textColor' => '#ffffff',
                'type' => 'update_status',
                'status' => $task->status,
                'client' => $task->brief->user->name ?? 'Client',
                'brief_date' => $briefDate->format('Y-m-d'),
                'task_id' => $task->id,
                'url' => route('team.task.detail', $task->id),
            ];
        }
    }
    
    return view('team.calendar', compact('events'));
}
    // Notifications
    public function notifications()
    {
        $tasks = Task::where('assigned_to', Auth::id())
            ->where('status', '!=', 'completed')
            ->orderBy('deadline', 'asc')
            ->get();
        
        return view('team.notifications', compact('tasks'));
    }

    // Profile Team
    public function profile()
    {
        $user = Auth::user();
        return view('team.profile', compact('user'));
    }

    public function updateProfile(Request $request)
    {
        $user = Auth::user();
        
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,' . $user->id,
            'phone' => 'nullable|string|max:20',
            'password' => 'nullable|min:8|confirmed',
        ]);
        
        $user->name = $request->name;
        $user->email = $request->email;
        $user->phone = $request->phone;
        
        if ($request->filled('password')) {
            $user->password = bcrypt($request->password);
        }
        
        $user->save();
        
        return redirect()->back()->with('success', 'Profile berhasil diperbarui');
    }
}