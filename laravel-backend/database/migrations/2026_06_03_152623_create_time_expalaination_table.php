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
        Schema::create('time_expalaination', function (Blueprint $table) {
            $table->id('explain_id');
            $table->date('create_date');
            $table->text('reason');
            $table->tinyInteger('status')->default(0);
            $table->foreignId('time_entry_id')
                ->constrained('time_entry', 'time_entry_id')
                ->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('time_expalaination');
    }
};
