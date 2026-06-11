<!DOCTYPE html>
<html lang="id" data-theme="dark">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>diver.ent — Digital Marketing Agency Medan</title>
    <meta name="description" content="diver.ent adalah digital marketing agency terpercaya di Medan. Layanan Social Media, Digital Ads, SEO, Website Development, Branding & Visual Production.">
    <meta property="og:title" content="diver.ent — Digital Marketing Agency Medan">
    <meta property="og:description" content="Digital marketing agency terpercaya di Medan dengan layanan komprehensif.">
    <meta property="og:type" content="website">
    <meta name="twitter:card" content="summary_large_image">
    <meta name="robots" content="index, follow">
    <link rel="canonical" href="{{ url('/') }}">
    
    <!-- Fonts Premium -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@300;400;500;600;700;800&family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    
    <!-- Vite Assets -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    
    <!-- Theme Script -->
    <script>
        const savedTheme = localStorage.getItem('theme') || 'dark';
        document.documentElement.setAttribute('data-theme', savedTheme);
    </script>
    
    <style>
        /* ===== diver.ent Premium Design System ===== */
        :root {
            --bg: #FBF9FB;
            --surface: #FFFFFF;
            --surface-alt: #F3F7FA;

            --accent: #00D2FF;
            --accent-hover: #0A192F;
            --accent-glow: rgba(0, 210, 255, 0.15);

            --bg-tint: #0A192F;
            --text: #0A192F;
            --text-secondary: #5B6575;
            --text-muted: #8A94A3;

            --border: #DCE4EA;
            --border-light: #E8EDF2;
            --navbar-bg: rgba(251, 249, 251, 0.98);

            --font-display: 'Outfit', sans-serif;
            --font-body: 'Inter', sans-serif;

            --radius-sm: 8px;
            --radius-md: 16px;
            --radius-lg: 24px;
            --transition: .4s cubic-bezier(0.2, 0.9, 0.4, 1.1);
            --shadow-sm: 0 4px 20px rgba(0, 0, 0, 0.02);
            --shadow-md: 0 8px 40px rgba(0, 0, 0, 0.04);
            --shadow-lg: 0 20px 60px rgba(0, 0, 0, 0.06);
        }

        /* ===== Dark Theme - Luxury Navy ===== */
        [data-theme="dark"] {
            --bg: #07111F;
            --surface: #0A192F;
            --surface-alt: #0F1F38;

            --accent: #00D2FF;
            --accent-hover: #4DE1FF;
            --accent-glow: rgba(0, 210, 255, 0.12);

            --bg-tint: #FBF9FB;
            --text: #FBF9FB;
            --text-secondary: #A7B3C2;
            --text-muted: #6B7A8C;

            --border: #1E324D;
            --border-light: #15273F;
            --navbar-bg: rgba(7, 17, 31, 0.98);
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
            font-weight: 400;
            -webkit-font-smoothing: antialiased;
            -moz-osx-font-smoothing: grayscale;
        }

        /* Elegant Scrollbar */
        ::-webkit-scrollbar {
            width: 6px;
        }

        ::-webkit-scrollbar-track {
            background: var(--surface);
        }

        ::-webkit-scrollbar-thumb {
            background: var(--accent);
            border-radius: 3px;
        }

        ::-webkit-scrollbar-thumb:hover {
            background: var(--accent-hover);
        }

        /* Selection */
        ::selection {
            background: var(--accent);
            color: #0A192F;
        }

        a {
            text-decoration: none;
            color: inherit;
            transition: var(--transition);
        }

        .container {
            width: 88%;
            max-width: 1280px;
            margin: 0 auto;
        }

        /* Premium Button Styles */
        .btn-primary {
            background: linear-gradient(135deg, var(--accent), var(--accent-hover));
            color: #fff;
            padding: 14px 32px;
            border-radius: 50px;
            font-weight: 600;
            font-size: 0.85rem;
            letter-spacing: 0.5px;
            transition: var(--transition);
            display: inline-flex;
            align-items: center;
            gap: 10px;
            border: none;
            cursor: pointer;
            position: relative;
            overflow: hidden;
        }

        .btn-primary::before {
            content: '';
            position: absolute;
            top: 50%;
            left: 50%;
            width: 0;
            height: 0;
            border-radius: 50%;
            background: rgba(255, 255, 255, 0.2);
            transform: translate(-50%, -50%);
            transition: width 0.6s, height 0.6s;
        }

        .btn-primary:hover::before {
            width: 300px;
            height: 300px;
        }

        .btn-primary:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 25px rgba(0, 210, 255, 0.25);
        }

        .btn-outline {
            background: transparent;
            border: 1.5px solid var(--border);
            color: var(--text);
            padding: 12px 28px;
            border-radius: 50px;
            font-weight: 600;
            font-size: 0.85rem;
            letter-spacing: 0.5px;
            transition: var(--transition);
            display: inline-flex;
            align-items: center;
            gap: 10px;
            cursor: pointer;
            position: relative;
            overflow: hidden;
        }

        .btn-outline::before {
            content: '';
            position: absolute;
            top: 0;
            left: -100%;
            width: 100%;
            height: 100%;
            background: var(--accent);
            transition: left 0.4s ease;
            z-index: 0;
        }

        .btn-outline:hover::before {
            left: 0;
        }

        .btn-outline:hover {
            border-color: var(--accent);
            color: #0A192F;
        }

        .btn-outline span,
        .btn-outline i {
            position: relative;
            z-index: 1;
        }

        /* Typography Classes */
        .section-tag {
            display: inline-block;
            font-size: 0.7rem;
            font-weight: 600;
            letter-spacing: 3px;
            text-transform: uppercase;
            color: var(--accent);
            margin-bottom: 20px;
            position: relative;
            padding-left: 30px;
        }

        .section-tag::before {
            content: '';
            position: absolute;
            left: 0;
            top: 50%;
            transform: translateY(-50%);
            width: 20px;
            height: 2px;
            background: var(--accent);
        }

        .section-title {
            font-family: var(--font-display);
            font-size: clamp(2.2rem, 5vw, 3.8rem);
            font-weight: 700;
            letter-spacing: -0.02em;
            line-height: 1.15;
            margin-bottom: 20px;
            background: linear-gradient(135deg, var(--text) 0%, var(--text-secondary) 100%);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
        }

        .section-desc {
            color: var(--text-secondary);
            font-size: 1rem;
            max-width: 600px;
            line-height: 1.7;
            font-weight: 400;
        }

        /* Grid System */
        .grid-2, .grid-3, .grid-4 {
            display: grid;
            gap: 30px;
        }

        .grid-2 {
            grid-template-columns: repeat(2, 1fr);
        }

        .grid-3 {
            grid-template-columns: repeat(3, 1fr);
        }

        .grid-4 {
            grid-template-columns: repeat(4, 1fr);
        }

        @media (max-width: 992px) {
            .grid-3, .grid-4 {
                grid-template-columns: repeat(2, 1fr);
            }
        }

        @media (max-width: 768px) {
            .grid-2, .grid-3, .grid-4 {
                grid-template-columns: 1fr;
            }
        }

        /* Card Styles */
        .card-premium {
            background: var(--surface);
            border: 1px solid var(--border);
            border-radius: var(--radius-lg);
            padding: 32px;
            transition: var(--transition);
            position: relative;
            overflow: hidden;
        }

        .card-premium::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            height: 3px;
            background: linear-gradient(90deg, var(--accent), transparent);
            transform: scaleX(0);
            transition: transform 0.4s ease;
        }

        .card-premium:hover::before {
            transform: scaleX(1);
        }

        .card-premium:hover {
            transform: translateY(-4px);
            border-color: var(--accent);
            box-shadow: var(--shadow-lg);
        }

        /* Animations */
        @keyframes fadeUp {
            from {
                opacity: 0;
                transform: translateY(30px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .reveal {
            opacity: 0;
            transform: translateY(40px);
            transition: all 0.8s cubic-bezier(0.2, 0.9, 0.4, 1.1);
        }

        .reveal.active {
            opacity: 1;
            transform: translateY(0);
        }

        /* Glass Effect */
        .glass {
            background: var(--navbar-bg);
            backdrop-filter: blur(12px);
            -webkit-backdrop-filter: blur(12px);
            border-bottom: 1px solid var(--border);
        }

        /* Divider */
        .divider {
            width: 60px;
            height: 2px;
            background: var(--accent);
            margin: 30px 0;
        }

        /* Responsive */
        @media (max-width: 768px) {
            .container {
                width: 90%;
            }

            .btn-primary, .btn-outline {
                padding: 12px 24px;
                font-size: 0.8rem;
            }

            .section-tag {
                font-size: 0.65rem;
                letter-spacing: 2px;
            }
        }

        /* Hover Effects */
        .hover-lift {
            transition: var(--transition);
        }

        .hover-lift:hover {
            transform: translateY(-4px);
        }

        /* Gradient Text */
        .gradient-text {
            background: linear-gradient(135deg, var(--accent), var(--text));
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
        }

        /* Transisi halaman yang smooth */
        .page-transition {
            animation: fadeIn 0.3s ease;
        }

        @keyframes fadeIn {
            from {
                opacity: 0;
                transform: translateY(10px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }
    </style>
</head>
<body>
    @yield('content')
    
    <script>
        // Reveal animation on scroll
        const reveals = document.querySelectorAll('.reveal');
        
        const revealObserver = new IntersectionObserver((entries) => {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    entry.target.classList.add('active');
                    revealObserver.unobserve(entry.target);
                }
            });
        }, { threshold: 0.1, rootMargin: '0px 0px -80px 0px' });
        
        reveals.forEach(reveal => {
            revealObserver.observe(reveal);
        });

        // Smooth scroll for anchor links
        document.querySelectorAll('a[href^="#"]').forEach(anchor => {
            anchor.addEventListener('click', function (e) {
                e.preventDefault();
                const target = document.querySelector(this.getAttribute('href'));
                if (target) {
                    target.scrollIntoView({ behavior: 'smooth', block: 'start' });
                }
            });
        });

        // Tambahkan class transition saat pindah halaman
        document.addEventListener('DOMContentLoaded', function() {
            document.body.classList.add('page-transition');
        });
    </script>
    
    @stack('scripts')
</body>
</html>