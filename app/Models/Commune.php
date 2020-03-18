<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Commune extends Model
{
    use SoftDeletes;

    protected $dates = ['deleted_at'];

    protected $fillable = [
        'id',
        'province_id',
        'name'
    ];

    // Inicio de mutadores y accesores
    public function setIdAttribute($value)
    {
        $this->attributes['id'] = $value;
    }

    public function getIdAttribute($value)
    {
        return $value;
    }

    public function setProvinceIdAttribute($value)
    {
        $this->attributes['province_id'] = $value;
    }

    public function getProvinceIdAttribute($value)
    {
        return $value;
    }

    public function setNameAttribute($value)
    {
        $this->attributes['name'] = $value;
    }

    public function getNameAttribute($value)
    {
        return $value;
    }
    // Fin de mutadores y accesores

    // Inicio de relaciones eloquent 
    public function province()
    {
        return $this->belongsTo(Province::class);
    }

    public function userAddresses()
    {
        return $this->hasMany(UserAddress::class);
    }
    // Fin de relaciones eloquent
}
