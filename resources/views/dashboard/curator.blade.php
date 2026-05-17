@extends('layouts.app')

@section('title', 'Curator Dashboard - Diver Entertainment')

@section('content')

<style>
    .stat-card {
        background: rgba(255, 255, 255, 0.03);
        border-radius: 20px;
        padding: 20px;
        border: 1px solid rgba(255, 255, 255, 0.06);
        transition: all 0.3s;
    }
    .stat-card:hover {
        border-color: rgba(0,210,255,0.3);
        transform: translateY(-3px);
    }
    .approve-btn {
        background: rgba(34, 197, 94, 0.15);
        color: #22c55e;
        border: 1px solid rgba(34, 197, 94, 0.3);
        transition: all 0.3s;
    }
    .approve-btn:hover {
        background: #22c55e;
        color: black;
    }
    .reject-btn {
        background: rgba(239, 68, 68, 0.15);
        color: #ef4444;
        border: 1px solid rgba(239, 68, 68, 0.3);
        transition: all 0.3s;
    }
    .reject-btn:hover {
        background: #ef4444;
        color: white;
    }
    .project-thumb {
        width: 50px;
        height: 50px;
        object-fit: cover;
        border-radius: 10px;
    }
    .empty-state {
        text-align: center;
        padding: 60px 20px;
    }
    .empty-state svg {
        width: 80px;
        height: 80px;
        margin-bottom: 20px;
        opacity: 0.3;
    }
</style>

<div class="py-24 px-6">
    <div class="container mx-auto max-w-7xl">
        <div class="flex justify-between items-center mb-8">
            <div>
                <h1 class="text-3xl md:text-4xl font-bold">Curator <span class="gradient-blue">Dashboard</span></h1>
                <p class="text-gray-400 mt-1">Manage and curate featured content</p>
            </div>
        </div>
        
        <!-- Stats Cards -->
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">
            <div class="stat-card text-center">
                <div class="text-2xl font-bold text-blue">{{ $pendingCount }}</div>
                <div class="text-sm text-gray-400">Pending Approval</div>
            </div>
            <div class="stat-card text-center">
                <div class="text-2xl font-bold text-blue">{{ $featuredCount }}</div>
                <div class="text-sm text-gray-400">Featured Projects</div>
            </div>
            <div class="stat-card text-center">
                <div class="text-2xl font-bold text-blue">{{ $totalProjects }}</div>
                <div class="text-sm text-gray-400">Total Projects</div>
            </div>
        </div>
        
        <!-- Pending Approvals Table -->
        <div class="glass rounded-2xl p-6">
            <h2 class="text-xl font-bold mb-4">Pending Approvals</h2>
            
            @if($pendingProjects->count() > 0)
            <div class="overflow-x-auto">
                <table class="w-full">
                    <thead>
                        <tr class="border-b border-white/10">
                            <th class="text-left py-3">Project</th>
                            <th class="text-left py-3">Creator</th>
                            <th class="text-left py-3">Category</th>
                            <th class="text-left py-3">Submitted</th>
                            <th class="text-left py-3">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($pendingProjects as $project)
                        <tr class="border-b border-white/5 hover:bg-white/5 transition">
                            <td class="py-3">
                                <div class="flex items-center gap-3">
                                    <img src="{{ $project->thumbnail }}" class="project-thumb" alt="{{ $project->title }}">
                                    <span class="font-medium">{{ $project->title }}</span>
                                </div>
                            </td>
                            <td class="py-3">
                                <div class="flex items-center gap-2">
                                    <span>{{ $project->user->name ?? 'Unknown' }}</span>
                                </div>
                            </td>
                            <td class="py-3">
                                <span class="text-xs px-2 py-1 rounded-full bg-white/10">
                                    {{ $project->category->name ?? 'Uncategorized' }}
                                </span>
                            </td>
                            <td class="py-3 text-gray-400">
                                {{ $project->created_at->diffForHumans() }}
                            </td>
                            <td class="py-3">
                                <div class="flex gap-2">
                                    <form action="{{ route('curator.projects.approve', $project->id) }}" method="POST" class="inline">
                                        @csrf
                                        @method('POST')
                                        <button type="submit" class="approve-btn px-4 py-1.5 rounded-full text-xs font-semibold transition"
                                                onclick="return confirm('Approve project "{{ $project->title }}"?')">
                                            ✓ Approve
                                        </button>
                                    </form>
                                    <form action="{{ route('curator.projects.reject', $project->id) }}" method="POST" class="inline">
                                        @csrf
                                        @method('POST')
                                        <button type="submit" class="reject-btn px-4 py-1.5 rounded-full text-xs font-semibold transition"
                                                onclick="return confirm('Reject project "{{ $project->title }}"?')">
                                            ✗ Reject
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            @else
            <div class="empty-state">
                <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                </svg>
                <h3 class="text-xl font-bold mb-2">No Pending Projects</h3>
                <p class="text-gray-400">All projects have been reviewed. Great job!</p>
            </div>
            @endif
        </div>
    </div>
</div>

@if(session('success'))
<script>
    alert("{{ session('success') }}");
</script>
@endif

@endsection