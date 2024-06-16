<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\Schema;

use MongoDB\Laravel\Schema\Blueprint;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::connection('mongodb')->create('payments', function (Blueprint $collection) {
            $collection->index('loan_id');
            $collection->decimal('monto', 10, 2);
            $collection->string('tipo');
            $collection->string('estado');
            $collection->timestamps();

            // Referencia a Loans
            $collection->foreign('loan_id')
                ->references('_id')
                ->on('loans')
                ->onDelete('cascade');
        });

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::connection('mongodb')->dropIfExists('payments');
    }
};
