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
        Schema::create('transactions', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->foreignId('user_id')->constrained('users')->cascadeOnUpdate();
            $table->foreignId('court_id')->constrained('courts')->cascadeOnDelete()->cascadeOnUpdate();
            $table->foreignId('booking_id')->constrained('bookings')->cascadeOnDelete()->cascadeOnUpdate();
            $table->integer('unique_payment_code')->unsigned();
            $table->integer('total')->unsigned();
            $table->string('payment_metode');
            $table->enum('payment_status', ['paid', 'unpaid'])->default('unpaid');
            $table->enum('order_status', ['awaiting_payment', 'need_confirm', 'confirmed', 'completed', 'cancelled'])->default('awaiting_payment');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('transactions');
    }
};
