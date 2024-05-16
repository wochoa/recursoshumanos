<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsuarioOficinasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('usuario_oficinas', function (Blueprint $table) {
            $table->id('iduserof');
            $table->integer('iduser');// usuario a asignar en la unidad u oficina
            $table->integer('idunidad');// id de la unidad ou oficina
            $table->integer('userupdate');// id del usuario quien hace os cambios
            $table->string('acceso');// tipo usuario:ADMINISTRADOR,SUPERADMIN,OFICINA,PERSONAL
            $table->string('cargo');// tel cargo que ocupa el suaurio asignado en la unidad u oficina
            $table->integer('estado');// estado del usuario: 1: activo, 2:inactivo o dejo de estar en la oficina
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
        Schema::dropIfExists('usuario_oficinas');
    }
}
