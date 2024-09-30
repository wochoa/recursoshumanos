<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Licenciaspersonal extends Model
{
    use HasFactory;
    protected $table='licenciaspersonals';
    protected $fillable = [
		'dni', 'nombres', 'oficina', 'condicion', 'fecha_ini', 'fecha_fin', 'ndias', 'regdoc', 'regexp', 'congoce','singoce','vacaciones','otros','justificacion'];

        public function dependencia()
        {
            return $this->belongsTo(Dependencia::class, 'oficina','iddependencia')->select('iddependencia','depe_nombre','depe_depende');
        }

        public function regimen()
        {
            return $this->belongsTo(Regimen::class, 'condicion','idregimen')->select('idregimen','nom_regimen');
        }
}
