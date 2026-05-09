<?php

namespace Database\Seeders;

use App\Models\Company;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class CompanySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Ambil user employer untuk dihubungkan
        $employer1 = User::where('email', 'hr@techindo.test')->first();
        $employer2 = User::where('email', 'rekrutmen@majujaya.test')->first();

        if ($employer1) {
            $name1 = 'PT Tech Indo Solusi';
            Company::create([
                'user_id' => $employer1->id,
                'name' => $name1,
                'slug' => Str::slug($name1),
                'sector' => 'IT', // Disesuaikan dari Beauty ke IT
                'description' => 'Perusahaan IT yang berfokus pada pengembangan perangkat lunak dan sistem informasi.',
                'address' => 'Jl. MT Haryono, Kendari',
                'social_link' => 'https://techindo.test',
            ]);
        }

        if ($employer2) {
            $name2 = 'CV Maju Jaya Abadi';
            Company::create([
                'user_id' => $employer2->id,
                'name' => $name2,
                'slug' => Str::slug($name2),
                'sector' => 'Retail & FMCG', // Disesuaikan dari IT ke Retail
                'description' => 'Distributor barang retail dan FMCG terbesar di Sulawesi Tenggara.',
                'address' => 'Jl. Bypass Kendari',
                'social_link' => 'https://majujaya.test',
            ]);
        }
    }
}
