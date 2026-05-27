<?php

namespace App\Http\Controllers;

use App\Models\Brief;
use App\Models\User;
use App\Models\Task;
use App\Models\Payment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class AdminBriefController extends Controller
{
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

    // Update status brief dan buat task otomatis jika approved
    public function updateStatus(Request $request, $id)
    {
        Log::info('========== UPDATE STATUS DIPANGGIL ==========');
        Log::info('Brief ID: ' . $id);
        Log::info('Status yang dikirim: ' . $request->status);
        
        $brief = Brief::findOrFail($id);
        $oldStatus = $brief->status;
        
        Log::info('Status lama di database: ' . $oldStatus);
        
        $brief->status = $request->status;
        $brief->save();
        
        // 🔴 BUAT TASK OTOMATIS KETIKA STATUS APPROVED 🔴
        if ($request->status == 'approved' && $oldStatus != 'approved') {
            Log::info('✅ KONDISI TERPENUHI - Memanggil createTasksForBrief');
            $this->createTasksForBrief($brief);
        } else {
            Log::info('❌ KONDISI TIDAK TERPENUHI');
            Log::info('Status request: ' . $request->status . ', Old status: ' . $oldStatus);
        }
        
        // Buat invoice/payment jika status approved
        if ($request->status == 'approved') {
            Log::info('Membuat invoice/payment untuk brief ID: ' . $brief->id);
            Payment::updateOrCreate(
                ['brief_id' => $brief->id],
                [
                    'amount' => $brief->budget ?? 0,
                    'invoice_number' => 'INV-' . date('Ymd') . '-' . str_pad($brief->id, 4, '0', STR_PAD_LEFT),
                    'status' => 'unpaid',
                ]
            );
        }
        
        $message = $request->status == 'approved' ? 'Brief disetujui! Task telah dibuat.' : 'Status brief berhasil diperbarui';
        
        Log::info('Response message: ' . $message);
        Log::info('========== UPDATE STATUS SELESAI ==========');
        
        return response()->json([
            'success' => true,
            'message' => $message,
            'status' => $brief->status
        ]);
    }

    /**
     * Create tasks for each category in brief
     */
    private function createTasksForBrief($brief)
    {
        Log::info('========== CREATE TASKS FOR BRIEF ==========');
        Log::info('Brief ID: ' . $brief->id);
        Log::info('Project Name: ' . $brief->project_name);
        Log::info('Categories: ' . json_encode($brief->categories));
        
        // Mapping kategori ke email team
        $categoryToTeam = [
            'Social Media Management' => 'team.social@diverent.com',
            'Videography' => 'team.video@diverent.com',
            'Fotografi' => 'team.foto@diverent.com',
            'Digital Ads' => 'team.ads@diverent.com',
        ];

        $categories = $brief->categories;
        $taskCount = 0;

        foreach ($categories as $category) {
            Log::info('Processing category: ' . $category);
            
            $teamEmail = $categoryToTeam[$category] ?? null;
            Log::info('Team email mapping: ' . ($teamEmail ?? 'TIDAK DITEMUKAN'));
            
            if ($teamEmail) {
                $team = User::where('email', $teamEmail)->first();
                Log::info('Team ditemukan: ' . ($team ? $team->id . ' - ' . $team->name : 'TIDAK ADA'));
                
                if ($team) {
                    // Cek apakah task sudah ada
                    $existingTask = Task::where('brief_id', $brief->id)
                        ->where('category', $category)
                        ->first();
                    
                    if (!$existingTask) {
                        Task::create([
                            'brief_id' => $brief->id,
                            'assigned_to' => $team->id,
                            'title' => $brief->project_name,
                            'category' => $category,
                            'description' => $brief->description,
                            'deadline' => now()->addDays(14),
                            'status' => 'pending',
                            'progress' => 0,
                        ]);
                        $taskCount++;
                        Log::info('✅ Task created untuk kategori: ' . $category . ' - assigned to team: ' . $team->name);
                    } else {
                        Log::info('Task sudah ada untuk kategori: ' . $category . ' - Task ID: ' . $existingTask->id);
                    }
                }
            } else {
                Log::info('Tidak ada mapping untuk category: ' . $category);
            }
        }
        
        Log::info('Total task yang dibuat: ' . $taskCount);
        Log::info('========== CREATE TASKS FOR BRIEF SELESAI ==========');
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