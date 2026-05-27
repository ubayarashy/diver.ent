<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Brief;
use App\Models\Payment;
use App\Models\Task;
use App\Models\Portfolio;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Symfony\Component\HttpFoundation\StreamedResponse;

class AdminController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | DASHBOARD
    |--------------------------------------------------------------------------
    */

    public function index()
    {
        $totalClients = User::where('role', 'client')->count();
        $totalTeams = User::where('role', 'team')->count();
        $totalBriefs = Brief::count();
        $pendingBriefs = Brief::where('status', 'pending')->count();
        $contactedBriefs = Brief::where('status', 'contacted')->count();
        $approvedBriefs = Brief::where('status', 'approved')->count();
        $recentBriefs = Brief::with('user')->orderBy('created_at', 'desc')->limit(5)->get();

        return view('admin.dashboard', compact(
            'totalClients',
            'totalTeams',
            'totalBriefs',
            'pendingBriefs',
            'contactedBriefs',
            'approvedBriefs',
            'recentBriefs'
        ));
    }

    /*
    |--------------------------------------------------------------------------
    | BRIEFS
    |--------------------------------------------------------------------------
    */

    public function briefs()
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

    public function briefDetail($id)
    {
        $brief = Brief::with('user', 'payment')->findOrFail($id);
        return view('admin.brief-detail', compact('brief'));
    }

    /**
     * Update status brief dan otomatis buat task jika status menjadi approved
     */
    public function updateBriefStatus(Request $request, $id)
    {
        $brief = Brief::findOrFail($id);
        
        $request->validate([
            'status' => 'required|in:pending,contacted,approved,rejected'
        ]);
        
        $oldStatus = $brief->status;
        $brief->status = $request->status;
        $brief->save();
        
        // 🔴 BUAT TASK OTOMATIS KETIKA STATUS APPROVED 🔴
        if ($request->status == 'approved' && $oldStatus != 'approved') {
            $this->createTasksForBrief($brief);
        }
        
        // Buat invoice/payment jika status approved
        if ($request->status == 'approved') {
            Payment::updateOrCreate(
                ['brief_id' => $brief->id],
                [
                    'amount' => $brief->budget ?? 0,
                    'invoice_number' => 'INV-' . date('Ymd') . '-' . str_pad($brief->id, 4, '0', STR_PAD_LEFT),
                    'status' => 'unpaid',
                ]
            );
        }
        
        if ($request->ajax()) {
            $message = $request->status == 'approved' ? 'Brief disetujui! Task telah dibuat untuk team terkait.' : 'Status brief berhasil diperbarui';
            return response()->json([
                'success' => true,
                'message' => $message,
                'status' => $brief->status
            ]);
        }
        
        return back()->with('success', 'Status brief berhasil diperbarui');
    }

    /**
     * Create tasks for each category in brief
     */
    private function createTasksForBrief($brief)
    {
        // Mapping kategori ke email team
        $categoryToTeam = [
            'Social Media Management' => 'team.social@diverent.com',
            'Videography' => 'team.video@diverent.com',
            'Fotografi' => 'team.foto@diverent.com',
            'Digital Ads' => 'team.ads@diverent.com',
        ];

        $categories = $brief->categories;

        foreach ($categories as $category) {
            $teamEmail = $categoryToTeam[$category] ?? null;
            
            if ($teamEmail) {
                $team = User::where('email', $teamEmail)->first();
                
                if ($team) {
                    // Cek apakah task sudah ada untuk brief dan kategori ini
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
                    }
                }
            }
        }
    }

    /**
     * Approve Brief via button (alternative method)
     */
    public function approveBrief($id)
    {
        $brief = Brief::findOrFail($id);
        
        // Update status brief
        $brief->status = 'approved';
        $brief->save();

        // Buat task untuk setiap kategori
        $this->createTasksForBrief($brief);
        
        // Buat invoice/payment
        Payment::updateOrCreate(
            ['brief_id' => $brief->id],
            [
                'amount' => $brief->budget ?? 0,
                'invoice_number' => 'INV-' . date('Ymd') . '-' . str_pad($brief->id, 4, '0', STR_PAD_LEFT),
                'status' => 'unpaid',
            ]
        );
        
        return redirect()->back()->with('success', 'Brief disetujui dan task telah diassign ke team terkait');
    }

    /*
    |--------------------------------------------------------------------------
    | EXPORT BRIEFS
    |--------------------------------------------------------------------------
    */

    public function exportBriefs()
    {
        $briefs = Brief::with('user')->orderBy('created_at', 'desc')->get();
        
        $filename = 'briefs_export_' . date('Y-m-d_His') . '.csv';
        
        $response = new StreamedResponse(function() use ($briefs) {
            $handle = fopen('php://output', 'w');
            
            // UTF-8 BOM for Excel
            fwrite($handle, "\xEF\xBB\xBF");
            
            // Headers
            fputcsv($handle, [
                'ID', 
                'Client Name', 
                'Client Email', 
                'Project Name', 
                'Categories', 
                'Budget', 
                'Description', 
                'Status', 
                'Created At'
            ]);
            
            // Data
            foreach ($briefs as $brief) {
                fputcsv($handle, [
                    $brief->id,
                    $brief->user->name ?? '-',
                    $brief->user->email ?? '-',
                    $brief->project_name,
                    is_array($brief->categories) ? implode(' | ', $brief->categories) : $brief->categories,
                    $brief->budget ?? '-',
                    strip_tags($brief->description ?? '-'),
                    $brief->status,
                    $brief->created_at->format('d/m/Y H:i')
                ]);
            }
            
            fclose($handle);
        }, 200, [
            'Content-Type' => 'text/csv; charset=UTF-8',
            'Content-Disposition' => 'attachment; filename="' . $filename . '"',
            'Cache-Control' => 'private, max-age=0, must-revalidate',
        ]);
        
        return $response;
    }

    /*
    |--------------------------------------------------------------------------
    | PAYMENT MANAGEMENT
    |--------------------------------------------------------------------------
    */

    public function payments()
    {
        $payments = Payment::with('brief.user')
            ->orderBy('created_at', 'desc')
            ->get();
        
        $pendingCount = Payment::where('status', 'pending')->count();
        $totalRevenue = Payment::where('status', 'paid')->sum('amount');
        
        return view('admin.payments', compact('payments', 'pendingCount', 'totalRevenue'));
    }

    public function verifyPayment($id)
    {
        $payment = Payment::findOrFail($id);
        $payment->update([
            'status' => 'paid',
            'paid_at' => now(),
        ]);
        
        // Update brief status
        $payment->brief->update(['status' => 'approved']);
        
        return redirect()->back()->with('success', 'Pembayaran berhasil diverifikasi');
    }

    public function rejectPayment($id)
    {
        $payment = Payment::findOrFail($id);
        $payment->update([
            'status' => 'unpaid',
            'payment_proof' => null,
        ]);
        
        return redirect()->back()->with('warning', 'Pembayaran ditolak, client perlu upload ulang');
    }

    /*
    |--------------------------------------------------------------------------
    | CLIENTS
    |--------------------------------------------------------------------------
    */

    public function clients()
    {
        $clients = User::where('role', 'client')->latest()->get();
        return view('admin.clients', compact('clients'));
    }

    public function clientDetail($id)
    {
        $client = User::findOrFail($id);
        $briefs = Brief::where('user_id', $id)->orderBy('created_at', 'desc')->get();
        return view('admin.client-detail', compact('client', 'briefs'));
    }

    public function deleteClient($id)
    {
        $client = User::findOrFail($id);
        if ($client->role == 'client') {
            $client->delete();
            return redirect()->route('admin.clients')->with('success', 'Client berhasil dihapus');
        }
        return redirect()->back()->with('error', 'Tidak dapat menghapus user ini');
    }

    /*
    |--------------------------------------------------------------------------
    | TEAMS
    |--------------------------------------------------------------------------
    */

    public function teams()
    {
        $teams = User::where('role', 'team')->latest()->get();
        return view('admin.teams', compact('teams'));
    }

    public function createTeam()
    {
        return view('admin.team-create');
    }

    public function storeTeam(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:8',
        ]);

        $user = new User();
        $user->name = $request->name;
        $user->email = $request->email;
        $user->password = Hash::make($request->password);
        $user->role = 'team';
        $user->save();

        return redirect()->route('admin.teams')->with('success', 'Team berhasil ditambahkan');
    }

    public function editTeam($id)
    {
        $team = User::findOrFail($id);
        return view('admin.team-edit', compact('team'));
    }

    public function updateTeam(Request $request, $id)
    {
        $team = User::findOrFail($id);

        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,' . $team->id,
        ]);

        $team->name = $request->name;
        $team->email = $request->email;

        if ($request->filled('password')) {
            $team->password = Hash::make($request->password);
        }

        $team->save();

        return redirect()->route('admin.teams')->with('success', 'Data team berhasil diperbarui');
    }

    public function deleteTeam($id)
    {
        $team = User::findOrFail($id);
        $team->delete();

        return redirect()->route('admin.teams')->with('success', 'Team berhasil dihapus');
    }

    /*
    |--------------------------------------------------------------------------
    | TASK MANAGEMENT
    |--------------------------------------------------------------------------
    */

  public function tasks()
{
    $tasks = Task::with(['brief.user', 'assignedTo'])
        ->orderBy('created_at', 'desc')
        ->paginate(15);
    
    // Hitung statistik
    $stats = [
        'total' => Task::count(),
        'pending' => Task::where('status', 'pending')->count(),
        'in_progress' => Task::where('status', 'in_progress')->count(),
        'review' => Task::where('status', 'review')->count(),
        'completed' => Task::where('status', 'completed')->count(),
    ];
    
    $teams = User::where('role', 'team')->get();
    
    return view('admin.tasks', compact('tasks', 'stats', 'teams'));
}

public function taskDetail($id)
{
    $task = Task::with(['brief.user', 'assignedTo'])->findOrFail($id);
    return view('admin.task-detail', compact('task'));
}
    public function assignTask(Request $request)
    {
        $request->validate([
            'task_id' => 'required|exists:tasks,id',
            'assigned_to' => 'required|exists:users,id',
        ]);

        $task = Task::findOrFail($request->task_id);
        $task->update([
            'assigned_to' => $request->assigned_to,
            'status' => 'pending',
        ]);

        return redirect()->back()->with('success', 'Task berhasil diassign');
    }

    public function updateTaskStatus(Request $request, $id)
    {
        $task = Task::findOrFail($id);
        $task->update(['status' => $request->status]);
        
        return response()->json(['success' => true]);
    }

    public function deleteTask($id)
    {
        Task::findOrFail($id)->delete();
        return redirect()->back()->with('success', 'Task berhasil dihapus');
    }

    /*
    |--------------------------------------------------------------------------
    | PORTFOLIO
    |--------------------------------------------------------------------------
    */

    public function portfolios()
    {
        $portfolios = Portfolio::orderBy('order', 'asc')->get();
        $projects = Brief::where('status', 'completed')->get();
        return view('admin.portfolios', compact('portfolios', 'projects'));
    }

    public function createPortfolio(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'category' => 'required|string',
            'thumbnail' => 'required|image|max:2048',
            'brief_id' => 'required|exists:briefs,id',
        ]);

        $thumbnailPath = $request->file('thumbnail')->store('portfolios', 'public');
        
        Portfolio::create([
            'brief_id' => $request->brief_id,
            'title' => $request->title,
            'slug' => \Str::slug($request->title),
            'category' => $request->category,
            'label' => $request->label ?? $request->category,
            'description' => $request->description ?? '',
            'thumbnail' => $thumbnailPath,
            'client_name' => $request->client_name,
            'year' => $request->year ?? date('Y'),
            'results' => $request->results ? json_decode($request->results, true) : null,
            'status' => $request->has('is_published') ? 'published' : 'draft',
            'order' => Portfolio::max('order') + 1,
        ]);

        return redirect()->route('admin.portfolios')->with('success', 'Portfolio berhasil ditambahkan');
    }

    public function updatePortfolioStatus($id)
    {
        $portfolio = Portfolio::findOrFail($id);
        $portfolio->update(['is_published' => !$portfolio->is_published]);
        return response()->json(['success' => true]);
    }

    public function deletePortfolio($id)
    {
        Portfolio::findOrFail($id)->delete();
        return redirect()->back()->with('success', 'Portfolio berhasil dihapus');
    }

    /*
    |--------------------------------------------------------------------------
    | ANALYTICS
    |--------------------------------------------------------------------------
    */

    public function analytics()
    {
        $totalClients = User::where('role', 'client')->count();
        $totalTeams = User::where('role', 'team')->count();
        $totalBriefs = Brief::count();
        $pendingBriefs = Brief::where('status', 'pending')->count();
        $contactedBriefs = Brief::where('status', 'contacted')->count();
        $approvedBriefs = Brief::where('status', 'approved')->count();
        $rejectedBriefs = Brief::where('status', 'rejected')->count();
        $totalRevenue = Payment::where('status', 'paid')->sum('amount');
        
        $briefsByMonth = Brief::selectRaw('MONTH(created_at) as month, COUNT(*) as total')
            ->whereYear('created_at', date('Y'))
            ->groupBy('month')
            ->orderBy('month')
            ->get();
        
        $chartLabels = [];
        $chartData = [];
        for ($i = 1; $i <= 12; $i++) {
            $monthName = date('F', mktime(0, 0, 0, $i, 1));
            $chartLabels[] = $monthName;
            $found = $briefsByMonth->firstWhere('month', $i);
            $chartData[] = $found ? $found->total : 0;
        }
        
        return view('admin.analytics', compact(
            'totalClients',
            'totalTeams',
            'totalBriefs',
            'pendingBriefs',
            'contactedBriefs',
            'approvedBriefs',
            'rejectedBriefs',
            'totalRevenue',
            'chartLabels',
            'chartData'
        ));
    }

    /*
    |--------------------------------------------------------------------------
    | PROFILE
    |--------------------------------------------------------------------------
    */

    public function profile()
    {
        $user = Auth::user();
        return view('admin.profile', compact('user'));
    }

    public function updateProfile(Request $request)
    {
        /** @var \App\Models\User $user */
        $user = Auth::user();

        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,' . $user->id,
            'profile_photo' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
            'password' => 'nullable|min:8|confirmed',
        ]);

        $user->name = $request->name;
        $user->email = $request->email;

        if ($request->hasFile('profile_photo')) {
            $photo = $request->file('profile_photo');
            $filename = time() . '.' . $photo->getClientOriginalExtension();
            $photo->storeAs('profile-photos', $filename, 'public');
            $user->profile_photo = 'profile-photos/' . $filename;
        }

        if ($request->filled('password')) {
            $user->password = Hash::make($request->password);
        }

        $user->save();

        return redirect()->back()->with('success', 'Profile berhasil diperbarui');
    }

    public function uploadPhoto(Request $request)
    {
        $request->validate([
            'photo' => 'required|image|max:2048',
        ]);

        $photo = $request->file('photo');
        $filename = time() . '.' . $photo->getClientOriginalExtension();
        $photo->storeAs('profile-photos', $filename, 'public');
        
        $user = Auth::user();
        $user->profile_photo = 'profile-photos/' . $filename;
        $user->save();

        return response()->json([
            'success' => true,
            'photo_url' => asset('storage/profile-photos/' . $filename)
        ]);
    }
}