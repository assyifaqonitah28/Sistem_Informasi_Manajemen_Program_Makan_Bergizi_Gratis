<?php

namespace Database\Seeders;

use App\Models\Region;
use App\Models\Program;
use App\Models\Beneficiary;
use App\Models\Distribution;
use App\Models\Report;
use App\Models\User;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        app()[\Spatie\Permission\PermissionRegistrar::class]->forgetCachedPermissions();

        $permissions = [
            // User Management
            'view-users', 'create-users', 'edit-users', 'delete-users',
            // Program Management
            'view-programs', 'create-programs', 'edit-programs', 'delete-programs',
            // Beneficiary Management
            'view-beneficiaries', 'create-beneficiaries', 'edit-beneficiaries', 'delete-beneficiaries',
            // Region Management
            'view-regions', 'create-regions', 'edit-regions', 'delete-regions',
            // Distribution Management
            'view-distributions', 'create-distributions', 'edit-distributions', 'delete-distributions',
            // Report Management
            'view-reports', 'create-reports', 'edit-reports', 'delete-reports',
        ];

        foreach ($permissions as $permission) {
            Permission::firstOrCreate(['name' => $permission]);
        }

        $adminRole = Role::firstOrCreate(['name' => 'admin']);
        $adminRole->syncPermissions($permissions);

        $userRole = Role::firstOrCreate(['name' => 'user']);
        $userRole->syncPermissions([
            'view-programs',
            'view-beneficiaries',
            'view-distributions',
            'view-reports',
            'create-reports',
        ]);

        $admin = User::firstOrCreate(
            ['email' => 'admin@mbg.local'],
            [
                'name' => 'Admin MBG',
                'password' => bcrypt('password'),
                'status' => 'active',
                'email_verified_at' => now(),
            ]
        );
        $admin->assignRole('admin');

        $user = User::firstOrCreate(
            ['email' => 'user@mbg.local'],
            [
                'name' => 'User MBG',
                'password' => bcrypt('password'),
                'status' => 'active',
                'email_verified_at' => now(),
            ]
        );
        $user->assignRole('user');

        $provinsi = Region::firstOrCreate(['name' => 'Jawa Barat', 'type' => 'provinsi']);
        $kota = Region::firstOrCreate(
            ['name' => 'Bandung', 'type' => 'kabupaten'],
            ['parent_id' => $provinsi->id]
        );
        $desa = Region::firstOrCreate(
            ['name' => 'Sukamaju', 'type' => 'desa'],
            ['parent_id' => $kota->id]
        );

        $program = Program::firstOrCreate(
            ['name' => 'Program Gizi Anak Sekolah Q3 2026'],
            [
                'description' => 'Program pemberian makanan bergizi gratis untuk anak sekolah dasar.',
                'start_date' => now(),
                'end_date' => now()->addMonths(3),
                'status' => 'active',
            ]
        );

        $beneficiaries = Beneficiary::factory(10)->create(['region_id' => $desa->id]);

        foreach ($beneficiaries as $beneficiary) {
            $distribution = Distribution::firstOrCreate(
                [
                    'program_id' => $program->id,
                    'beneficiary_id' => $beneficiary->id,
                ],
                [
                    'distribution_date' => now(),
                    'quantity' => fake()->numberBetween(1, 5),
                    'status' => 'distributed',
                    'notes' => fake()->sentence(),
                ]
            );

            Report::firstOrCreate(
                ['distribution_id' => $distribution->id],
                [
                    'user_id' => $admin->id,
                    'report_date' => now(),
                    'description' => fake()->paragraph(),
                    'status' => 'approved',
                ]
            );
        }
    }
}
