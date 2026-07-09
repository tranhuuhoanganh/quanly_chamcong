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
            Schema::create('deductions', function (Blueprint $table) {
                $table->id('deduction_id');

                $table->foreignId('user_id')
                    ->constrained('users')
                    ->cascadeOnDelete();

                $table->foreignId('deduction_type_id')
                    ->constrained('deduction_types')
                    ->cascadeOnDelete();

                $table->decimal('amount', 12, 2);

                $table->text('reason')->nullable();

                $table->date('deduction_date');

                $table->timestamps();
            });
        }

        /**
         * Reverse the migrations.
         */
        public function down(): void
        {
            Schema::dropIfExists('deductions');
        }
    };
