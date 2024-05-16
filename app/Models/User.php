<?php

namespace App\Models;

use Tymon\JWTAuth\Contracts\JWTSubject;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Spatie\Permission\Traits\HasRoles;

class User extends Authenticatable implements JWTSubject
{
    use HasApiTokens, HasFactory, Notifiable;
    use HasRoles;
    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
		'adm_name', 'adm_lastname', 'adm_email', 'adm_dni', 'adm_inicial', 'adm_estado', 'adm_cargo', 'depe_id', 'adm_vigencia', 'adm_observacion', 'adm_tipo', 'adm_caseta', 'adm_esjefe', 'adm_telefono', 'adm_direccion', 'adm_con_especialidad', 'darkmode', 'push_id', 'avatar', 'adm_correo',
	];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    // protected $hidden = [
    //     'password',
    //     'remember_token',
    // ];
    protected $hidden = [
        'adm_password',
        'remember_token',
    ];

    protected $table='admin';
    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    protected $appends = ['fullname'];

	public function getFullNameAttribute()
	{
		return $this->adm_name . ' ' . $this->adm_lastname;

	}

    public function getAuthPassword()
    {
        return $this->adm_password;
    }
    public function dependencia()
    {
        return $this->belongsTo(Dependencia::class, 'depe_id','iddependencia')->select('iddependencia','depe_nombre','depe_depende');
    }

    public function getJWTIdentifier()
    {
        return $this->getKey();
    }

    public function getJWTCustomClaims()
    {
        return [];
    }
}
