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
        Schema::create('asignavacaciones', function (Blueprint $table) {
            $table->id();
            $table->integer('idvacaciones');
            $table->text('sustento')->nullable();
            $table->integer('cantidaddias');// al cumplir 1 ano se asigna 30 dias
            $table->integer('status')->default(1);// 0: inactivo, 1:activo
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('asignavacaciones');
    }
};
