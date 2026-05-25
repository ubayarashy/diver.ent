<?php

namespace App\Http\Controllers;

use App\Models\Brief;
use Illuminate\Http\Request;

class AdminBriefController extends Controller
{
    // HAPUS constructor ini:
    // public function __construct()
    // {
    //     $this->middleware('auth');
    // }

    // Daftar semua brief
    public function index()
    {
        $briefs = Brief::with('user')->orderBy('created_at', 'desc')->paginate(10);
        
        $stats = [
            'total' => Brief::count(),
            'pending' => Brief::where('status', 'pending')->count(),
            'contacted' => Brief::where('status', 'contacted')->count(),
            'approved' => Brief::where('status', 'approved')->count(),
            'rejected' => Brief::where('status', 'rejected')->count(),
        ];
        
        return view('admin.briefs', compact('briefs', 'stats'));
    }

    // Detail brief
    public function show($id)
    {
        $brief = Brief::with('user')->findOrFail($id);
        return view('admin.brief-detail', compact('brief'));
    }

    // Update status brief
    public function updateStatus(Request $request, $id)
    {
        $brief = Brief::findOrFail($id);
        
        $request->validate([
            'status' => 'required|in:pending,contacted,approved,rejected'
        ]);
        
        $brief->update([
            'status' => $request->status
        ]);
        
        return response()->json([
            'success' => true,
            'message' => 'Status brief berhasil diperbarui',
            'status' => $brief->status
        ]);
    }

    // Hapus brief
    public function destroy($id)
    {
        $brief = Brief::findOrFail($id);
        $brief->delete();
        
        return response()->json([
            'success' => true,
            'message' => 'Brief berhasil dihapus'
        ]);
    }

    // Export brief ke CSV
    public function export()
    {
        $briefs = Brief::with('user')->get();
        
        $filename = 'briefs_' . date('Y-m-d') . '.csv';
        $handle = fopen('php://output', 'w');
        
        fputcsv($handle, ['ID', 'Nama Client', 'Email', 'Project', 'Kategori', 'Budget', 'Status', 'Tanggal']);
        
        foreach ($briefs as $brief) {
            fputcsv($handle, [
                $brief->id,
                $brief->user->name ?? 'Unknown',
                $brief->user->email ?? '-',
                $brief->project_name,
                implode(', ', $brief->categories),
                $brief->budget ? 'Rp ' . number_format($brief->budget, 0, ',', '.') : '-',
                $brief->status,
                $brief->created_at->format('d/m/Y H:i')
            ]);
        }
        
        fclose($handle);
        
        return response($handle)
            ->header('Content-Type', 'text/csv')
            ->header('Content-Disposition', 'attachment; filename="' . $filename . '"');
    }
}