@props(['types', 'categories'])
<div class="flex flex-col text-center py-8 bg-white items-center space-y-6">
    <div class="px-4">
        <p class="tracking-widest text-xs">KENDARI LOKER</p>
        <h1 class="font-bold text-3xl md:text-4xl leading-tight">Cari, Temukan & Lamar</h1>
        <p class="text-neutral-500 text-sm md:text-base">Temukan lowongan pekerjaan yang cocok untuk kamu disini</p>
    </div>

    <form action="{{ route('index') }}" method="GET" class="flex flex-col md:flex-row w-full max-w-4xl gap-2 px-4">
        <div class="flex-1">
            <label class="input input-bordered flex items-center gap-2 w-full rounded-selector">
                <i data-feather="search" class="w-4 h-4"></i>
                <input type="search" name="search" class="grow" value="{{ request('search') }}"
                    placeholder="Search" />
            </label>
        </div>
        <div class="flex-1">
            <select name="job_type" class="select select-bordered w-full rounded-selector">
                <option value="" {{ request('job_type') == '' ? 'selected' : '' }}>Semua Tipe</option>
                @foreach ($types as $type)
                    <option value="{{ $type->id }}" {{ request('job_type') == $type->id ? 'selected' : '' }}>
                        {{ $type->name }}
                    </option>
                @endforeach
            </select>
        </div>
        <div class="flex-1">
            <select name="category" class="select select-bordered w-full rounded-selector">
                <option value="" {{ request('category') == '' ? 'selected' : '' }}>Semua Kategori</option>
                @foreach ($categories as $cat)
                    <option value="{{ $cat->id }}" {{ request('category') == $cat->id ? 'selected' : '' }}>
                        {{ $cat->name }}
                    </option>
                @endforeach
            </select>
        </div>
        <button type="submit" class="btn btn-neutral rounded-selector md:px-8">Cari</button>
    </form>

    <div class="flex flex-col gap-1 items-center px-4 text-sm md:text-base">
        @guest
            <p class="max-w-lg">
                Punya usaha dan butuh karyawan?
                <span class="font-semibold">Pasang lowongan di sini</span>
            </p>
            <a href="{{ route('auth.register') }}" class="btn btn-primary rounded-selector text-white w-full sm:w-auto">
                Daftar & Pasang Lowongan
            </a>
        @endguest

        @auth
            <a href="{{ route('employer.jobs.create') }}"
                class="btn btn-primary rounded-selector text-white w-full sm:w-auto">
                Tambahkan Lowongan Pekerjaan
            </a>
        @endauth
    </div>
    <div class="divider w-full"></div>
</div>
