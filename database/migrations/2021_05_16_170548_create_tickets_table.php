<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTicketsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tickets', function (Blueprint $table) {
            $table->increments('idticket');//$table->id();
            $table->integer('iduser');
            $table->integer('idoficina');
            $table->integer('codejecutora');
            $table->integer('ayudasede')->nullable();// ayuda a sede desde cualquier dependencia
            $table->integer('tipoayuda');
            $table->text('detalleayuda');
            $table->string('prioridad');
            $table->dateTime('fecha_recepcion')->nullable();
            $table->date('fecha_resuelto')->nullable();
            $table->time('hora_resuelto')->nullable();
            $table->string('tiempo_transcurrido')->nullable();
            $table->enum('estado_atencion',['ENVIADO','RECEPCIONADO','FINALIZADO'])->default('ENVIADO');
            $table->integer('idsoporte')->nullable();//usuario del soporte quien lo atiende
            $table->text('solucion')->nullable();
            // $table->string('Estado_atencion');
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
        Schema::dropIfExists('tickets');
    }
}
