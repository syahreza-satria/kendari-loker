<nav class="navbar w-full bg-white">
    <label for="my-drawer-4" aria-label="open sidebar" class="btn btn-square btn-ghost">
        <!-- Sidebar toggle icon -->
        <i data-feather="sidebar" class="my-1.5 inline-block size-4"></i>
    </label>
    <div class="px-4">DASHBOARD KENDARI LOKER</div>
    <div class="px-4 ml-auto flex gap-2 items-center">
        <a href="{{ route('index') }}" class="btn btn-ghost rounded-selector font-normal">Home</a>
        <form action="{{ route('auth.logout') }}" method="post">
            @csrf
            <button class="btn btn-outline rounded-selector font-normal flex items-center">
                Logout <i data-feather="log-out" class="size-4"></i>
            </button>
        </form>
    </div>
</nav>
