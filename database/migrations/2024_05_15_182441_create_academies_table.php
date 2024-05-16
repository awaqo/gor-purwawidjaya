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
        Schema::create('academies', function (Blueprint $table) {
            $table->id();
            $table->string('coach_name');
            $table->string('slug');
            $table->text('coach_profile');
            $table->integer('price_academy')->unsigned();
            $table->string('day_schedule');
            $table->integer('meeting')->unsigned();
            $table->string('time_schedule_start');
            $table->string('time_schedule_end');
            $table->string('difficulty_academy');
            $table->integer('slot_academy')->unsigned();
            $table->string('location_academy');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('academies');
    }
};
