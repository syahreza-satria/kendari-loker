<?php

namespace App\Http\Controllers;

use App\Models\JobType;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class JobTypeController extends Controller
{
    public function index()
    {
        $types = JobType::orderBy('id', 'asc')->get();

        return view('admin.types.index', compact('types'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255|unique:job_categories,name',
        ]);

        JobType::create([
            'name' => $request->name,
            'slug' => Str::slug($request->name),
        ]);

        return redirect()->route('admin.type.index')
            ->with('success', 'Tipe pekerjaan berhasil ditambahkan.');
    }

    public function update(Request $request, JobType $type)
    {
        $request->validate([
            'name' => 'required|string|max:255,'.$type->id,
        ]);

        $type->update([
            'name' => $request->name,
            'slug' => Str::slug($request->name),
        ]);

        return redirect()->route('admin.type.index')
            ->with('success', 'Tipe pekerjaan berhasil diperbarui.');
    }

    public function destroy(JobType $type)
    {
        $type->delete();

        return redirect()->route('admin.type.index')
            ->with('success', 'Tipe pekerjaan berhasil dihapus.');
    }
}
