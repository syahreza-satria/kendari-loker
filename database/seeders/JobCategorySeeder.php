<?php

namespace Database\Seeders;

use App\Models\JobCategory;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class JobCategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $categories = [
            ['name' => 'Administrasi & Perkantoran', 'icon' => 'file-text'],
            ['name' => 'Teknologi Informasi', 'icon' => 'monitor'],
            ['name' => 'Desain & Kreatif', 'icon' => 'pen-tool'],
            ['name' => 'Penjualan & Pemasaran', 'icon' => 'trending-up'],
            ['name' => 'Keuangan & Akuntansi', 'icon' => 'dollar-sign'],
            ['name' => 'Layanan Pelanggan', 'icon' => 'headphones'],
            ['name' => 'Sumber Daya Manusia (HR)', 'icon' => 'users'],
            ['name' => 'Teknik & Arsitektur', 'icon' => 'tool'],
            ['name' => 'Kesehatan & Medis', 'icon' => 'activity'],
            ['name' => 'Pendidikan & Pelatihan', 'icon' => 'book-open'],
            ['name' => 'Manajemen & Konsultan', 'icon' => 'briefcase'],
            ['name' => 'Logistik & Rantai Pasok', 'icon' => 'truck'],
            ['name' => 'Hukum & Kepatuhan', 'icon' => 'shield'],
            ['name' => 'Restoran & Perhotelan', 'icon' => 'coffee'],
            ['name' => 'Ritel & E-Commerce', 'icon' => 'shopping-cart'],
        ];

        foreach ($categories as $cat) {
            JobCategory::create([
                'name' => $cat['name'],
                'slug' => Str::slug($cat['name']),
                'icon' => $cat['icon'],
            ]);
        }
    }
}
