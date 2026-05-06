<x-layout.dashboard>
    <div class="w-full space-y-4">
        <div class="flex justify-between items-center">
            <h1 class="text-2xl font-medium">Data Postingan Pekerjaan</h1>
        </div>
        <div class="bg-white rounded-box border border-base-300 shadow">
            <table class="table table-zebra">
                <thead>
                    <tr>
                        <th class="w-16"></th>
                        <th>Poster</th>
                        <th>Judul Postingan</th>
                        <th>Tipe </th>
                        <th>Lokasi</th>
                        <th class="text-center">Status</th>
                        <th class="text-center">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($jobs as $job)
                        <tr>
                            <th class="text-center">{{ $job->id }}</th>
                            <td>
                                <div class="avatar">
                                    <div class="w-24 rounded cursor-pointer transition-transform hover:scale-105">
                                        @if (!empty($job->poster))
                                            <a href="{{ asset('storage/' . $job->poster) }}"
                                                data-lightbox="poster-{{ $job->id }}"
                                                data-title="Poster: {{ $job->title }} - {{ $job->company->name }}">

                                                <img src="{{ asset('storage/' . $job->poster) }}"
                                                    alt="Poster {{ $job->title }}" />
                                            </a>
                                        @else
                                            <a href="https://ui-avatars.com/api/?name={{ urlencode($job->company->name) }}&background=random&color=fff&size=800"
                                                data-lightbox="poster-{{ $job->id }}"
                                                data-title="Logo: {{ $job->company->name }}">

                                                <img src="https://ui-avatars.com/api/?name={{ urlencode($job->company->name) }}&background=random&color=fff&size=200"
                                                    alt="{{ $job->company->name }} Logo" />
                                            </a>
                                        @endif
                                    </div>
                                </div>
                            </td>
                            <td>{{ $job->title }}</td>
                            <td>{{ $job->type->name }}</td>
                            <td>{{ $job->location_area }}</td>
                            <td class="text-center font-medium">
                                @if ($job->is_active = true)
                                    <span class="badge badge-success text-white">Terbuka</span>
                                @else
                                    <span class="badge badge-error text-white">Tutup</span>
                                @endif
                            </td>
                            <td>
                                <div class="flex gap-2 justify-center">
                                    <div class="tooltip" data-tip="Edit">
                                        <button
                                            onclick="document.getElementById('show_data_{{ $job->id }}').showModal()"
                                            class="btn btn-info btn-sm rounded-selector">
                                            <i data-feather="eye" class="size-4 text-white"></i>
                                        </button>
                                    </div>
                                    <div class="tooltip" data-tip="Edit">
                                        <button
                                            onclick="document.getElementById('edit_data_{{ $job->id }}').showModal()"
                                            class="btn btn-warning btn-sm rounded-selector">
                                            <i data-feather="edit-3" class="size-4 text-white"></i>
                                        </button>
                                    </div>
                                    <div class="tooltip" data-tip="Hapus">
                                        <button
                                            onclick="document.getElementById('delete_data_{{ $job->id }}').showModal()"
                                            class="btn btn-error btn-sm rounded-selector">
                                            <i data-feather="trash" class="size-4 text-white"></i>
                                        </button>
                                    </div>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="7" class="text-center py-12">
                                <div class="flex flex-col items-center justify-center gap-2 text-base-content/50">
                                    <i data-feather="clipboard" class="size-10"></i>
                                    <p class="text-base font-medium">Belum ada data postingan pekerjaan.</p>
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

@foreach ($jobs as $job)
    <dialog id="show_data_{{ $job->id }}" class="modal">
        <div class="modal-box w-11/12 max-w-4xl">
            <h3 class="text-xl font-bold mb-4 border-b pb-4">Detail Lowongan Pekerjaan</h3>
            <div class="py-2 space-y-6">
                <div class="flex items-center gap-4">
                    <div class="avatar">
                        <div class="w-16 h-16 rounded shadow">
                            <img src="{{ !empty($job->company->logo) ? asset('storage/' . $job->company->logo) : 'https://ui-avatars.com/api/?name=' . urlencode($job->company->name ?? 'Company') . '&background=random&color=fff&size=100' }}"
                                alt="{{ $job->company->name ?? 'Company' }} Logo" />
                        </div>
                    </div>
                    <div>
                        <h4 class="text-2xl font-bold text-base-content">{{ $job->title }}</h4>
                        <p class="text-base-content/70 font-medium">{{ $job->company->name ?? '-' }}</p>
                    </div>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-4 bg-base-200 p-4 rounded-xl">
                    <!-- ... (Kode Grid Kategori, Tipe, Lokasi, Gaji, dll tetap sama persis) ... -->
                    <div>
                        <span
                            class="block text-xs font-bold text-base-content/50 uppercase tracking-wider">Kategori</span>
                        <span class="block text-base font-medium">{{ $job->category->name ?? '-' }}</span>
                    </div>
                    <div>
                        <span class="block text-xs font-bold text-base-content/50 uppercase tracking-wider">Tipe
                            Pekerjaan</span>
                        <span class="block text-base font-medium">{{ $job->type->name ?? '-' }}</span>
                    </div>
                    <div>
                        <span class="block text-xs font-bold text-base-content/50 uppercase tracking-wider">Area
                            Lokasi</span>
                        <span class="block text-base font-medium">{{ $job->location_area }}</span>
                    </div>
                    <div>
                        <span class="block text-xs font-bold text-base-content/50 uppercase tracking-wider">Rentang
                            Gaji</span>
                        <span class="block text-base font-medium text-success">
                            @if ($job->salary_min && $job->salary_max)
                                Rp {{ number_format($job->salary_min, 0, ',', '.') }} - Rp
                                {{ number_format($job->salary_max, 0, ',', '.') }}
                            @elseif($job->salary_min)
                                Mulai Rp {{ number_format($job->salary_min, 0, ',', '.') }}
                            @elseif($job->salary_max)
                                Maks Rp {{ number_format($job->salary_max, 0, ',', '.') }}
                            @else
                                Dirahasiakan
                            @endif
                        </span>
                    </div>
                    <div>
                        <span class="block text-xs font-bold text-base-content/50 uppercase tracking-wider">Tutup
                            Pada</span>
                        <span class="block text-base font-medium text-error">
                            {{ \Carbon\Carbon::parse($job->closing_date)->translatedFormat('d F Y') }}
                        </span>
                    </div>
                    <div>
                        <span
                            class="block text-xs font-bold text-base-content/50 uppercase tracking-wider">Status</span>
                        @if ($job->is_active)
                            <div class="badge badge-success text-white mt-1 border-none">Terbuka</div>
                        @else
                            <div class="badge badge-error text-white mt-1 border-none">Tutup</div>
                        @endif
                    </div>

                    <div class="md:col-span-2 mt-2 pt-2 border-t border-base-300">
                        <span class="block text-xs font-bold text-base-content/50 uppercase tracking-wider">Link
                            Pendaftaran / Info</span>
                        @if ($job->link)
                            <a href="{{ $job->link }}" target="_blank"
                                class="block text-base font-medium text-primary hover:underline break-all">
                                {{ $job->link }}
                            </a>
                        @else
                            <span class="block text-base font-medium text-base-content/70">-</span>
                        @endif
                    </div>
                </div>

                <div>
                    <span class="block text-sm font-bold text-base-content mb-2 border-b pb-1">Deskripsi
                        Pekerjaan</span>
                    <div class="text-sm text-base-content/80 whitespace-pre-wrap">{{ $job->description }}</div>
                </div>
                <div>
                    <span class="block text-sm font-bold text-base-content mb-2 border-b pb-1">Persyaratan</span>
                    <div class="text-sm text-base-content/80 whitespace-pre-wrap">{{ $job->requirements }}</div>
                </div>

                <!-- Tambahan Tampilan Poster -->
                @if ($job->poster)
                    <div>
                        <span class="block text-sm font-bold text-base-content mb-2 border-b pb-1">Poster
                            Lowongan</span>
                        <img src="{{ asset('storage/' . $job->poster) }}" alt="Poster {{ $job->title }}"
                            class="max-w-full h-auto rounded-xl border border-base-300 shadow-sm mt-2" />
                    </div>
                @endif

            </div>
            <div class="modal-action">
                <form method="dialog">
                    <button class="btn rounded-selector">Tutup</button>
                </form>
            </div>
        </div>
        <form method="dialog" class="modal-backdrop">
            <button>close</button>
        </form>
    </dialog>

    <dialog id="edit_data_{{ $job->id }}" class="modal">
        <div class="modal-box w-11/12 max-w-4xl">
            <h3 class="text-xl font-bold mb-2">Edit Data Lowongan Pekerjaan</h3>

            <!-- PENTING: Tambahkan enctype="multipart/form-data" -->
            <form action="{{ route('admin.job.update', $job->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')

                <div class="py-4 grid grid-cols-1 md:grid-cols-2 gap-4">
                    <!-- ... (Field Title, Company, Category, dll tetap sama persis) ... -->
                    <fieldset class="fieldset md:col-span-2">
                        <legend class="fieldset-legend">Judul Lowongan <span class="text-error">*</span></legend>
                        <input type="text" name="title" class="input input-bordered w-full rounded-selector"
                            placeholder="Misal: Staff Administrasi Gudang" value="{{ $job->title }}" required />
                    </fieldset>

                    <fieldset class="fieldset">
                        <legend class="fieldset-legend">Perusahaan <span class="text-error">*</span></legend>
                        <select name="company_id" class="select select-bordered w-full rounded-selector" required>
                            <option value="" disabled>Pilih Perusahaan</option>
                            @foreach ($companies as $company)
                                <option value="{{ $company->id }}"
                                    {{ $job->company_id == $company->id ? 'selected' : '' }}>
                                    {{ $company->name }}
                                </option>
                            @endforeach
                        </select>
                    </fieldset>

                    <fieldset class="fieldset">
                        <legend class="fieldset-legend">Kategori <span class="text-error">*</span></legend>
                        <select name="category_id" class="select select-bordered w-full rounded-selector" required>
                            <option value="" disabled>Pilih Kategori</option>
                            @foreach ($categories as $category)
                                <option value="{{ $category->id }}"
                                    {{ $job->category_id == $category->id ? 'selected' : '' }}>
                                    {{ $category->name }}
                                </option>
                            @endforeach
                        </select>
                    </fieldset>

                    <fieldset class="fieldset">
                        <legend class="fieldset-legend">Tipe Pekerjaan <span class="text-error">*</span></legend>
                        <select name="type_id" class="select select-bordered w-full rounded-selector" required>
                            <option value="" disabled>Pilih Tipe</option>
                            @foreach ($types as $type)
                                <option value="{{ $type->id }}"
                                    {{ $job->type_id == $type->id ? 'selected' : '' }}>
                                    {{ $type->name }}
                                </option>
                            @endforeach
                        </select>
                    </fieldset>

                    <fieldset class="fieldset">
                        <legend class="fieldset-legend">Area Lokasi <span class="text-error">*</span></legend>
                        <input type="text" name="location_area"
                            class="input input-bordered w-full rounded-selector" placeholder="Misal: Kota Kendari"
                            value="{{ $job->location_area }}" required />
                    </fieldset>

                    <fieldset class="fieldset">
                        <legend class="fieldset-legend">Gaji Minimal (Opsional)</legend>
                        <label class="input input-bordered flex items-center w-full gap-2 rounded-selector">
                            <span>Rp</span>
                            <input type="number" name="salary_min" class="grow" placeholder="3000000"
                                value="{{ $job->salary_min }}" />
                        </label>
                        <div class="fieldset-label text-xs mt-1 text-base-content/60">
                            Isi salah satu saja jika gaji berupa nilai pasti. Kosongkan jika dirahasiakan.
                        </div>
                    </fieldset>

                    <fieldset class="fieldset">
                        <legend class="fieldset-legend">Gaji Maksimal (Opsional)</legend>
                        <label class="input input-bordered flex items-center w-full gap-2 rounded-selector">
                            <span>Rp</span>
                            <input type="number" name="salary_max" class="grow " placeholder="5000000"
                                value="{{ $job->salary_max }}" />
                        </label>
                        <div class="fieldset-label text-xs mt-1 text-base-content/60">
                            Isi jika ada batas atas gaji.
                        </div>
                    </fieldset>

                    <fieldset class="fieldset">
                        <legend class="fieldset-legend">Tanggal Penutupan <span class="text-error">*</span></legend>
                        <input type="date" name="closing_date"
                            class="input input-bordered w-full rounded-selector"
                            value="{{ $job->closing_date ? \Carbon\Carbon::parse($job->closing_date)->format('Y-m-d') : '' }}"
                            required />
                    </fieldset>

                    <fieldset class="fieldset">
                        <legend class="fieldset-legend">Status Lowongan <span class="text-error">*</span></legend>
                        <select name="is_active" class="select select-bordered w-full rounded-selector" required>
                            <option value="1" {{ $job->is_active == 1 ? 'selected' : '' }}>Terbuka</option>
                            <option value="0" {{ $job->is_active == 0 ? 'selected' : '' }}>Tutup</option>
                        </select>
                    </fieldset>

                    <fieldset class="fieldset md:col-span-2">
                        <legend class="fieldset-legend">Link Pendaftaran / Info (Opsional)</legend>
                        <input type="url" name="link" class="input input-bordered w-full rounded-selector"
                            placeholder="Misal: https://forms.gle/... atau https://perusahaan.com/karir"
                            value="{{ $job->link }}" />
                        <label class="label text-xs">Kamu bisa memasukkan link dengan ketik "https://wa.me/(nomor wa
                            tujuan)"</label>
                    </fieldset>

                    <fieldset class="fieldset md:col-span-2">
                        <legend class="fieldset-legend">Deskripsi Pekerjaan <span class="text-error">*</span></legend>
                        <textarea name="description" class="textarea textarea-bordered w-full h-32 rounded-selector"
                            placeholder="Jelaskan deskripsi pekerjaan secara detail..." required>{{ $job->description }}</textarea>
                    </fieldset>

                    <fieldset class="fieldset md:col-span-2">
                        <legend class="fieldset-legend">Persyaratan (Requirements) <span class="text-error">*</span>
                        </legend>
                        <textarea name="requirements" class="textarea textarea-bordered w-full h-32 rounded-selector"
                            placeholder="Jelaskan syarat dan kualifikasi yang dibutuhkan..." required>{{ $job->requirements }}</textarea>
                    </fieldset>

                    <!-- Tambahan Form Input Poster -->
                    <fieldset class="fieldset md:col-span-2">
                        <legend class="fieldset-legend">Poster Lowongan (Opsional)</legend>
                        <input type="file" name="poster"
                            class="file-input file-input-bordered w-full rounded-selector"
                            accept="image/jpeg,image/png,image/webp" />
                        <div class="fieldset-label text-xs mt-1 text-base-content/60">
                            Format: JPG, PNG, WEBP. Biarkan kosong jika tidak ingin mengubah poster.
                        </div>

                        <!-- Preview Poster Saat Ini -->
                        @if ($job->poster)
                            <div class="mt-3">
                                <span class="block text-xs font-bold mb-1">Poster saat ini:</span>
                                <img src="{{ asset('storage/' . $job->poster) }}"
                                    class="h-32 w-auto object-cover rounded border border-base-300 shadow-sm"
                                    alt="Current Poster" />
                            </div>
                        @endif
                    </fieldset>

                </div>
                <div class="modal-action">
                    <button type="submit" class="btn btn-primary text-white rounded-selector">Update
                        Lowongan</button>
                    <button type="button" class="btn rounded-selector"
                        onclick="document.getElementById('edit_data_{{ $job->id }}').close()">Batal</button>
                </div>
            </form>
        </div>
    </dialog>

    <dialog id="delete_data_{{ $job->id }}" class="modal">
        <div class="modal-box">
            <h3 class="text-lg font-bold mb-2">Hapus Data Lowongan</h3>
            <form action="{{ route('admin.job.destroy', $job->id) }}" method="POST">
                @csrf
                @method('DELETE')
                <div class="py-4 space-y-4">
                    <p>Apakah kamu yakin ingin menghapus lowongan pekerjaan <span
                            class="font-bold">{{ $job->title }}</span> dari usaha <span
                            class="font-bold">{{ $job->company->name }}</span>
                        ?</p>
                </div>
                <div class="modal-action">
                    <button type="submit" class="btn btn-primary rounded-selector">Hapus Kategori</button>
                    <button type="button" class="btn rounded-selector"
                        onclick="document.getElementById('delete_data_{{ $job->id }}').close()">Batal</button>
                </div>
            </form>
        </div>
    </dialog>
@endforeach
