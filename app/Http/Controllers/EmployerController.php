<?php

namespace App\Http\Controllers;

use App\Models\Company;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class EmployerController extends Controller
{
    public function profile()
    {
        $employer = auth()->user();

        return view('profile', compact('employer'));
    }

    public function update(Request $request, User $user)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'gender' => 'nullable|in:pria,wanita',
            'birthdate' => 'nullable|date',
            'personal_address' => 'nullable|string',
            'identity_number' => 'nullable|numeric|digits:16', // Validasi angka 16 digit
            'phone_number' => 'nullable|string|max:20',
            'social_account' => 'nullable|string',
            'avatar' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
        ]);

        if ($request->hasFile('avatar')) {
            if ($user->avatar) {
                Storage::disk('public')->delete($user->avatar);
            }
            $validated['avatar'] = $request->file('avatar')->store('avatars', 'public');
        }

        $user->update($validated);

        return redirect()->route('employer.profile')->with('success', 'Data diri berhasil diperbarui!');
    }

    public function company()
    {
        $company = Company::where('user_id', Auth::id())->first();

        return view('employer.company.index', compact('company'));
    }

    public function settings()
    {
        return view('setting');
    }
}
