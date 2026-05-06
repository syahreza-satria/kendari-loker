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
        // 1. Ambil beberapa perusahaan secara acak untuk disebar ke 20 lowongan
        // Pastikan Anda sudah punya minimal 1 data perusahaan di tabel companies
        $companies = Company::all();

        if ($companies->isEmpty()) {
            $this->command->error('Tabel companies kosong! Silakan isi data perusahaan terlebih dahulu.');

            return;
        }

        // 2. Siapkan 20 data lowongan dalam bentuk Array
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
            [
                'category_name' => 'Restoran & Perhotelan',
                'type_name' => 'Full-time',
                'title' => 'Barista Full-Time',
                'description' => 'Dicari Barista berpengalaman untuk meracik kopi dan melayani pelanggan dengan ramah di coffee shop kami.',
                'requirements' => "- Pengalaman minimal 1 tahun sebagai Barista\n- Paham kalibrasi espresso\n- Berpenampilan menarik",
                'location_area' => 'Kendari, Sulawesi Tenggara',
                'salary_min' => 2500000,
                'salary_max' => 3500000,
                'closing_days' => 7,
                'link' => 'https://forms.gle/baristakendari',
                'poster' => null,
            ],
            [
                'category_name' => 'Teknik & Arsitektur',
                'type_name' => 'Kontrak',
                'title' => 'Operator Alat Berat (Excavator)',
                'description' => 'Dibutuhkan segera operator alat berat untuk site pertambangan di area Morosi.',
                'requirements' => "- Memiliki SIO aktif\n- Pengalaman minimal 2 tahun di area tambang\n- Sehat jasmani dan rohani",
                'location_area' => 'Morosi, Konawe',
                'salary_min' => 6000000,
                'salary_max' => 10000000,
                'closing_days' => 10,
                'link' => null,
                'poster' => 'posters/tambang-hiring.png',
            ],
            [
                'category_name' => 'Ritel & E-Commerce',
                'type_name' => 'Penuh Waktu',
                'title' => 'Kasir Minimarket',
                'description' => 'Dibutuhkan kasir minimarket untuk shift pagi dan malam.',
                'requirements' => "- Lulusan SMA/SMK\n- Jujur, cekatan, dan ramah\n- Bersedia bekerja dengan sistem shift",
                'location_area' => 'Kendari, Sulawesi Tenggara',
                'salary_min' => 2800000,
                'salary_max' => 3200000,
                'closing_days' => 5,
                'link' => null,
                'poster' => null,
            ],
            [
                'category_name' => 'Penjualan & Pemasaran',
                'type_name' => 'Full-time',
                'title' => 'Sales Executive Otomotif',
                'description' => 'Peluang karir sebagai Sales Executive untuk dealer mobil terkemuka di Kendari.',
                'requirements' => "- Komunikatif dan target-oriented\n- Memiliki kendaraan pribadi & SIM C\n- Pengalaman di bidang sales menjadi nilai plus",
                'location_area' => 'Kendari, Sulawesi Tenggara',
                'salary_min' => 3000000,
                'salary_max' => 8000000,
                'closing_days' => 20,
                'link' => 'https://wa.me/628111222333',
                'poster' => null,
            ],
            [
                'category_name' => 'Desain & Kreatif',
                'type_name' => 'Freelance',
                'title' => 'Graphic Designer',
                'description' => 'Mencari desainer grafis freelance untuk membuat konten social media bulanan.',
                'requirements' => "- Menguasai Adobe Illustrator & Photoshop\n- Memahami tren desain media sosial\n- Melampirkan portofolio (wajib)",
                'location_area' => 'Remote / Kendari',
                'salary_min' => 1500000,
                'salary_max' => 3000000,
                'closing_days' => 12,
                'link' => 'https://bit.ly/loker-desainer',
                'poster' => null,
            ],
            [
                'category_name' => 'Keuangan & Akuntansi',
                'type_name' => 'Full-time',
                'title' => 'Staff Akuntansi dan Pajak',
                'description' => 'Mencari staff akuntansi yang mengerti penyusunan laporan keuangan dan pelaporan pajak perusahaan.',
                'requirements' => "- S1 Akuntansi\n- Brevet A & B diutamakan\n- Pengalaman min. 1 tahun",
                'location_area' => 'Kendari, Sulawesi Tenggara',
                'salary_min' => 4000000,
                'salary_max' => 6000000,
                'closing_days' => 25,
                'link' => null,
                'poster' => null,
            ],
            [
                'category_name' => 'Layanan Pelanggan',
                'type_name' => 'Full-time',
                'title' => 'Customer Service Representative',
                'description' => 'Menangani komplain dan pertanyaan pelanggan secara langsung maupun melalui telepon.',
                'requirements' => "- Wanita, max 27 tahun\n- Berpenampilan menarik dan rapi\n- Sabar dan memiliki problem solving yang baik",
                'location_area' => 'Kendari, Sulawesi Tenggara',
                'salary_min' => 3000000,
                'salary_max' => 4000000,
                'closing_days' => 15,
                'link' => null,
                'poster' => null,
            ],
            [
                'category_name' => 'Sumber Daya Manusia (HR)',
                'type_name' => 'Full-time',
                'title' => 'HR Generalist',
                'description' => 'Mengelola proses rekrutmen, absensi, hingga perhitungan payroll karyawan.',
                'requirements' => "- S1 Psikologi / Hukum / Manajemen SDM\n- Paham UU Ketenagakerjaan\n- Mahir Ms. Excel",
                'location_area' => 'Kendari, Sulawesi Tenggara',
                'salary_min' => 4500000,
                'salary_max' => 6500000,
                'closing_days' => 30,
                'link' => null,
                'poster' => null,
            ],
            [
                'category_name' => 'Kesehatan & Medis',
                'type_name' => 'Full-time',
                'title' => 'Perawat Klinik',
                'description' => 'Klinik swasta di Kendari membutuhkan perawat umum yang memiliki STR aktif.',
                'requirements' => "- D3/S1 Keperawatan\n- STR Aktif wajib\n- Bersedia jaga shift malam",
                'location_area' => 'Kendari, Sulawesi Tenggara',
                'salary_min' => 3500000,
                'salary_max' => 5000000,
                'closing_days' => 20,
                'link' => null,
                'poster' => null,
            ],
            [
                'category_name' => 'Pendidikan & Pelatihan',
                'type_name' => 'Part-time',
                'title' => 'Tentor Komputer (Part-Time)',
                'description' => 'Dibutuhkan pengajar untuk kursus komputer dasar dan pemrograman web untuk anak sekolah.',
                'requirements' => "- Mahasiswa IT tingkat akhir dipersilakan\n- Suka mengajar dan sabar\n- Menguasai HTML, CSS, dan dasar Office",
                'location_area' => 'Kendari, Sulawesi Tenggara',
                'salary_min' => 1000000,
                'salary_max' => 2000000,
                'closing_days' => 10,
                'link' => null,
                'poster' => null,
            ],
            [
                'category_name' => 'Logistik & Rantai Pasok',
                'type_name' => 'Kontrak',
                'title' => 'Kurir Ekspedisi',
                'description' => 'Dibutuhkan kurir pengiriman paket untuk rute dalam kota Kendari.',
                'requirements' => "- Memiliki motor pribadi & SIM C aktif\n- Menguasai jalanan kota Kendari\n- Disiplin dan bertanggung jawab",
                'location_area' => 'Kendari, Sulawesi Tenggara',
                'salary_min' => 2800000,
                'salary_max' => 3500000,
                'closing_days' => 7,
                'link' => null,
                'poster' => null,
            ],
            [
                'category_name' => 'Hukum & Kepatuhan',
                'type_name' => 'Full-time',
                'title' => 'Legal Staff',
                'description' => 'Menyusun dan mereview kontrak kerjasama perusahaan serta perizinan.',
                'requirements' => "- S1 Ilmu Hukum\n- Memiliki PKPA menjadi nilai plus\n- Detail dan teliti",
                'location_area' => 'Kendari, Sulawesi Tenggara',
                'salary_min' => 4000000,
                'salary_max' => 5500000,
                'closing_days' => 20,
                'link' => null,
                'poster' => null,
            ],
            [
                'category_name' => 'Teknologi Informasi',
                'type_name' => 'Full-time',
                'title' => 'IT Support & Networking',
                'description' => 'Memastikan infrastruktur jaringan dan perangkat keras kantor berjalan lancar.',
                'requirements' => "- Mengerti Mikrotik & LAN\n- Bisa melakukan troubleshooting hardware PC\n- Responsif terhadap keluhan user",
                'location_area' => 'Kendari, Sulawesi Tenggara',
                'salary_min' => 3500000,
                'salary_max' => 5000000,
                'closing_days' => 14,
                'link' => null,
                'poster' => null,
            ],
            [
                'category_name' => 'Penjualan & Pemasaran',
                'type_name' => 'Full-time',
                'title' => 'Social Media Admin',
                'description' => 'Dibutuhkan admin sosmed untuk mengelola akun Instagram dan Tiktok brand lokal kami.',
                'requirements' => "- Aktif di Tiktok dan paham algoritma\n- Bisa edit video ringan (Capcut)\n- Mampu membalas DM dengan cepat",
                'location_area' => 'Kendari, Sulawesi Tenggara',
                'salary_min' => 2500000,
                'salary_max' => 3500000,
                'closing_days' => 10,
                'link' => null,
                'poster' => null,
            ],
            [
                'category_name' => 'Restoran & Perhotelan',
                'type_name' => 'Full-time',
                'title' => 'Chef de Partie',
                'description' => 'Hotel bintang 3 di Kendari membutuhkan CDP berpengalaman untuk masakan Nusantara dan Western.',
                'requirements' => "- Pengalaman min 3 tahun di kitchen\n- Mampu memimpin tim (cook helper)\n- Menjaga kebersihan area dapur",
                'location_area' => 'Kendari, Sulawesi Tenggara',
                'salary_min' => 5000000,
                'salary_max' => 7000000,
                'closing_days' => 25,
                'link' => null,
                'poster' => null,
            ],
            [
                'category_name' => 'Manajemen & Konsultan',
                'type_name' => 'Full-time',
                'title' => 'Branch Manager',
                'description' => 'Memimpin dan mengelola operasional cabang untuk mencapai target penjualan tahunan.',
                'requirements' => "- Pengalaman level manajerial min 3 tahun\n- Strong leadership\n- Bersedia dinas luar kota",
                'location_area' => 'Bau-Bau, Sulawesi Tenggara',
                'salary_min' => 8000000,
                'salary_max' => 15000000,
                'closing_days' => 30,
                'link' => null,
                'poster' => null,
            ],
            [
                'category_name' => 'Teknik & Arsitektur',
                'type_name' => 'Kontrak',
                'title' => 'HSE / Safety Officer',
                'description' => 'Memastikan pelaksanaan K3 (Kesehatan dan Keselamatan Kerja) di area site project berjalan sesuai standar.',
                'requirements' => "- Sertifikat AK3 Umum Kemnaker\n- Tegas dan teliti\n- Pengalaman di konstruksi / tambang diutamakan",
                'location_area' => 'Konawe Utara, Sulawesi Tenggara',
                'salary_min' => 5500000,
                'salary_max' => 8500000,
                'closing_days' => 15,
                'link' => null,
                'poster' => null,
            ],
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

        // 3. Looping data array untuk dimasukkan ke database
        foreach ($jobsData as $index => $data) {

            // Cari ID Kategori berdasarkan nama (fall-back ke ID 1 jika tidak ketemu)
            $category = JobCategory::where('name', $data['category_name'])->first();
            $categoryId = $category ? $category->id : 1;

            // Cari ID Type Pekerjaan berdasarkan nama (fall-back ke ID 1 jika tidak ketemu)
            // Misal jika 'Full-time' tidak ada, gunakan default ID 1
            $type = JobType::where('name', 'like', "%{$data['type_name']}%")->first();
            $typeId = $type ? $type->id : 1;

            // Buat Job Baru
            Job::create([
                // Mengambil company_id secara acak dari database yang sudah ada
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

                // Sengaja dibuat beberapa ada yang tidak aktif agar UI Dashboard terlihat dinamis
                'is_active' => ($index % 5 === 0) ? false : true,

                'closing_date' => Carbon::now()->addDays($data['closing_days']),
                'link' => $data['link'],
                'poster' => $data['poster'],
            ]);
        }

        $this->command->info('20 Data Loker Kendari berhasil di-seed!');
    }
}
