<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Brief;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

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
        $brief = Brief::with('user')->findOrFail($id);
        return view('admin.brief-detail', compact('brief'));
    }

    public function updateBriefStatus(Request $request, $id)
    {
        $brief = Brief::findOrFail($id);
        
        $request->validate([
            'status' => 'required|in:pending,contacted,approved,rejected'
        ]);
        
        $brief->status = $request->status;
        $brief->save();
        
        if ($request->ajax()) {
            return response()->json([
                'success' => true,
                'message' => 'Status brief berhasil diperbarui',
                'status' => $brief->status
            ]);
        }
        
        return back()->with('success', 'Status brief berhasil diperbarui');
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
        return view('admin.client-detail', compact('client'));
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
    | PORTFOLIO
    |--------------------------------------------------------------------------
    */

    public function portfolio()
    {
        $portfolios = \App\Models\Portfolio::orderBy('order', 'asc')->get();
        return view('admin.portfolio', compact('portfolios'));
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
        
        // Chart data
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

        'email' =>
            'required|email|unique:users,email,' . $user->id,

        'profile_photo' =>
            'nullable|image|mimes:jpg,jpeg,png|max:2048',

        'password' =>
            'nullable|min:8|confirmed',

    ]);

    /*
    |--------------------------------------------------------------------------
    | UPDATE BASIC
    |--------------------------------------------------------------------------
    */

    $user->name = $request->name;

    $user->email = $request->email;

    /*
    |--------------------------------------------------------------------------
    | UPLOAD PHOTO
    |--------------------------------------------------------------------------
    */

    if ($request->hasFile('profile_photo')) {

        $photo =
            $request->file('profile_photo');

        $filename =
            time() . '.' .
            $photo->getClientOriginalExtension();

        $photo->storeAs(

            'profile-photos',

            $filename,

            'public'

        );

        $user->profile_photo =
            'profile-photos/' . $filename;
    }

    /*
    |--------------------------------------------------------------------------AAA
    | PASSWORD
    |--------------------------------------------------------------------------
    */

    if ($request->filled('password')) {

        $user->password = Hash::make(
            $request->password
        );
    }

    /*
    |--------------------------------------------------------------------------
    | SAVE
    |--------------------------------------------------------------------------
    */

    $user->save();

    return redirect()
        ->back()
        ->with(

            'success',

            'Profile berhasil diperbarui'

        );
}
}