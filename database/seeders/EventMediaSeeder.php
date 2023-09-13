<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class EventMediaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('event_media')->insert([
            'event_id' => 1,
            'judul' => 'judul satu',
            'file' => 'file',
            'jenis' => 'jenis',
            'utama' => false
        ]);
    }
}
