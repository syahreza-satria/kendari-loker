<div class="navbar bg-base-100 shadow-sm">
    <div class="flex-1">
        <a href="{{ route('index') }}" class="btn btn-ghost text-xl rounded-selector tracking-tight font-bold">
            KENDARI <span class="text-primary">LOKER</span>
        </a>
    </div>

    <div class="flex-none">
        <ul class="menu menu-horizontal items-center">
            @guest
                <li><a href=""></a></li>
                <li><a href="{{ route('auth.login') }}" class="rounded-selector">Masuk ke akun</a></li>
            @endguest
            @auth
                <li>
                    <details>
                        <summary class="rounded-selector">
                            {{ Auth::user()->name }}
                            <img src="{{ Auth::user()->avatar ? asset('storage/' . Auth::user()->avatar) : 'https://ui-avatars.com/api/?name=' . urlencode(Auth::user()->name) . '&background=random' }}"
                                alt="{{ Auth::user()->name }}" class="w-8 h-8 rounded-full object-cover">
                        </summary>
                        <ul class="z-10 right-0">
                            @if (Auth::user()->role === 'employer')
                                <li>
                                    <a href="{{ route('employer.profile') }}" class="rounded-selector">Profil</a>
                                </li>
                                <li>
                                    <a href="{{ route('employer.company.index') }}" class="rounded-selector">Usaha</a>
                                </li>
                                <li>
                                    <a href="{{ route('employer.jobs.index') }}" class="rounded-selector">
                                        Lowongan</a>
                                </li>
                                <li>
                                    <a href="{{ route('employer.settings') }}" class="rounded-selector">Pengaturan</a>
                                </li>
                                <div class="divider my-0 mx-0"></div>
                            @elseif(Auth::user()->role === 'admin')
                                <li>
                                    <a href="{{ route('admin.dashboard.index') }}" class="rounded-selector gap-1">
                                        <i data-feather="grid" class="size-4"></i>
                                        Dashboard
                                    </a>
                                </li>
                                <div class="divider my-0 mx-0"></div>
                            @endif
                            <li>
                                <form action="{{ route('auth.logout') }}" method="POST" class=" rounded-selector">
                                    @csrf
                                    <button type="submit" class="cursor-pointer flex items-center gap-1">
                                        <i data-feather="log-out" class="size-4"></i>
                                        Logout
                                    </button>
                                </form>
                            </li>
                        </ul>
                    </details>
                </li>
            @endauth
        </ul>
    </div>
</div>
