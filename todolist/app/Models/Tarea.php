<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tarea extends Model
{
    use HasFactory;

    public function lista(){
        return $this->belongsTo(Lista::class,'id_lista');
    }
}
