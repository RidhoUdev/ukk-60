<?php

namespace Database\Seeders;

use Carbon\Carbon;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

use function Symfony\Component\Clock\now;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $timestamp = Carbon::now();

        DB::table('categories')->insert(
            [
                [
                    'category_name' => 'Kebersihan',
                    'created_at' => $timestamp,
                    'updated_at' => $timestamp,
                ],
                [
                    'category_name' => 'Kerusakan',
                    'created_at' => $timestamp,
                    'updated_at' => $timestamp,
                ],
                [
                    'category_name' => 'Fasilitas Umum',
                    'created_at' => $timestamp,
                    'updated_at' => $timestamp,
                ]
            ]
        );
    }
}
