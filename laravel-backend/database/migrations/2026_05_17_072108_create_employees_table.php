<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('employees', function (Blueprint $table) {

            $table->id();

            $table->string('emp_code')->unique();
            $table->string('fullname');

            $table->date('birthday')->nullable();

            $table->enum('sex', ['nam', 'nữ'])->nullable();

            $table->string('email')->unique();

            $table->string('phone', 10)->nullable();

            $table->date('hire_date')->nullable();

            $table->boolean('status')->default(1);

            $table->unsignedBigInteger('manager_id')->nullable();

            // department
            $table->unsignedBigInteger('depart_id');

            $table->foreign('depart_id')
                ->references('depart_id')
                ->on('departments')
                ->cascadeOnUpdate()
                ->restrictOnDelete();

            // position
            $table->unsignedBigInteger('pos_id');

            $table->foreign('pos_id')
                ->references('pos_id')
                ->on('positions')
                ->cascadeOnUpdate()
                ->restrictOnDelete();

            // role
            $table->unsignedBigInteger('role_id');

            $table->foreign('role_id')
                ->references('role_id')
                ->on('role')
                ->cascadeOnUpdate()
                ->restrictOnDelete();

            // user
            $table->foreignId('user_id')
                ->constrained('users')
                ->cascadeOnDelete();

            $table->softDeletes();

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('employees');
    }
};