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
        Schema::create('alquiler_recibos', function (Blueprint $table) {
            $table->id();
            $table->foreignId("alquiler_id")->constrained("alquileres");
            $table->string("servicio_nombre",100);
            $table->integer("servicio_precio");
            $table->integer("servicio_cantidad")->default(1);
            $table->integer("servicio_deposito");
            $table->time("desde");
            $table->time("hasta");
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('alquiler_recibos');
    }
};
