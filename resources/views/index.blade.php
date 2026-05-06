<x-layout.app>

    <x-hero :types="$types" :categories="$categories" />

    <div class="bg-white space-y-12 pb-16 px-4 md:px-0">
        <section class="space-y-4">
            <div class="flex justify-between items-center gap-2">
                <h2 class="text-lg md:text-xl font-bold text-nowrap">Kategori Lowongan</h2>
                <a href="{{ route('showAllCategory') }}"
                    class="btn btn-xs md:btn-sm btn-outline btn-primary rounded-selector">
                    Lihat Semua &rarr;
                </a>
            </div>
            <div class="carousel carousel-center w-full gap-4 py-2">
                @foreach ($categories as $category)
                    <a href="{{ route('index', ['category' => $category->id]) }}"
                        class="carousel-item w-64 group flex items-center gap-4 p-4 bg-base-200 border border-neutral-300 rounded-2xl hover:border-primary transition-all duration-300">
                        <div class="p-3 bg-base-300 rounded-xl group-hover:bg-primary/10 shrink-0">
                            <i data-feather="{{ $category->icon ?? 'file-text' }}"
                                class="w-6 h-6 text-base-content/70 group-hover:text-primary"></i>
                        </div>
                        <div class="flex flex-col overflow-hidden">
                            <span class="text-base font-bold text-base-content truncate group-hover:text-primary">
                                {{ $category->name }}
                            </span>
                            <span class="text-sm text-base-content/60 mt-0.5">
                                {{ $category->jobs_count }} Lowongan
                            </span>
                        </div>
                    </a>
                @endforeach
            </div>
        </section>

        <section class="space-y-4">
            <div class="flex justify-between items-center gap-2">
                <h2 class="text-lg md:text-xl font-bold">Lowongan Terbaru</h2>
                <a href="{{ route('showAllJobs') }}"
                    class="btn btn-xs md:btn-sm rounded-selector btn-outline btn-primary">
                    Lebih Banyak &rarr;
                </a>
            </div>

            <div class="flex flex-col">
                @forelse ($jobs as $job)
                    <a href="{{ route('show', $job->slug) }}"
                        class="flex flex-col sm:flex-row justify-between items-start hover:bg-base-300 p-2 rounded-selector transition gap-2 sm:gap-0">

                        <div class="flex gap-2">
                            <div class="avatar shrink-0">
                                <div class="w-28 rounded-selector">
                                    <img src="{{ $job->company->logo ? asset('storage/' . $job->company->logo) : asset('storage/' . $job->poster) }}"
                                        alt="{{ $job->company->name }} Logo" />
                                </div>
                            </div>
                            <div class="flex flex-col py-1">
                                <span class="font-medium text-lg">{{ $job->title }}</span>
                                <span class="">{{ $job->company->name }}</span>
                                <div class="flex flex-wrap gap-2 mt-auto pt-2 sm:pt-0">
                                    <span class="badge badge-success text-white badge-xs md:badge-sm">
                                        Terbuka
                                    </span>
                                    <span
                                        class="badge badge-ghost badge-xs md:badge-sm border border-neutral-300 italic">
                                        {{ str_replace('_', ' ', Str::title($job->type->name)) }}
                                    </span>
                                </div>
                            </div>
                        </div>

                        <div class="flex flex-col py-1 sm:pr-2 text-left sm:text-end w-full sm:w-auto mt-2 sm:mt-0">
                            @if (!empty($job->salary_max) || !empty($job->salary_min))
                                <span class="text-success font-medium text-lg">Rp
                                    {{ number_format($job->salary_min, 0, ',', '.') }} - Rp
                                    {{ number_format($job->salary_max, 0, ',', '.') }}</span>
                            @endif
                            <span class="text-neutral-500">/Bulan</span>
                        </div>
                    </a>
                    <div class="divider my-0"></div>
                @empty
                    <div class="text-center py-4 text-gray-500">
                        Tidak ada data lowongan yang sesuai dengan kriteria.
                    </div>
                @endforelse
                <a href="{{ route('showAllJobs') }}" class="btn btn-primary mt-4 btn-outline rounded-selector">Lihat
                    Semua</a>
            </div>
        </section>
    </div>
</x-layout.app>
