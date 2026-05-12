<x-layout.app>
    <div class="bg-white space-y-8 pb-16 px-4 md:px-0 mt-8 max-w-7xl mx-auto">

        {{-- Tombol Kembali --}}
        <div>
            <a href="{{ route('index') }}" class="btn btn-sm btn-ghost hover:bg-base-200 rounded-selector gap-2">
                <i data-feather="arrow-left" class="w-4 h-4"></i>
                Kembali ke Daftar Lowongan
            </a>
        </div>

        {{-- Header Detail Lowongan --}}
        <section
            class="flex flex-col md:flex-row justify-between items-start gap-6 p-6 bg-base-200/50 border border-neutral-300 rounded-selector">
            <div class="flex flex-col sm:flex-row gap-4 items-start">
                <div class="avatar shrink-0 bg-white p-2 border border-neutral-200 rounded-selector">
                    <div class="w-24 sm:w-32 rounded-selector">
                        <img src="{{ $job->company->logo ? asset('storage/' . $job->company->logo) : asset('storage/' . $job->poster) }}"
                            alt="{{ $job->company->name }} Logo" class="object-contain" />
                    </div>
                </div>
                <div class="flex flex-col py-1 space-y-2">
                    <div>
                        <h1 class="font-bold text-2xl md:text-3xl text-base-content">{{ $job->title }}</h1>
                        <span class="text-lg text-neutral-600 font-medium">{{ $job->company->name }}</span>
                    </div>
                    <div class="flex flex-wrap gap-2 pt-2">
                        @if ($job->is_active && \Carbon\Carbon::parse($job->closing_date)->isFuture())
                            <span class="badge badge-success text-white badge-sm md:badge-md">
                                Terbuka
                            </span>
                        @else
                            <span class="badge badge-error text-white badge-sm md:badge-md">
                                Ditutup
                            </span>
                        @endif
                        <span class="badge badge-ghost badge-sm md:badge-md border border-neutral-300 italic">
                            {{ str_replace('_', ' ', Str::title($job->type->name)) }}
                        </span>
                        <span class="badge badge-ghost badge-sm md:badge-md border border-neutral-300">
                            {{ $job->category->name }}
                        </span>
                    </div>
                </div>
            </div>

            <div class="w-full md:w-auto flex flex-col gap-3 mt-4 md:mt-0 shrink-0">
                @if ($job->link)
                    <a href="{{ $job->link }}" target="_blank" rel="noopener noreferrer"
                        class="btn btn-primary w-full md:w-auto rounded-selector shadow-lg">
                        Lamar Sekarang <i data-feather="external-link" class="w-4 h-4 ml-1"></i>
                    </a>
                @else
                    <button class="btn btn-primary w-full md:w-auto rounded-selector shadow-lg" disabled>
                        Link Lamaran Tidak Tersedia
                    </button>
                @endif
                <button class="btn btn-outline btn-primary w-full md:w-auto rounded-selector">
                    <i data-feather="bookmark" class="w-4 h-4 mr-1"></i> Simpan Lowongan
                </button>
            </div>
        </section>

        {{-- Konten Utama --}}
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">

            {{-- Kolom Kiri: Deskripsi & Persyaratan --}}
            <div class="lg:col-span-2 space-y-8">
                @if ($job->poster && !$job->company->logo)
                    <div class="w-full rounded-selector overflow-hidden border border-neutral-200">
                        <img src="{{ asset('storage/' . $job->poster) }}" alt="Poster {{ $job->title }}"
                            class="w-full h-auto object-cover">
                    </div>
                @endif

                <section class="space-y-4">
                    <h2 class="text-xl font-bold border-b border-neutral-200 pb-2">Deskripsi Pekerjaan</h2>
                    <div class="prose prose-sm md:prose-base max-w-none text-neutral-700">
                        {!! $job->description !!}
                    </div>
                </section>

                <section class="space-y-4">
                    <h2 class="text-xl font-bold border-b border-neutral-200 pb-2">Persyaratan</h2>
                    <div class="prose prose-sm md:prose-base max-w-none text-neutral-700">
                        {!! $job->requirements !!}
                    </div>
                </section>
            </div>

            {{-- Kolom Kanan: Ringkasan Informasi --}}
            <div class="space-y-6">
                {{-- Card Ringkasan Pekerjaan --}}
                <div class="bg-base-100 border border-neutral-300 rounded-selector p-5 space-y-5">
                    <h3 class="font-bold text-lg border-b border-neutral-200 pb-2">Ringkasan Pekerjaan</h3>

                    <div class="space-y-4">
                        {{-- Gaji --}}
                        <div class="flex items-start gap-3">
                            <div class="p-2 bg-base-200 rounded-lg shrink-0 text-primary">
                                <i data-feather="dollar-sign" class="w-5 h-5"></i>
                            </div>
                            <div>
                                <span class="block text-sm text-neutral-500">Gaji per Bulan</span>
                                @if (!empty($job->salary_max) || !empty($job->salary_min))
                                    <span class="text-success font-bold text-base">
                                        Rp {{ number_format($job->salary_min, 0, ',', '.') }} - Rp
                                        {{ number_format($job->salary_max, 0, ',', '.') }}
                                    </span>
                                @else
                                    <span class="font-medium text-base text-base-content">Gaji Disembunyikan</span>
                                @endif
                            </div>
                        </div>

                        {{-- Lokasi --}}
                        <div class="flex items-start gap-3">
                            <div class="p-2 bg-base-200 rounded-lg shrink-0 text-primary">
                                <i data-feather="map-pin" class="w-5 h-5"></i>
                            </div>
                            <div>
                                <span class="block text-sm text-neutral-500">Area Lokasi Kerja</span>
                                <span class="font-medium text-base text-base-content">{{ $job->location_area }}</span>
                            </div>
                        </div>

                        {{-- Tanggal Diposting --}}
                        <div class="flex items-start gap-3">
                            <div class="p-2 bg-base-200 rounded-lg shrink-0 text-primary">
                                <i data-feather="calendar" class="w-5 h-5"></i>
                            </div>
                            <div>
                                <span class="block text-sm text-neutral-500">Tanggal Diposting</span>
                                <span
                                    class="font-medium text-base text-base-content">{{ $job->created_at->translatedFormat('d F Y') }}</span>
                            </div>
                        </div>

                        {{-- Batas Lamaran --}}
                        <div class="flex items-start gap-3">
                            <div class="p-2 bg-error/10 rounded-lg shrink-0 text-error">
                                <i data-feather="clock" class="w-5 h-5"></i>
                            </div>
                            <div>
                                <span class="block text-sm text-neutral-500">Batas Lamaran</span>
                                <span
                                    class="font-bold text-base text-error">{{ \Carbon\Carbon::parse($job->closing_date)->translatedFormat('d F Y') }}</span>
                            </div>
                        </div>
                    </div>
                </div>

                {{-- Card Tentang Perusahaan --}}
                <div class="bg-base-100 border border-neutral-300 rounded-selector p-5 space-y-4">
                    <h3 class="font-bold text-lg border-b border-neutral-200 pb-2">Tentang Perusahaan</h3>

                    <div class="flex items-center gap-3">
                        <div class="w-14 h-14 rounded-selector border border-neutral-200 p-1 shrink-0 bg-white">
                            <img src="{{ $job->company->logo ? asset('storage/' . $job->company->logo) : asset('storage/' . $job->poster) }}"
                                alt="Logo {{ $job->company->name }}" class="w-full h-full object-contain" />
                        </div>
                        <div class="flex flex-col">
                            <span class="font-bold text-base-content leading-tight">{{ $job->company->name }}</span>
                            <span class="text-sm text-neutral-500">{{ $job->company->sector }}</span>
                        </div>
                    </div>

                    <div class="prose prose-sm text-neutral-600 line-clamp-4">
                        {!! $job->company->description !!}
                    </div>

                    <div class="pt-2 space-y-2 border-t border-neutral-100">
                        <div class="flex items-start gap-2 text-sm text-neutral-600">
                            <i data-feather="map" class="w-4 h-4 shrink-0 mt-0.5 text-neutral-400"></i>
                            <span>{{ $job->company->address }}</span>
                        </div>

                        @if ($job->company->social_link)
                            <div class="flex items-start gap-2 text-sm text-neutral-600">
                                <i data-feather="globe" class="w-4 h-4 shrink-0 mt-0.5 text-neutral-400"></i>
                                <a href="{{ $job->company->social_link }}" target="_blank" rel="noopener noreferrer"
                                    class="text-primary hover:underline break-all">
                                    {{ $job->company->social_link }}
                                </a>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>

        {{-- Section Lowongan Serupa --}}
        @if (isset($relatedJobs) && $relatedJobs->isNotEmpty())
            <section class="mt-12 pt-8 border-t border-neutral-200 space-y-6">
                <div class="flex justify-between items-center gap-2">
                    <h2 class="text-xl font-bold">Lowongan Serupa di Kategori {{ $job->category->name }}</h2>
                </div>

                <div class="flex flex-col">
                    @foreach ($relatedJobs as $related)
                        <a href="{{ route('show', $related->slug) }}"
                            class="flex flex-col sm:flex-row justify-between items-start hover:bg-base-300 p-3 rounded-selector transition gap-2 sm:gap-0 border border-transparent hover:border-neutral-200">

                            <div class="flex gap-4">
                                <div class="avatar shrink-0">
                                    <div class="w-20 sm:w-24 rounded-selector border border-neutral-200 bg-white p-1">
                                        <img src="{{ $related->company->logo ? asset('storage/' . $related->company->logo) : asset('storage/' . $related->poster) }}"
                                            alt="{{ $related->company->name }} Logo" class="object-contain" />
                                    </div>
                                </div>
                                <div class="flex flex-col py-1">
                                    <span
                                        class="font-bold text-lg text-base-content hover:text-primary transition-colors">{{ $related->title }}</span>
                                    <span class="text-neutral-600">{{ $related->company->name }} &bull;
                                        {{ $related->location_area }}</span>
                                    <div class="flex flex-wrap gap-2 mt-2">
                                        <span class="badge badge-ghost badge-sm border border-neutral-300 italic">
                                            {{ str_replace('_', ' ', Str::title($related->type->name)) }}
                                        </span>
                                    </div>
                                </div>
                            </div>

                            <div
                                class="flex flex-col py-1 sm:pr-2 text-left sm:text-end w-full sm:w-auto mt-2 sm:mt-0">
                                @if (!empty($related->salary_max) || !empty($related->salary_min))
                                    <span class="text-success font-medium text-base sm:text-lg">Rp
                                        {{ number_format($related->salary_min, 0, ',', '.') }} - Rp
                                        {{ number_format($related->salary_max, 0, ',', '.') }}</span>
                                @endif
                                <span class="text-sm text-neutral-500">Batas:
                                    {{ \Carbon\Carbon::parse($related->closing_date)->translatedFormat('d M Y') }}</span>
                            </div>
                        </a>

                        @if (!$loop->last)
                            <div class="divider my-1"></div>
                        @endif
                    @endforeach
                </div>
            </section>
        @endif

    </div>

    @push('scripts')
        <script>
            feather.replace();
        </script>
    @endpush
</x-layout.app>
