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
        Schema::table('event_pesertas', function (Blueprint $table) {
            $table->bigInteger('harga')->nullable();
        });
        Schema::table('events', function (Blueprint $table) {
            $table->bigInteger('harga_perevent')->nullable();
            $table->bigInteger('harga_perorang')->nullable();
            $table->bigInteger('harga_anak')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('event_pesertas', function (Blueprint $table) {
            $table->dropColumn('harga');
        });
        Schema::table('events', function (Blueprint $table) {
            $table->dropColumn('harga_perevent');
            $table->dropColumn('harga_perorang');
            $table->dropColumn('harga_anak');
        });
    }
};
