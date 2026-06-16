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
        Schema::create('confirm_leave_request', function (Blueprint $table) {
            $table->id('cf_request_id');
            $table->date('confirm_results');
            $table->integer('approve_id');
            $table->foreignId('request_id')
            ->constrained('Leave Requests', 'request_id')
            ->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('confirm_leave_request');
    }
};
