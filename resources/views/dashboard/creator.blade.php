@extends('layouts.app')

@section('title', 'Creator Dashboard - Diver Entertainment')

@section('content')

<style>
    .stat-card { background: rgba(255, 255, 255, 0.03); border-radius: 20px; padding: 20px; border: 1px solid rgba(255, 255, 255, 0.06); transition: all 0.3s; }
    .stat-card:hover { border-color: rgba(0,210,255,0.3); transform: translateY(-3px); }
    
    .project-table { width: 100%; border-collapse: collapse; }
    .project-table th, .project-table td { padding: 16px 12px; text-align: left; border-bottom: 1px solid rgba(255,255,255,0.06); }
    .project-table th { color: #9a9a9a; font-weight: 500; font-size: 13px; letter-spacing: 0.5px; }
    .project-table td { color: #e0e0e0; }
    
    .status-badge { display: inline-flex; align-items: center; gap: 6px; padding: 5px 12px; border-radius: 30px; font-size: 12px; font-weight: 500; }
    .status-approved { background: rgba(0,210,255,0.12); color: #00D2FF; border: 1px solid rgba(0,210,255,0.2); }
    .status-pending { background: rgba(255,165,0,0.12); color: #ffa500; border: 1px solid rgba(255,165,0,0.2); }
    .status-rejected { background: rgba(255,68,68,0.12); color: #ff4444; border: 1px solid rgba(255,68,68,0.2); }
    
    .cancel-btn {
        display: inline-flex;
        align-items: center;
        gap: 8px;
        padding: 8px 16px;
        background: rgba(255,68,68,0.1);
        border: 1px solid rgba(255,68,68,0.3);
        border-radius: 30px;
        color: #ff6666;
        font-size: 12px;
        font-weight: 500;
        cursor: pointer;
        transition: all 0.3s ease;
    }
    .cancel-btn:hover {
        background: rgba(255,68,68,0.2);
        border-color: #ff4444;
        color: #ff8888;
        transform: scale(1.02);
    }
    .cancel-btn svg {
        width: 14px;
        height: 14px;
    }
    
    .empty-state { text-align: center; padding: 60px 20px; }
    .empty-state svg { width: 80px; height: 80px; margin-bottom: 20px; opacity: 0.3; }
    
    /* Modal Popup */
    .modal-overlay {
        position: fixed;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        background: rgba(0,0,0,0.8);
        backdrop-filter: blur(8px);
        z-index: 1000;
        display: flex;
        align-items: center;
        justify-content: center;
        opacity: 0;
        visibility: hidden;
        transition: all 0.3s ease;
    }
    .modal-overlay.active {
        opacity: 1;
        visibility: visible;
    }
    .modal-container {
        background: #0a0a0a;
        border: 1px solid rgba(255,68,68,0.3);
        border-radius: 24px;
        padding: 32px;
        max-width: 400px;
        width: 90%;
        text-align: center;
        transform: scale(0.9);
        transition: transform 0.3s ease;
    }
    .modal-overlay.active .modal-container {
        transform: scale(1);
    }
    .modal-icon {
        width: 64px;
        height: 64px;
        background: rgba(255,68,68,0.15);
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        margin: 0 auto 20px;
    }
    .modal-title {
        font-size: 1.5rem;
        font-weight: 700;
        margin-bottom: 12px;
    }
    .modal-message {
        color: #9a9a9a;
        margin-bottom: 24px;
        line-height: 1.5;
    }
    .modal-buttons {
        display: flex;
        gap: 12px;
        justify-content: center;
    }
    .modal-btn {
        padding: 10px 24px;
        border-radius: 40px;
        font-weight: 600;
        font-size: 14px;
        cursor: pointer;
        transition: all 0.3s;
        border: none;
    }
    .modal-btn-cancel {
        background: rgba(255,255,255,0.1);
        color: #fff;
    }
    .modal-btn-cancel:hover {
        background: rgba(255,255,255,0.2);
    }
    .modal-btn-confirm {
        background: #ff4444;
        color: #fff;
    }
    .modal-btn-confirm:hover {
        background: #ff6666;
        transform: scale(1.02);
    }
</style>

<div class="py-24 px-6">
    <div class="container mx-auto max-w-7xl">
        <!-- Header -->
        <div class="flex justify-between items-center mb-8 flex-wrap gap-4">
            <div>
                <h1 class="text-3xl md:text-4xl font-bold">Creator <span class="gradient-blue">Dashboard</span></h1>
                <p class="text-gray-400 mt-1">Manage your projects and track your performance</p>
            </div>
            <a href="{{ route('creator.projects.create') }}" class="flex items-center gap-2 px-5 py-2 bg-blue text-black rounded-full text-sm font-semibold hover:bg-blue-dark transition">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path></svg>
                New Project
            </a>
        </div>
        
        <!-- Stats -->
        <div class="grid grid-cols-2 md:grid-cols-4 gap-4 mb-8">
            <div class="stat-card text-center">
                <div class="text-2xl font-bold text-blue">{{ $totalProjects }}</div>
                <div class="text-sm text-gray-400">Total Projects</div>
            </div>
            <div class="stat-card text-center">
                <div class="text-2xl font-bold text-blue">{{ number_format($totalViews) }}</div>
                <div class="text-sm text-gray-400">Total Views</div>
            </div>
            <div class="stat-card text-center">
                <div class="text-2xl font-bold text-blue">{{ number_format($totalLikes) }}</div>
                <div class="text-sm text-gray-400">Total Likes</div>
            </div>
            <div class="stat-card text-center">
                <div class="text-2xl font-bold text-blue">{{ number_format($followersCount) }}</div>
                <div class="text-sm text-gray-400">Followers</div>
            </div>
        </div>
        
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
            <!-- Projects Table -->
            <div class="lg:col-span-2 glass rounded-2xl p-6">
                <h2 class="text-xl font-bold mb-4">Your Projects</h2>
                
                @if($projects->count() > 0)
                <div class="overflow-x-auto">
                    <table class="project-table">
                        <thead>
                            <tr>
                                <th>Project</th>
                                <th>Status</th>
                                <th>Views</th>
                                <th>Likes</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($projects as $project)
                            <tr>
                                <td class="font-medium">{{ $project->title }}</td>
                                <td>
                                    <span class="status-badge status-{{ $project->status }}">
                                        <span>●</span> {{ ucfirst($project->status) }}
                                    </span>
                                </td>
                                <td>{{ number_format($project->views) }}</td>
                                <td>{{ number_format($project->likes_count) }}</td>
                                <td>
                                    @if($project->status === 'pending')
                                    <button onclick="showCancelModal({{ $project->id }}, '{{ addslashes($project->title) }}')" 
                                            class="cancel-btn">
                                        <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                                        </svg>
                                        Cancel
                                    </button>
                                    <form id="delete-form-{{ $project->id }}" action="{{ route('creator.projects.destroy', $project->id) }}" method="POST" style="display: none;">
                                        @csrf
                                        @method('DELETE')
                                    </form>
                                    @endif
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                @else
                <div class="empty-state">
                    <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                    </svg>
                    <h3 class="text-xl font-bold mb-2">No Projects Yet</h3>
                    <p class="text-gray-400 mb-4">You haven't uploaded any projects yet.</p>
                    <a href="{{ route('creator.projects.create') }}" class="px-6 py-2 bg-blue text-black rounded-full text-sm font-semibold hover:bg-blue-dark transition">
                        + Upload Your First Project
                    </a>
                </div>
                @endif
            </div>
            
            <!-- Quick Stats -->
            <div class="space-y-4">
                <div class="glass rounded-2xl p-6">
                    <h3 class="font-bold mb-3">Performance</h3>
                    <div>
                        <div class="flex justify-between text-sm mb-1">
                            <span>Engagement Rate</span>
                            <span class="text-blue">{{ $engagementRate }}%</span>
                        </div>
                        <div class="h-2 bg-white/10 rounded-full">
                            <div class="h-full w-[{{ min($engagementRate, 100) }}%] bg-blue rounded-full"></div>
                        </div>
                    </div>
                </div>
                
                <div class="glass rounded-2xl p-6">
                    <h3 class="font-bold mb-3">Tips for Success</h3>
                    <ul class="space-y-2 text-sm text-gray-400">
                        <li>✓ Post consistently</li>
                        <li>✓ Use relevant hashtags</li>
                        <li>✓ Engage with your audience</li>
                        <li>✓ High quality thumbnails</li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Modal Konfirmasi Cancel -->
<div id="cancelModal" class="modal-overlay">
    <div class="modal-container">
        <div class="modal-icon">
            <svg class="w-8 h-8 text-red-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"></path>
            </svg>
        </div>
        <h3 class="modal-title">Cancel Project</h3>
        <p class="modal-message" id="modalMessage">Are you sure you want to cancel this project?<br>This action cannot be undone!</p>
        <div class="modal-buttons">
            <button onclick="closeModal()" class="modal-btn modal-btn-cancel">No, Keep</button>
            <button onclick="confirmDelete()" class="modal-btn modal-btn-confirm">Yes, Cancel</button>
        </div>
    </div>
</div>

@push('scripts')
<script>
    let currentProjectId = null;
    
    function showCancelModal(projectId, projectTitle) {
        currentProjectId = projectId;
        document.getElementById('modalMessage').innerHTML = `Are you sure you want to cancel project "<strong>${projectTitle}</strong>"?<br>This action cannot be undone!`;
        document.getElementById('cancelModal').classList.add('active');
    }
    
    function closeModal() {
        document.getElementById('cancelModal').classList.remove('active');
        currentProjectId = null;
    }
    
    function confirmDelete() {
        if (currentProjectId) {
            document.getElementById(`delete-form-${currentProjectId}`).submit();
        }
    }
    
    // Close modal when clicking outside
    document.getElementById('cancelModal').addEventListener('click', function(e) {
        if (e.target === this) {
            closeModal();
        }
    });
    
    // Close modal with Escape key
    document.addEventListener('keydown', function(e) {
        if (e.key === 'Escape') {
            closeModal();
        }
    });
</script>
@endpush

@endsection