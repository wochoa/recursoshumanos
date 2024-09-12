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
        Schema::create('papeletaspermisos', function (Blueprint $table) {
            $table->id();
            $table->string('dni')->nullable();
            $table->text('nombres')->nullable();
            $table->integer('oficina')->nullable();
            $table->integer('condicion_lab')->nullable();
            $table->text('motivo_salida')->nullable();
            $table->text('destino')->nullable();
            $table->text('justificacion')->nullable();
            $table->date('fecha')->nullable();
            $table->time('hora_salida')->nullable();
            $table->time('hora_retorno')->nullable();
            $table->text('archivo')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('papeletaspermisos');
    }
};
