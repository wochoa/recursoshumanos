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
            $table->string('nombres')->nullable();
            $table->string('apellidos')->nullable();
            $table->string('dni')->nullable();
            $table->string('ruc')->nullable();
            $table->string('sexo')->nullable();
            $table->date('nacimiento')->nullable();//fecha nacimiento
            $table->date('vinculo')->nullable();//fecha vinculo
            $table->string('celular')->nullable();
            $table->string('nacionalidad')->nullable();
            $table->string('departamento')->nullable();
            $table->string('provincia')->nullable();
            $table->string('distrito')->nullable();
            $table->string('estadocivil')->nullable();
            $table->string('correo')->nullable();
            $table->string('correoinst')->nullable();
            $table->string('cargocontrato')->nullable();
            $table->string('cargoactual')->nullable();
            $table->string('direccion')->nullable();
            $table->string('regimen')->nullable();//tiporegimen
            $table->integer('regimen_id')->nullable();//tiporegimen
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
