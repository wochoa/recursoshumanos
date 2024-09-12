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
        Schema::create('licenciaspersonals', function (Blueprint $table) {
            $table->id();
            $table->string('dni');
            $table->text('nombres');
            $table->integer('oficina');
            $table->integer('condicion');//designado,nombrado,etc
            $table->date('fecha_ini');
            $table->date('fecha_fin');
            $table->integer('ndias');
            $table->text('regdoc');
            $table->text('regexp');
            $table->enum('congoce',['POR ENFERMEDAD','POR MATERNIDAD','POR FALLECIMIENTO DEL CONYUGUE, PADRES, HIJOS O HNOS','POR MATERNIDAD','POR PATERNIDAD','POR CITACION EXPRESA(JUDICIAL,MILITAR)','POR ENFERMEDAD GRAVE O TERMINAL DE UN FAMILIAR DIRECTO(CONYUGUE,PADRES E HIJOS)']);
            $table->enum('singoce',['POR MOTIVOS PERSONALES','POR CAPACITACION OFICIALIZADA']);
            $table->enum('vacaciones',['VACACIONES','POR MATRIMONIO','POR ENFERMEDAD GRAVE DEL CONYUGUE,PADRES E HIJOS']);
            $table->enum('otros',['COMPENSACION POR HORAS EXTRAS','POR LACTANCIA','ONOMASTICO','COMISION SIN VIATICOS']);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('licenciaspersonals');
    }
};
