<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    protected $fillable = [
        'name',
        'email',
        'password',
        'role_id', // 🔽 agregar
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    // Un usuario pertenece a un rol
    public function role()
    {
        return $this->belongsTo(Role::class);
    }

    // Un usuario (solicitante) tiene muchas solicitudes
    public function solicitudes()
    {
        return $this->hasMany(Solicitud::class);
    }
}