<?php

namespace Database\Seeders;

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
        DB::table('users')->insert([
            'name' => 'nama satu',
            'username' => 'user1',
            'email' => 'satu@gmail.com',
            'password' => bcrypt('password'),
            'alamat' => 'alamat satu',
            'whatsapp' => '12345678',
            'pekerjaan' => 'mahasiswa',
            'jenis_kelamin' => 'pria',
            'tanggal_lahir' => Carbon::today(),
            'ayah_id' => null, //2
            'ayah_id_approval' => null, //true
            'ibu_id' => null, //3
            'ibu_id_approval' => null, //true
            'pasangan_id' => null, //4
            'pasangan_id_approval' => null, //true
        ]);
    }
}
