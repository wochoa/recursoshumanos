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
        Schema::create('reginicidencias', function (Blueprint $table) {
            $table->id();
            $table->text('incidencias');
            $table->date('fecha');
            $table->time('hora');
            $table->integer('sectores')->default(1);//1: sede, 2:archivo (por tener do tipos de marcaciones : normal y corrido)

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('reginicidencias');
    }
};
