@props(['employer'])

<section class="p-4 bg-white shadow rounded-box border border-neutral-100">
    <ul class="space-y-1">
        <li>
            <div class="flex gap-1 items-center">
                <img src="{{ Auth::user()->avatar
                    ? asset('storage/' . Auth::user()->avatar)
                    : 'https://ui-avatars.com/api/?name=' . urlencode(Auth::user()->name) }}"
                    alt="{{ Auth::user()->name }}" class="size-10 rounded-full">
                <span class="font-semibold">{{ Auth::user()->name }}</span>
            </div>
        </li>
        <div class="divider"></div>
        <li>
            <a href="{{ route('employer.profile') }}"
                class="flex gap-2 items-center btn rounded-selector justify-start font-medium hover:btn-outline hover:btn-primary hover:text-white {{ request()->routeIs('employer.profile') ? 'btn-primary btn-outline ' : 'btn-ghost text-neutral-500' }}">
                <i data-feather="user-check" class="size-4"></i>
                <span>Profil Saya</span>
            </a>
        </li>
        <li>
            <a href="{{ route('employer.company.index') }}"
                class="flex gap-2 items-center btn rounded-selector justify-start font-medium hover:btn-outline hover:btn-primary hover:text-white {{ request()->routeIs('employer.company.index') ? 'btn-primary btn-outline ' : 'btn-ghost text-neutral-500' }}">
                <i data-feather="briefcase" class="size-4"></i>
                <span>Profil Usaha</span>
            </a>
        </li>
        <li>
            <a href="{{ route('employer.jobs.index') }}"
                class="flex gap-2 items-center btn rounded-selector justify-start font-medium hover:btn-outline hover:btn-primary hover:text-white {{ request()->routeIs('employer.jobs.index') ? 'btn-primary btn-outline' : 'btn-ghost text-neutral-500' }}">
                <i data-feather="send" class="size-4"></i>
                <span>Postingan Saya</span>
            </a>
        </li>
        <li>
            <a href="{{ route('employer.settings') }}"
                class="flex gap-2 items-center btn rounded-selector justify-start font-medium hover:btn-outline hover:btn-primary hover:text-white {{ request()->routeIs('employer.settings') ? 'btn-primary btn-outline' : 'btn-ghost text-neutral-500' }}">
                <i data-feather="settings" class="size-4"></i>
                <span>Pengaturan</span>
            </a>
        </li>
    </ul>
</section>
