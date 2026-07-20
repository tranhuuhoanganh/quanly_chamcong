<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('employment_contracts', function (Blueprint $table) {
            $table->renameColumn('insurance_salary', 'position_allowance');
            $table->renameColumn('allowance', 'living_allowance');
        });
    }

    public function down(): void
    {
        Schema::table('employment_contracts', function (Blueprint $table) {
            $table->renameColumn('position_allowance', 'insurance_salary');
            $table->renameColumn('living_allowance', 'allowance');
        });
    }
};