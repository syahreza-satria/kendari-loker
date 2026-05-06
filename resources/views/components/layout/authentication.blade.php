<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Kendari Loker</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="min-h-screen flex flex-col bg-base-200 text-base-content antialiased">

    <div class="navbar w-full max-w-6xl mx-auto px-4 lg:px-8 pt-4">
        <a href="{{ route('index') }}" class="text-2xl font-extrabold tracking-tight hover:opacity-80 transition-opacity">
            Kendari<span class="text-primary">Loker</span>
        </a>
    </div>

    <main class="flex-1 flex items-center justify-center p-4">
        <div class="hero w-full">
            <div class="hero-content flex-col lg:flex-row-reverse w-full max-w-5xl gap-10 lg:gap-20">
                {{ $slot }}
            </div>
        </div>
    </main>

</body>

</html>
