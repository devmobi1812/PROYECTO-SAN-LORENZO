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
            $table->integer("servicio_cantidad")->nullable()->default(1);
            $table->time("desde")->nullable();
            $table->time("hasta")->nullable();
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
