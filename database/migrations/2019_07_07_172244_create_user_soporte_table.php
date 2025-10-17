<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUserSoporteTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        DB::statement("CREATE VIEW vistausersoporte as select admin.id,adm_name,adm_lastname,adm_estado,adm_cargo,adm_correo,adm_telefono,adm_dni,avatar,name as rolasignado,depe_nombre,depe_sigla,depe_depende from admin join model_has_roles on(admin.id=model_has_roles.model_id) 
        join roles on(model_has_roles.role_id=roles.id) join tram_dependencia on(admin.depe_id=tram_dependencia.iddependencia) WHERE (adm_estado = 1 AND (adm_lastname IS NOT NULL AND TRIM(adm_lastname) <> ''));");
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        DB::statement("DROP VIEW vistausersoporte");
    }
}
