<?php

namespace App\Http\Controllers;

use App\Models\Company;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class CompanyManageController extends Controller
{
    public function index()
    {
        $company = Company::where('user_id', Auth::id())->first();

        return view('employer.company.index', compact('company'));
    }

    public function create()
    {
        return view('employer.company.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'sector' => 'required|string|max:255',
            'description' => 'required|string',
            'address' => 'required|string',
            'logo' => 'nullable|image|mimes:jpeg,png,jpg,svg|max:2048',
            'social_link' => 'nullable|url|max:255',
        ]);

        $logoPath = null;
        if ($request->hasFile('logo')) {
            $logoPath = $request->file('logo')->store('companies/logos', 'public');
        }

        $slug = Str::slug($request->name).'-'.Str::random(5);

        Company::create([
            'user_id' => Auth::id(),
            'name' => $request->name,
            'slug' => $slug,
            'sector' => $request->sector,
            'description' => $request->description,
            'address' => $request->address,
            'logo' => $logoPath,
            'social_link' => $request->social_link,
        ]);

        return redirect()->route('employer.company.index')->with('success', 'Profil perusahaan berhasil ditambahkan!');
    }

    public function update(Request $request, Company $company)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'sector' => 'required|string|max:255',
            'description' => 'required|string',
            'address' => 'required|string',
            'logo' => 'nullable|image|mimes:jpeg,png,jpg,svg|max:2048',
            'social_link' => 'nullable|url|max:255',
        ]);

        if ($company->user_id !== Auth::id()) {
            abort(403, 'Anda tidak memiliki akses untuk mengubah data ini.');
        }

        $updateData = [
            'name' => $request->name,
            'sector' => $request->sector,
            'description' => $request->description,
            'address' => $request->address,
            'social_link' => $request->social_link,
        ];

        if ($request->name !== $company->name) {
            $updateData['slug'] = Str::slug($request->name).'-'.Str::random(5);
        }

        if ($request->hasFile('logo')) {
            if ($company->logo && Storage::disk('public')->exists($company->logo)) {
                Storage::disk('public')->delete($company->logo);
            }
            $updateData['logo'] = $request->file('logo')->store('companies/logos', 'public');
        }

        $company->update($updateData);

        return redirect()->route('employer.company.index')->with('success', 'Profil perusahaan berhasil diperbarui!');
    }

    public function destroy(Company $company)
    {
        if ($company->user_id !== Auth::id()) {
            abort(403, 'Anda tidak memiliki akses untuk menghapus data ini.');
        }

        if ($company->logo && Storage::disk('public')->exists($company->logo)) {
            Storage::disk('public')->delete($company->logo);
        }

        $company->delete();

        return redirect()->route('employer.company.index')->with('success', 'Profil perusahaan berhasil dihapus!');
    }
}
