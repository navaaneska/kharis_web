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
        Schema::create('events', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('kategori_id');
            $table->unsignedBigInteger('kategori2_id')->nullable();
            $table->unsignedBigInteger('kategori3_id')->nullable();
            $table->string('nama', 100);
            $table->dateTime('tanggal_mulai');
            $table->dateTime('tanggal_selesai');
            $table->string('deskripsi');
            $table->integer('lat');
            $table->integer('lng');
            $table->string('ketentuan');
            $table->string('status');
            $table->bigInteger('harga');
            $table->integer('maksimal_peserta');
            $table->string('qr')->nullable();
            $table->dateTime('created_at');
            $table->unsignedBigInteger('created_by');
            $table->dateTime('updated_at');
            $table->unsignedBigInteger('updated_by');

            $table->foreign('kategori_id')->references('id')->on('event__categories');
            $table->foreign('kategori2_id')->references('id')->on('event__categories');
            $table->foreign('kategori3_id')->references('id')->on('event__categories');
            $table->foreign('created_by')->references('id')->on('users');
            $table->foreign('updated_by')->references('id')->on('users');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('events');
    }
};
