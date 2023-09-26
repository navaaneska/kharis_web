<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class EventCategorieSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('event_categories')->insert([
            [
                'nama' => 'kategori1',
                'icon' => 'icon',
                'image' => 'image',
            ], [
                'nama' => 'kategori2',
                'icon' => 'icon',
                'image' => 'image',
            ]

        ]);
    }
}
