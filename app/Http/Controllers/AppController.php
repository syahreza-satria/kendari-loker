<?php

namespace App\Http\Controllers;

use App\Models\Job;
use App\Models\JobCategory;
use App\Models\JobType;
use Illuminate\Http\Request;

class AppController extends Controller
{
    public function index(Request $request)
    {
        $categories = JobCategory::withCount(['jobs' => function ($query) {
            $query->where('is_active', true);
        }])->get();

        $types = JobType::all();

        $query = Job::with(['company', 'category', 'type'])->where('is_active', true);

        if ($request->filled('search')) {
            $searchTerm = $request->search;
            $query->where(function ($q) use ($searchTerm) {
                $q->where('title', 'like', '%'.$searchTerm.'%')
                    ->orWhere('location_area', 'like', '%'.$searchTerm.'%')
                    ->orWhereHas('company', function ($c) use ($searchTerm) {
                        $c->where('name', 'like', '%'.$searchTerm.'%');
                    });
            });
        }

        if ($request->filled('job_type')) {
            $query->where('type_id', $request->job_type);
        }

        if ($request->filled('category')) {
            $query->where('category_id', $request->category);
        }

        $jobs = $query->latest()->paginate(8);

        return view('index', compact('jobs', 'categories', 'types'));
    }

    public function show($slug)
    {
        $job = Job::with(['company', 'category'])
            ->where('slug', $slug)
            ->where('is_active', true)
            ->firstOrFail();

        return view('show', compact('job'));
    }

    public function showAllCategory()
    {
        $categories = JobCategory::withCount(['jobs' => function ($query) {
            $query->where('is_active', true);
        }])->orderBy('name', 'asc')->get();

        return view('category', compact('categories'));
    }

    public function showAllJob(Request $request)
    {
        $categories = JobCategory::orderBy('name', 'asc')->get();
        $types = JobType::orderBy('name', 'asc')->get();
        $query = Job::with(['company', 'type'])->where('is_active', true);

        if ($request->filled('category_id')) {
            $query->where('category_id', $request->category_id);
        }

        if ($request->filled('type_id')) {
            $query->where('type_id', $request->type_id);
        }

        if ($request->filled('salary')) {
            switch ($request->salary) {
                case 'highest':
                    $query->orderBy('salary_max', 'desc');
                    break;
                case 'lowest':
                    $query->orderBy('salary_min', 'asc');
                    break;
                case 'hidden':
                    $query->whereNull('salary_min')->whereNull('salary_max');
                    break;
            }
        } else {
            $query->latest();
        }

        $jobs = $query->paginate(15);

        return view('job', compact('jobs', 'categories', 'types'));
    }

    public function type()
    {
        return view('type');
    }

    public function profile()
    {
        return view('profile');
    }
}
