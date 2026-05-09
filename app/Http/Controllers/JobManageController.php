<?php

namespace App\Http\Controllers;

use App\Models\Job;
use App\Models\JobCategory;
use App\Models\JobType;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class JobManageController extends Controller
{
    public function index()
    {
        $jobs = Job::whereHas('company', function ($query) {
            $query->where('user_id', auth()->id());
        })
            ->with(['category', 'type'])
            ->latest()
            ->paginate(10);

        return view('employer.jobs.index', compact('jobs'));
    }

    public function create()
    {
        $categories = JobCategory::orderBy('name', 'asc')->get();
        $types = JobType::orderBy('name', 'asc')->get();

        return view('employer.jobs.create', compact('categories', 'types'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'category_id' => 'required|exists:job_categories,id',
            'type_id' => 'required|exists:job_types,id', // Disesuaikan dengan migration
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'requirements' => 'required|string',
            'location_area' => 'required|string|max:255', // Dilonggarkan sedikit ke 255
            'salary_min' => 'nullable|numeric|min:0',
            'salary_max' => 'nullable|numeric|min:0|gte:salary_min', // Gaji max harus >= gaji min
            'closing_date' => 'required|date|after_or_equal:today',
            'link' => 'nullable|url|max:255', // Validasi URL
            'poster' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:2048', // Maksimal 2MB
            'is_active' => 'required|boolean', // Diambil dari input hidden & checkbox form
        ]);

        $company = Auth::user()->company;

        // 2. Upload Poster (Jika ada)
        $posterPath = null;
        if ($request->hasFile('poster')) {
            // Simpan gambar ke folder 'storage/app/public/job-posters'
            $posterPath = $request->file('poster')->store('job-posters', 'public');
        }

        // 3. Generate slug unik (misal: frontend-developer-xyz123)
        $slug = Str::slug($request->title).'-'.Str::random(6);

        // 4. Simpan ke Database
        Job::create([
            'company_id' => $company->id,
            'category_id' => $request->category_id,
            'type_id' => $request->type_id,
            'title' => $request->title,
            'slug' => $slug,
            'description' => $request->description,
            'requirements' => $request->requirements,
            'location_area' => $request->location_area,
            'salary_min' => $request->salary_min,
            'salary_max' => $request->salary_max,
            'is_active' => $request->is_active,
            'link' => $request->link,
            'poster' => $posterPath,
            'closing_date' => $request->closing_date,
        ]);

        // 5. Redirect dengan pesan sukses
        $message = $request->is_active
            ? 'Lowongan pekerjaan berhasil ditayangkan!'
            : 'Lowongan pekerjaan berhasil disimpan sebagai draft!';

        return redirect()->route('employer.jobs.index')->with('success', $message);
    }

    public function show(Job $job)
    {
        $job->load('company');

        if ($job->company->user_id !== Auth::id()) {
            abort(403, 'Anda tidak memiliki akses untuk melihat lowongan ini.');
        }

        $job->load(['category', 'type']);

        return view('employer.jobs.show', compact('job'));
    }
}
