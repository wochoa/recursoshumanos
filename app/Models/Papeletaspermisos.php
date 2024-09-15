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
}
