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
    Schema::create('positions', function (Blueprint $table) {
        $table->id('pos_id');

        $table->string('pos_code')->unique();
        $table->string('pos_name');

        $table->integer('level')->default(1);

        $table->text('pos_description')->nullable();

        $table->timestamps();
    });
}

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('positions');
    }
};
