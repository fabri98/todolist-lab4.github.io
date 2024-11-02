<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tablero extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'descripcion']; 

    
    public function listas()
    {
        return $this->hasMany(Lista::class, 'id_tablero');
    }
}
