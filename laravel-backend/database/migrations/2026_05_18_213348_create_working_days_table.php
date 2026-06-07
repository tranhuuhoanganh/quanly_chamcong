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
        Schema::create('working_days', function (Blueprint $table) {

            $table->id('day_id');

            // ngày làm việc
            $table->date('work_date');

            // giờ checkin
            $table->time('checkin_time');

            // giờ checkout
            $table->time('checkout_time');

            // loại ngày
            $table->foreignId('type_id')->constrained('types', 'type_id');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('working_days');
    }
};
