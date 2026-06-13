<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use App\Models\User;
use App\Models\Brief;
use App\Models\Payment;

class ClientAreaController extends Controller
{
    // ==================== DASHBOARD & OVERVIEW ====================
    
    public function index()
    {
        $user = Auth::user();
        $totalBriefs = Brief::where('user_id', $user->id)->count();
        $pendingBriefs = Brief::where('user_id', $user->id)->where('status', 'pending')->count();
        $approvedBriefs = Brief::where('user_id', $user->id)->where('status', 'approved')->count();
        
        return view('client.dashboard', compact('user', 'totalBriefs', 'pendingBriefs', 'approvedBriefs'));
    }

    public function overview()
    {
        return $this->index();
    }

    public function dashboard()
    {
        return $this->index();
    }

    // ==================== CREATE PROJECT ====================
    
    public function createProject()
    {
        return view('client.create-project');
    }

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

        // Simpan ke database
        $brief = Brief::create([
            'user_id' => Auth::id(),
            'project_name' => $request->project_name,
            'categories' => json_encode($request->services ?? []),
            'budget' => $request->budget,
            'description' => $request->custom_request,
            'status' => 'pending',
        ]);

        return redirect()->route('client.projects')->with('success', 'Project berhasil diajukan! Menunggu review admin.');
    }

    // ==================== MY PROJECTS ====================
    
    public function projects()
    {
        $user = Auth::user();
        $briefs = Brief::where('user_id', $user->id)
            ->orderBy('created_at', 'desc')
            ->get();
        
        return view('client.my-projects', compact('briefs'));
    }

    public function showProject($id)
    {
        $user = Auth::user();
        $brief = Brief::where('user_id', $user->id)
            ->with('payment')
            ->findOrFail($id);
        
        return view('client.project-detail', compact('brief'));
    }

    public function requestRevision(Request $request, $id)
    {
        $request->validate([
            'revision_note' => 'required|string|min:3'
        ]);

        $brief = Brief::where('user_id', Auth::id())->findOrFail($id);
        $brief->update(['status' => 'revision']);
        
        return redirect()->back()->with('success', 'Permintaan revisi telah dikirim ke tim!');
    }

    public function approveProject($id)
    {
        $brief = Brief::where('user_id', Auth::id())->findOrFail($id);
        $brief->update(['status' => 'waiting_approval']);
        
        return redirect()->back()->with('success', 'Proyek disetujui! Silakan lanjut ke pembayaran.');
    }

    // ==================== PAYMENTS ====================
    
    public function payments()
    {
        $user = Auth::user();
        
        $approvedBriefs = Brief::where('user_id', $user->id)
            ->where('status', 'approved')
            ->with('payment')
            ->orderBy('created_at', 'desc')
            ->get();
        
        $payments = Payment::whereHas('brief', function($query) use ($user) {
            $query->where('user_id', $user->id);
        })->with('brief')->orderBy('created_at', 'desc')->get();
        
        $totalUnpaid = $approvedBriefs->filter(function($brief) {
            return !$brief->payment || $brief->payment->status == 'unpaid';
        })->count();
        
        $totalPaid = Payment::whereHas('brief', function($query) use ($user) {
            $query->where('user_id', $user->id);
        })->where('status', 'paid')->sum('amount');
        
        return view('client.payments', compact('approvedBriefs', 'payments', 'totalUnpaid', 'totalPaid'));
    }

    public function uploadPaymentProof(Request $request, $briefId)
    {
        $request->validate([
            'payment_proof' => 'required|image|mimes:jpg,jpeg,png|max:2048',
            'amount' => 'required|numeric|min:0',
        ]);

        $brief = Brief::where('user_id', Auth::id())->findOrFail($briefId);
        
        $proofPath = $request->file('payment_proof')->store('payment-proofs', 'public');
        
        $invoiceNumber = 'INV-' . date('Ymd') . '-' . str_pad($brief->id, 4, '0', STR_PAD_LEFT);
        
        $payment = Payment::updateOrCreate(
            ['brief_id' => $brief->id],
            [
                'amount' => $request->amount,
                'invoice_number' => $invoiceNumber,
                'payment_proof' => $proofPath,
                'status' => 'pending',
                'paid_at' => null,
            ]
        );
        
        return redirect()->route('client.payments')->with('success', 'Bukti pembayaran diupload! Menunggu verifikasi admin.');
    }

    public function invoices()
    {
        $user = Auth::user();
        $payments = Payment::whereHas('brief', function($query) use ($user) {
            $query->where('user_id', $user->id);
        })->with('brief')->orderBy('created_at', 'desc')->get();
        
        return view('client.invoices', compact('payments'));
    }

    public function showInvoice($id)
    {
        $payment = Payment::with('brief')->findOrFail($id);
        
        if ($payment->brief->user_id != Auth::id()) {
            abort(403, 'Unauthorized');
        }
        
        return view('client.invoice-detail', compact('payment'));
    }

    // ==================== NOTIFICATIONS ====================
    
    public function notifications()
    {
        $user = Auth::user();
        $notifications = $this->getNotifications($user);
        
        return view('client.notifications', compact('notifications'));
    }

    public function markNotificationRead($id)
    {
        return redirect()->back()->with('success', 'Notifikasi ditandai sudah dibaca');
    }

    public function markAllNotificationsRead()
    {
        return redirect()->back()->with('success', 'Semua notifikasi ditandai sudah dibaca');
    }

    // ==================== PROFILE ====================
    
    public function profile()
    {
        $user = Auth::user();
        return view('client.profile', compact('user'));
    }

    public function updateProfile(Request $request)
    {
        $user = Auth::user();
        
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,' . $user->id,
            'phone' => 'nullable|string|max:20',
            'profile_photo' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'current_password' => 'nullable|required_with:new_password',
            'new_password' => 'nullable|min:6|confirmed',
        ]);
        
        // Update basic info
        $user->name = $request->name;
        $user->email = $request->email;
        $user->phone = $request->phone;
        
        // Update password jika ada
        if ($request->filled('current_password')) {
            if (!Hash::check($request->current_password, $user->password)) {
                return redirect()->back()->with('error', 'Password saat ini salah.');
            }
            $user->password = Hash::make($request->new_password);
        }
        
        // Update foto profil
        if ($request->hasFile('profile_photo')) {
            // Hapus foto lama jika ada
            if ($user->profile_photo && Storage::disk('public')->exists($user->profile_photo)) {
                Storage::disk('public')->delete($user->profile_photo);
            }
            
            $path = $request->file('profile_photo')->store('profile-photos', 'public');
            $user->profile_photo = $path;
        }
        
        $user->save();
        
        // ✅ REDIRECT dengan flash message
        return redirect()->route('client.profile')->with('success', 'Profil berhasil diperbarui!');
    }

    public function uploadProfilePicture(Request $request)
    {
        $request->validate([
            'profile_pic' => 'required|image|max:2048'
        ]);

        $path = $request->file('profile_pic')->store('profile-photos', 'public');
        $user = Auth::user();
        $user->profile_photo = $path;
        $user->save();
        
        return redirect()->route('client.profile')->with('success', 'Foto profil berhasil diperbarui!');
    }

    public function changePassword(Request $request)
    {
        $request->validate([
            'current_password' => 'required|string',
            'new_password' => 'required|string|min:6|confirmed',
        ]);
        
        $user = Auth::user();
        
        if (!Hash::check($request->current_password, $user->password)) {
            return redirect()->back()->with('error', 'Password saat ini salah.');
        }
        
        $user->password = Hash::make($request->new_password);
        $user->save();
        
        return redirect()->route('client.profile')->with('success', 'Password berhasil diubah!');
    }

    // ==================== LOGOUT ====================
    
    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        
        return redirect('/')->with('success', 'Anda telah logout');
    }

    // ==================== PRIVATE METHODS ====================

    private function getRecentActivities($user)
    {
        $recentBriefs = Brief::where('user_id', $user->id)
            ->orderBy('created_at', 'desc')
            ->limit(5)
            ->get();
        
        $activities = [];
        foreach ($recentBriefs as $brief) {
            $activities[] = (object)[
                'type' => 'project',
                'title' => $brief->project_name,
                'message' => 'Status: ' . ucfirst($brief->status),
                'date' => $brief->created_at,
                'icon' => '📁'
            ];
        }
        
        if (empty($activities)) {
            return [
                (object)[
                    'type' => 'info',
                    'title' => 'Welcome!',
                    'message' => 'Mulai kerjasama dengan diver.ent',
                    'date' => now(),
                    'icon' => '👋'
                ]
            ];
        }
        
        return $activities;
    }

    private function getNotifications($user)
    {
        $notifications = [];
        
        $pendingBriefs = Brief::where('user_id', $user->id)
            ->where('status', 'pending')
            ->count();
        
        if ($pendingBriefs > 0) {
            $notifications[] = (object)[
                'id' => 1,
                'title' => 'Brief Menunggu Review',
                'message' => $pendingBriefs . ' brief sedang menunggu review admin',
                'is_read' => false,
                'date' => now(),
                'link' => route('client.projects')
            ];
        }
        
        $approvedBriefs = Brief::where('user_id', $user->id)
            ->where('status', 'approved')
            ->count();
        
        if ($approvedBriefs > 0) {
            $notifications[] = (object)[
                'id' => 2,
                'title' => 'Brief Disetujui',
                'message' => $approvedBriefs . ' brief telah disetujui, silakan lakukan pembayaran',
                'is_read' => false,
                'date' => now(),
                'link' => route('client.payments')
            ];
        }
        
        if (empty($notifications)) {
            return [
                (object)[
                    'id' => 0,
                    'title' => 'Tidak Ada Notifikasi',
                    'message' => 'Belum ada notifikasi baru',
                    'is_read' => true,
                    'date' => now(),
                    'link' => '#'
                ]
            ];
        }
        
        return $notifications;
    }
}