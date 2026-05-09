<x-layout.profile>
    {{-- Header Section --}}
    <section class="p-6 bg-white shadow rounded-box">
        <h2 class="text-2xl font-medium">Tambah Data Usaha/Perusahaan</h2>
    </section>

    {{-- Form Section --}}
    <section class="p-6 mt-6 bg-white shadow rounded-box flex flex-col gap-8">
        <div class="flex items-center justify-between">
            <h1 class="text-lg font-medium">Lengkapi Informasi Usaha</h1>
        </div>

        <form action="{{ route('employer.company.store') }}" method="POST" enctype="multipart/form-data"
            class="flex flex-col gap-6">
            @csrf

            {{-- Upload Logo --}}
            <div class="form-control w-full max-w-xs">
                <label class="label justify-center mb-4">
                    <span class="label-text text-sm font-semibold text-neutral-500">Logo Usaha/Perusahaan</span>
                </label>
                <div class="flex items-center space-x-4">
                    {{-- Avatar Preview --}}
                    <div class="avatar">
                        <div class="w-24 rounded-selector ring ring-primary ring-offset-base-100 ring-offset-2">
                            <img id="logo_preview_{{ $company->id ?? 'new' }}"
                                src="{{ !empty($company->logo) ? asset('storage/' . $company->logo) : 'https://ui-avatars.com/api/?name=' . urlencode($company->name ?? 'Company') }}"
                                alt="Profile Picture" class="object-cover w-full h-full" />
                        </div>
                    </div>

                    {{-- Input File --}}
                    <label class="form-control w-full max-w-xs">
                        <div class="label">
                            <span class="label-text text-xs font-medium">Unggah Foto Baru</span>
                        </div>
                        <input type="file" name="logo" accept="image/*"
                            class="file-input file-input-bordered file-input-sm w-full rounded-selector mx-auto"
                            onchange="previewLogo(event, 'logo_preview_{{ $company->id ?? 'new' }}')">
                    </label>
                </div>
            </div>

            {{-- Grid Data Input --}}
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mt-4">

                {{-- Nama Usaha --}}
                <div class="form-control w-full">
                    <label class="label">
                        <span class="label-text text-xs font-semibold text-neutral-500">Nama Usaha/Perusahaan <span
                                class="text-error">*</span></span>
                    </label>
                    <input type="text" name="name" value="{{ old('name') }}"
                        placeholder="Misal: PT Tech Indo Solusi"
                        class="input input-bordered w-full text-sm font-medium text-neutral-900 rounded-selector"
                        required />
                </div>

                {{-- Sektor Usaha --}}
                <div class="form-control w-full">
                    <label class="label">
                        <span class="label-text text-xs font-semibold text-neutral-500">Sektor Usaha</span>
                    </label>
                    <input type="text" name="sector" value="{{ old('sector') }}"
                        placeholder="Misal: Teknologi, F&B, Jasa"
                        class="input input-bordered w-full text-sm font-medium text-neutral-900 rounded-selector" />
                </div>

                {{-- Sosial Media --}}
                <div class="form-control w-full">
                    <label class="label">
                        <span class="label-text text-xs font-semibold text-neutral-500">Sosial Media /
                            Website</span>
                    </label>
                    <input type="text" name="social_link" value="{{ old('social_link') }}"
                        placeholder="Tautan instagram atau website"
                        class="input input-bordered w-full text-sm font-medium text-neutral-900 rounded-selector" />
                </div>

                {{-- Akun Pengelola (Read-only karena otomatis terikat dengan user login) --}}
                <div class="form-control w-full">
                    <label class="label">
                        <span class="label-text text-xs font-semibold text-neutral-500">Akun Pengelola</span>
                    </label>
                    <input type="text" value="{{ auth()->user()->name ?? '-' }}"
                        class="input input-bordered w-full text-sm font-medium bg-neutral-50 text-neutral-500 rounded-selector cursor-not-allowed"
                        readonly />
                </div>

                {{-- Alamat --}}
                <div class="form-control flex flex-col w-full col-span-1 md:col-span-2">
                    <label class="label">
                        <span class="label-text text-xs font-semibold text-neutral-500">Alamat Usaha <span
                                class="text-error">*</span></span>
                    </label>
                    <textarea name="address" placeholder="Masukkan alamat lengkap usaha..."
                        class="textarea textarea-bordered h-24 text-sm font-medium text-neutral-900 rounded-selector w-full" required>{{ old('address') }}</textarea>
                </div>

                {{-- Deskripsi --}}
                <div class="form-control flex flex-col w-full col-span-1 md:col-span-2">
                    <label class="label">
                        <span class="label-text text-xs font-semibold text-neutral-500">Deskripsi Usaha <span
                                class="text-error">*</span></span>
                    </label>
                    <textarea name="description" placeholder="Ceritakan secara singkat tentang profil dan bidang usaha Anda..."
                        class="textarea textarea-bordered h-32 text-sm font-medium text-neutral-900 rounded-selector w-full" required>{{ old('description') }}</textarea>
                </div>
            </div>

            {{-- Action Buttons --}}
            <div class="flex items-center justify-end gap-3 mt-6 border-t border-neutral-100 pt-6">
                {{-- Sesuaikan route ini dengan rute kembali ke profil kamu --}}
                <a href="{{ url()->previous() }}" class="btn btn-ghost rounded-selector">Batal</a>
                <button type="submit" class="btn btn-primary rounded-selector flex items-center gap-2">
                    <i data-feather="save" class="size-4"></i>
                    Simpan Data
                </button>
            </div>
        </form>
    </section>

    @push('scripts')
        <script>
            function previewLogo(event, previewElementId) {
                const input = event.target;
                const previewImage = document.getElementById(previewElementId);

                if (input.files && input.files[0]) {
                    const reader = new FileReader();

                    reader.onload = function(e) {
                        previewImage.src = e.target.result;
                    }

                    reader.readAsDataURL(input.files[0]);
                }
            }
        </script>
    @endpush
</x-layout.profile>
