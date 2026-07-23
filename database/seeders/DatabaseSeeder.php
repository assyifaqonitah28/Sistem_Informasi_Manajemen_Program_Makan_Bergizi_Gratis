<?php

namespace Database\Seeders;

use App\Models\Region;
use App\Models\Program;
use App\Models\Beneficiary;
use App\Models\Distribution;
use App\Models\Report;
use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        User::factory()->create([
            'name' => 'Admin MBG',
            'email' => 'admin@mbg.local',
            'password' => bcrypt('password'),
            'status' => 'active',
            'email_verified_at' => now(),
        ]);

        $provinsi = Region::create(['name' => 'Jawa Barat', 'type' => 'provinsi']);
        $kota = Region::create(['name' => 'Bandung', 'type' => 'kabupaten', 'parent_id' => $provinsi->id]);
        $desa = Region::create(['name' => 'Sukamaju', 'type' => 'desa', 'parent_id' => $kota->id]);

        $program = Program::factory()->create([
            'name' => 'Program Gizi Anak Sekolah Q3 2026',
            'start_date' => now(),
            'end_date' => now()->addMonths(3),
        ]);

        $beneficiaries = Beneficiary::factory(10)->create(['region_id' => $desa->id]);

        foreach ($beneficiaries as $beneficiary) {
            $distribution = Distribution::factory()->create([
                'program_id' => $program->id,
                'beneficiary_id' => $beneficiary->id,
                'status' => 'distributed',
            ]);

            Report::factory()->create([
                'distribution_id' => $distribution->id,
                'user_id' => 1,
                'status' => 'approved',
            ]);
        }
    }
}
