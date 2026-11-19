<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Kaon Ta! Davao – Palparan's Food Guide</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="min-h-screen bg-slate-50 text-slate-800 antialiased">
    <header class="border-b-4 border-teal-500 bg-slate-900 text-white">
        <div class="mx-auto flex max-w-6xl flex-col gap-4 px-4 py-5 lg:flex-row lg:items-center lg:justify-between">
            <a href="{{ route('home') }}" class="text-xl font-extrabold tracking-tight sm:text-2xl">Kaon Ta! Davao – Palparan's Food Guide</a>
            @include('partials.nav')
        </div>
    </header>

    <main class="mx-auto max-w-6xl px-4 py-10">
        @include('partials.flash')
        @yield('content')
    </main>

    @include('partials.confirm-modal')
</body>
</html>