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
        if (!$user->divisi) {
            abort(403, 'Divisi tidak ditemukan untuk akun ini.');
        }
        $tasks = Task::where('divisi', $user->divisi)->orderBy('created_at', 'desc')->get();
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
        $query = Task::where('divisi', $user->divisi);
        if ($request->has('status') && $request->status != 'all') {
            $query->where('status', $request->status);
        }
        $tasks = $query->orderBy('created_at', 'desc')->paginate(10);
        return view('team.tasks', compact('tasks'));
    }

    public function showTask($id)
    {
        $user = Auth::user();
        $task = Task::with('brief')->where('id', $id)->where('divisi', $user->divisi)->firstOrFail();
        return view('team.task-detail', compact('task'));
    }

    public function updateTaskStatus(Request $request, $id)
    {
        $user = Auth::user();
        $task = Task::where('id', $id)->where('divisi', $user->divisi)->firstOrFail();
        $request->validate([
            'status' => 'required|in:pending,in_progress,review,completed',
        ]);
        $task->status = $request->status;
        $task->save();
        return redirect()->back()->with('success', 'Status task diperbarui.');
    }

    public function uploadResult(Request $request, $id)
    {
        $user = Auth::user();
        $task = Task::where('id', $id)->where('divisi', $user->divisi)->firstOrFail();

        $request->validate([
            'thumbnail' => 'required|image|max:2048',
            'work_link' => 'required|url',
            'notes' => 'nullable|string',
        ]);

        $path = $request->file('thumbnail')->store('thumbnails', 'public');

        $result = $task->result ?: new ProjectResult();
        $result->task_id = $task->id;
        $result->thumbnail = $path;
        $result->work_link = $request->work_link;
        $result->notes = $request->notes;
        $result->save();

        // Ubah status task menjadi review jika belum completed
        if ($task->status != 'completed') {
            $task->status = 'review';
            $task->save();
        }

        return redirect()->back()->with('success', 'Laporan berhasil dikirim.');
    }

    public function calendar()
    {
        // Jika ingin menampilkan deadline dari brief, bisa diimplementasikan nanti
        return view('team.calendar', ['events' => []]);
    }

    public function notifications()
    {
        $user = Auth::user();
        $tasks = Task::where('divisi', $user->divisi)
                    ->where('status', '!=', 'completed')
                    ->orderBy('created_at', 'desc')
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
            'email' => 'required|email|unique:users,email,' . $user->id,
            'phone' => 'nullable|string|max:20',
        ]);
        $user->update($request->only('name', 'email', 'phone'));
        return redirect()->back()->with('success', 'Profil diperbarui.');
    }
}