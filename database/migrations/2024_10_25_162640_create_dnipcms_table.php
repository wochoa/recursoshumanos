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
        Schema::create('dnipcms', function (Blueprint $table) {
            $table->id();
            $table->integer('credencialAnterior');
            $table->integer('credencialNueva');
            $table->bigInteger('nuDni');
            $table->bigInteger('nuRuc');
            $table->integer('creditos');
            $table->integer('estado')->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('dnipcms');
    }
};
