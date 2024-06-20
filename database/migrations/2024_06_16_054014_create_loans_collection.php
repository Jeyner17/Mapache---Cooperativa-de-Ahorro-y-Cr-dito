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
        Schema::connection('mongodb')->create('loans', function (Blueprint $collection) {
            $collection->index('member_id');
            $collection->decimal('monto', 10, 2);
            $collection->decimal('interes', 5, 2);
            $collection->integer('plazo');
            $collection->string('estado');
            $collection->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::connection('mongodb')->dropIfExists('loans');
    }
};
