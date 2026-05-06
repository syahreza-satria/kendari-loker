<x-layout.profile>
    <section class="p-6 bg-white shadow rounded-box">
        <h2 class="text-2xl font-medium">Profil Saya</h2>
    </section>

    <section class="p-6 bg-white shadow rounded-box flex flex-col gap-8">
        <div class="flex items-center justify-between">
            <h1 class="text-lg font-medium">Informasi Usaha/Perusahaan</h1>

            @if (!empty($company))
                <button type="button" class="btn btn-ghost btn-xs p-1">
                    <i data-feather="edit-2" class="size-4 text-primary"></i>
                </button>
            @endif
        </div>

        @if (!empty($company))
            <img src="{{ $company->logo
                ? asset('storage/' . $company->logo)
                : 'https://ui-avatars.com/api/?name=' . urlencode($company->logo) }}"
                alt="{{ $employer->name }}" class="size-24 rounded-full">
            <div class="grid grid-cols-3 space-y-6">
                <div class="flex flex-col space-y-0">
                    <label class="text-sm font-semibold">Nama</label>
                    <input type="text" class="text-sm font-normal" disabled value="{{ $company->name }}" />
                </div>
            </div>
        @else
            <div class="flex flex-col items-center justify-center text-center space-y-3 py-10 text-neutral-500">
                <i data-feather="briefcase" class="w-12 h-12"></i>
                <p class="text-sm font-light max-w-lg">Kamu belum menambahkan data usaha kamu, silahkan tambahkan data
                    usaha kamu
                    terlebih
                    dahulu agar bisa memposting lowongan pekerjaan.</p>
                <a href="{{ route('employer.company.create') }}"
                    class="btn btn-sm rounded-selector btn-primary text-white">Tambahkan Data
                    perusahaan</a>
            </div>
        @endif
    </section>
</x-layout.profile>
