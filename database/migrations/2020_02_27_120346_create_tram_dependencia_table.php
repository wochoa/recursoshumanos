<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTramDependenciaTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tram_dependencia', function (Blueprint $table) {
            $table->id('iddependencia');
            $table->text('depe_nombre')->nullable();
            $table->text('depe_abreviado')->nullable();
            $table->text('depe_sigla')->nullable();
            $table->text('depe_representante')->nullable();
            $table->text('depe_cargo')->nullable();
            $table->string('depe_dni', 8)->nullable();
            $table->integer('depe_depende')->nullable();
            $table->text('depe_superior')->nullable();
            $table->integer('depe_tipo');
            $table->integer('depe_proyectado');
            $table->integer('depe_estado')->nullable();
            $table->text('depe_observaciones')->nullable();
            $table->integer('depe_idusuario')->nullable();
            $table->integer('depe_idusuariotransp')->nullable();
            $table->integer('depe_recibetramite')->nullable();
            $table->integer('depe_mesa_virtual')->default(0)->nullable();
            $table->integer('depe_agente')->nullable();
            $table->integer('depe_diasmaxenproceso')->nullable();
            $table->integer('depe_idusuarioreclamo')->nullable();
            $table->text('depe_imagen_header')->nullable();
            $table->text('depe_imagen_footer')->nullable();
            $table->integer('depe_rrhh')->nullable();
            $table->text('depe_ciudad')->nullable();
            $table->text('depe_direccion')->nullable();
            $table->integer('depe_minuto_tolerancia')->nullable();
            $table->timestamps();

            $table->index('iddependencia', 'tram_dependencia_indx1');
            $table->index(['iddependencia', 'depe_depende'], 'tram_dependencia_indx2');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('tram_dependencia');
    }
}
