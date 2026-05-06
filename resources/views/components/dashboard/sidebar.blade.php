<ul class="menu w-full grow">
    <li>
        <a href="{{ route('admin.dashboard.index') }}" class="is-drawer-close:tooltip is-drawer-close:tooltip-right"
            data-tip="Dashboard">
            <i data-feather="grid" class="my-1.5 inline-block size-4"></i>
            <span class="is-drawer-close:hidden">Dashboard</span>
        </a>
    </li>

    <div class="divider is-drawer-open:hidden"></div>
    <div class="divider is-drawer-close:hidden">
        <span class="text-xs font-medium">Core Business</span>
    </div>

    <li>
        <a href="{{ route('admin.job.index') }}" class="is-drawer-close:tooltip is-drawer-close:tooltip-right"
            data-tip="Lowongan">
            <i data-feather="clipboard" class="my-1.5 inline-block size-4"></i>
            <span class="is-drawer-close:hidden">Lowongan</span>
        </a>
    </li>

    <li>
        <a href="{{ route('admin.company.index') }}" class="is-drawer-close:tooltip is-drawer-close:tooltip-right"
            data-tip="Perusahaan">
            <i data-feather="briefcase" class="my-1.5 inline-block size-4"></i>
            <span class="is-drawer-close:hidden">Perusahaan</span>
        </a>
    </li>

    <div class="divider is-drawer-open:hidden"></div>
    <div class="divider is-drawer-close:hidden">
        <span class="text-xs font-medium">Manajemen User</span>
    </div>

    <li>
        <a href="{{ route('admin.user.index') }}" class="is-drawer-close:tooltip is-drawer-close:tooltip-right"
            data-tip="Pengguna">
            <i data-feather="users" class="my-1.5 inline-block size-4"></i>
            <span class="is-drawer-close:hidden">Pengguna</span>
        </a>
    </li>

    <div class="divider is-drawer-open:hidden"></div>
    <div class="divider is-drawer-close:hidden">
        <span class="text-xs font-medium">Master Data</span>
    </div>

    <li>
        <a href="{{ route('admin.category.index') }}" class="is-drawer-close:tooltip is-drawer-close:tooltip-right"
            data-tip="Kategori">
            <i data-feather="tag" class="my-1.5 inline-block size-4"></i>
            <span class="is-drawer-close:hidden">Kategori</span>
        </a>
    </li>

    <li>
        <a href="{{ route('admin.type.index') }}" class="is-drawer-close:tooltip is-drawer-close:tooltip-right"
            data-tip="Tipe Pekerjaan">
            <i data-feather="layers" class="my-1.5 inline-block size-4"></i>
            <span class="is-drawer-close:hidden">Tipe Pekerjaan</span>
        </a>
    </li>

    <div class="divider is-drawer-open:hidden"></div>
    <div class="divider is-drawer-close:hidden">
        <span class="text-xs font-medium">Konfig</span>
    </div>

    <li>
        <a href="#" class="is-drawer-close:tooltip is-drawer-close:tooltip-right" data-tip="Pengaturan">
            <i data-feather="settings" class="my-1.5 inline-block size-4"></i>
            <span class="is-drawer-close:hidden">Pengaturan</span>
        </a>
    </li>
</ul>
