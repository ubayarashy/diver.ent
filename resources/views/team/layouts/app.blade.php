<!DOCTYPE html>
<html lang="id" data-theme="dark">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Team Dashboard - diver.ent</title>
    <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@400;500;600;700;800&family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <style>
        :root {
            --bg: #0a0a0a;
            --surface: #111111;
            --surface-card: #161616;
            --accent: #3B82FF;
            --accent-hover: #2563EB;
            --text-primary: #F5F5F0;
            --text-secondary: #888888;
            --border: #222222;
            --success: #00c853;
            --warning: #ffaa00;
            --danger: #ff4444;
            --info: #2196f3;
            --navbar-bg: rgba(17, 17, 17, 0.9);
            --font-display: 'Outfit', sans-serif;
            --font-body: 'Inter', sans-serif;
            --transition: .35s cubic-bezier(.4,0,.2,1);
        }

        [data-theme="light"] {
            --bg: #F0F4FF;
            --surface: #FFFFFF;
            --surface-card: #F8FAFF;
            --text-primary: #060614;
            --text-secondary: #4A5568;
            --border: #D6E4FF;
            --navbar-bg: rgba(255, 255, 255, 0.9);
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: var(--font-body);
            background: var(--bg);
            color: var(--text-primary);
            overflow-x: hidden;
        }

        .container {
            max-width: 1400px;
            margin: 0 auto;
            padding: 0 24px;
        }
    </style>
    @stack('styles')
</head>
<body>
    @yield('content')

    <script>
        const savedTheme = localStorage.getItem('theme') || 'dark';
        document.documentElement.setAttribute('data-theme', savedTheme);
    </script>
    @stack('scripts')
</body>
</html>