<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Papeletaspermisos extends Model
{
    use HasFactory;
    protected $table='papeletaspermisos';
    protected $fillable = [
		'dni', 'nombres', 'oficina', 'condicion_lab', 'motivo_salida', 'destino', 'justificacion', 'fecha', 'hora_salida', 'hora_retorno', 'archivo','tiempo_excedido'];

        public function dependencia()
        {
            return $this->belongsTo(Dependencia::class, 'oficina','iddependencia')->select('iddependencia','depe_nombre','depe_depende');
        }

        public function regimen()
        {
            return $this->belongsTo(Regimen::class, 'condicion_lab','idregimen')->select('idregimen','nom_regimen');
        }
}
