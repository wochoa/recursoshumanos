<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUserofiTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        // Schema::create('userofi', function (Blueprint $table) {
        //     $table->id();
        //     $table->timestamps();
        // });
        DB::statement("CREATE VIEW userofi AS (select id,adm_name,adm_lastname,adm_inicial,adm_email,adm_password,adm_estado,cargo as adm_cargo,acceso,adm_correo, userof.idunidad as depe_id,adm_vigencia,adm_observacion,adm_tipo,adm_caseta,adm_esjefe,adm_correo_personal,adm_telefono,adm_direccion,adm_dni,adm_con_especialidad,tipousuario,push_id,adm_primer_logeo,avatar,darkmode,remember_token,email_verified_at from usuario_oficinas as userof join admin on(userof.iduser=admin.id) where userof.estado=1);");

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        // Schema::dropIfExists('userofi');
        DB::statement("DROP VIEW userofi");

    }
}
