<?php

namespace Database\Seeders;

use App\Models\JobType;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class JobTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $types = ['Full-time', 'Part-time', 'Kontrak', 'Paruh-waktu', 'Magang'];

        foreach ($types as $type) {
            JobType::create([
                'name' => $type,
                'slug' => Str::slug($type),
            ]);
        }
    }
}
