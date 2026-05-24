<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Halaman Tidak Ditemukan - GoSocial</title>
    <link href="https://fonts.googleapis.com/css2?family=DM+Sans:wght@400;500;600;700&family=Syne:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <style>
        :root {
            --bg: #0a0a0a;
            --surface: #111111;
            --accent: #E8FF3A;
            --text-primary: #F5F5F0;
            --text-secondary: #888888;
        }
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }
        body {
            font-family: 'DM Sans', sans-serif;
            background: var(--bg);
            color: var(--text-primary);
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 24px;
        }
        .error-container {
            text-align: center;
            max-width: 600px;
        }
        .error-code {
            font-size: 120px;
            font-weight: 800;
            font-family: 'Syne', sans-serif;
            color: var(--accent);
            line-height: 1;
            margin-bottom: 24px;
        }
        .error-title {
            font-size: 32px;
            margin-bottom: 16px;
        }
        .error-message {
            color: var(--text-secondary);
            margin-bottom: 32px;
        }
        .btn-home {
            background: var(--accent);
            color: #000;
            border: none;
            padding: 14px 32px;
            border-radius: 40px;
            font-weight: 600;
            text-decoration: none;
            display: inline-block;
            transition: all 0.3s;
        }
        .btn-home:hover {
            transform: translateY(-2px);
            filter: brightness(0.95);
        }
        .links {
            margin-top: 48px;
            display: flex;
            gap: 24px;
            justify-content: center;
            flex-wrap: wrap;
        }
        .links a {
            color: var(--text-secondary);
            text-decoration: none;
        }
        .links a:hover {
            color: var(--accent);
        }
    </style>
</head>
<body>
    <div class="error-container">
        <div class="error-code">404</div>
        <h1 class="error-title">Halaman Tidak Ditemukan</h1>
        <p class="error-message">Maaf, halaman yang Anda cari tidak tersedia atau telah dipindahkan.</p>
        <a href="{{ url('/') }}" class="btn-home">← Kembali ke Beranda</a>
        
        <div class="links">
            <a href="{{ url('/') }}">Beranda</a>
            <a href="{{ url('/portfolio') }}">Portfolio</a>
            <a href="{{ url('/services') }}">Layanan</a>
            <a href="{{ url('/contact') }}">Kontak</a>
        </div>
    </div>
</body>
</html>