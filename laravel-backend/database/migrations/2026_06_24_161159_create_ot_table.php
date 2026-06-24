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
        Schema::create('ot', function (Blueprint $table) {
            $table->id();
                $table->date('ot_date');
                $table->time('start_time');
                $table->time('end_time');
                $table->decimal('sum_hours_ot', 5, 2)->default(0);
                $table->tinyInteger('status')->default(0);
                $table->text('reason')->nullable();
                $table->unsignedBigInteger('type_id');
                $table->foreign('type_id')
                  ->references('type_id')
                  ->on('types')
                  ->onDelete('cascade');

            $table->foreignId('user_id')
                  ->constrained('users')
                  ->onDelete('cascade');
 
            $table->timestamps();
        });
    }


    public function down(): void
    {
        Schema::dropIfExists('ot');
    }
};
