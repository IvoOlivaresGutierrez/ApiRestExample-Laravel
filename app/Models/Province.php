<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Province extends Model
{
    use SoftDeletes;

    protected $dates = ['deleted_at'];

    protected $fillable = [
        'id',
        'name',
        'capital'
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

    public function setNameAttribute($value)
    {
        $this->attributes['name'] = $value;
    }

    public function getNameAttribute($value)
    {
        return $value;
    }

    public function setCapitalAttribute($value)
    {
        $this->attributes['capital'] = $value;
    }

    public function getCapitalAttribute($value)
    {
        return $value;
    }
    // Fin de accesores y mutadores

    // Inicio de relaciones eloquent
    public function communes()
    {
        return $this->hasMany(Commune::class);
    }
    // Fin de relaciones eloquent
}
