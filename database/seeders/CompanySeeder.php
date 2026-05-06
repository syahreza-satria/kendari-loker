<?php

namespace Database\Seeders;

use App\Models\Company;
use App\Models\User;
use Illuminate\Database\Seeder;

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

        Company::create([
            'user_id' => $employer1->id,
            'name' => 'PT Tech Indo Solusi',
            'description' => 'Perusahaan IT yang berfokus pada pengembangan perangkat lunak dan sistem informasi.',
            'address' => 'Jl. MT Haryono, Kendari',
            'website' => 'https://techindo.test',
        ]);

        Company::create([
            'user_id' => $employer2->id,
            'name' => 'CV Maju Jaya Abadi',
            'description' => 'Distributor barang retail dan FMCG terbesar di Sulawesi Tenggara.',
            'address' => 'Jl. Bypass Kendari',
            'website' => 'https://majujaya.test',
        ]);
    }
}
