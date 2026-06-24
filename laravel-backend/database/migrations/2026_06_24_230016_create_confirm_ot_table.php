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
        Schema::create('confirm_ot', function (Blueprint $table) {
            $table->id('cf_ot_id');
            $table->decimal('sum_hours_ot', 5, 2)->default(0);
            $table->date('cf_date');
            $table->text('reason')->nullable();
            $table->integer('approve_id');
            $table->unsignedBigInteger('ot_id');

            $table->foreign('ot_id')
                ->references('ot_id')
                ->on('ot')
                ->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('confirm_ot');
    }
};
