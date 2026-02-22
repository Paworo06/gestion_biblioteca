<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Book extends Model
{
    //
    protected $fillable = [
        'titulo',
        'autor',
        'isbn',
        'descripcion',
        'stock',
    ];

    /**
     * 
     */
    public function reservas()
    {
        return $this->hasMany(Reservation::class);
    }

    /**
     * 
     */
    public function copiasDisponibles(): int
    {
        $prestados = $this->reservas()
            ->whereIn('estado', ['pendiente', 'confirmada'])
            ->count();

        return $this->stock - $prestados;
    }

    public function isDisponible(): bool
    {
        return $this->copiasDisponibles() > 0;
    }


}
