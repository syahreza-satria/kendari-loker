<?php

namespace Database\Seeders;

use App\Models\Company;
use App\Models\Job;
use App\Models\JobCategory;
use App\Models\JobType;
use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class JobSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $companies = Company::all();

        if ($companies->isEmpty()) {
            $this->command->error('Tabel companies kosong! Silakan isi data perusahaan (Jalankan CompanySeeder) terlebih dahulu.');

            return;
        }

        // Siapkan 20 data lowongan dalam bentuk Array
        $jobsData = [
            [
                'category_name' => 'Teknologi Informasi',
                'type_name' => 'Full-time',
                'title' => 'Frontend Developer (React/Tailwind)',
                'description' => 'Kami mencari Frontend Developer yang berpengalaman dalam membangun antarmuka web yang responsif dan modern.',
                'requirements' => "- Minimal 1 tahun pengalaman menggunakan React.js\n- Menguasai Tailwind CSS\n- Bersedia ditempatkan di Kendari",
                'location_area' => 'Kendari, Sulawesi Tenggara',
                'salary_min' => 5000000,
                'salary_max' => 8000000,
                'closing_days' => 30,
                'link' => 'https://wa.me/6285298240941',
                'poster' => 'posters/sample-it-poster.png',
            ],
            [
                'category_name' => 'Administrasi & Perkantoran',
                'type_name' => 'Kontrak',
                'title' => 'Staff Administrasi Gudang',
                'description' => 'Membutuhkan staff administrasi untuk mencatat barang masuk dan keluar di gudang utama kami.',
                'requirements' => "- Pendidikan minimal SMA/SMK\n- Mahir menggunakan Microsoft Excel\n- Teliti dan jujur",
                'location_area' => 'Konawe, Sulawesi Tenggara',
                'salary_min' => 3000000,
                'salary_max' => 4500000,
                'closing_days' => 14,
                'link' => null,
                'poster' => null,
            ],
            // ... (Data array lainnya tetap sama, diringkas agar kode fokus)
            [
                'category_name' => 'Layanan Pelanggan',
                'type_name' => 'Full-time',
                'title' => 'Security / Satpam',
                'description' => 'Menjaga keamanan aset perusahaan dan mengatur kendaraan di area parkir kantor.',
                'requirements' => "- Sertifikat Gada Pratama aktif\n- Tinggi min 165 cm\n- Disiplin, sigap, dan sopan",
                'location_area' => 'Kendari, Sulawesi Tenggara',
                'salary_min' => 3000000,
                'salary_max' => 3500000,
                'closing_days' => 10,
                'link' => null,
                'poster' => null,
            ],
        ];

        // Looping data array untuk dimasukkan ke database
        foreach ($jobsData as $index => $data) {

            // Cari ID Kategori berdasarkan nama (fall-back ke ID 1 jika tidak ketemu)
            $category = JobCategory::where('name', $data['category_name'])->first();
            $categoryId = $category ? $category->id : 1;

            // Jika tabel job_types ada, cari ID-nya.
            // Opsional: Jika type_id bisa dikosongkan/null di DB-mu, ubah fallback `1` menjadi `null`.
            $type = class_exists(JobType::class) ? JobType::where('name', 'like', "%{$data['type_name']}%")->first() : null;
            $typeId = $type ? $type->id : 1;

            // Buat Job Baru
            Job::create([
                'company_id' => $companies->random()->id,
                'category_id' => $categoryId,
                'type_id' => $typeId,
                'title' => $data['title'],
                'slug' => Str::slug($data['title'].' '.Str::random(5)),
                'description' => $data['description'],
                'requirements' => $data['requirements'],
                'location_area' => $data['location_area'],
                'salary_min' => $data['salary_min'],
                'salary_max' => $data['salary_max'],
                'is_active' => ($index % 5 === 0) ? false : true,
                'closing_date' => Carbon::now()->addDays($data['closing_days']),
                'link' => $data['link'],
                'poster' => $data['poster'],
            ]);
        }

        $this->command->info('Data Loker Kendari berhasil di-seed!');
    }
}
