<x-layout.app>
    <div class="text-center max-w-2xl mx-auto mb-4">
        <h1 class="text-3xl font-extrabold text-base-content tracking-tight">
            Eksplorasi <span class="text-primary">Lowongan</span>
        </h1>
    </div>

    <form action="{{ route('showAllJobs') }}" method="GET" class="mb-4">
        <div class="grid grid-cols-3 gap-2">
            <label
                class="input col-span-3 w-full ring-0 rounded-selector bg-base-300 focus-within:bg-white active:bg-white transition-all duration-300">
                <svg class="h-[1em] opacity-50" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24">
                    <g stroke-linejoin="round" stroke-linecap="round" stroke-width="2.5" fill="none"
                        stroke="currentColor">
                        <circle cx="11" cy="11" r="8"></circle>
                        <path d="m21 21-4.3-4.3"></path>
                    </g>
                </svg>
                <input type="search" required placeholder="Search" />
            </label> <select name="category_id" class="select rounded-selector w-full sm:w-auto cursor-pointer"
                onchange="this.form.submit()">
                <option value="">Semua Kategori</option>
                @foreach ($categories as $category)
                    <option value="{{ $category->id }}" {{ request('category_id') == $category->id ? 'selected' : '' }}>
                        {{ $category->name }}
                    </option>
                @endforeach
            </select>

            <select name="type_id" class="select rounded-selector w-full sm:w-auto cursor-pointer"
                onchange="this.form.submit()">
                <option value="">Tipe Kerjaan</option>
                @foreach ($types as $type)
                    <option value="{{ $type->id }}" {{ request('type_id') == $type->id ? 'selected' : '' }}>
                        {{ str_replace('_', ' ', Str::title($type->name)) }}
                    </option>
                @endforeach
            </select>

            <select name="salary" class="select rounded-selector w-full sm:w-auto cursor-pointer"
                onchange="this.form.submit()">
                <option value="">Semua Gaji</option>
                <option value="highest" {{ request('salary') == 'highest' ? 'selected' : '' }}>Gaji Tertinggi
                </option>
                <option value="lowest" {{ request('salary') == 'lowest' ? 'selected' : '' }}>Gaji Terendah</option>
                <option value="hidden" {{ request('salary') == 'hidden' ? 'selected' : '' }}>Gaji Dirahasiakan
                </option>
            </select>
        </div>
    </form>

    <div class="flex flex-col gap-4">
        @forelse ($jobs as $job)
            <a href="{{ route('show', $job->slug) }}"
                class="flex flex-col sm:flex-row justify-between items-start hover:bg-base-300 p-2 rounded-selector transition gap-2 sm:gap-y-0">

                <div class="flex gap-2">
                    <div class="avatar shrink-0">
                        <div class="w-28 rounded-selector">
                            <img src="{{ $job->company->logo ? asset('storage/' . $job->company->logo) : asset('storage/' . $job->poster) }}"
                                alt="{{ $job->company->name }} Logo" />
                        </div>
                    </div>
                    <div class="flex flex-col py-1">
                        <span class="font-bold">{{ $job->title }}</span>
                        <p class="flex flex-wrap items-center gap-2 text-sm">
                            <span class="font-medium">{{ $job->company->name }}</span>

                            <span class="text-neutral-400">•</span>

                            <span class="flex items-center gap-1 text-neutral-500">
                                <i data-feather="map-pin" class="size-3 shrink-0"></i>
                                <span>{{ $job->location_area }}</span>
                            </span>
                        </p>
                        <div class="flex flex-wrap gap-2 mt-auto pt-2 sm:pt-0 items-center">
                            <span class="badge badge-ghost badge-xs md:badge-sm border border-neutral-300 italic">
                                {{ str_replace('_', ' ', Str::title($job->type->name)) }}
                            </span>
                            <span class="text-xs text-neutral-500">
                                Daftar sebelum {{ $job->created_at->translatedFormat('d F Y') }} </span>
                        </div>
                    </div>
                </div>

                <div class="flex flex-col py-1 sm:pr-2 text-left sm:text-end w-full sm:w-auto mt-2 sm:mt-0">
                    @if (!empty($job->salary_max) || !empty($job->salary_min))
                        <span class="text-success font-semibold">Rp
                            {{ number_format($job->salary_min, 0, ',', '.') }} - Rp
                            {{ number_format($job->salary_max, 0, ',', '.') }}</span>
                    @endif
                    <span class="text-neutral-500">/Bulan</span>
                </div>
            </a>
            <div class="divider my-0 md:hidden"></div>
        @empty
            <div class="text-center py-4 text-gray-500">
                Tidak ada data lowongan yang sesuai dengan kriteria.
            </div>
        @endforelse
    </div>

    <div class="mt-4">
        {{ $jobs->withQueryString()->links() }}
    </div>
</x-layout.app>
