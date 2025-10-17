<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Catatenciones extends Model
{
    use HasFactory;
    protected $table = 'cat_atencions';

    public function vistatickets()
    {
        return $this->hasMany(VistaTicket::class, 'tipoayuda', 'idatencion');
    }
}
