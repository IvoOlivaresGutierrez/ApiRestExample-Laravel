<?php

namespace App\Models;

use App\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class UserAddress extends Model
{
    use SoftDeletes;

    protected $dates = ['deleted_at'];

    protected $fillable = [
        'id',
        'user_id',
        'commune_id',
        'address'
    ];

    // Inicio de accesores y mutadores
    public function setIdAttribute($value)
    {
        $this->attributes['id'] = $value;
    }

    public function getIdAttribute($value)
    {
        return $value;
    }

    public function setUserIdAttribute($value)
    {
        $this->attributes['user_id'] = $value;
    }

    public function getUserId($value)
    {
        return $value;
    }

    public function setCommuneIdAttribute($value)
    {
        $this->attributes['commune_id'] = $value;
    }

    public function getCommuneIdAttribute($value)
    {
        return $value;
    }

    public function setAddressAttribute($value)
    {
        $this->attributes['address'] = $value;
    }

    public function getAddressAttribute($value)
    {
        return $value;
    }
    // Fin de accesores y mutadores

    // Inicio de relaciones eloquent
    public function user()
    {
        return $this->hasOne(User::class);
    }

    public function commune()
    {
        return $this->hasOne(Commune::class);
    }
    // Fin de relaciones eloquent
}
