<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('alquiler_abonos', function (Blueprint $table) {
            $table->id();
            $table->foreignId("alquiler_id")->constrained("alquileres")->onDelete('cascade');
            $table->integer("monto_pagado");
            $table->string("detalle", 100)->nullable();
            $table->foreignId("metodo_de_pagos_id")->constrained("metodo_de_pagos");
            $table->boolean("es_deposito")->default(false);
            $table->timestamps();
        });

        DB::unprepared("
            CREATE TRIGGER after_alquiler_abonos_insert
            AFTER INSERT ON alquiler_abonos
            FOR EACH ROW
            BEGIN
                UPDATE alquileres
                SET monto_adeudado = monto_adeudado - NEW.monto_pagado
                WHERE id = NEW.alquiler_id;
            END;
        ");
        DB::unprepared("
            CREATE TRIGGER after_alquiler_abonos_update
            AFTER UPDATE ON alquiler_abonos
            FOR EACH ROW
            BEGIN
                UPDATE alquileres
                SET monto_adeudado = monto_adeudado + OLD.monto_pagado - NEW.monto_pagado
                WHERE id = NEW.alquiler_id;
            END;
        ");
        DB::unprepared("
            CREATE TRIGGER after_alquiler_abonos_delete
            AFTER DELETE ON alquiler_abonos
            FOR EACH ROW
            BEGIN
                UPDATE alquileres
                SET monto_adeudado = monto_adeudado + OLD.monto_pagado
                WHERE id = OLD.alquiler_id;
            END;
        ");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::unprepared("DROP TRIGGER IF EXISTS after_alquiler_abonos_insert;");
        DB::unprepared("DROP TRIGGER IF EXISTS after_alquiler_abonos_update;");
        DB::unprepared("DROP TRIGGER IF EXISTS after_alquiler_abonos_delete;");
        Schema::dropIfExists('alquiler_abonos'); 
    }
};
