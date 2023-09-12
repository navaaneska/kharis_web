<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('name', 255);
            $table->string('username')->unique();
            $table->string('email', 100)->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password', 255);
            $table->string('alamat', 500);
            $table->string('whatsapp', 100);
            $table->string('pekerjaan', 100);
            $table->string('jenis_kelamin');
            $table->date('tanggal_lahir');
            $table->integer('ayah_id')->nullable();
            $table->string('ayah_id_approval')->nullable();
            $table->integer('ibu_id')->nullable();
            $table->string('ibu_id_approval')->nullable();
            $table->integer('pasangan_id')->nullable();
            $table->string('pasangan_id_approval')->nullable();
            $table->rememberToken();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('users');
    }
};
