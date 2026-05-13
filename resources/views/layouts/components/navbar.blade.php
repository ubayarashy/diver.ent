<nav x-data="{ isOpen: false, scrolled: false }" 
     x-init="window.addEventListener('scroll', () => { scrolled = window.scrollY > 50 })"
     class="fixed top-0 w-full z-50 transition-all duration-500"
     :class="scrolled ? 'bg-black/95 backdrop-blur-xl border-b border-white/10 py-4' : 'bg-transparent py-6'">
    <div class="container mx-auto px-6">
        <div class="flex justify-between items-center">
            <!-- Logo -->
            <a href="/" class="text-2xl font-bold tracking-tighter">
                <span class="bg-gradient-to-r from-white to-gray-500 bg-clip-text text-transparent">
                    DIVER
                </span>
                <span class="text-xs text-gray-400">.ent</span>
            </a>
            
            <!-- Desktop Menu -->
            <div class="hidden md:flex items-center space-x-8">
                <a href="/" class="text-sm uppercase tracking-wider hover:text-gray-300 transition">Home</a>
                <a href="/explore" class="text-sm uppercase tracking-wider hover:text-gray-300 transition">Explore</a>
                <a href="/creators" class="text-sm uppercase tracking-wider hover:text-gray-300 transition">Creators</a>
                <a href="/contact" class="text-sm uppercase tracking-wider hover:text-gray-300 transition">Contact</a>
                
                @auth
                    <a href="/dashboard" class="text-sm uppercase tracking-wider hover:text-gray-300 transition">Dashboard</a>
                    <form method="POST" action="{{ route('logout') }}" class="inline">
                        @csrf
                        <button type="submit" class="text-sm uppercase tracking-wider hover:text-gray-300 transition">Logout</button>
                    </form>
                @else
                    <a href="/login" class="px-6 py-2 border border-white/20 rounded-full text-sm uppercase tracking-wider hover:bg-white hover:text-black transition-all duration-300 magnetic-btn">
                        Sign In
                    </a>
                @endauth
            </div>
            
            <!-- Mobile Menu Button -->
            <button @click="isOpen = !isOpen" class="md:hidden">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path x-show="!isOpen" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"/>
                    <path x-show="isOpen" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                </svg>
            </button>
        </div>
        
        <!-- Mobile Menu -->
        <div x-show="isOpen" x-transition.duration.300ms class="md:hidden mt-4 pb-4 space-y-3">
            <a href="/" class="block text-sm uppercase tracking-wider hover:text-gray-300 transition py-2">Home</a>
            <a href="/explore" class="block text-sm uppercase tracking-wider hover:text-gray-300 transition py-2">Explore</a>
            <a href="/creators" class="block text-sm uppercase tracking-wider hover:text-gray-300 transition py-2">Creators</a>
            <a href="/contact" class="block text-sm uppercase tracking-wider hover:text-gray-300 transition py-2">Contact</a>
            @auth
                <a href="/dashboard" class="block text-sm uppercase tracking-wider hover:text-gray-300 transition py-2">Dashboard</a>
            @else
                <a href="/login" class="block px-6 py-2 border border-white/20 rounded-full text-sm uppercase tracking-wider text-center hover:bg-white hover:text-black transition">Sign In</a>
            @endauth
        </div>
    </div>
</nav>