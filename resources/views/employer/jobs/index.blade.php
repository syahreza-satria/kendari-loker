<x-layout.profile>
    <section class="p-6 bg-white shadow rounded-box">
        <h2 class="text-2xl font-medium">Pengaturan Lowongan</h2>
    </section>

    <section class="p-6 bg-white shadow rounded-box flex flex-col gap-4">
        <div class="flex items-center justify-between">
            <h1 class="text-lg font-medium">Informasi Loker</h1>
            <a href="{{ route('employer.jobs.create') }}"
                class="btn btn-sm flex gap-1 items-center rounded-selector btn-primary text-white">Tambah Lowongan <i
                    data-feather="plus"></i></a>
        </div>

        @if ($jobs->isNotEmpty())
            <div class="flex flex-col space-y-2">
                @foreach ($jobs as $job)
                    <div
                        class="bg-white rounded-selector border border-neutral-200 p-5 flex flex-col md:flex-row md:items-center justify-between gap-4 transition hover:shadow-sm">

                        {{-- Info Utama Lowongan --}}
                        <div class="flex-1">
                            <div class="flex items-center gap-2 mb-1">
                                <a href="{{ route('employer.jobs.show', $job->id) }}"
                                    class="text-lg font-semibold text-neutral-800 hover:underline">{{ $job->title }}
                                </a>
                                @if ($job->is_active)
                                    <span class="badge badge-success text-white badge-xs">Aktif</span>
                                @else
                                    <span class="badge badge-error text-white badge-xs">Ditutup</span>
                                @endif
                            </div>

                            <div class="flex flex-wrap items-center gap-x-4 gap-y-2 text-sm text-neutral-600">
                                {{-- Kategori & Tipe --}}
                                <div class="flex items-center gap-1.5">
                                    <i data-feather="briefcase" class="size-4 text-neutral-400"></i>
                                    <span>{{ $job->category->name ?? '-' }} • {{ $job->type->name ?? '-' }}</span>
                                </div>

                                {{-- Lokasi --}}
                                <div class="flex items-center gap-1.5">
                                    <i data-feather="map-pin" class="size-4 text-neutral-400"></i>
                                    <span>{{ $job->location_area }}</span>
                                </div>

                                {{-- Gaji --}}
                                <div class="flex items-center gap-1.5">
                                    <i data-feather="dollar-sign" class="size-4 text-neutral-400"></i>
                                    @if ($job->salary_min && $job->salary_max)
                                        <span>Rp {{ number_format($job->salary_min, 0, ',', '.') }} - Rp
                                            {{ number_format($job->salary_max, 0, ',', '.') }}</span>
                                    @else
                                        <span>Gaji disembunyikan</span>
                                    @endif
                                </div>

                                {{-- Batas Waktu --}}
                                <div class="flex items-center gap-1.5">
                                    <i data-feather="calendar" class="size-4 text-neutral-400"></i>
                                    <span>Tutup: {{ \Carbon\Carbon::parse($job->closing_date)->format('d M Y') }}</span>
                                </div>
                            </div>
                        </div>

                        {{-- Action Buttons --}}
                        <div class="flex items-center gap-2 border-t md:border-t-0 pt-3 md:pt-0 mt-2 md:mt-0">
                            <a href="{{ route('employer.jobs.edit', $job->id) }}"
                                class="btn btn-sm btn-outline btn-info rounded-selector hover:text-white">
                                <i data-feather="edit" class="size-4"></i> Edit
                            </a>

                            <form action="{{ route('employer.jobs.destroy', $job->id) }}" method="POST"
                                onsubmit="return confirm('Apakah kamu yakin ingin menghapus lowongan ini?');">
                                @csrf
                                @method('DELETE')
                                <button type="submit"
                                    class="btn btn-sm btn-outline btn-error rounded-selector hover:text-white">
                                    <i data-feather="trash-2" class="size-4"></i> Hapus
                                </button>
                            </form>
                        </div>

                    </div>
                @endforeach
            </div>
        @else
            <div class="flex flex-col py-8 text-center space-y-4 text-neutral-500">
                <i data-feather="briefcase" class="size-16 mx-auto"></i>
                <span class="text-sm max-w-md text-center mx-auto">Kamu belum menambahkan Usaha/Perusahaan kamu,
                    silahkan
                    tambahkan dulu
                    informasi
                    usaha kamu disini
                    agar dapat memposting pekerjaan</span>
                <a href="{{ route('employer.company.create') }}"
                    class="btn btn-primary rounded-selector mx-auto btn-sm flex gap-1 items-center">Tambah Informasi
                    <i data-feather="plus" class="size-4"></i></a>
            </div>
        @endif
    </section>
</x-layout.profile>
