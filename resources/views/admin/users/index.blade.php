<x-layout.dashboard>
    <div class="flex flex-col space-y-4">
        <div class="flex items-center justify-between">
            <h1 class="text-2xl font-medium">Pengguna Terdaftar</h1>
        </div>
        <div class="bg-white rounded-box shadow border border-base-300">
            <table class="table table-zebra">
                <thead>
                    <tr>
                        <th class="w-16"></th>
                        <th>Nama</th>
                        <th>E-Mail</th>
                        <th>Nama Usaha</th>
                        <th>Role</th>
                        <th>Nomor Handphone</th>
                        <th class="text-center">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($users as $user)
                        <tr>
                            <th class="text-center">{{ $user->id }}</th>
                            <td>{{ $user->name }}</td>
                            <td>{{ $user->email }}</td>
                            <td>
                                @if (!empty($user->company->name))
                                    {{ $user->company->name }}
                                @else
                                    <span class="text-neutral-500">Belum memasukkan usaha</span>
                                @endif
                            </td>
                            <td>{{ Str::ucfirst($user->role) }}</td>
                            <td>{{ $user->phone_number }}</td>
                            <td>
                                <div class="flex gap-1 justify-center">
                                    <div class="tooltip" data-tip="Lihat Informasi">
                                        <button
                                            onclick="document.getElementById('show_data_{{ $user->id }}').showModal()"
                                            class="btn btn-info btn-xs text-white">
                                            <i data-feather="eye" class="size-4"></i>
                                        </button>
                                    </div>
                                    <div class="tooltip" data-tip="Edit">
                                        <button
                                            onclick="document.getElementById('edit_data_{{ $user->id }}').showModal()"
                                            class="btn btn-warning btn-xs text-white">
                                            <i data-feather="edit-3" class="size-4"></i>
                                        </button>
                                    </div>
                                    <div class="tooltip" data-tip="Delete">
                                        <button
                                            onclick="document.getElementById('delete_data_{{ $user->id }}').showModal()"
                                            class="btn btn-error btn-xs text-white">
                                            <i data-feather="trash" class="size-4"></i>
                                        </button>
                                    </div>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="text-center py-12">
                                <div class="flex flex-col items-center justify-center gap-2 text-base-content/50">
                                    <i data-feather="users" class="size-10"></i>
                                    <p class="text-base font-medium">Belum ada data pengguna.</p>
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

@foreach ($users as $user)
    {{-- Show --}}
    <dialog id="show_data_{{ $user->id }}" class="modal">
        <div class="modal-box">
            <h3 class="text-lg font-bold mb-2">Detail Pengguna</h3>

            <div class="py-4 space-y-4">
                <div class="flex items-center justify-center">
                    <div class="avatar">
                        <div class="w-24 rounded-selector">
                            @if (!empty($user->avatar))
                                <img src="{{ asset('storage/' . $user->avatar) }}" alt="{{ $user->name }}" />
                            @else
                                <img src="https://ui-avatars.com/api/?name={{ urlencode($user->name) }}&background=random&color=fff"
                                    alt="{{ $user->name }}" />
                            @endif
                        </div>
                    </div>
                </div>

                <div>
                    <label class="label pb-1"><span class="label-text font-medium">Nama Lengkap</span></label>
                    <input type="text"
                        class="input input-bordered input-md bg-neutral-200 text-black border-gray-300 rounded-selector w-full"
                        disabled value="{{ $user->name }}" />
                </div>

                <div>
                    <label class="label pb-1"><span class="label-text font-medium">Email</span></label>
                    <input type="text"
                        class="input input-bordered input-md bg-neutral-200 text-black border-gray-300 rounded-selector w-full"
                        disabled value="{{ $user->email }}" />
                </div>

                <div>
                    <label class="label pb-1"><span class="label-text font-medium">Role</span></label>
                    <input type="text"
                        class="input input-bordered input-md bg-neutral-200 text-black border-gray-300 rounded-selector w-full"
                        disabled value="{{ Str::ucfirst($user->role) }}" />
                </div>

                <div>
                    <label class="label pb-1"><span class="label-text font-medium">Phone Number</span></label>
                    <input type="text"
                        class="input input-bordered input-md bg-neutral-200 text-black border-gray-300 rounded-selector w-full"
                        disabled value="{{ $user->phone_number }}" />
                </div>

                <div>
                    <label class="label pb-1"><span class="label-text font-medium">Date & Time Created</span></label>
                    <!-- Bonus: Menampilkan tanggal dengan format yang lebih mudah dibaca daripada Str::ucfirst -->
                    <input type="text"
                        class="input input-bordered input-md bg-neutral-200 text-black border-gray-300 rounded-selector w-full"
                        disabled value="{{ $user->created_at->format('d F Y, H:i') }}" />
                </div>
            </div>

            <div class="modal-action">
                <form method="dialog">
                    <button class="btn rounded-selector">Tutup</button>
                </form>
            </div>
        </div>

        <form method="dialog" class="modal-backdrop">
            <button>Tutup</button>
        </form>
    </dialog>

    {{-- Edit --}}
    <dialog id="edit_data_{{ $user->id }}" class="modal">
        <div class="modal-box">
            <h3 class="text-lg font-bold mb-2">Edit Data Pengguna</h3>
            <form action="{{ route('admin.user.update', $user->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <div class="py-4 space-y-4">
                    <div class="flex gap-2 items-center ">
                        <div class="avatar">
                            <div class="w-24 rounded-selector">
                                @if (!empty($user->avatar))
                                    <img src="{{ asset('storage/' . $user->avatar) }}" alt="{{ $user->name }}" />
                                @else
                                    <img src="https://ui-avatars.com/api/?name={{ urlencode($user->name) }}&background=random&color=fff"
                                        alt="{{ $user->name }}" />
                                @endif
                            </div>
                        </div>
                        <input type="file" class="file-input w-full rounded-selector" />
                    </div>
                    <div>
                        <label class="label pb-1"><span class="label-text font-medium">Nama Lengkap</span></label>
                        <input type="text" name="name"
                            class="input input-bordered rounded-selector input-md w-full" value="{{ $user->name }}"
                            required />
                    </div>

                    <div>
                        <label class="label pb-1"><span class="label-text font-medium">Email</span></label>
                        <input type="email" name="email"
                            class="input input-bordered input-md w-full rounded-selector" value="{{ $user->email }}"
                            required />
                    </div>

                    <div>
                        <label class="label pb-1"><span class="label-text font-medium">Role</span></label>
                        <select name="role" class="select select-bordered w-full rounded-selector" required>
                            @foreach (['admin', 'employer'] as $roleOption)
                                <option value="{{ $roleOption }}"
                                    {{ $user->role === $roleOption ? 'selected' : '' }}>
                                    {{ Str::ucfirst($roleOption) }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <div>
                        <label class="label pb-1"><span class="label-text font-medium">Phone Number</span></label>
                        <input type="text" name="phone_number"
                            class="input input-bordered input-md w-full rounded-selector"
                            value="{{ $user->phone_number }}" />
                    </div>
                </div>
                <div class="modal-action">
                    <button type="submit" class="btn btn-primary rounded-selector">Update Pengguna</button>
                    <button type="button" class="btn rounded-selector"
                        onclick="document.getElementById('edit_data_{{ $user->id }}').close()">Batal</button>
                </div>
            </form>
        </div>
    </dialog>

    {{-- Hapus --}}
    <dialog id="delete_data_{{ $user->id }}" class="modal">
        <div class="modal-box">
            <h3 class="text-lg font-bold mb-2">Hapus Data Kategori</h3>
            <form action="{{ route('admin.user.destroy', $user->id) }}" method="POST">
                @csrf
                @method('DELETE')
                <div class="py-4 space-y-4">
                    <p>Apakah kamu yakin ingin menghapus user atas nama <span
                            class="font-bold">{{ $user->name }}</span>
                        ?</p>
                </div>
                <div class="modal-action">
                    <button type="submit" class="btn btn-primary rounded-selector">Hapus Nama</button>
                    <button type="button" class="btn rounded-selector"
                        onclick="document.getElementById('delete_data_{{ $user->id }}').close()">Batal</button>
                </div>
            </form>
        </div>
    </dialog>
@endforeach
