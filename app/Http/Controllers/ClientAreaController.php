<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use App\Models\Brief;
use App\Models\Invoice;
use Illuminate\Support\Facades\Storage;
class ClientAreaController extends Controller
{
    /**
     * Constructor - apply middleware auth
     */
    // public function __construct()
    // {
    //     $this->middleware('auth');
    // }

    // ==================== DASHBOARD & OVERVIEW ====================
    
    /**
     * Display client area dashboard (overview)
     */
  public function index()
{
    $user = Auth::user();
    $totalBriefs = Brief::where('user_id', $user->id)->count();
    $pendingBriefs = Brief::where('user_id', $user->id)->where('status', 'pending')->count();
    $approvedBriefs = Brief::where('user_id', $user->id)->where('status', 'approved')->count();
    
    return view('client.dashboard', compact('user', 'totalBriefs', 'pendingBriefs', 'approvedBriefs'));
}

    /**
     * Display dashboard overview
     */
    public function overview()
    {
        return $this->index();
    }

    /**
     * Display dashboard (alias for index)
     */
    public function dashboard()
    {
        return $this->index();
    }

    // ==================== CREATE PROJECT ====================
    
    /**
     * Show create project form
     */
    public function createProject()
    {
        return view('client.create-project');
    }

    /**
     * Store new project
     */
    public function storeProject(Request $request)
    {
        $request->validate([
            'project_name' => 'required|string|max:255',
            'brand_name' => 'required|string|max:255',
            'campaign_name' => 'nullable|string|max:255',
            'services' => 'nullable|array',
            'start_date' => 'required|date',
            'deadline' => 'required|date|after:start_date',
            'event_time' => 'nullable',
            'location' => 'nullable|string',
            'budget' => 'required|numeric|min:0',
            'custom_request' => 'nullable|string',
            'ig_link' => 'nullable|url',
            'tiktok_link' => 'nullable|url',
            'pinterest_link' => 'nullable|url',
            'concept' => 'nullable|string',
            'visual_mood' => 'nullable|string',
            'target_audience' => 'nullable|string',
        ]);

        // TODO: Save to database
        // $project = Project::create([...]);

        return response()->json([
            'success' => true,
            'message' => 'Project submitted successfully! Waiting for admin review.',
            'redirect' => route('client.projects')
        ]);
    }

    // ==================== MY PROJECTS ====================
    
    /**
     * Display all client projects
     */
    public function projects()
    {
        $user = Auth::user();
        $projects = $this->getProjects($user);
        
        return view('client.my-projects', compact('projects'));
    }

    /**
     * Display single project detail
     */
    public function showProject($id)
    {
        $user = Auth::user();
        $projects = $this->getProjects($user);
        $project = collect($projects)->firstWhere('id', (int)$id);
        
        if (!$project) {
            abort(404, 'Project not found');
        }
        
        return view('client.project-detail', compact('project'));
    }

    /**
     * Request revision for project
     */
    public function requestRevision(Request $request, $id)
    {
        $request->validate([
            'revision_note' => 'required|string|min:3'
        ]);

        // TODO: Update project status to revision and save revision note
        
        return response()->json([
            'success' => true,
            'message' => 'Revision request sent to team!'
        ]);
    }

    /**
     * Approve project
     */
    public function approveProject($id)
    {
        // TODO: Update project status to waiting_approval
        
        return response()->json([
            'success' => true,
            'message' => 'Project approved! Proceeding to payment.'
        ]);
    }

    // ==================== PAYMENTS ====================
    
    /**
     * Display payments page
     */
    public function payments()
    {
        $user = Auth::user();
        $this->ensureUserHasInvoices($user);
        $invoices = $this->getInvoices($user);

        return view('client.payments', compact('invoices'));
    }

    /**
     * Display invoices list
     */
    public function invoices()
    {
        $user = Auth::user();
        $invoices = $this->getInvoices($user);
        
        return view('client.invoices', compact('invoices'));
    }

    /**
     * Display single invoice detail
     */
    public function showInvoice($id)
    {
        $user = Auth::user();
        $invoices = $this->getInvoices($user);
        $invoice = collect($invoices)->firstWhere('id', (int)$id);
        
        if (!$invoice) {
            abort(404, 'Invoice not found');
        }
        
        return view('client.invoice-detail', compact('invoice'));
    }

    /**
     * Upload payment proof
     */
    public function uploadPaymentProof(Request $request, $id)
    {
        $request->validate([
            'payment_proof' => 'required|image|max:2048',
        ]);

        $invoice = Invoice::where('user_id', Auth::id())->findOrFail($id);

        if ($invoice->payment_proof) {
            Storage::disk('public')->delete($invoice->payment_proof);
        }

        $path = $request->file('payment_proof')->store('payment_proofs', 'public');

        $invoice->update([
            'payment_proof' => $path,
            'status' => 'pending',
        ]);

        return redirect()
            ->route('client.payments')
            ->with('success', 'Bukti pembayaran berhasil diunggah. Menunggu verifikasi admin.');
    }

    // ==================== NOTIFICATIONS ====================
    
    /**
     * Display notifications page
     */
    public function notifications()
    {
        $user = Auth::user();
        $notifications = $this->getNotifications($user);
        
        return view('client.notifications', compact('notifications'));
    }

    /**
     * Mark notification as read
     */
    public function markNotificationRead($id)
    {
        // TODO: Update notification status
        
        return response()->json([
            'success' => true,
            'message' => 'Notification marked as read'
        ]);
    }

    /**
     * Mark all notifications as read
     */
    public function markAllNotificationsRead()
    {
        // TODO: Update all notifications status
        
        return response()->json([
            'success' => true,
            'message' => 'All notifications marked as read'
        ]);
    }

    // ==================== PROFILE ====================
    
    /**
     * Display client profile page
     */
    public function profile()
    {
        $user = Auth::user();
        return view('client.profile', compact('user'));
    }

    /**
     * Update client profile
     */
    public function updateProfile(Request $request)
    {
        $user = Auth::user();
        
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,' . $user->id,
            'phone' => 'nullable|string|max:20',
            'company' => 'nullable|string|max:255',
            'address' => 'nullable|string|max:500',
        ]);
        
        $user->update([
            'name' => $request->name,
            'email' => $request->email,
            'phone' => $request->phone,
            'company' => $request->company,
            'address' => $request->address,
        ]);
        
        return response()->json([
            'success' => true,
            'message' => 'Profile updated successfully!',
            'user' => $user
        ]);
    }

    /**
     * Upload profile picture
     */
    public function uploadProfilePicture(Request $request)
    {
        $request->validate([
            'profile_pic' => 'required|image|max:2048'
        ]);

        // TODO: Save profile picture
        
        return response()->json([
            'success' => true,
            'message' => 'Profile picture updated!'
        ]);
    }

    /**
     * Change password
     */
    public function changePassword(Request $request)
    {
        $request->validate([
            'current_password' => 'required|string',
            'new_password' => 'required|string|min:8|confirmed',
        ]);
        
        $user = Auth::user();
        
        if (!Hash::check($request->current_password, $user->password)) {
            return response()->json([
                'success' => false,
                'message' => 'Current password is incorrect'
            ], 422);
        }
        
        $user->update([
            'password' => Hash::make($request->new_password)
        ]);
        
        return response()->json([
            'success' => true,
            'message' => 'Password changed successfully!'
        ]);
    }

    // ==================== REPORTS ====================
    
    /**
     * Display client reports
     */
    public function reports()
    {
        $user = Auth::user();
        
        $data = [
            'user' => $user,
            'monthly_stats' => $this->getMonthlyStats($user),
            'campaign_performance' => $this->getCampaignPerformance($user),
        ];
        
        return view('client.reports', $data);
    }

    // ==================== SUPPORT / TICKETS ====================
    
    /**
     * Display support/ticket page
     */
    public function support()
    {
        $user = Auth::user();
        $tickets = $this->getTickets($user);
        
        return view('client.support', compact('tickets'));
    }

    /**
     * Create new support ticket
     */
    public function createTicket(Request $request)
    {
        $request->validate([
            'subject' => 'required|string|max:255',
            'message' => 'required|string',
            'priority' => 'required|in:low,medium,high',
        ]);
        
        // TODO: Save ticket to database
        
        return response()->json([
            'success' => true,
            'message' => 'Support ticket created successfully!'
        ]);
    }

    // ==================== SETTINGS ====================
    
    /**
     * Get user settings page
     */
    public function settings()
    {
        $user = Auth::user();
        return view('client.settings', compact('user'));
    }

    /**
     * Update user settings
     */
    public function updateSettings(Request $request)
    {
        $user = Auth::user();
        
        $request->validate([
            'email_notifications' => 'boolean',
            'whatsapp_notifications' => 'boolean',
            'language' => 'in:id,en',
        ]);
        
        $settings = [
            'email_notifications' => $request->email_notifications ?? false,
            'whatsapp_notifications' => $request->whatsapp_notifications ?? false,
            'language' => $request->language ?? 'id',
        ];
        
        $user->update([
            'settings' => json_encode($settings)
        ]);
        
        return response()->json([
            'success' => true,
            'message' => 'Settings updated successfully!'
        ]);
    }

    // ==================== LOGOUT ====================
    
    /**
     * Logout from client area
     */
    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        
        return redirect('/')->with('success', 'You have been logged out');
    }

    // ==================== PRIVATE METHODS (MOCK DATA) ====================

    /**
     * Get total projects count
     */
    private function getTotalProjects($user)
    {
        // TODO: Ambil dari database
        // return $user->projects()->count();
        return 5;
    }

    /**
     * Get active projects count
     */
    private function getActiveProjects($user)
    {
        // TODO: Ambil dari database
        // return $user->projects()->where('status', 'in_progress')->count();
        return 3;
    }

    /**
     * Get completed projects count
     */
    private function getCompletedProjects($user)
    {
        // TODO: Ambil dari database
        // return $user->projects()->where('status', 'completed')->count();
        return 2;
    }

    /**
     * Get total invoices count
     */
    private function getTotalInvoices($user)
    {
        // TODO: Ambil dari database
        // return $user->invoices()->count();
        return 4;
    }

    /**
     * Get pending invoices count
     */
    private function getPendingInvoices($user)
    {
        // TODO: Ambil dari database
        // return $user->invoices()->where('status', 'pending')->count();
        return 1;
    }

    /**
     * Get projects list
     */
    private function getProjects($user)
    {
        // TODO: Ambil dari database
        return [
            (object)[
                'id' => 1,
                'name' => 'Website Development - PT Maju Jaya',
                'description' => 'Pengembangan website corporate dengan fitur CMS dan dashboard admin',
                'category' => 'Website Development',
                'status' => 'in-progress',
                'progress' => 65,
                'deadline' => '2026-06-30',
                'budget' => 15000000,
                'icon' => '🌐'
            ],
            (object)[
                'id' => 2,
                'name' => 'Social Media Campaign - Brand Fashion',
                'description' => 'Instagram & TikTok content strategy dengan target engagement 15%',
                'category' => 'Social Media',
                'status' => 'review',
                'progress' => 90,
                'deadline' => '2026-05-25',
                'budget' => 8500000,
                'icon' => '📱'
            ],
            (object)[
                'id' => 3,
                'name' => 'Brand Identity - Coffee Shop',
                'description' => 'Pembuatan logo, color palette, dan brand guidelines',
                'category' => 'Branding',
                'status' => 'revision',
                'progress' => 85,
                'deadline' => '2026-05-20',
                'budget' => 5000000,
                'icon' => '🎨'
            ],
            (object)[
                'id' => 4,
                'name' => 'Google Ads Campaign - E-commerce',
                'description' => 'Optimasi campaign Google Ads untuk meningkatkan ROI',
                'category' => 'Digital Ads',
                'status' => 'completed',
                'progress' => 100,
                'deadline' => '2026-05-15',
                'budget' => 12500000,
                'icon' => '📢'
            ],
            (object)[
                'id' => 5,
                'name' => 'Commercial Video Production',
                'description' => 'Produksi video company profile dan iklan',
                'category' => 'Video Production',
                'status' => 'in-progress',
                'progress' => 40,
                'deadline' => '2026-06-10',
                'budget' => 20000000,
                'icon' => '🎬'
            ],
        ];
    }

    /**
     * Get invoices list
     */
    private function getInvoices($user)
    {
        return Invoice::query()
            ->where('user_id', $user->id)
            ->orderByDesc('due_date')
            ->get();
    }

    /**
     * Seed demo invoices for the user when none exist yet.
     */
    private function ensureUserHasInvoices(User $user): void
    {
        if (Invoice::where('user_id', $user->id)->exists()) {
            return;
        }

        Storage::disk('public')->makeDirectory('payment_proofs');

        $demoProofPath = null;
        $source = public_path('img/logo.png');
        if (is_file($source)) {
            $demoProofPath = 'payment_proofs/demo-user-' . $user->id . '.png';
            Storage::disk('public')->put($demoProofPath, file_get_contents($source));
        }

        $rows = [
            [
                'number' => 'INV-2026-001',
                'description' => 'Website Development - Phase 1',
                'amount' => 15000000,
                'status' => 'lunas',
                'due_date' => '2026-01-15',
                'issue_date' => '2026-01-01',
                'payment_proof' => $demoProofPath,
            ],
            [
                'number' => 'INV-2026-002',
                'description' => 'Social Media Management - March',
                'amount' => 8500000,
                'status' => 'diverifikasi',
                'due_date' => '2026-02-20',
                'issue_date' => '2026-02-01',
                'payment_proof' => $demoProofPath,
            ],
            [
                'number' => 'INV-2026-003',
                'description' => 'Google Ads Campaign - May',
                'amount' => 12500000,
                'status' => 'pending',
                'due_date' => '2026-05-30',
                'issue_date' => '2026-05-01',
                'payment_proof' => $demoProofPath,
            ],
            [
                'number' => 'INV-2026-004',
                'description' => 'SEO Optimization - Package A',
                'amount' => 5000000,
                'status' => 'pending',
                'due_date' => '2026-06-10',
                'issue_date' => '2026-05-15',
                'payment_proof' => null,
            ],
        ];

        foreach ($rows as $row) {
            Invoice::create(array_merge($row, ['user_id' => $user->id]));
        }
    }

    /**
     * Get support tickets
     */
    private function getTickets($user)
    {
        // TODO: Ambil dari database
        return [
            (object)[
                'id' => 1,
                'subject' => 'Technical Issue on Website',
                'message' => 'Website mengalami loading yang lambat',
                'status' => 'resolved',
                'priority' => 'high',
                'created_at' => now()->subDays(5)
            ],
            (object)[
                'id' => 2,
                'subject' => 'Request for Monthly Report',
                'message' => 'Mohon kirimkan laporan performa bulan April',
                'status' => 'in_progress',
                'priority' => 'medium',
                'created_at' => now()->subDays(2)
            ],
        ];
    }

    /**
     * Get recent activities for client
     */
    private function getRecentActivities($user)
    {
        // TODO: Ambil dari database
        return [
            (object)[
                'type' => 'project_update',
                'title' => 'Website Development Progress',
                'message' => 'Tim sedang mengerjakan halaman homepage dan integration API',
                'date' => now()->subHours(2),
                'icon' => '📁'
            ],
            (object)[
                'type' => 'report',
                'title' => 'Laporan Bulanan April 2026',
                'message' => 'Laporan performa campaign telah tersedia untuk diunduh',
                'date' => now()->subDays(1),
                'icon' => '📊'
            ],
            (object)[
                'type' => 'invoice',
                'title' => 'Invoice #INV-2026-003',
                'message' => 'Invoice baru telah diterbitkan, jatuh tempo 30 Mei 2026',
                'date' => now()->subDays(3),
                'icon' => '💰'
            ],
            (object)[
                'type' => 'message',
                'title' => 'Pesan dari Tim Support',
                'message' => 'Terima kasih telah mempercayakan project Anda kepada kami',
                'date' => now()->subDays(5),
                'icon' => '💬'
            ],
        ];
    }

    /**
     * Get notifications for client
     */
    private function getNotifications($user)
    {
        // TODO: Ambil dari database
        return [
            (object)[
                'id' => 1,
                'title' => 'Meeting Schedule',
                'message' => 'Jadwal meeting progress project hari Jumat, 10:00 WIB via Zoom',
                'is_read' => false,
                'date' => now()->subHours(5),
                'link' => '#'
            ],
            (object)[
                'id' => 2,
                'title' => 'Report Ready',
                'message' => 'Laporan bulan April 2026 siap diunduh di dashboard',
                'is_read' => false,
                'date' => now()->subDays(1),
                'link' => route('client.reports')
            ],
            (object)[
                'id' => 3,
                'title' => 'Payment Reminder',
                'message' => 'Invoice #INV-2026-003 akan jatuh tempo dalam 7 hari',
                'is_read' => true,
                'date' => now()->subDays(2),
                'link' => route('client.invoices')
            ],
            (object)[
                'id' => 4,
                'title' => 'Project Update',
                'message' => 'Progress Website Development mencapai 65%',
                'is_read' => true,
                'date' => now()->subDays(3),
                'link' => '#'
            ],
        ];
    }

    /**
     * Get monthly statistics
     */
    private function getMonthlyStats($user)
    {
        // TODO: Ambil dari database
        return [
            'impressions' => 125000,
            'clicks' => 8750,
            'conversions' => 432,
            'engagement_rate' => 4.8,
            'roi' => 285,
        ];
    }

    /**
     * Get campaign performance data
     */
    private function getCampaignPerformance($user)
    {
        // TODO: Ambil dari database
        return [
            'labels' => ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun'],
            'impressions' => [65, 72, 80, 85, 88, 92],
            'clicks' => [45, 52, 60, 68, 75, 82],
            'conversions' => [25, 30, 38, 45, 52, 60],
        ];
    }
}