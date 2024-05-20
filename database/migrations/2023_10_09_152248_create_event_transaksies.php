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
        Schema::create('event_transaksies', function (Blueprint $table) {
            $table->uuid('id')->primary(); //order_id
            $table->unsignedBigInteger('user_id')->nullable();
            $table->unsignedBigInteger('event_id')->nullable();

            $table->date('transaction_date')->nullable();
            $table->dateTime('transaction_time')->nullable();

            $table->string('transaction_id', 200)->nullable();
            $table->string('order_id', 200)->nullable();
            $table->string('payment_type', 100)->nullable();
            $table->string('bank', 100)->nullable();
            $table->bigInteger('va_number')->nullable();

            $table->bigInteger('jumlah_bayar')->nullable();  // gross_amount
            $table->string('status_bayar', 100)->nullable(); // transaction_status
            $table->dateTime('tanggal_bayar')->nullable();

            $table->dateTime('expiry_time')->nullable();

            $table->timestamps();

            $table->foreign('user_id')->references('id')->on('users');
            $table->foreign('event_id')->references('id')->on('events');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('event_transaksies');
    }
};
