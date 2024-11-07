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
        Schema::create('alquileres', function (Blueprint $table) {
            $table->id();
            $table->foreignId("nombre_id")->nullable()->constrained("clientes");
            $table->foreignId("dia_id")->constrained("dias");
            $table->foreignId("descuento_id")->constrained("descuentos");
            $table->foreignId("estado_id")->constrained("estados");
            $table->integer("monto_final");
            $table->integer("monto_adeudado");
            $table->integer("deposito")->default(0);
            $table->date("fecha");


            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('alquileres');
    }
};
