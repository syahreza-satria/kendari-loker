<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function showLoginForm()
    {
        return view('auth.login');
    }

    public function showRegisterForm()
    {
        return view('auth.register');
    }

    public function register(Request $request)
    {
        // 1. Validasi Input (sesuaikan dengan migration)
        $request->validate([
            'avatar' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
            'name' => 'required|string|max:255',
            'phone_number' => 'required|string|max:20',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8',
            'role' => 'required|in:seeker,employer',
        ], [
            'email.unique' => 'Email ini sudah terdaftar.',
            'avatar.max' => 'Ukuran foto maksimal adalah 2MB.',
        ]);

        // 2. Proses Upload Avatar
        $avatarPath = null;
        if ($request->hasFile('avatar')) {
            $avatarPath = $request->file('avatar')->store('avatars', 'public');
        }

        // 3. Simpan User ke Database
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role' => $request->role,
            'phone_number' => $request->phone_number,
            'avatar' => $avatarPath,
        ]);

        // 4. Otomatis login setelah daftar
        Auth::login($user);

        // 5. Redirect berdasarkan role
        if ($user->role === 'employer') {
            return redirect()->route('index')->with('success', 'Registrasi berhasil!');
        }

        return redirect()->route('index')->with('success', 'Registrasi berhasil!');
    }

    // Method untuk memproses login
    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();

            // Redirect berdasarkan role
            if (Auth::user()->role === 'admin') {
                return redirect()->intended(route('admin.dashboard.index'));
            } elseif (Auth::user()->role === 'employer') {
                return redirect()->intended(route('index'))->with('success', 'Kamu berhasil masuk ke akunmu');
            }
        }

        return back()->withErrors([
            'email' => 'Email atau password yang Anda masukkan salah.',
        ])->onlyInput('email');
    }

    // Method untuk logout
    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('index');
    }
}
