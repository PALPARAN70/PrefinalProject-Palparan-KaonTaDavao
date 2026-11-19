<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Kaon Ta! Davao – Palparan's Food Guide</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-gray-50 text-gray-800">
    <header class="bg-orange-600 text-white">
        <div class="max-w-6xl mx-auto px-4 py-4">
            <h1 class="text-2xl font-bold">Kaon Ta! Davao – Palparan's Food Guide</h1>
        </div>
    </header>

    @include('partials.nav')

    <main class="max-w-6xl mx-auto px-4 py-8">
        @include('partials.flash')
        @yield('content')
    </main>
</body>
</html>