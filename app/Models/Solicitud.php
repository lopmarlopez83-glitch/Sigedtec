<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Solicitud extends Model
{
    use HasFactory;

    protected $table = 'solicitudes';

    protected $fillable = [
        'oficina',
        'cantidad_equipos',
        'estado',
        'user_id',
        'categoria_id',
        'fecha_respuesta',
    ];

    // Una solicitud pertenece a un usuario (solicitante)
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // Una solicitud pertenece a una categoría
    public function categoria()
    {
        return $this->belongsTo(Categoria::class);
    }

    // Una solicitud puede tener muchas asignaciones
    public function asignaciones()
    {
        return $this->hasMany(Asignacion::class);
    }
}