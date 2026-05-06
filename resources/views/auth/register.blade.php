<x-layout.authentication>
    <div class="text-center lg:text-left max-w-lg">
        <h1 class="text-4xl lg:text-5xl font-bold leading-tight">Gabung sebagai Perekrut!</h1>
        <p class="py-6 text-base-content/80 text-lg">
            Daftarkan usaha Anda sekarang untuk mulai pasang lowongan di Kendari Loker. Temukan kandidat yang sesuai
            dengan kebutuhan Anda dengan lebih cepat dan mudah.
        </p>
    </div>
    <div class="card bg-base-100 w-full max-w-sm shrink-0 shadow-xl border border-base-200/60">
        <form action="{{ route('auth.register.post') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <input type="hidden" name="role" value="employer">

            <div class="card-body">
                <fieldset class="fieldset space-y-2">
                    <div>
                        <label class="label fieldset-legend font-medium">Foto Profil / Logo</label>
                        <input type="file" name="avatar"
                            class="file-input file-input-bordered w-full rounded-selector focus:outline-primary"
                            accept="image/*" />
                        @error('avatar')
                            <label class="label text-xs text-error mt-1">{{ $message }}</label>
                        @enderror
                    </div>
                    <div>
                        <label class="label fieldset-legend font-medium">Nama Lengkap PIC</label>
                        <input type="text" name="name"
                            class="input input-bordered w-full rounded-selector focus:outline-primary"
                            placeholder="Nama Lengkap" value="{{ old('name') }}" required />
                        @error('name')
                            <label class="label text-xs text-error mt-1">{{ $message }}</label>
                        @enderror
                    </div>
                    <div>
                        <label class="label fieldset-legend font-medium">Nomor Handphone</label>
                        <input type="text" name="phone_number"
                            class="input input-bordered w-full rounded-selector focus:outline-primary"
                            placeholder="08XX-XXXX-XXXX" value="{{ old('phone_number') }}" required />
                        @error('phone_number')
                            <label class="label text-xs text-error mt-1">{{ $message }}</label>
                        @enderror
                    </div>
                    <div>
                        <label class="label fieldset-legend font-medium">Email Perusahaan</label>
                        <input type="email" name="email"
                            class="input input-bordered w-full rounded-selector focus:outline-primary"
                            placeholder="contoh@perusahaan.com" value="{{ old('email') }}" required />
                        @error('email')
                            <label class="label text-xs text-error mt-1">{{ $message }}</label>
                        @enderror
                    </div>
                    <div>
                        <label class="label fieldset-legend font-medium">Password</label>
                        <input type="password" name="password"
                            class="input input-bordered w-full rounded-selector focus:outline-primary"
                            placeholder="••••••••" required />
                        @error('password')
                            <label class="label text-xs text-error mt-1">{{ $message }}</label>
                        @enderror
                    </div>
                    <div class="pt-4 flex flex-col space-y-3">
                        <button type="submit" class="btn btn-neutral w-full text-white rounded-selector">Daftar
                            Sekarang</button>

                        <div class="divider text-xs text-base-content/50">Atau</div>

                        <a href="{{ route('auth.login') }}" class="btn w-full rounded-selector border-neutral-300">
                            Sudah punya akun? Login
                        </a>
                    </div>

                </fieldset>
            </div>
        </form>
    </div>
</x-layout.authentication>
