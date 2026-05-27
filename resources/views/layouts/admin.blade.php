
<!DOCTYPE html>
<html lang="id" data-theme="dark">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Admin Panel - diver.ent</title>
    <meta name="description" content="Admin Panel diver.ent - Kelola agency digital marketing">
    
    <!-- Fonts & Icons -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@400;500;600;700;800&family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    
    <!-- Vite Assets -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    
    <!-- Theme Script -->
    <script>
        const savedTheme = localStorage.getItem('theme') || 'dark';
        document.documentElement.setAttribute('data-theme', savedTheme);
    </script>
    
    <style>
        /* Global CSS Variables */
        :root {
            --sidebar-width: 280px;
            --header-height: 70px;
        }
        
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }
        
        body {
            font-family: var(--font-body);
            background: var(--bg);
            color: var(--text);
            line-height: 1.6;
            overflow-x: hidden;
        }
        
        .container {
            width: 90%;
            max-width: 1320px;
            margin: 0 auto;
        }
        
        /* Admin Main Content */
        .admin-main {
            margin-left: var(--sidebar-width);
            margin-top: var(--header-height);
            min-height: calc(100vh - var(--header-height));
            background: var(--bg);
        }
        
        /* Responsive */
        @media (max-width: 768px) {
            .admin-main {
                margin-left: 0;
                margin-top: var(--header-height);
            }
        }
        
        /* Animations */
        @keyframes fadeIn {
            from {
                opacity: 0;
                transform: translateY(-10px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }
        
        .fade-in {
            animation: fadeIn 0.3s ease;
        }
    </style>
</head>
<body>
    {{-- Admin Sidebar & Header (sudah include di dalam sidebar.blade.php) --}}
    @include('admin.sidebar')
    
    {{-- Main Content --}}
    <main class="admin-main">
        @yield('content')
    </main>
    
    {{-- Additional Scripts --}}
    @stack('scripts')
    
    {{-- Global Admin Scripts --}}
    <script>
        // Close sidebar on click outside (mobile)
        document.addEventListener('DOMContentLoaded', function() {
            const mobileToggle = document.getElementById('mobileToggle');
            const sidebar = document.querySelector('.app-sidebar');
            
            if (mobileToggle && sidebar) {
                mobileToggle.addEventListener('click', function() {
                    sidebar.classList.toggle('open');
                });
            }
            
            // Close sidebar when clicking outside on mobile
            document.addEventListener('click', function(e) {
                if (window.innerWidth <= 768 && sidebar && sidebar.classList.contains('open')) {
                    if (!sidebar.contains(e.target) && !mobileToggle?.contains(e.target)) {
                        sidebar.classList.remove('open');
                    }
                }
            });
        });
    </script>
</body>
</html>