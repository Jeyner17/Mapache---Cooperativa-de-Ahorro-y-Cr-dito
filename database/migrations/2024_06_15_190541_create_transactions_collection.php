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
        Schema::connection('mongodb')->create('transactions', function (Blueprint $collection) {
            $collection->index('savings_account_id');
            $collection->string('tipo');
            $collection->decimal('monto', 10, 2);
            $collection->string('descripcion');
            $collection->string('estado');
            $collection->timestamps();

            // Referencia a SavingsAccounts
            $collection->foreign('savings_account_id')
                ->references('_id')
                ->on('savings_accounts')
                ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::connection('mongodb')->dropIfExists('transactions');
    }
};
