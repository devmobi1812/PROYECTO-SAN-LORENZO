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
        Schema::create('alquiler_abonos', function (Blueprint $table) {
            $table->id();
            $table->foreignId("alquiler_id")->constrained("alquileres");
            $table->integer("monto_pagado");
            $table->foreignId("metodo_de_pagos_id")->constrained("metodo_de_pagos");
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('alquiler_abonos');
    }
};
