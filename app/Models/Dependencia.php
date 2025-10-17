<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Dependencia extends Model
{
    use HasFactory;
    protected $table='tram_dependencia';
    protected $primaryKey = 'iddependencia';

    // app/Models/VistaTicket.php


    public function vistatickets()
    {
        return $this->hasMany(VistaTicket::class, 'idoficina', 'iddependencia');
    }
    
}
