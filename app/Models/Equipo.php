<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Equipo extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'equipos';

    protected $fillable = [
        'codigo_patrimonial',
        'marca',
        'modelo',
        'cpu',
        'ram',
        'almacenamiento',
        'estado',
        'categoria_id',
    ];

    // Un equipo pertenece a una categoría
    public function categoria()
    {
        return $this->belongsTo(Categoria::class);
    }

    // Un equipo puede estar en muchas asignaciones
    public function asignaciones()
    {
        return $this->hasMany(Asignacion::class);
    }
}