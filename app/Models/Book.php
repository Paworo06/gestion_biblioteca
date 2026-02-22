<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Book extends Model
{

    use HasFactory;

    protected $fillable = [
        'titulo',
        'autor',
        'isbn',
        'descripcion',
        'stock',
    ];

    /**
     * Devuelve todas las reservas relacionadas con el libro
     */
    public function reservas()
    {
        return $this->hasMany(Reservation::class);
    }

    /**
     * Calcula las copias disponibles en el momento
     */
    public function copiasDisponibles(): int
    {
        $prestados = $this->reservas()
            ->whereIn('estado', ['pendiente', 'confirmada'])
            ->count();

        return $this->stock - $prestados;
    }

    /**
     * Devuelve true si hay al menos 1 copia disponible
     */
    public function isDisponible(): bool
    {
        return $this->copiasDisponibles() > 0;
    }


}
