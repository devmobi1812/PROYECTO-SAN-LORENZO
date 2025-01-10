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
            $table->foreignId("nombre_id")->constrained("clientes");
            $table->foreignId("dia_id")->constrained("dias");
            $table->integer( "descuento")->default(0);
            $table->foreignId(column: "estado_id")->constrained("estados")->default(2); // inpago
            $table->integer("monto_final")->default(0);
            $table->integer("monto_adeudado")->default(0);
            $table->integer("deposito")->default(0);
            $table->unsignedBigInteger("estado_deposito")->default(2);
            $table->foreign("estado_deposito")->references("id")->on("estados");
            $table->date("fecha");


            $table->timestamps();
        });

        DB::unprepared("
            CREATE TRIGGER after_alquileres_update
            BEFORE UPDATE ON alquileres
            FOR EACH ROW
            BEGIN
                IF OLD.descuento != NEW.descuento THEN
                SET NEW.monto_final = NEW.monto_final / (1 - OLD.descuento / 100)
                                                    * (1 - NEW.descuento / 100);
                    SET NEW.monto_adeudado =  NEW.monto_final - (OLD.monto_final - OLD.monto_adeudado);
                END IF;
            END;
        ");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::unprepared("DROP TRIGGER IF EXISTS after_alquileres_update;");
        Schema::dropIfExists('alquileres');
    }
};
