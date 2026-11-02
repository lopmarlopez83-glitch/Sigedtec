<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Asignacion extends Model
{
    use HasFactory;

    protected $table = 'asignaciones';

    protected $fillable = [
        'solicitud_id',
        'equipo_id',
        'fecha_asignacion',
    ];

    // Una asignación pertenece a una solicitud
    public function solicitud()
    {
        return $this->belongsTo(Solicitud::class);
    }

    // Una asignación pertenece a un equipo
    public function equipo()
    {
        return $this->belongsTo(Equipo::class);
    }
}