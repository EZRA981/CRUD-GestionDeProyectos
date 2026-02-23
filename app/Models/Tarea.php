<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Tarea extends Model
{
    use HasFactory;
    protected $fillable = [
        "proyecto_id",
        "titulo",
        "descripcion",
        "estado",
        "prioridad",
        "fecha_limite",
    ];

    public function proyecto(): BelongsTo
    {
        return $this->belongsTo(Proyecto::class);
    }
}