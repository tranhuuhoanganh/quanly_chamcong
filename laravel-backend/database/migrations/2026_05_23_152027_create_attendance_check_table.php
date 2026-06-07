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
        Schema::create('attendance_check', function (Blueprint $table) {

            $table->id('check_id');
        
            $table->foreignId('time_entry_id')
                ->constrained('time_entry', 'time_entry_id')
                ->onDelete('cascade');
        
            $table->boolean('is_late')->default(0);
            $table->boolean('is_quit_early')->default(0);
            $table->boolean('confirm_late')->default(0);
            $table->boolean('confirm_early')->default(0);
            $table->timestamps();
        
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('attendance_check');
    }
};
