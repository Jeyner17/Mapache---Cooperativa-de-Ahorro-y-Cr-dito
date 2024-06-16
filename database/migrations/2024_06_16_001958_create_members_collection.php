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
        Schema::connection('mongodb')->create('members', function (Blueprint $collection) {
            $collection->string('nombre');
            $collection->string('apellido');
            $collection->string('cedula')->unique();
            $collection->string('email')->unique();
            $collection->embedded('direccion', function ($subcollection) {
                $subcollection->string('calle');
                $subcollection->string('numero');
                $subcollection->string('calle_secundaria')->nullable();
                $subcollection->string('ciudad');
            });
            $collection->array('telefono', function ($subcollection) {
                $subcollection->string('telefono');
            });
            $collection->string('estado');
            $collection->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::connection('mongodb')->dropIfExists('members');
    }
};
