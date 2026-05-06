<?php

namespace App\Http\Controllers;

use App\Models\JobCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class JobCategoryController extends Controller
{
    public function index()
    {
        $categories = JobCategory::orderBy('id', 'asc')->get();

        return view('admin.categories.index', compact('categories'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255|unique:job_categories,name',
            'icon' => 'required|string|max:255',
        ]);

        JobCategory::create([
            'name' => $request->name,
            'slug' => Str::slug($request->name),
            'icon' => $request->icon,
        ]);

        return redirect()->route('admin.category.index')
            ->with('success', 'Kategori pekerjaan berhasil ditambahkan.');
    }

    public function update(Request $request, JobCategory $category)
    {
        $request->validate([
            'name' => 'required|string|max:255|unique:job_categories,name,'.$category->id,
            'icon' => 'required|string|max:255',
        ]);

        $category->update([
            'name' => $request->name,
            'slug' => Str::slug($request->name),
            'icon' => $request->icon,
        ]);

        return redirect()->route('admin.category.index')
            ->with('success', 'Kategori pekerjaan berhasil diperbarui.');
    }

    public function destroy(JobCategory $category)
    {
        $category->delete();

        return redirect()->route('admin.category.index')
            ->with('success', 'Kategori pekerjaan berhasil dihapus.');
    }
}
