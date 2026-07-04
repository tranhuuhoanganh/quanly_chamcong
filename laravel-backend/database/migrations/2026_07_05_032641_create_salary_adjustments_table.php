<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('salary_adjustments', function (Blueprint $table) {
            $table->id('adjustment_id');

            // Nhân viên
            $table->foreignId('user_id')
                ->constrained('users')
                ->cascadeOnDelete();

            // Kỳ lương
            $table->unsignedTinyInteger('month');
            $table->unsignedSmallInteger('year');

            // Loại điều chỉnh
            // 1: Thưởng
            // 2: Phụ cấp
            // 3: Khấu trừ
            $table->unsignedTinyInteger('type');

            // Tên khoản
            $table->string('name');

            // Số tiền
            $table->decimal('amount', 15, 2);

            // Ghi chú
            $table->text('note')->nullable();

            // Trạng thái
            $table->unsignedTinyInteger('status')->default(1);

            $table->timestamps();

            $table->index(['user_id', 'month', 'year']);
            $table->index('type');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('salary_adjustments');
    }
};