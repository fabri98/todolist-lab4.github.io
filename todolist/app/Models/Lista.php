<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Lista extends Model
{
    use HasFactory;

    public function tablero(){
        return $this->belongsTo(Tablero::class,'id_tablero');
    }

    public function tareas(){
        return $this->hasMany(Tarea::class,'id_tarea');
    }
}
