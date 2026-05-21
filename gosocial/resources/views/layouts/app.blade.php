<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>diver.ent — Digital Marketing Agency Medan</title>
    <meta name="description" content="diver.ent adalah digital marketing agency terpercaya di Medan. Layanan Social Media, Digital Ads, SEO, Website Development, Branding & Visual Production.">
    <meta property="og:title" content="diver.ent — Digital Marketing Agency Medan">
    <meta property="og:description" content="Digital marketing agency terpercaya di Medan dengan layanan komprehensif.">
    <meta property="og:type" content="website">
    <meta name="twitter:card" content="summary_large_image">
    <meta name="robots" content="index, follow">
    <link rel="canonical" href="{{ url('/') }}">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@400;500;600;700;800&family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <script>
        const savedTheme = localStorage.getItem('theme') || 'light';
        document.documentElement.setAttribute('data-theme', savedTheme);
    </script>
</head>
<body>
    @yield('content')
</body>
</html>
