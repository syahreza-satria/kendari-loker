<x-layout.app>
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8 lg:pb-12 lg:pt-6">

        <div class="text-center max-w-2xl mx-auto mb-8">
            <h1 class="text-3xl font-extrabold text-base-content tracking-tight">
                Eksplorasi <span class="text-primary">Kategori</span>
            </h1>
            <p class="text-base-content/70 mt-2">
                Temukan berbagai peluang karir berdasarkan bidang keahlian dan minatmu di Kendari Loker.
            </p>
        </div>

        <div class="divider mb-10"></div>
        <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6">

            @forelse ($categories as $category)
                <a href="#"
                    class="bg-base-100 p-6 rounded-selector shadow-sm hover:shadow-md border border-neutral-300 hover:border-primary transition-all duration-300 flex flex-col items-center justify-start group text-center">

                    <div
                        class="bg-base-200 group-hover:bg-primary/10 p-4 rounded-full mb-4 group-hover:scale-110 transition-all duration-300">
                        <i data-feather="{{ $category->icon }}"
                            class="size-8 text-base-content group-hover:text-primary transition-colors"></i>
                    </div>

                    <h3 class="font-medium text-lg text-base-content group-hover:text-primary transition-colors">
                        {{ $category->name }}
                    </h3>

                    <div
                        class="mt-3 badge badge-neutral badge-sm group-hover:badge-primary font-medium transition-colors">
                        {{ $category->jobs_count }} Lowongan
                    </div>

                </a>
            @empty
                <div
                    class="col-span-full py-20 flex flex-col items-center justify-center text-center bg-base-200/50 rounded-selector border border-dashed border-base-300">
                    <div class="bg-base-100 p-4 rounded-full mb-4 shadow-sm">
                        <i data-feather="inbox" class="size-10 text-base-content/40"></i>
                    </div>
                    <h3 class="text-xl font-medium text-base-content/80">Belum Ada Kategori</h3>
                    <p class="text-base-content/50 mt-1">Belum ada kategori pekerjaan yang didaftarkan saat ini.</p>
                </div>
            @endforelse

        </div>
    </div>
</x-layout.app>
