<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Kendari Loker</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    @stack('styles')
</head>

<body class="min-h-screen flex flex-col max-w-5xl mx-auto">
    <x-navbar />

    <main class="grow container mx-auto py-8 px-4 sm:px-0">
        {{ $slot }}
    </main>

    <x-footer />

    @stack('scripts')
</body>

</html>
