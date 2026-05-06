<?php

namespace App\Http\Controllers;

use App\Models\Job;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class JobManageController extends Controller
{
    public function index()
    {
        return view('employer.index');
    }

    /**
     * Menyimpan loker baru ke database
     */
    public function store(Request $request)
    {
        $request->validate([
            'category_id' => 'required|exists:job_categories,id',
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'requirements' => 'required|string',
            'location_area' => 'required|string|max:100',
            'job_type' => 'required|in:full_time,part_time,contract,freelance,internship',
            'salary_min' => 'nullable|numeric',
            'salary_max' => 'nullable|numeric',
            'closing_date' => 'required|date|after:today',
        ]);

        $company = Auth::user()->company;

        // Generate slug unik (misal: frontend-developer-xyz123)
        $slug = Str::slug($request->title).'-'.Str::random(6);

        Job::create([
            'company_id' => $company->id,
            'category_id' => $request->category_id,
            'title' => $request->title,
            'slug' => $slug,
            'description' => $request->description,
            'requirements' => $request->requirements,
            'location_area' => $request->location_area,
            'job_type' => $request->job_type,
            'salary_min' => $request->salary_min,
            'salary_max' => $request->salary_max,
            'is_active' => true,
            'closing_date' => $request->closing_date,
        ]);

        return redirect()->route('employer.jobs.index')->with('success', 'Lowongan pekerjaan berhasil ditayangkan!');
    }
}
