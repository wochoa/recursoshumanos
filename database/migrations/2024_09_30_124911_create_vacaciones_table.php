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
        Schema::create('vacaciones', function (Blueprint $table) {
            $table->id();
            $table->integer('idescalafon');
            $table->text('sustento');// porque se asignan vacaciones en la columna tot-vacaciones
            $table->integer('tot_vacaciones');// p.ejemplo 30 (30 dis)
            $table->integer('rest_vacaciones');// lo que va gastando sus vacaciones
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('vacaciones');
    }
};
