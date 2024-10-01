<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Escalafon extends Model
{
    use HasFactory;

    protected $fillable = [
		'nombres', 'apellidos', 'dni', 'ruc', 'sexo', 'nacimiento', 'vinculo','termino', 'celular', 'nacionalidad', 'departamento', 'provincia', 'distrito', 'estadocivil', 'correo', 'correoinst', 'cargocontrato', 'cargoactual', 'direccion', 'regimen_id', 'depe_id','proceso_contratacion','archivo_contrato','url_contrato','remuneracion','estado','created_at','updated_at',
	];

    protected $table='escalafon';

    protected $primaryKey = 'idescalafon';

    public function dependencia()
    {
        return $this->belongsTo(Dependencia::class, 'depe_id','iddependencia')->select('iddependencia','depe_nombre','depe_depende');
    }

    public function regimen()
    {
        return $this->belongsTo(Regimen::class, 'regimen_id','idregimen')->select('idregimen','nom_regimen');
    }




}
