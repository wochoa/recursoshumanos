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
        Schema::create('escalafon', function (Blueprint $table) {
            $table->id('idescalafon');
            $table->string('nombres');
            $table->string('apellidos');
            $table->string('dni');
            $table->string('ruc');
            $table->string('sexo');
            $table->date('nacimiento');//fecha nacimiento
            $table->date('vinculo');//fecha vinculo
            $table->string('celular');
            $table->string('nacionalidad');
            $table->string('departamento');
            $table->string('provincia');
            $table->string('distrito');
            $table->string('estadocivil');
            $table->string('correo');
            $table->string('correoinst');
            $table->string('cargocontrato');
            $table->string('cargoactual');
            $table->string('direccion');
            $table->string('regimen');//tiporegimen
            $table->integer('regimen_id')->nullable();;//tiporegimen
            $table->integer('oficina_id')->nullable();//id de oficina
            $table->integer('depe_id')->nullable();//id depe
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('escalafon');
    }
};
