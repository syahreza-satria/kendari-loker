<?php

namespace App\Http\Controllers;

use App\Models\Company;
use App\Models\Job;
use App\Models\User;
use Carbon\Carbon;

class AdminDashboardController extends Controller
{
    public function index()
    {
        // 1. Data Statistik (Summary Cards)
        // Hitung total lowongan yang masih aktif dan belum melewati tanggal penutupan
        $totalActiveJobs = Job::where('is_active', true)
            ->where('closing_date', '>=', Carbon::today())
            ->count();

        // Hitung lowongan baru yang ditambahkan dalam 7 hari terakhir
        $newJobsThisWeek = Job::where('created_at', '>=', Carbon::now()->subDays(7))->count();

        // Hitung total perusahaan dan pengguna
        $totalCompanies = Company::count();
        $totalUsers = User::count();

        // 2. Data Tabel (Recent Activities)
        // Ambil 5 lowongan terbaru (eager load dengan relasi company agar tidak N+1 query)
        $recentJobs = Job::with('company')
            ->latest() // Sama dengan orderBy('created_at', 'desc')
            ->take(5)
            ->get();

        // Ambil 5 lowongan yang akan segera berakhir dalam 7 hari ke depan
        $expiringJobs = Job::with('company')
            ->where('is_active', true)
            ->whereBetween('closing_date', [Carbon::today(), Carbon::today()->addDays(7)])
            ->orderBy('closing_date', 'asc')
            ->take(5)
            ->get();

        // Kirim semua data ke view dashboard Anda
        return view('admin.index', compact(
            'totalActiveJobs',
            'newJobsThisWeek',
            'totalCompanies',
            'totalUsers',
            'recentJobs',
            'expiringJobs'
        ));
    }
}
