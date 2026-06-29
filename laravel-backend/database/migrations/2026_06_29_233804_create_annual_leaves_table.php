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
       Schema::create('annual_leaves', function (Blueprint $table) {
            $table->id('annual_leave_id');

            // Số ngày phép năm
            $table->decimal('annual_leave_number', 5, 2)->default(0);

            // Số ngày nghỉ được quy đổi từ OT
            $table->decimal('ot_converted_number', 5, 2)->default(0);

            // Năm áp dụng
            $table->year('year');

            // Nhân viên
            $table->foreignId('user_id')
                  ->constrained('users')
                  ->onDelete('cascade');

            $table->timestamps();

            // Mỗi nhân viên chỉ có 1 bản ghi trong 1 năm
            $table->unique(['user_id', 'year']);
        }); 
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('annual_leaves');
    }
};
