<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Vacaciones extends Model
{
    use HasFactory;
    protected $table='vacaciones';
    protected $fillable = [
		'idescalafon','sustento', 'tot_vacaciones', 'rest_vacaciones', ];

    // public function escalafon()
    // {
    //     return $this->belongsTo(Escalafon::class, 'idescalafon','idescalafon');
    // }

}
