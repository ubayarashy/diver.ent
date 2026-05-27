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
      /* ===== diver.ent Design System ===== */
:root {
    --bg: #FBF9FB;             /* Surface White */
    --surface: #FFFFFF;        /* Pure White */
    --surface-alt: #F3F7FA;    /* Soft Blue Tint */

    --accent: #00D2FF;         /* Vibrant Blue */
    --accent-hover: #0A192F;   /* Primary Navy */

    --bg-tint: #0A192F;        /* Navy */
    --text: #0A192F;           /* Main Text */
    --text-secondary: #5B6575; /* Soft Gray Text */

    --border: #DCE4EA;         /* Soft Border */
    --navbar-bg: rgba(251, 249, 251, 0.92);

    --font-display: 'Outfit', sans-serif;
    --font-body: 'Inter', sans-serif;

    --radius: 12px;
    --transition: .35s cubic-bezier(.4,0,.2,1);
}

/* ===== Dark Theme ===== */
[data-theme="dark"] {
    --bg: #07111F;
    --surface: #0A192F;
    --surface-alt: #12243B;

    --accent: #00D2FF;
    --accent-hover: #4DE1FF;

    --bg-tint: #FBF9FB;

    --text: #FBF9FB;
    --text-secondary: #A7B3C2;

    --border: #1E324D;
    --navbar-bg: rgba(10, 25, 47, 0.92);
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
        
        a {
            text-decoration: none;
            color: inherit;
        }
        
        .container {
            width: 90%;
            max-width: 1320px;
            margin: 0 auto;
        }
        
        .btn-primary {
            background: linear-gradient(135deg, var(--accent), var(--accent-hover));
            color: #fff;
            padding: 12px 28px;
            border-radius: 50px;
            font-weight: 600;
            font-size: 0.9rem;
            transition: var(--transition);
            display: inline-flex;
            align-items: center;
            gap: 8px;
            border: none;
            cursor: pointer;
        }
        
        .btn-primary:hover {
            transform: translateY(-2px);
            box-shadow: 0 4px 15px rgba(59, 130, 255, 0.3);
        }
        
        .btn-outline {
            background: transparent;
            border: 1px solid var(--border);
            color: var(--text);
            padding: 12px 28px;
            border-radius: 50px;
            font-weight: 600;
            transition: var(--transition);
            display: inline-flex;
            align-items: center;
            gap: 8px;
            cursor: pointer;
        }
        
        .btn-outline:hover {
            border-color: var(--accent);
            color: var(--accent);
        }
    </style>
</head>
<body>
    @yield('content')
    
    @stack('scripts')
</body>
</html>