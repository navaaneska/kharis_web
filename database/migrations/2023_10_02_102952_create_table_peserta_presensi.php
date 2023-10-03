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

        Schema::create('event_qrcodes', function (Blueprint $table) {
            $table->id();
            $table->string('judul', 100);
            $table->unsignedBigInteger('event_id');
            $table->string('qr', 64)->unique();

            $table->foreign('event_id')->references('id')->on('events');
        });

        Schema::create('event_peserta_presensis', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('qrcode_id');
            $table->unsignedBigInteger('user_id');
            $table->timestamp('jam_presensi');

            $table->foreign('qrcode_id')->references('id')->on('event_qrcodes');
            $table->foreign('user_id')->references('id')->on('users');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('event_peserta_presensis');
        Schema::dropIfExists('event_qrcodes');
    }
};
