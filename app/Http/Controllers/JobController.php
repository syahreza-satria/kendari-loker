<?php

namespace App\Http\Controllers;

use App\Models\Company;
use App\Models\Job;
use App\Models\JobCategory;
use App\Models\JobType;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class JobController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $jobs = Job::latest()->get();
        $companies = Company::all();
        $categories = JobCategory::all();
        $types = JobType::all();

        return view('admin.jobs.index', compact('jobs', 'companies', 'categories', 'types'));
    }

    public function update(Request $request, Job $job)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'company_id' => 'required|exists:companies,id',
            'category_id' => 'required|exists:job_categories,id',
            'type_id' => 'required|exists:job_types,id',
            'location_area' => 'required|string|max:255',
            'salary_min' => 'nullable|numeric|min:0',
            'salary_max' => 'nullable|numeric|gte:salary_min',
            'closing_date' => 'required|date',
            'is_active' => 'required|boolean',
            'description' => 'required|string',
            'requirements' => 'required|string',
            'link' => 'nullable|url|max:255',
            'poster' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:2048',
        ], [
            'salary_max.gte' => 'Gaji maksimal harus lebih besar atau sama dengan gaji minimal.',
            'poster.image' => 'File poster harus berupa gambar.',
            'poster.mimes' => 'Format gambar harus jpeg, png, jpg, atau webp.',
            'poster.max' => 'Ukuran gambar maksimal adalah 2MB.',
        ]);

        if ($request->title !== $job->title) {
            $validated['slug'] = Str::slug($request->title.' '.Str::random(5));
        }

        if ($request->hasFile('poster')) {
            if ($job->poster && Storage::disk('public')->exists($job->poster)) {
                Storage::disk('public')->delete($job->poster);
            }
            $path = $request->file('poster')->store('posters', 'public');
            $validated['poster'] = $path;
        }

        $job->update($validated);

        return redirect()->route('admin.job.index')
            ->with('success', 'Data lowongan pekerjaan berhasil diperbarui.');
    }

    public function destroy(Job $job)
    {
        if ($job->poster && Storage::disk('public')->exists($job->poster)) {
            Storage::disk('public')->delete($job->poster);
        }

        $job->delete();

        return redirect()->route('admin.job.index')
            ->with('success', 'Data lowongan pekerjaan berhasil dihapus.');
    }
}
