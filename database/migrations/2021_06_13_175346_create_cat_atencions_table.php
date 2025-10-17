<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCatAtencionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cat_atencions', function (Blueprint $table) {
            $table->increments('idatencion');
            $table->string('problema');
            $table->string('idejecutora');
            $table->integer('tipo_tiket')->default(1); // 1: informatica, 2: declaracion jurada
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
        Schema::dropIfExists('cat_atencions');
    }
}
