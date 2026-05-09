<x-layout.profile>
    <section class="p-6 bg-white shadow rounded-box">
        <h2 class="text-2xl font-medium">Pengaturan Usaha/Perusahaan</h2>
    </section>

    <section class="p-6 bg-white shadow rounded-box flex flex-col gap-8">
        <div class="flex items-center justify-between">
            <h1 class="text-lg font-medium">Informasi Usaha/Perusahaan</h1>
            {{-- Tombol Edit --}}
            @if (!empty($company->id))
                <button type="button" onclick="document.getElementById('edit_data_{{ $company->id }}').showModal()"
                    class="btn btn-ghost btn-xs p-1">
                    <i data-feather="edit-2" class="size-4 text-primary"></i>
                </button>
            @endif
        </div>

        @if (!empty($company->id))
            {{-- Logo --}}
            <img src="{{ $company->logo ? asset('storage/' . $company->logo) : 'https://ui-avatars.com/api/?name=' . urlencode($company->name) }}"
                alt="{{ $company->name }}" class="size-32 rounded-selector object-cover mx-auto">

            {{-- Grid Data --}}
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                <div class="flex flex-col space-y-1">
                    <span class="text-sm font-semibold text-neutral-500">Nama Usaha/Perusahaan</span>
                    <p class="text-sm font-normal text-neutral-800">{{ $company->name }}</p>
                </div>

                <div class="flex flex-col space-y-1">
                    <span class="text-sm font-semibold text-neutral-500">Sektor Usaha</span>
                    <p class="text-sm font-normal text-neutral-800">{{ $company->sector ?: '-' }}</p>
                </div>

                <div class="flex flex-col space-y-1">
                    <span class="text-sm font-semibold text-neutral-500">Alamat Usaha</span>
                    <p class="text-sm font-normal text-neutral-800">{{ $company->address ?: '-' }}</p>
                </div>

                <div class="flex flex-col space-y-1">
                    <span class="text-sm font-semibold text-neutral-500">Sosial Media</span>
                    <p class="text-sm font-normal text-neutral-800">{{ $company->social_link ?: '-' }}</p>
                </div>

                <div class="flex flex-col space-y-1">
                    <span class="text-sm font-semibold text-neutral-500">Akun pengelola</span>
                    <p class="text-sm font-normal text-neutral-800">{{ $company->user->name ?? '-' }}</p>
                </div>

                <div class="flex flex-col space-y-1">
                    <span class="text-sm font-semibold text-neutral-500">Total lowongan</span>
                    <p class="text-sm font-normal text-neutral-800">{{ $company->jobs->count() ?? '-' }}</p>
                </div>

                <div class="flex flex-col space-y-1 col-span-full">
                    <span class="text-sm font-semibold text-neutral-500">Deskripsi</span>
                    <p class="text-sm font-normal text-neutral-800">
                        {{ $company->description ?: '-' }}</p>
                </div>
            </div>

            <dialog id="edit_data_{{ $company->id }}" class="modal">
                <div class="modal-box max-w-3xl">
                    <h3 class="text-xl font-bold text-center mb-6">Edit Profil Perusahaan</h3>

                    <form action="{{ route('employer.company.update', $company->id) }}" method="POST"
                        enctype="multipart/form-data">
                        @csrf
                        @method('PUT')

                        {{-- Logo Section dengan Preview --}}
                        <div class="flex flex-col items-center mb-6">
                            <div class="avatar mb-3">
                                <div class="w-24 rounded-selector ring ring-primary ring-offset-base-100 ring-offset-2">
                                    <img id="logo_preview_{{ $company->id }}"
                                        src="{{ $company->logo ? asset('storage/' . $company->logo) : 'https://ui-avatars.com/api/?name=' . urlencode($company->name) }}"
                                        alt="Company Logo" />
                                </div>
                            </div>
                            <label class="form-control w-full max-w-xs">
                                <div class="label pb-1 pt-0">
                                    <span class="text-sm mx-auto">Unggah Logo Baru</span>
                                </div>
                                <input type="file" name="logo" accept="image/*"
                                    class="file-input file-input-bordered file-input-sm w-full rounded-selector"
                                    onchange="previewAvatar(event, 'logo_preview_{{ $company->id }}')">
                            </label>
                        </div>

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                            {{-- Nama Perusahaan --}}
                            <label class="form-control w-full">
                                <span class="text-sm">Nama Perusahaan<span class="text-error">*</span></span>
                                <input type="text" name="name" value="{{ $company->name }}"
                                    class="input input-bordered w-full rounded-selector" required>
                            </label>

                            {{-- Sektor --}}
                            <label class="form-control w-full">
                                <span class="text-sm">Sektor Usaha<span class="text-error">*</span></span>
                                <input type="text" name="sector" value="{{ $company->sector }}"
                                    class="input input-bordered w-full rounded-selector" required
                                    placeholder="Contoh: IT, Retail, F&B">
                            </label>

                            {{-- Social Account (URL) --}}
                            <label class="form-control w-full md:col-span-2">
                                <span class="text-sm">Sosial Media / Website (URL)</span>
                                <input type="url" name="social_link" value="{{ $company->social_link }}"
                                    class="input input-bordered w-full rounded-selector"
                                    placeholder="https://perusahaan.com">
                            </label>

                            {{-- Alamat --}}
                            <label class="form-control w-full md:col-span-2">
                                <span class="text-sm">Alamat Perusahaan<span class="text-error">*</span></span>
                                <textarea name="address" class="textarea textarea-bordered w-full rounded-2xl" rows="2" required>{{ $company->address }}</textarea>
                            </label>

                            {{-- Deskripsi --}}
                            <label class="form-control w-full md:col-span-2">
                                <span class="text-sm">Deskripsi Perusahaan<span class="text-error">*</span></span>
                                <textarea name="description" class="textarea textarea-bordered w-full rounded-2xl" rows="3" required>{{ $company->description }}</textarea>
                            </label>
                        </div>

                        {{-- Action Buttons --}}
                        <div class="modal-action mt-6">
                            <button type="button" class="btn btn-ghost rounded-selector"
                                onclick="document.getElementById('edit_data_{{ $company->id }}').close()">Batal</button>
                            <button type="submit" class="btn btn-primary rounded-selector px-6">
                                <i data-feather="save" class="size-4"></i>Simpan Perubahan
                            </button>
                        </div>
                    </form>
                </div>

                <form method="dialog" class="modal-backdrop">
                    <button>close</button>
                </form>
            </dialog>
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
