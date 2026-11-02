<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Categoria extends Model
{
    use HasFactory;

    protected $table = 'categorias';

    protected $fillable = ['nombre', 'descripcion'];

    // Una categoría tiene muchos equipos
    public function equipos()
    {
        return $this->hasMany(Equipo::class);
    }

    // Una categoría tiene muchas solicitudes
    public function solicitudes()
    {
        return $this->hasMany(Solicitud::class);
    }
}