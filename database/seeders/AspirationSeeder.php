<?php

namespace Database\Seeders;

use Carbon\Carbon;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class AspirationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $now = Carbon::now();

        DB::table('aspirations')->insert([
            [
                'user_id' => 2,
                'category_id' => 2,
                'title' => 'Komputer tidak bisa digunakan.',
                'description' => 'Komputer nomor 10 pada ruang Lab A RPL mengalami BSOD(Blue Sceen Of Death)',
                'location' => 'Ruang Lab A RPL',
                'status' => 'Menunggu',
                'photo' => asset('assets/komputer_rusak.png'),
                'created_at' => '2026-01-01',
                'updated_at' => '2026-01-01',
            ],
            [
                'user_id' => 3,
                'category_id' => 2,
                'title' => 'AC Ruangan bocor.',
                'description' => 'AC pada ruangan RPS mengalami kebocoran.',
                'location' => 'Ruang RPS RPL',
                'status' => 'Menunggu',
                'photo' => asset('assets/ac_ruangan.jpg'),
                'created_at' => '2026-02-01',
                'updated_at' => '2026-02-01',
            ],
            [
                'user_id' => 4,
                'category_id' => 3,
                'title' => 'Kran air pada taman rusak.',
                'description' => 'Kran air pada taman mengalami kerusakan / tidak bisa ditutup.',
                'location' => 'Taman sekolah',
                'status' => 'Menunggu',
                'photo' => asset('assets/kran_air.jpeg'),
                'created_at' => '2026-02-12',
                'updated_at' => '2026-02-12',
            ],
        ]);
    }
}
