<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="dark">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, viewport-fit=cover">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Diver Entertainment - @yield('title', 'Creative Agency Digital')</title>
    
    <!-- Fonts -->
    <link href="https://api.fontshare.com/v2/css?f[]=satoshi@400,500,700,900&f[]=general-sans@400,500,600,700&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Inter:opsz,wght@14..32,100..900&display=swap" rel="stylesheet">
    
    <!-- Tailwind -->
    <script src="https://cdn.tailwindcss.com"></script>
    
    <!-- Alpine.js -->
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
    
    <!-- GSAP -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/3.12.5/gsap.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/3.12.5/ScrollTrigger.min.js"></script>
    
    <style>
        /* ============================================ */
        /* THEME: BLACK & WHITE + SOLID BLUE */
        /* ============================================ */
        :root {
            --black: #000000;
            --white: #ffffff;
            --blue: #00D2FF;
            --blue-dark: #0099cc;
            --gray-100: #1a1a1a;
            --gray-200: #2a2a2a;
            --gray-300: #3a3a3a;
            --gray-400: #6b6b6b;
            --gray-500: #9a9a9a;
        }
        
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }
        
        body {
            background: var(--black);
            color: var(--white);
            font-family: 'Satoshi', 'Inter', sans-serif;
            overflow-x: hidden;
        }
        
        /* Solid Blue Accents - No Animation */
        .text-blue { color: var(--blue) !important; }
        .bg-blue { background: var(--blue) !important; }
        .border-blue { border-color: var(--blue) !important; }
        
        /* Scrollbar */
        ::-webkit-scrollbar { width: 6px; }
        ::-webkit-scrollbar-track { background: var(--gray-100); }
        ::-webkit-scrollbar-thumb { background: var(--blue); border-radius: 3px; }
        
        /* Selection */
        ::selection { background: var(--blue); color: var(--black); }
        
        /* Glassmorphism */
        .glass {
            background: rgba(255, 255, 255, 0.03);
            backdrop-filter: blur(12px);
            border: 1px solid rgba(255, 255, 255, 0.06);
        }
        
        /* Navbar */
        .navbar {
            position: fixed;
            top: 0;
            width: 100%;
            z-index: 1000;
            background: var(--black);
            border-bottom: 1px solid rgba(0, 210, 255, 0.15);
            transition: all 0.3s ease;
        }
        
        .navbar-scrolled {
            border-bottom-color: rgba(0, 210, 255, 0.3);
        }
        
        .navbar-spacer {
            height: 80px;
        }
        
        @media (max-width: 768px) {
            .navbar-spacer { height: 70px; }
        }
        
        /* Buttons */
        .btn-primary {
            background: var(--blue);
            color: var(--black);
            transition: all 0.3s ease;
        }
        .btn-primary:hover {
            background: var(--blue-dark);
            transform: translateY(-2px);
        }
        
        .btn-outline {
            border: 1px solid var(--blue);
            color: var(--blue);
            transition: all 0.3s ease;
        }
        .btn-outline:hover {
            background: var(--blue);
            color: var(--black);
        }
        
        /* Link Hover */
        a { transition: color 0.3s ease; }
        a:hover { color: var(--blue); }
        
        /* Reveal Animation */
        .reveal {
            opacity: 0;
            transform: translateY(30px);
            transition: all 0.8s cubic-bezier(0.25, 0.46, 0.45, 0.94);
        }
        .reveal.active {
            opacity: 1;
            transform: translateY(0);
        }
        
        /* Loading Screen */
        .loading-screen {
            position: fixed;
            inset: 0;
            background: var(--black);
            z-index: 9999;
            display: flex;
            justify-content: center;
            align-items: center;
        }
        .loader {
            width: 40px;
            height: 40px;
            border: 2px solid var(--gray-300);
            border-top-color: var(--blue);
            border-radius: 50%;
            animation: spin 0.8s linear infinite;
        }
        @keyframes spin { to { transform: rotate(360deg); } }
        
        /* Typography */
        h1, h2, h3, h4, h5, h6 {
            font-weight: 700;
            letter-spacing: -0.02em;
        }
        
        /* Floating Blue Shapes Static */
        .floating-blue {
            position: fixed;
            background: radial-gradient(circle, rgba(0, 210, 255, 0.04) 0%, transparent 70%);
            border-radius: 50%;
            filter: blur(60px);
            pointer-events: none;
            z-index: 0;
        }
    </style>
    
    @stack('styles')
</head>
<body x-data="app()" x-init="init()">

    <!-- Loading Screen -->
    <div x-show="loading" class="loading-screen" x-transition:leave="transition duration-800" x-transition:leave-start="opacity-100" x-transition:leave-end="opacity-0">
        <div class="loader"></div>
    </div>
    
    <!-- Floating Blue Shapes -->
    <div class="floating-blue" style="width: 400px; height: 400px; top: 20%; left: -150px;"></div>
    <div class="floating-blue" style="width: 500px; height: 500px; bottom: 10%; right: -200px;"></div>
    
    <!-- Navbar -->
    <nav x-data="{ isOpen: false, scrolled: false }" 
         x-init="window.addEventListener('scroll', () => { scrolled = window.scrollY > 20 })"
         class="navbar"
         :class="scrolled ? 'navbar-scrolled' : ''">
        <div class="container mx-auto px-6">
            <div class="flex justify-between items-center h-20">
                <a href="/" class="text-2xl font-bold tracking-tighter">
                    <span class="text-white">DIVER</span>
                    <span class="text-blue">.ent</span>
                </a>
                
                <div class="hidden md:flex items-center space-x-8">
                    <a href="/" class="text-sm uppercase tracking-wider hover:text-blue transition">Home</a>
                    <a href="/explore" class="text-sm uppercase tracking-wider hover:text-blue transition">Explore</a>
                    <a href="/creators" class="text-sm uppercase tracking-wider hover:text-blue transition">Creators</a>
                    <a href="/contact" class="text-sm uppercase tracking-wider hover:text-blue transition">Contact</a>
                    
                    @auth
                        <a href="/dashboard" class="text-sm uppercase tracking-wider hover:text-blue transition">Dashboard</a>
                        <form method="POST" action="{{ route('logout') }}" class="inline">
                            @csrf
                            <button type="submit" class="text-sm uppercase tracking-wider hover:text-blue transition">Logout</button>
                        </form>
                    @else
                        <a href="/login" class="px-6 py-2 border border-blue rounded-full text-sm uppercase tracking-wider hover:bg-blue hover:text-black transition">Sign In</a>
                    @endauth
                </div>
                
                <button @click="isOpen = !isOpen" class="md:hidden text-white">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path x-show="!isOpen" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"/>
                        <path x-show="isOpen" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                    </svg>
                </button>
            </div>
            
            <div x-show="isOpen" x-transition.duration.300ms class="md:hidden pb-4 space-y-3">
                <a href="/" class="block text-sm uppercase tracking-wider hover:text-blue transition py-2">Home</a>
                <a href="/explore" class="block text-sm uppercase tracking-wider hover:text-blue transition py-2">Explore</a>
                <a href="/creators" class="block text-sm uppercase tracking-wider hover:text-blue transition py-2">Creators</a>
                <a href="/contact" class="block text-sm uppercase tracking-wider hover:text-blue transition py-2">Contact</a>
                @auth
                    <a href="/dashboard" class="block text-sm uppercase tracking-wider hover:text-blue transition py-2">Dashboard</a>
                @else
                    <a href="/login" class="block px-6 py-2 border border-blue rounded-full text-sm uppercase tracking-wider text-center hover:bg-blue hover:text-black transition">Sign In</a>
                @endauth
            </div>
        </div>
    </nav>
    
    <div class="navbar-spacer"></div>
    
    <main>
        @yield('content')
    </main>
    
    <!-- Footer -->
    <footer class="bg-black border-t border-blue/10 py-16 mt-20">
        <div class="container mx-auto px-6">
            <div class="grid grid-cols-1 md:grid-cols-4 gap-12 mb-12">
                <div>
                    <h3 class="text-2xl font-bold mb-4">DIVER<span class="text-blue">.ent</span></h3>
                    <p class="text-gray-500 text-sm">Your diving buddy to elevate your brand. Creative agency based in Medan.</p>
                </div>
                <div>
                    <h4 class="font-semibold mb-4 uppercase text-xs tracking-wider text-blue">Explore</h4>
                    <ul class="space-y-2 text-sm text-gray-400">
                        <li><a href="/" class="hover:text-blue transition">Home</a></li>
                        <li><a href="/explore" class="hover:text-blue transition">Projects</a></li>
                        <li><a href="/creators" class="hover:text-blue transition">Creators</a></li>
                        <li><a href="/contact" class="hover:text-blue transition">Contact</a></li>
                    </ul>
                </div>
                <div>
                    <h4 class="font-semibold mb-4 uppercase text-xs tracking-wider text-blue">Social</h4>
                    <ul class="space-y-2 text-sm text-gray-400">
                        <li><a href="#" class="hover:text-blue transition">Instagram</a></li>
                        <li><a href="#" class="hover:text-blue transition">Behance</a></li>
                        <li><a href="#" class="hover:text-blue transition">LinkedIn</a></li>
                        <li><a href="#" class="hover:text-blue transition">Twitter</a></li>
                    </ul>
                </div>
                <div>
                    <h4 class="font-semibold mb-4 uppercase text-xs tracking-wider text-blue">Contact</h4>
                    <ul class="space-y-2 text-sm text-gray-400">
                        <li>hello@diver.ent</li>
                        <li>+62 812 3456 7890</li>
                        <li>Medan, Indonesia</li>
                    </ul>
                </div>
            </div>
            <div class="pt-8 border-t border-white/10 text-center text-gray-500 text-sm">
                <p>&copy; 2024 Diver Entertainment. All rights reserved.</p>
            </div>
        </div>
    </footer>
    
    <script>
        function app() {
            return {
                loading: true,
                init() {
                    setTimeout(() => { this.loading = false; }, 1000);
                    
                    // Reveal animations
                    const reveals = document.querySelectorAll('.reveal');
                    const observer = new IntersectionObserver((entries) => {
                        entries.forEach(entry => {
                            if (entry.isIntersecting) entry.target.classList.add('active');
                        });
                    }, { threshold: 0.1 });
                    reveals.forEach(el => observer.observe(el));
                }
            }
        }
    </script>
    
    @stack('scripts')
</body>
</html>