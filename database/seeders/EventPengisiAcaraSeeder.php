<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class EventPengisiAcaraSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('event_pengisi_acaras')->insert([
            'user_id' => 1,
            'event_id' => 1,
            'nama' => 'pengisi acara satu',
        ]);
    }
}
