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
        Schema::connection('mongodb')->create('savings_quotas', function (Blueprint $collection) {
            $collection->index('member_id');
            $collection->decimal('monto', 10, 2)->default(5.00);
            $collection->date('fecha_semana');
            $collection->string('estado');
            $collection->timestamp('fecha_pago')->nullable();
            $collection->timestamps();

            // Referencia a Members
            $collection->foreign('member_id')
                ->references('_id')
                ->on('members')
                ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::connection('mongodb')->dropIfExists('savings_quotas');
    }
};
