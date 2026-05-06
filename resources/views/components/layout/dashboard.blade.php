<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Kendari Loker</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <link href="https://cdnjs.cloudflare.com/ajax/libs/lightbox2/2.11.4/css/lightbox.min.css" rel="stylesheet" />
</head>

<body class="bg-neutral-200">
    <div class="drawer lg:drawer-open">
        <input id="my-drawer-4" type="checkbox" class="drawer-toggle" />
        <div class="drawer-content">
            <!-- Navbar -->
            <x-dashboard.navbar />
            @if (session('success'))
                <div id="flash-alert" class="toast toast-top toast-end z-50 transition-opacity duration-500">
                    <div role="alert" class="alert alert-success shadow-lg">
                        <i data-feather="check-circle" class="size-5 shrink-0 stroke-current"></i>
                        <!-- Menampilkan pesan dinamis dari Controller -->
                        <span>{{ session('success') }}</span>
                    </div>
                </div>
            @endif
            <!-- Page content here -->
            <div class="p-4">{{ $slot }}</div>
        </div>

        <div class="drawer-side is-drawer-close:overflow-visible">
            <label for="my-drawer-4" aria-label="close sidebar" class="drawer-overlay"></label>
            <div
                class="flex min-h-full flex-col items-start bg-white shadow is-drawer-close:w-14 is-drawer-open:w-64 border-r border-base-300">
                <!-- Sidebar content here -->
                <x-dashboard.sidebar />
            </div>
        </div>
    </div>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/lightbox2/2.11.4/js/lightbox.min.js"></script>
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            const alertBox = document.getElementById('flash-alert');

            if (alertBox) {
                setTimeout(() => {
                    alertBox.style.opacity = '0';
                    setTimeout(() => {
                        alertBox.remove();
                    }, 500);
                }, 3000);
            }
        });
    </script>
</body>

</html>
