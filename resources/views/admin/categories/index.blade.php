<x-layout.dashboard>
    <div class="w-full space-y-4">
        <div class="flex justify-between items-center">
            <h1 class="text-2xl font-medium">Data Kategori Pekerjaan</h1>
            <button type="button" onclick="add_data.showModal()" class="btn btn-primary rounded-selector btn-sm">Tambah
                Data
                <i data-feather="plus" class="size-4"></i></button>
        </div>
        <div class="bg-white rounded-box border border-base-300 shadow">
            <table class="table table-zebra">
                <thead>
                    <tr>
                        <th class="w-16"></th>
                        <th>Nama Kategori</th>
                        <th>Icon</th>
                        <th>Tanggal Ditambahkan</th>
                        <th class="text-center">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($categories as $category)
                        <tr>
                            <th class="text-center">{{ $category->id }}</th>
                            <td>{{ $category->name }}</td>
                            <td><i data-feather="{{ $category->icon }}"></i></td>
                            <td>{{ $category->created_at }}</td>
                            <td>
                                <div class="flex gap-2 justify-center">
                                    <div class="tooltip" data-tip="Edit">
                                        <button
                                            onclick="document.getElementById('edit_data_{{ $category->id }}').showModal()"
                                            class="btn btn-warning btn-sm rounded-selector">
                                            <i data-feather="edit-3" class="size-4 text-white"></i>
                                        </button>
                                    </div>
                                    <div class="tooltip" data-tip="Hapus">
                                        <button
                                            onclick="document.getElementById('delete_data_{{ $category->id }}').showModal()"
                                            class="btn btn-error btn-sm rounded-selector">
                                            <i data-feather="trash" class="size-4 text-white"></i>
                                        </button>
                                    </div>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="text-center py-12">
                                <div class="flex flex-col items-center justify-center gap-2 text-base-content/50">
                                    <i data-feather="inbox" class="size-10"></i>
                                    <p class="text-base font-medium">Belum ada data kategori pekerjaan.</p>
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

<dialog id="add_data" class="modal">
    <div class="modal-box">
        <h3 class="text-lg font-bold mb-2">Tambah Data Kategori</h3>
        <form action="{{ route('admin.category.store') }}" method="POST">
            @csrf
            <div class="py-4 space-y-4">
                <fieldset class="fieldset">
                    <legend class="fieldset-legend">Nama Kategori</legend>
                    <input type="text" name="name" class="input input-bordered w-full"
                        placeholder="Misal: IT Support" required />
                </fieldset>

                <fieldset class="fieldset">
                    <legend class="fieldset-legend">Icon</legend>
                    <input type="text" name="icon" class="input input-bordered w-full"
                        placeholder="Misal: activity" required />
                    <label class="fieldset-label text-xs mt-1 text-base-content/70">
                        Cari referensi icon di
                        <a href="https://feathericons.com/" target="_blank" rel="noopener noreferrer"
                            class="link link-primary hover:link-hover">
                            feathericons.com
                        </a>
                    </label>
                </fieldset>
            </div>

            <div class="modal-action">
                <button type="submit" class="btn btn-primary rounded-selector">Simpan Kategori</button>
                <button type="button" class="btn rounded-selector"
                    onclick="document.getElementById('add_data').close()">Batal</button>
            </div>
        </form>
    </div>

    <form method="dialog" class="modal-backdrop">
        <button>Tutup</button>
    </form>
</dialog>

@foreach ($categories as $category)
    <dialog id="edit_data_{{ $category->id }}" class="modal">
        <div class="modal-box">
            <h3 class="text-lg font-bold mb-2">Edit Data Kategori</h3>
            <form action="{{ route('admin.category.update', $category->id) }}" method="POST">
                @csrf
                @method('PUT')
                <div class="py-4 space-y-4">
                    <fieldset class="fieldset">
                        <legend class="fieldset-legend">Nama Kategori</legend>
                        <input type="text" name="name" class="input input-bordered w-full"
                            placeholder="Misal: IT Support" value="{{ $category->name }}" required />
                    </fieldset>
                    <fieldset class="fieldset">
                        <legend class="fieldset-legend">Icon</legend>
                        <input type="text" name="icon" class="input input-bordered w-full"
                            placeholder="Misal: activity" value="{{ $category->icon }}" required />
                        <label class="fieldset-label text-xs mt-1 text-base-content/70">
                            Cari referensi icon di
                            <a href="https://feathericons.com/" target="_blank" rel="noopener noreferrer"
                                class="link link-primary hover:link-hover">
                                feathericons.com
                            </a>
                        </label>
                    </fieldset>
                </div>
                <div class="modal-action">
                    <button type="submit" class="btn btn-primary rounded-selector">Update Kategori</button>
                    <button type="button" class="btn rounded-selector"
                        onclick="document.getElementById('edit_data_{{ $category->id }}').close()">Batal</button>
                </div>
            </form>
        </div>
    </dialog>

    <dialog id="delete_data_{{ $category->id }}" class="modal">
        <div class="modal-box">
            <h3 class="text-lg font-bold mb-2">Hapus Data Kategori</h3>
            <form action="{{ route('admin.category.destroy', $category->id) }}" method="POST">
                @csrf
                @method('DELETE')
                <div class="py-4 space-y-4">
                    <p>Apakah kamu yakin ingin menghapus kategori <span class="font-bold">{{ $category->name }}</span>
                        ?</p>
                </div>
                <div class="modal-action">
                    <button type="submit" class="btn btn-primary rounded-selector">Hapus Kategori</button>
                    <button type="button" class="btn rounded-selector"
                        onclick="document.getElementById('delete_data_{{ $category->id }}').close()">Batal</button>
                </div>
            </form>
        </div>
    </dialog>
@endforeach
