<x-layout.profile>
    <section class="p-6 bg-white shadow rounded-box">
        <h2 class="text-2xl font-medium">Profil Saya</h2>
    </section>

    <section class="p-6 bg-white shadow rounded-box flex flex-col gap-8">
        <div class="flex items-center justify-between">
            <h1 class="text-lg font-medium">Informasi Personal</h1>
            {{-- Tombol Edit --}}
            <button type="button" onclick="document.getElementById('edit_data_{{ $employer->id }}').showModal()"
                class="btn btn-ghost btn-xs p-1">
                <i data-feather="edit-2" class="size-4 text-primary"></i>
            </button>
        </div>

        {{-- Avatar --}}
        <img src="{{ $employer->avatar ? asset('storage/' . $employer->avatar) : 'https://ui-avatars.com/api/?name=' . urlencode($employer->name) }}"
            alt="{{ $employer->name }}" class="size-24 rounded-selector object-cover">

        {{-- Grid Data --}}
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
            <div class="flex flex-col space-y-1">
                <span class="text-sm font-semibold text-neutral-500">Nama</span>
                <p class="text-sm font-normal text-neutral-800">{{ $employer->name }}</p>
            </div>

            <div class="flex flex-col space-y-1">
                <span class="text-sm font-semibold text-neutral-500">Nomor Handphone</span>
                <p class="text-sm font-normal text-neutral-800">
                    {{ $employer->phone_number ? preg_replace('/(\d{4})(\d{4})(\d+)/', '$1-$2-$3', $employer->phone_number) : '-' }}
                </p>
            </div>

            <div class="flex flex-col space-y-1">
                <span class="text-sm font-semibold text-neutral-500">Alamat Pribadi</span>
                <p class="text-sm font-normal text-neutral-800">{{ $employer->personal_address ?: '-' }}</p>
            </div>

            <div class="flex flex-col space-y-1">
                <span class="text-sm font-semibold text-neutral-500">NIK</span>
                <p class="text-sm font-normal text-neutral-800">{{ $employer->identity_number ?: '-' }}</p>
            </div>

            <div class="flex flex-col space-y-1">
                <span class="text-sm font-semibold text-neutral-500">E-Mail</span>
                <p class="text-sm font-normal text-neutral-800">{{ $employer->email }}</p>
            </div>

            <div class="flex flex-col space-y-1">
                <span class="text-sm font-semibold text-neutral-500">Jenis Kelamin</span>
                <p class="text-sm font-normal text-neutral-800">
                    {{ $employer->gender ? ucfirst($employer->gender) : '-' }}</p>
            </div>

            <div class="flex flex-col space-y-1">
                <span class="text-sm font-semibold text-neutral-500">Tanggal Lahir</span>
                <p class="text-sm font-normal text-neutral-800">
                    {{ $employer->birthdate ? \Carbon\Carbon::parse($employer->birthdate)->format('d-m-Y') : '-' }}
                </p>
            </div>

            <div class="flex flex-col space-y-1">
                <span class="text-sm font-semibold text-neutral-500">Profil Linkedin</span>
                @if ($employer->social_account)
                    <a href="{{ $employer->social_account }}" target="_blank"
                        class="text-sm font-normal text-primary hover:underline truncate">
                        {{ $employer->social_account }}
                    </a>
                @else
                    <p class="text-sm font-normal text-neutral-800">-</p>
                @endif
            </div>
        </div>
    </section>



    <dialog id="edit_data_{{ $employer->id }}" class="modal">
        <div class="modal-box max-w-3xl">
            <h3 class="text-xl font-bold text-center mb-6">Edit Data Diri</h3>

            <form action="{{ route('employer.profile.update', $employer->id) }}" method="POST"
                enctype="multipart/form-data">
                @csrf
                @method('PUT')

                {{-- Avatar Section dengan Preview --}}
                <div class="flex flex-col items-center mb-6">
                    <div class="avatar mb-3">
                        <div class="w-24 rounded-selector ring ring-primary ring-offset-base-100 ring-offset-2">
                            <img id="avatar_preview_{{ $employer->id }}"
                                src="{{ $employer->avatar ? asset('storage/' . $employer->avatar) : 'https://ui-avatars.com/api/?name=' . urlencode($employer->name) }}"
                                alt="Profile Picture" />
                        </div>
                    </div>
                    <label class="form-control w-full max-w-xs">
                        <div class="label pb-1 pt-0">
                            <span class="text-sm mx-auto">Unggah Foto Baru</span>
                        </div>
                        <input type="file" name="avatar" accept="image/*"
                            class="file-input file-input-bordered file-input-sm w-full rounded-selector"
                            onchange="previewAvatar(event, 'avatar_preview_{{ $employer->id }}')">
                    </label>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    {{-- Nama --}}
                    <label class="form-control w-full">
                        <span class="text-sm">Nama Lengkap<span class="text-error">*</span></span>
                        <input type="text" name="name" value="{{ $employer->name }}"
                            class="input input-bordered w-full rounded-selector" required>
                    </label>

                    {{-- Email --}}
                    <label class="form-control w-full">
                        <span class="text-sm">Email</span>
                        <input type="email" name="email" value="{{ $employer->email }}"
                            class="input input-bordered w-full rounded-selector readonly:border-neutral-300 readonly:bg-neutral-50 readonly:text-neutral-500"
                            readonly>
                    </label>

                    {{-- Gender --}}
                    <label class="form-control w-full">
                        <span class="text-sm">Jenis Kelamin</span>
                        <select name="gender" class="select select-bordered w-full rounded-selector">
                            <option value="" disabled {{ !$employer->gender ? 'selected' : '' }}>Pilih Gender
                            </option>
                            <option value="laki-laki" {{ $employer->gender == 'laki-laki' ? 'selected' : '' }}>
                                Laki-laki</option>
                            <option value="perempuan" {{ $employer->gender == 'perempuan' ? 'selected' : '' }}>
                                Perempuan
                            </option>
                        </select>
                    </label>

                    {{-- Tanggal Lahir --}}
                    <label class="form-control w-full">
                        <span class="text-sm">Tanggal Lahir</span>
                        <input type="date" name="birthdate" value="{{ $employer->birthdate }}"
                            class="input input-bordered w-full rounded-selector">
                    </label>

                    {{-- NIK --}}
                    <label class="form-control w-full">
                        <span class="text-sm">NIK</span>
                        <input type="text" name="identity_number" value="{{ $employer->identity_number }}"
                            class="input input-bordered w-full rounded-selector" inputmode="numeric" pattern="[0-9]*"
                            maxlength="16" oninput="this.value = this.value.replace(/[^0-9]/g, '')"
                            placeholder="Masukkan 16 digit NIK">
                    </label>

                    {{-- Nomor HP --}}
                    <label class="form-control w-full">
                        <span class="text-sm">Nomor HP</span>
                        <input type="text" name="phone_number" value="{{ $employer->phone_number }}"
                            class="input input-bordered w-full rounded-selector">
                    </label>

                    {{-- Social Account (LinkedIn) --}}
                    <label class="form-control w-full md:col-span-2">
                        <span class="text-sm">Profil LinkedIn / Sosial Media (URL)</span>
                        <input type="url" name="social_account" value="{{ $employer->social_account }}"
                            class="input input-bordered w-full rounded-selector"
                            placeholder="https://linkedin.com/in/username">
                    </label>

                    {{-- Alamat --}}
                    <label class="form-control w-full md:col-span-2">
                        <span class="text-sm">Alamat Pribadi</span>
                        <textarea name="personal_address" class="textarea textarea-bordered w-full rounded-2xl" rows="2">{{ $employer->personal_address }}</textarea>
                    </label>
                </div>

                {{-- Action Buttons --}}
                <div class="modal-action mt-6">
                    <button type="button" class="btn btn-ghost rounded-selector"
                        onclick="document.getElementById('edit_data_{{ $employer->id }}').close()">Batal</button>
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

    @push('scripts')
        <script>
            function previewAvatar(event, previewElementId) {
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
