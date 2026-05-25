<?php

namespace App\Http\Controllers;

use App\Models\Task;
use App\Models\ProjectResult;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TeamController extends Controller
{
    

    public function dashboard()
    {
        $user = Auth::user();
        $tasks = Task::where('assigned_to', $user->id)
                    ->orderBy('deadline')
                    ->get();
        $stats = [
            'total' => $tasks->count(),
            'pending' => $tasks->where('status', 'pending')->count(),
            'in_progress' => $tasks->where('status', 'in_progress')->count(),
            'review' => $tasks->where('status', 'review')->count(),
            'completed' => $tasks->where('status', 'completed')->count(),
        ];
        $recentTasks = $tasks->take(5);
        return view('team.dashboard', compact('stats', 'recentTasks'));
    }

    public function tasks(Request $request)
    {
        $user = Auth::user();
        $query = Task::where('assigned_to', $user->id);
        if ($request->has('status') && $request->status != 'all') {
            $query->where('status', $request->status);
        }
        $tasks = $query->orderBy('deadline')->paginate(10);
        return view('team.tasks', compact('tasks'));
    }

    public function showTask($id)
    {
        $task = Task::with('project', 'result')->where('assigned_to', Auth::id())->findOrFail($id);
        return view('team.task-detail', compact('task'));
    }

    public function updateTaskStatus(Request $request, $id)
    {
        $task = Task::where('assigned_to', Auth::id())->findOrFail($id);
        $request->validate([
            'status' => 'required|in:pending,in_progress,review,revision,completed',
        ]);
        $task->status = $request->status;
        $task->save();
        return redirect()->back()->with('success', 'Status task diperbarui.');
    }

    public function updateProgress(Request $request, $id)
    {
        $task = Task::where('assigned_to', Auth::id())->findOrFail($id);
        $request->validate([
            'progress' => 'required|integer|min:0|max:100',
        ]);
        $task->progress = $request->progress;
        if ($task->progress == 100 && $task->status != 'completed') {
            $task->status = 'review';
        }
        $task->save();
        return redirect()->back()->with('success', 'Progress diperbarui.');
    }

    public function uploadResult(Request $request, $id)
    {
        $task = Task::where('assigned_to', Auth::id())->findOrFail($id);
        $request->validate([
            'thumbnail' => 'nullable|image|max:2048',
            'youtube_link' => 'nullable|url',
            'social_link' => 'nullable|url',
            'drive_link' => 'nullable|url',
            'notes' => 'nullable|string',
        ]);

        $result = $task->result ?: new ProjectResult();
        $result->task_id = $task->id;

        if ($request->hasFile('thumbnail')) {
            $path = $request->file('thumbnail')->store('thumbnails', 'public');
            $result->thumbnail = $path;
        }
        $result->youtube_link = $request->youtube_link;
        $result->social_link = $request->social_link;
        $result->drive_link = $request->drive_link;
        $result->notes = $request->notes;
        $result->save();

        // Jika baru upload, ubah status ke review
        if ($task->status != 'completed') {
            $task->status = 'review';
            $task->save();
        }

        return redirect()->back()->with('success', 'Hasil project berhasil diupload.');
    }

    public function calendar()
{
    $tasks = Task::where('assigned_to', Auth::id())->get();
    $events = $tasks->map(function($task) {
        return [
            'title' => $task->title,
            'start' => $task->deadline->format('Y-m-d'),
            'color' => $task->status == 'completed' ? '#00c853' : ($task->status == 'in_progress' ? '#3b82ff' : '#ffaa00'),
        ];
    });
    return view('team.calendar', compact('events'));
}

    public function notifications()
    {
        // Untuk sementara kita ambil task yang deadline mendekat sebagai notifikasi
        $tasks = Task::where('assigned_to', Auth::id())
                    ->where('status', '!=', 'completed')
                    ->where('deadline', '<=', now()->addDays(3))
                    ->get();
        return view('team.notifications', compact('tasks'));
    }

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
            'email' => 'required|email|unique:users,email,'.$user->id,
            'phone' => 'nullable|string',
        ]);
        $user->update($request->only('name', 'email', 'phone'));
        return redirect()->back()->with('success', 'Profil diperbarui.');
    }
}