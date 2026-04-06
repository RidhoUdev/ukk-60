<?php

namespace Database\Seeders;

use App\Models\User;
use Carbon\Carbon;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $now = Carbon::now();

        DB::table('users')->insert(
            [
                [
                    'username' => '1122334455',
                    'full_name' => 'Admin Sekolah',
                    'class' => null,
                    'role' => 'admin',
                    'password' => Hash::make('admin123'),
                    'created_at' => $now,
                    'updated_at' => $now,
                    
                ],
                [
                    'username' => '0088776655',
                    'full_name' => 'Muhammad Ridho',
                    'class' => 'XII RPL 2',
                    'role' => 'siswa',
                    'password' => Hash::make('siswa123'),
                    'created_at' => $now,
                    'updated_at' => $now,
                ],
                [
                    'username' => '0099887766',
                    'full_name' => 'Chris John',
                    'class' => 'XII RPL 1',
                    'role' => 'siswa',
                    'password' => Hash::make('siswa123'),
                    'created_at' => $now,
                    'updated_at' => $now,
                ],
                [
                    'username' => '00000000',
                    'full_name' => 'Catlyn Heiper',
                    'class' => 'XII RPL 3',
                    'role' => 'siswa',
                    'password' => Hash::make('siswa123'),
                    'created_at' => $now,
                    'updated_at' => $now,
                ],
                [
                    'username' => '0011223344',
                    'full_name' => 'Davina',
                    'class' => 'XII RPL 1',
                    'role' => 'siswa',
                    'password' => Hash::make('siswa123'),
                    'created_at' => $now,
                    'updated_at' => $now,
                ],
                [
                    'username' => '009911223344',
                    'full_name' => 'John Doe',
                    'class' => 'XII RPL 2',
                    'role' => 'siswa',
                    'password' => Hash::make('siswa123'),
                    'created_at' => $now,
                    'updated_at' => $now,
                ],
                [
                    'username' => '0055667788',
                    'full_name' => 'James Cristopher',
                    'class' => 'XII RPL 3',
                    'role' => 'siswa',
                    'password' => Hash::make('siswa123'),
                    'created_at' => $now,
                    'updated_at' => $now,
                ],
            ]
        );
    }
}
