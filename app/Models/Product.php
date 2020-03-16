<?php

namespace App\Models;

use App\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Product extends Model
{
    use SoftDeletes;

    protected $dates = ['deleted_at'];

    protected $fillable = [
        'id',
        'name',
        'description',
        'quantity'
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

    public function setNameAttribute($value)
    {
        $this->attributes['name'] = $value;
    }

    public function getNameAttribute($value)
    {
        return $value;
    }

    public function setDescriptionAttribute($value)
    {
        $this->attributes['description'] = $value;
    }

    public function getDescriptionAttribute($value)
    {
        return $value;
    }

    public function setQuantityAttribute($value)
    {
        $this->attributes['quantity'] = $value;
    }

    public function getQuantityAttribute($value)
    {
        return $value;
    }
    // Fin de accesores y mutadores

    // Inicio de relaciones eloquent
    public function users()
    {
        return $this->belongsToMany(User::class, 'user_product');
    }
    // Fin de relaciones eloquent
}
