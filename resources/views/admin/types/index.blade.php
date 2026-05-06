<x-layout.dashboard>
    <div class="w-full space-y-4">
        <div class="flex justify-between items-center">
            <h1 class="text-2xl font-medium">Data Tipe Pekerjaan</h1>
            <button type="button" onclick="add_data.showModal()" class="btn btn-primary rounded-selector btn-sm">Tambah
                Data
                <i data-feather="plus" class="size-4"></i></button>
        </div>
        <div class="bg-white rounded-box border border-base-300 shadow">
            <table class="table table-zebra">
                <thead>
                    <tr>
                        <th class="w-16"></th>
                        <th>Nama Tipe</th>
                        <th>Slug</th>
                        <th>Tanggal Ditambahkan</th>
                        <th class="text-center">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($types as $type)
                        <tr>
                            <th class="text-center">{{ $type->id }}</th>
                            <td>{{ $type->name }}</td>
                            <td>{{ $type->slug }}</td>
                            <td>{{ $type->created_at }}</td>
                            <td>
                                <div class="flex gap-2 justify-center">
                                    <div class="tooltip" data-tip="Edit">
                                        <button
                                            onclick="document.getElementById('edit_data_{{ $type->id }}').showModal()"
                                            class="btn btn-warning btn-sm rounded-selector">
                                            <i data-feather="edit-3" class="size-4 text-white"></i>
                                        </button>
                                    </div>
                                    <div class="tooltip" data-tip="Hapus">
                                        <button
                                            onclick="document.getElementById('delete_data_{{ $type->id }}').showModal()"
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
                                    <i data-feather="layers" class="size-10"></i>
                                    <p class="text-base font-medium">Belum ada data tipe pekerjaan.</p>
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
        <h3 class="text-lg font-bold mb-2">Tambah Data Tipe Pekerjaan</h3>
        <form action="{{ route('admin.type.store') }}" method="POST">
            @csrf
            <div class="py-4 space-y-4">
                <fieldset class="fieldset">
                    <legend class="fieldset-legend">Nama Tipe Pekerjaan</legend>
                    <input type="text" name="name" class="input input-bordered w-full"
                        placeholder="Misal: Full-time" required />
                </fieldset>
            </div>

            <div class="modal-action">
                <button type="submit" class="btn btn-primary rounded-selector">Simpan Tipe Pekerjaan</button>
                <button type="button" class="btn rounded-selector"
                    onclick="document.getElementById('add_data').close()">Batal</button>
            </div>
        </form>
    </div>

    <form method="dialog" class="modal-backdrop">
        <button>Tutup</button>
    </form>
</dialog>

@foreach ($types as $type)
    <dialog id="edit_data_{{ $type->id }}" class="modal">
        <div class="modal-box">
            <h3 class="text-lg font-bold mb-2">Edit Data Tipe Pekerjaan</h3>
            <form action="{{ route('admin.type.update', $type->id) }}" method="POST">
                @csrf
                @method('PUT')
                <div class="py-4 space-y-4">
                    <fieldset class="fieldset">
                        <legend class="fieldset-legend">Nama Tipe Pekerjaan</legend>
                        <input type="text" name="name" class="input input-bordered w-full"
                            value="{{ $type->name }}" placeholder="Misal: Full-time" required />
                    </fieldset>
                </div>

                <div class="modal-action">
                    <button type="submit" class="btn btn-primary rounded-selector">Simpan Tipe Pekerjaan</button>
                    <button type="button" class="btn rounded-selector"
                        onclick="document.getElementById('edit_data_{{ $type->id }}').close()">Batal</button>
                </div>
            </form>
        </div>
    </dialog>

    <dialog id="delete_data_{{ $type->id }}" class="modal">
        <div class="modal-box">
            <h3 class="text-lg font-bold mb-2">Hapus Data Tipe Pekerjaan</h3>
            <form action="{{ route('admin.type.destroy', $type->id) }}" method="POST">
                @csrf
                @method('DELETE')
                <div class="py-4 space-y-4">
                    <p>Apakah kamu yakin ingin menghapus tipe pekerjaan <span
                            class="font-bold">{{ $type->name }}</span>
                        ?</p>
                </div>
                <div class="modal-action">
                    <button type="submit" class="btn btn-primary rounded-selector">Hapus Tipe Pekerjaan</button>
                    <button type="button" class="btn rounded-selector"
                        onclick="document.getElementById('delete_data_{{ $type->id }}').close()">Batal</button>
                </div>
            </form>
        </div>
    </dialog>
@endforeach
