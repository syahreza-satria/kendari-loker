<x-layout.dashboard>
    <div class="w-full space-y-6">

        <!-- Header Section -->
        <div class="flex flex-col md:flex-row md:items-center justify-between gap-4">
            <div>
                <h1 class="text-2xl font-bold text-base-content">Dashboard</h1>
                <p class="text-sm text-base-content/70 mt-1">Ringkasan aktivitas portal Kendari Loker hari ini.</p>
            </div>
        </div>

        <div class="space-y-6">
            <!-- 1. Statistik Cards -->
            <div class="stats stats-vertical lg:stats-horizontal shadow-sm border border-base-200 w-full bg-base-100">

                <div class="stat">
                    <div class="stat-figure text-primary bg-primary/10 p-3 rounded-2xl">
                        <i data-feather="briefcase" class="w-6 h-6"></i>
                    </div>
                    <div class="stat-title font-medium text-base-content/70">Lowongan Aktif</div>
                    <div class="stat-value text-primary">{{ $totalActiveJobs }}</div>
                    <div class="stat-desc font-medium mt-1 text-success flex items-center gap-1">
                        <i data-feather="trending-up" class="w-3 h-3"></i>
                        {{ $newJobsThisWeek }} ditambahkan minggu ini
                    </div>
                </div>

                <div class="stat">
                    <div class="stat-figure text-secondary bg-secondary/10 p-3 rounded-2xl">
                        <i data-feather="building" class="w-6 h-6"></i>
                    </div>
                    <div class="stat-title font-medium text-base-content/70">Total Perusahaan</div>
                    <div class="stat-value text-secondary">{{ $totalCompanies }}</div>
                    <div class="stat-desc mt-1">Terdaftar di platform</div>
                </div>

                <div class="stat">
                    <div class="stat-figure text-accent bg-accent/10 p-3 rounded-2xl">
                        <i data-feather="users" class="w-6 h-6"></i>
                    </div>
                    <div class="stat-title font-medium text-base-content/70">Total Pengguna</div>
                    <div class="stat-value">{{ $totalUsers }}</div>
                    <div class="stat-desc mt-1">Admin & Employer</div>
                </div>

            </div>

            <!-- 2. Grid Tabel Aktivitas -->
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">

                <!-- Table Lowongan Terbaru -->
                <div class="card bg-base-100 shadow-sm border border-base-200">
                    <div class="card-body p-0">
                        <!-- Card Header -->
                        <div class="flex items-center justify-between p-5 border-b border-base-200">
                            <h2 class="card-title text-lg font-bold">Lowongan Terbaru</h2>
                            <a href="{{ route('admin.job.index') }}" class="btn btn-xs btn-ghost text-primary">Lihat
                                Semua</a>
                        </div>

                        <!-- Table Content -->
                        <div class="overflow-x-auto">
                            <table class="table table-zebra w-full">
                                <thead class="bg-base-200/50 text-base-content/70 uppercase text-xs">
                                    <tr>
                                        <th class="font-semibold">Posisi</th>
                                        <th class="font-semibold">Perusahaan</th>
                                        <th class="font-semibold text-center">Status</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse ($recentJobs as $job)
                                        <tr class="hover">
                                            <td class="font-medium truncate max-w-37.5" title="{{ $job->title }}">
                                                {{ $job->title }}
                                                <div class="text-xs text-base-content/50 font-normal lg:hidden">
                                                    {{ $job->company->name ?? '-' }}</div>
                                            </td>
                                            <td class="hidden lg:table-cell">{{ $job->company->name ?? '-' }}</td>
                                            <td class="text-center">
                                                @if ($job->is_active && \Carbon\Carbon::parse($job->closing_date)->isFuture())
                                                    <div class="badge badge-success badge-sm text-white border-none">
                                                        Aktif</div>
                                                @else
                                                    <div class="badge badge-error badge-sm text-white border-none">
                                                        Ditutup</div>
                                                @endif
                                            </td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="4" class="text-center py-8 text-base-content/50">
                                                Belum ada data lowongan terbaru.
                                            </td>
                                        </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>

                <!-- Table Lowongan Segera Berakhir -->
                <div class="card bg-base-100 shadow-sm border border-base-200">
                    <div class="card-body p-0">
                        <!-- Card Header -->
                        <div class="flex items-center justify-between p-5 border-b border-base-200">
                            <h2 class="card-title text-lg font-bold">Segera Berakhir</h2>
                            <div class="badge badge-error badge-outline badge-sm">7 Hari Kedepan</div>
                        </div>

                        <!-- Table Content -->
                        <div class="overflow-x-auto">
                            <table class="table table-zebra w-full">
                                <thead class="bg-base-200/50 text-base-content/70 uppercase text-xs">
                                    <tr>
                                        <th class="font-semibold">Posisi</th>
                                        <th class="font-semibold">Perusahaan</th>
                                        <th class="font-semibold text-right">Deadline</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse ($expiringJobs as $job)
                                        <tr class="hover">
                                            <td class="font-medium truncate max-w-30" title="{{ $job->title }}">
                                                {{ $job->title }}
                                            </td>
                                            <td class="text-sm">{{ $job->company->name ?? '-' }}</td>
                                            <td class="text-right font-semibold text-error text-sm">
                                                {{ \Carbon\Carbon::parse($job->closing_date)->diffForHumans() }}
                                            </td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="4"
                                                class="text-center py-8 text-base-content/50 flex flex-col items-center gap-2">
                                                <i data-feather="check-circle" class="w-8 h-8 text-success/50"></i>
                                                Aman! Tidak ada lowongan yang segera berakhir.
                                            </td>
                                        </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
</x-layout.dashboard>
