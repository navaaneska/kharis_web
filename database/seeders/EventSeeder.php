<?php

namespace Database\Seeders;

use Carbon\Carbon;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class EventSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('events')->insert([[
            'kategori_id' => 1,
            'kategori2_id' => null,
            'kategori3_id' => null,
            'nama' => 'Mariage',
            'nama_slug' => 'Mariage',
            'tanggal_mulai' => Carbon::now()->format('Y-m-d H:i:s'),
            'tanggal_selesai' => Carbon::now()->format('Y-m-d H:i:s'),
            'deskripsi' => 'deskripsi acara 1',
            'lokasi' => 'jl.surabaya',
            'lat' => 12345,
            'lng' => 12345,
            'ketentuan' => 'Mariage',
            'status' => 'open',
            'online' => 1,
            'harga' => 20000,
            'maksimal_peserta' => 20,
            'qr' => 'Mariage',
            'featured_image' => 'featured_image',
            'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
            'created_by' => '1',
            'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),
            'updated_by' => '1',
        ], [
            'kategori_id' => 1,
            'kategori2_id' => null,
            'kategori3_id' => null,
            'nama' => 'Mariage dua',
            'nama_slug' => 'Mariage_dua',
            'tanggal_mulai' => Carbon::now()->format('Y-m-d H:i:s'),
            'tanggal_selesai' => Carbon::now()->format('Y-m-d H:i:s'),
            'deskripsi' => 'deskripsi acara 2',
            'lokasi' => 'jl.surabaya',
            'lat' => 12345,
            'lng' => 12345,
            'ketentuan' => 'Mariage',
            'status' => 'open',
            'online' => 0,
            'harga' => 50000,
            'maksimal_peserta' => 10,
            'qr' => 'Mariage',
            'featured_image' => 'featured_image',
            'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
            'created_by' => '1',
            'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),
            'updated_by' => '1',
        ]]);
    }
}
