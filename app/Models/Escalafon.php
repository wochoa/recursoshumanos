<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Escalafon extends Model
{
    use HasFactory;

    protected $fillable = [
		'nombres', 'apellidos', 'dni', 'ruc', 'sexo', 'nacimiento', 'vinculo', 'celular', 'nacionalidad', 'departamento', 'provincia', 'distrito', 'estadocivil', 'correo', 'correoinst', 'cargocontrato', 'cargoactual', 'direccion', 'regimen_id', 'depe_id','created_at','updated_at',
	];

    protected $table='escalafon';

    protected $primaryKey = 'idescalafon';

    public function dependencia()
    {
        return $this->belongsTo(Dependencia::class, 'depe_id','iddependencia')->select('iddependencia','depe_nombre','depe_depende');
    }




}
