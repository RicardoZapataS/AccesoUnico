<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::connection('sqlsrv')->create('marcaciones', function (Blueprint $table) {
            $table->id();
            $table->string('codigo', 191);
            $table->string('codigo_tarjeta', 191);
            $table->string('areas_acceso', 191);
            $table->string('areas_solicitadas', 191);
            $table->unsignedBigInteger('punto_accesos_id');
            $table->boolean('permitido');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('marcaciones');
    }
};
