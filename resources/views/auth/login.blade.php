<x-layout.authentication>
    <div class="text-center lg:text-left max-w-lg">
        <h1 class="text-4xl lg:text-5xl font-bold leading-tight">Selamat Datang Kembali!</h1>
        <p class="py-6 text-base-content/80 text-lg">
            Masuk ke akun Anda untuk mulai mengelola profil usaha, memasang lowongan, dan menemukan kandidat terbaik
            untuk tim Anda di Kendari Loker.
        </p>
    </div>
    <div class="card bg-base-100 w-full max-w-sm shrink-0 shadow-xl border border-base-200/60">
        <form action="{{ route('auth.login') }}" method="POST">
            @csrf
            <div class="card-body">
                <fieldset class="fieldset space-y-2">
                    <div>
                        <label class="label fieldset-legend font-medium">Email</label>
                        <input type="email" class="input input-bordered w-full rounded-selector focus:outline-primary"
                            placeholder="Email Perusahaan/PIC" name="email" value="{{ old('email') }}" required />
                        @error('email')
                            <label class="label text-xs text-error mt-1">{{ $message }}</label>
                        @enderror
                    </div>
                    <div>
                        <label class="label fieldset-legend font-medium">Password</label>
                        <input type="password"
                            class="input input-bordered w-full rounded-selector focus:outline-primary"
                            placeholder="••••••••" name="password" required />
                        @error('password')
                            <label class="label text-xs text-error mt-1">{{ $message }}</label>
                        @enderror
                    </div>
                    <div class="pt-4 flex flex-col space-y-3">
                        <button type="submit" class="btn btn-neutral w-full text-white rounded-selector">Login</button>

                        <div class="divider text-xs text-base-content/50">Atau</div>

                        <a href="{{ route('auth.register') }}" class="btn w-full rounded-selector border-neutral-300">
                            Daftar sebagai Perekrut
                        </a>
                    </div>
                </fieldset>
            </div>
        </form>
    </div>
</x-layout.authentication>
