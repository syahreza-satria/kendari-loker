<x-layout.dashboard>
    <div class="w-full space-y-4">
        <div class="flex justify-between items-center">
            <h1 class="text-2xl font-medium">Data Perusahaan Terdaftar</h1>
        </div>
        <div class="bg-white rounded-box border border-base-300 shadow">
            <table class="table table-zebra">
                <thead>
                    <tr>
                        <th class="w-16"></th>
                        <th>Logo Usaha</th>
                        <th>Nama Usaha</th>
                        <th>Deskripsi</th>
                        <th>Alamat</th>
                        <th>Website</th>
                        <th class="text-center">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($companies as $company)
                        <tr>
                            <th class="text-center">{{ $company->id }}</th>
                            <td>
                                <div class="avatar">
                                    <div class="w-24 rounded cursor-pointer transition-transform hover:scale-105">
                                        @if (!empty($company->logo))
                                            <a href="{{ asset('storage/' . $company->logo) }}"
                                                data-lightbox="poster-{{ $company->id }}"
                                                data-title="Logo {{ $company->name }}">

                                                <img src="{{ asset('storage/' . $company->logo) }}"
                                                    alt="Poster {{ $company->title }}" />
                                            </a>
                                        @else
                                            <a href="https://ui-avatars.com/api/?name={{ urlencode($company->name) }}&background=random&color=fff&size=800"
                                                data-lightbox="poster-{{ $company->id }}"
                                                data-title="Logo: {{ $company->name }}">

                                                <img src="https://ui-avatars.com/api/?name={{ urlencode($company->name) }}&background=random&color=fff&size=200"
                                                    alt="{{ $company->name }} Logo" />
                                            </a>
                                        @endif
                                    </div>
                                </div>
                            </td>
                            <td>{{ $company->name }}</td>
                            <td>{{ $company->description }}</td>
                            <td>{{ $company->address }}</td>
                            <td>{{ $company->website }}</td>
                            <td>
                                <div class="flex gap-2 justify-center">
                                    <div class="tooltip" data-tip="Lihat Informasi">
                                        <button
                                            onclick="document.getElementById('show_data_{{ $company->id }}').showModal()"
                                            class="btn btn-info btn-sm rounded-selector">
                                            <i data-feather="eye" class="size-4 text-white"></i>
                                        </button>
                                    </div>
                                    <div class="tooltip" data-tip="Edit">
                                        <button
                                            onclick="document.getElementById('edit_data_{{ $company->id }}').showModal()"
                                            class="btn btn-warning btn-sm rounded-selector">
                                            <i data-feather="edit-3" class="size-4 text-white"></i>
                                        </button>
                                    </div>
                                    <div class="tooltip" data-tip="Hapus">
                                        <button
                                            onclick="document.getElementById('delete_data_{{ $company->id }}').showModal()"
                                            class="btn btn-error btn-sm rounded-selector">
                                            <i data-feather="trash" class="size-4 text-white"></i>
                                        </button>
                                    </div>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="text-center py-12">
                                <div class="flex flex-col items-center justify-center gap-2 text-base-content/50">
                                    <i data-feather="briefcase" class="size-10"></i>
                                    <p class="text-base font-medium">Belum ada data perusahaan .</p>
                                    <p class="text-sm">Data yang Anda tambahkan akan muncul di sini.</p>
                                </div>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</x-layout.dashboard>

@foreach ($companies as $company)
    <dialog id="show_data_{{ $company->id }}" class="modal">
        <div class="modal-box w-11/12 max-w-3xl">
            <h3 class="text-xl font-bold mb-4 border-b pb-4">Detail Profil Perusahaan</h3>

            <div class="py-2 space-y-6">
                <div class="flex items-center gap-5">
                    <div class="avatar">
                        <div class="w-20 h-20 rounded-xl border border-base-300 shadow-sm bg-base-100 p-1">
                            @if (!empty($company->logo))
                                <img src="{{ asset('storage/' . $company->logo) }}" alt="Logo {{ $company->name }}"
                                    class="rounded-lg object-contain" />
                            @else
                                <img src="https://ui-avatars.com/api/?name={{ urlencode($company->name) }}&background=random&color=fff&size=150"
                                    alt="{{ $company->name }} Logo" class="rounded-lg" />
                            @endif
                        </div>
                    </div>
                    <div>
                        <h4 class="text-2xl font-bold text-base-content">{{ $company->name }}</h4>
                        <p class="text-sm font-medium mt-1">
                            @if ($company->website)
                                <a href="{{ $company->website }}" target="_blank"
                                    class="text-primary hover:underline break-all flex items-center gap-1">
                                    <i data-feather="external-link" class="size-3"></i> {{ $company->website }}
                                </a>
                            @else
                                <span class="text-base-content/50 italic flex items-center gap-1">
                                    <i data-feather="link-2" class="size-3"></i> Tidak ada website
                                </span>
                            @endif
                        </p>
                    </div>
                </div>

                <div class="grid grid-cols-1 gap-4 bg-base-200 p-5 rounded-xl">
                    <div>
                        <span
                            class="block text-xs font-bold text-base-content/50 uppercase tracking-wider mb-1">Pengelola
                            Akun (Employer)</span>
                        <span class="block text-base font-medium">
                            {{ $company->user->name ?? 'User Tidak Ditemukan' }}
                            <span
                                class="text-sm font-normal text-base-content/70">({{ $company->user->email ?? '-' }})</span>
                        </span>
                    </div>

                    <div class="pt-3 border-t border-base-300/60">
                        <span class="block text-xs font-bold text-base-content/50 uppercase tracking-wider mb-1">Alamat
                            Lengkap</span>
                        <span
                            class="block text-base text-base-content whitespace-pre-wrap">{{ $company->address }}</span>
                    </div>
                </div>

                <div>
                    <span class="block text-sm font-bold text-base-content mb-2 border-b pb-1">Deskripsi
                        Perusahaan</span>
                    <div class="text-sm text-base-content/80 whitespace-pre-wrap leading-relaxed">
                        {{ $company->description }}</div>
                </div>
            </div>
            <div class="modal-action mt-6 pt-4 border-t border-base-200">
                <form method="dialog">
                    <button class="btn rounded-selector px-8">Tutup</button>
                </form>
            </div>
        </div>

        <form method="dialog" class="modal-backdrop">
            <button>close</button>
        </form>
    </dialog>

    <dialog id="edit_data_{{ $company->id }}" class="modal">
        <div class="modal-box w-11/12 max-w-3xl">
            <h3 class="text-xl font-bold mb-4 border-b pb-2">Edit Data Perusahaan</h3>

            <!-- PENTING: Tambahkan enctype="multipart/form-data" untuk upload logo -->
            <form action="{{ route('admin.company.update', $company->id) }}" method="POST"
                enctype="multipart/form-data">
                @csrf
                @method('PUT')

                <div class="py-4 grid grid-cols-1 md:grid-cols-2 gap-4">

                    <!-- Nama Perusahaan -->
                    <fieldset class="fieldset md:col-span-2">
                        <legend class="fieldset-legend">Nama Perusahaan <span class="text-error">*</span></legend>
                        <input type="text" name="name" class="input input-bordered w-full rounded-selector"
                            placeholder="Misal: PT Tech Indo Solusi" value="{{ $company->name }}" required />
                    </fieldset>

                    <!-- Relasi User / Pemilik Perusahaan (Hanya Read-Only) -->
                    <fieldset class="fieldset md:col-span-2">
                        <legend class="fieldset-legend">Pemilik Akun (Employer)</legend>
                        <input type="text"
                            class="input input-bordered w-full rounded-selector bg-base-200 text-base-content/70 cursor-not-allowed disabled:border disabled:border-neutral-300"
                            value="{{ $company->user->name ?? 'Tidak ada data' }} ({{ $company->user->email ?? '-' }})"
                            disabled />
                        <div class="fieldset-label text-xs mt-1 text-base-content/60">
                            *Akun pengelola perusahaan tidak dapat diubah setelah perusahaan didaftarkan.
                        </div>
                    </fieldset>

                    <!-- Website -->
                    <fieldset class="fieldset md:col-span-2">
                        <legend class="fieldset-legend">Website Perusahaan (Opsional)</legend>
                        <input type="url" name="website" class="input input-bordered w-full rounded-selector"
                            placeholder="Misal: https://techindo.test" value="{{ $company->website }}" />
                    </fieldset>

                    <!-- Deskripsi Perusahaan -->
                    <fieldset class="fieldset md:col-span-2">
                        <legend class="fieldset-legend">Deskripsi <span class="text-error">*</span></legend>
                        <textarea name="description" class="textarea textarea-bordered w-full h-32 rounded-selector"
                            placeholder="Jelaskan profil perusahaan..." required>{{ $company->description }}</textarea>
                    </fieldset>

                    <!-- Alamat -->
                    <fieldset class="fieldset md:col-span-2">
                        <legend class="fieldset-legend">Alamat Lengkap <span class="text-error">*</span></legend>
                        <textarea name="address" class="textarea textarea-bordered w-full h-24 rounded-selector"
                            placeholder="Misal: Jl. MT Haryono, Kendari..." required>{{ $company->address }}</textarea>
                    </fieldset>

                    <!-- Logo Perusahaan -->
                    <fieldset class="fieldset md:col-span-2">
                        <legend class="fieldset-legend">Logo Perusahaan (Opsional)</legend>
                        <input type="file" name="logo"
                            class="file-input file-input-bordered w-full rounded-selector"
                            accept="image/jpeg,image/png,image/webp" />
                        <div class="fieldset-label text-xs mt-1 text-base-content/60">
                            Format: JPG, PNG, WEBP. Biarkan kosong jika tidak ingin mengubah logo saat ini.
                        </div>

                        <!-- Preview Logo Saat Ini -->
                        <div class="mt-3">
                            <span class="block text-xs font-bold mb-2">Logo saat ini:</span>
                            <div class="avatar">
                                <div class="w-16 h-16 rounded border border-base-300 shadow-sm bg-base-200">
                                    @if (!empty($company->logo))
                                        <img src="{{ asset('storage/' . $company->logo) }}"
                                            alt="Logo {{ $company->name }}" />
                                    @else
                                        <img src="https://ui-avatars.com/api/?name={{ urlencode($company->name) }}&background=random&color=fff&size=100"
                                            alt="Fallback Logo" />
                                    @endif
                                </div>
                            </div>
                        </div>
                    </fieldset>

                </div>

                <!-- Modal Action Buttons -->
                <div class="modal-action border-t pt-4 mt-2">
                    <button type="submit" class="btn btn-primary text-white rounded-selector">Update Data</button>
                    <button type="button" class="btn rounded-selector"
                        onclick="document.getElementById('edit_data_{{ $company->id }}').close()">Batal</button>
                </div>
            </form>
        </div>
    </dialog>

    <dialog id="delete_data_{{ $company->id }}" class="modal">
        <div class="modal-box">
            <h3 class="text-lg font-bold mb-2">Hapus Data Kategori</h3>
            <form action="{{ route('admin.company.destroy', $company->id) }}" method="POST">
                @csrf
                @method('DELETE')
                <div class="py-4 space-y-4">
                    <p>Apakah kamu yakin ingin menghapus kategori <span class="font-bold">{{ $company->name }}</span>
                        ?</p>
                </div>
                <div class="modal-action">
                    <button type="submit" class="btn btn-primary rounded-selector">Hapus Kategori</button>
                    <button type="button" class="btn rounded-selector"
                        onclick="document.getElementById('delete_data_{{ $company->id }}').close()">Batal</button>
                </div>
            </form>
        </div>
    </dialog>
@endforeach
