<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Diver Entertainment - @yield('title', 'Auth')</title>
    
    <!-- Fonts -->
    <link href="https://api.fontshare.com/v2/css?f[]=satoshi@400,500,700,900&display=swap" rel="stylesheet">
    
    <!-- Tailwind -->
    <script src="https://cdn.tailwindcss.com"></script>
    
    <!-- Alpine.js -->
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
    
    <style>
        body {
            background: #000000;
            font-family: 'Satoshi', sans-serif;
        }
        
        .glass {
            background: rgba(255, 255, 255, 0.03);
            backdrop-filter: blur(20px);
            border: 1px solid rgba(255, 255, 255, 0.05);
        }
        
        .reveal {
            opacity: 0;
            transform: translateY(20px);
            animation: reveal 0.6s ease forwards;
        }
        
        @keyframes reveal {
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }
        
        .magnetic-btn {
            transition: transform 0.2s ease-out;
        }
    </style>
</head>
<body class="text-white">
    @yield('content')
</body>
</html>