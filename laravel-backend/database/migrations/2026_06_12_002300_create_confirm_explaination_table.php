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
        Schema::create('confirm_explaination', function (Blueprint $table) {
            $table->id('cf_explain_id');
            $table->date('cf_date');
            $table->integer('approve_id');
            $table->foreignId('explain_id')
            ->constrained('time_expalaination', 'explain_id')
            ->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('confirm_explaination');
    }
};
