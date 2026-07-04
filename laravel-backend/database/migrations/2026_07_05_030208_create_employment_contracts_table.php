<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('employment_contracts', function (Blueprint $table) {
            $table->id('contract_id');

            // Nhân viên
            $table->foreignId('user_id')
                ->constrained('users')
                ->cascadeOnDelete();

            // Thông tin hợp đồng
            $table->string('contract_code')->unique();

            // Thời gian
            $table->date('sign_date')->nullable();
            $table->date('start_date');
            $table->date('end_date')->nullable();

            // Lương
            $table->decimal('basic_salary', 15, 2)->default(0);
            $table->decimal('insurance_salary', 15, 2)->default(0); // Lương đóng BH
            $table->decimal('allowance', 15, 2)->default(0);
            $table->decimal('taxable_allowance', 15, 2)->default(0);

            // Bảo hiểm và thuế
            $table->boolean('participate_insurance')->default(true);

            // Hợp đồng hiện hành
            $table->boolean('is_current')->default(false);

            // 1: hoạt động, 2: hết hạn, 3: chấm dứt
            $table->unsignedTinyInteger('status')->default(1);

            $table->timestamps();

            $table->index(['user_id', 'is_current']);
            $table->index('status');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('employment_contracts');
    }
};
