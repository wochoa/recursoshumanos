<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateViewTicketTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        // Schema::create('view_ticket', function (Blueprint $table) {
        //     $table->id();
        //     $table->timestamps();
        // });
        DB::statement("CREATE VIEW vistaticket as select idticket,iduser,(adm_name||' '||adm_lastname) as nombre_pedido,detalleayuda,prioridad,estado_atencion, (SELECT b.adm_name||' '||b.adm_lastname from admin b WHERE b.id=tickets.idsoporte) as nombre_atencion, idsoporte, tickets.created_at as fechaticket,fecha_recepcion, adm_cargo,idoficina,codejecutora,ayudasede,adm_telefono,tipoayuda from tickets join admin a on(tickets.iduser=a.id ) WHERE estado_atencion<>'FINALIZADO';");
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        DB::statement("DROP VIEW vistaticket");
    }
}
