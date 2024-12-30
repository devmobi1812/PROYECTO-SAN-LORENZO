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
            $table->foreignId("alquiler_id")->constrained("alquileres")->onDelete('cascade');
            $table->string("servicio_nombre",100);
            $table->integer("servicio_precio");
            $table->integer("servicio_cantidad")->default(1);
            $table->time("desde")->nullable();
            $table->time("hasta")->nullable();
            $table->timestamps();
        });


        DB::unprepared("
            CREATE TRIGGER after_alquiler_recibos_insert
            AFTER INSERT ON alquiler_recibos
            FOR EACH ROW
            BEGIN
                UPDATE alquileres
                SET monto_final = monto_final + (NEW.servicio_precio * NEW.servicio_cantidad * (1 - descuento / 100)),
                    monto_adeudado = monto_adeudado + (NEW.servicio_precio * NEW.servicio_cantidad * (1 - descuento / 100))
                WHERE id = NEW.alquiler_id;
            END;
        ");
        DB::unprepared("
            CREATE TRIGGER after_alquiler_recibos_update
            AFTER UPDATE ON alquiler_recibos
            FOR EACH ROW
            BEGIN
                UPDATE alquileres
                SET monto_final = monto_final - (OLD.servicio_precio * OLD.servicio_cantidad * (1 - descuento / 100)) + (NEW.servicio_precio * NEW.servicio_cantidad * (1 - descuento / 100)),
                    monto_adeudado = monto_adeudado - (OLD.servicio_precio * OLD.servicio_cantidad * (1 - descuento / 100)) + (NEW.servicio_precio * NEW.servicio_cantidad * (1 - descuento / 100))
                WHERE id = NEW.alquiler_id;
            END;
        ");
        DB::unprepared("
            CREATE TRIGGER after_alquiler_recibos_delete
            AFTER DELETE ON alquiler_recibos
            FOR EACH ROW
            BEGIN
                UPDATE alquileres
                SET monto_final = monto_final - (OLD.servicio_precio * OLD.servicio_cantidad * (1 - descuento / 100)),
                    monto_adeudado = monto_adeudado - (OLD.servicio_precio * OLD.servicio_cantidad * (1 - descuento / 100))
                WHERE id = OLD.alquiler_id;
            END;
        ");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::unprepared("DROP TRIGGER IF EXISTS after_alquiler_recibos_insert;");
        DB::unprepared("DROP TRIGGER IF EXISTS after_alquiler_recibos_update;");
        DB::unprepared("DROP TRIGGER IF EXISTS after_alquiler_recibos_delete;");
        Schema::dropIfExists('alquiler_recibos');
    }
};
