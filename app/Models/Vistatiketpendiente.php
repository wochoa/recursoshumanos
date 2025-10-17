<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Vistatiketpendiente extends Model
{
    use HasFactory;
    protected $table = 'vistaticket';

    public function oficina()
    {
        return $this->belongsTo(Dependencia::class, 'idoficina', 'iddependencia');
    }
    public function catticket()
    {
        return $this->belongsTo(Catatenciones::class, 'tipoayuda', 'idatencion');
    }
}
