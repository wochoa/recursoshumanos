<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Asignavacaciones extends Model
{
    use HasFactory;

    protected $table='asignavacaciones';
    protected $fillable = [
		'idvacaciones', 'sustento', 'cantidaddias', ];
}
