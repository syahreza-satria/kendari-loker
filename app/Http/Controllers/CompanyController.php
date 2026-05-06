<?php

namespace App\Http\Controllers;

use App\Models\Company;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class CompanyController extends Controller
{
    public function index()
    {
        $companies = Company::orderBy('id', 'asc')->get();

        return view('admin.companies.index', compact('companies'));
    }

    public function update(Request $request, Company $company)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'required|string',
            'address' => 'required|string',
            'website' => 'nullable|url|max:255',
            'logo' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:2048',
        ], [
            'logo.image' => 'File logo harus berupa gambar.',
            'logo.mimes' => 'Format logo harus jpeg, png, jpg, atau webp.',
            'logo.max' => 'Ukuran logo maksimal adalah 2MB.',
            'website.url' => 'Format website harus berupa URL yang valid (contoh: https://domain.com).',
        ]);

        if ($request->hasFile('logo')) {
            if ($company->logo && Storage::disk('public')->exists($company->logo)) {
                Storage::disk('public')->delete($company->logo);
            }

            $path = $request->file('logo')->store('logos', 'public');

            $validated['logo'] = $path;
        }

        $company->update($validated);

        return redirect()->route('admin.company.index')
            ->with('success', 'Data perusahaan berhasil diperbarui.');
    }

    public function destroy(Company $company)
    {
        // Sebelum menghapus data perusahaan, hapus dulu file logonya jika ada
        if ($company->logo && Storage::disk('public')->exists($company->logo)) {
            Storage::disk('public')->delete($company->logo);
        }

        // Hapus data perusahaan dari database
        $company->delete();

        // Redirect kembali dengan pesan sukses
        return redirect()->route('admin.company.index')
            ->with('success', 'Data perusahaan berhasil dihapus.');
    }
}
