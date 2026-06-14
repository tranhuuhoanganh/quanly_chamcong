<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLeaveRequestsTable extends Migration
{
    public function up()
    {
        Schema::create('leave_requests', function (Blueprint $table) {

            $table->id('request_id');

            $table->date('start_date');
            $table->date('end_date');

            $table->decimal('sum_days', 5, 2)->default(0);

            $table->integer('hours')->nullable();

            $table->text('content')->nullable();

            $table->string('status_request', 30)
                  ->default('PENDING');

            $table->timestamp('create_date')
                  ->useCurrent();

            $table->unsignedBigInteger('type_id');

            $table->foreign('type_id')
                  ->references('type_id')
                  ->on('leave_types')
                  ->onDelete('cascade');

            $table->foreignId('user_id')
                  ->constrained('users')
                  ->onDelete('cascade');
        });
    }

    public function down()
    {
        Schema::dropIfExists('leave_requests');
    }
}