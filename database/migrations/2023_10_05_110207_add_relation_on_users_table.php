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
        Schema::table('users', function ($table) {
            $table->unsignedBigInteger('ayah_id')->nullable()->change();
            $table->unsignedBigInteger('ibu_id')->nullable()->change();
            $table->unsignedBigInteger('pasangan_id')->nullable()->change();
            $table->foreign('ayah_id')->references('id')->on('users');
            $table->foreign('ibu_id')->references('id')->on('users');
            $table->foreign('pasangan_id')->references('id')->on('users');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function ($table) {
            $table->dropForeign(['ayah_id']);
            $table->dropForeign(['ibu_id']);
            $table->dropForeign(['pasangan_id']);
            $table->dropColumn('ayah_id');
            $table->dropColumn('ibu_id');
            $table->dropColumn('pasangan_id');
        });
    }
};
