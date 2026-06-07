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
        Schema::create('time_entry', function (Blueprint $table) {
            $table->id('time_entry_id');
            $table->foreignId('user_id')
                ->constrained('employees', 'user_id')
                ->onDelete('cascade');

            $table->foreignId('checkin_date')
                ->constrained('working_days', 'day_id');

            // Giờ vào / ra
            $table->time('checkin_time')->nullable();
            $table->time('checkout_time')->nullable();

            // Số phút đi muộn
            $table->integer('number_minutes_late')->default(0);

            // Số phút về sớm
            $table->integer('number_minutes_quit_early')->default(0);

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('time_emtry');
    }
};
