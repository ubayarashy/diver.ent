<?php

namespace App\Http\Controllers;

use App\Models\Task;
use App\Models\Brief;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TeamController extends Controller
{
    // public function __construct()
    // {
    //     $this->middleware('auth');
    // }

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

    // Calendar Team
    public function calendar()
{
    $tasks = Task::where('assigned_to', Auth::id())
        ->whereNotNull('deadline')
        ->get(['id', 'title', 'deadline', 'status']);
    
    // Format events untuk FullCalendar
    $events = [];
    foreach ($tasks as $task) {
        $color = '#3b82f6'; // default blue
        if ($task->status == 'completed') {
            $color = '#10b981'; // green
        } elseif ($task->status == 'pending') {
            $color = '#f59e0b'; // orange
        } elseif ($task->status == 'in_progress') {
            $color = '#3b82f6'; // blue
        }
        
        $events[] = [
            'id' => $task->id,
            'title' => $task->title,
            'start' => $task->deadline->format('Y-m-d'),
            'backgroundColor' => $color,
            'borderColor' => $color,
            'url' => route('team.task.detail', $task->id),
        ];
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