<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Proyecto extends Model
{
    use HasFactory;
    protected $fillable = [   
        "nombre",
        "descripcion",
        "fecha_inicio",
        "fecha_fin"
    ];
    public function tareas(): HasMany{
        return $this->hasMany(Tarea::class);
    }
}
