<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Reservation extends Model
{
    //
    protected $fillable = [
        'user_id',
        'book_id',
        'fecha_inicio',
        'fecha_fin',
        'estado',
        'recogido',
    ];

    /**
     * Transforma los campos que vienen de la base de datos
     */
    protected $casts = [
        'fecha_inicio' => 'date',
        'fecha_fin' => 'date',
        'recodigo' => 'datetime',
    ];

    /**
     * Devuelve el usuario al que pertenece la reserva
     */
    public function usuario()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Devuelve el libro que se presta en la reserva
     */
    public function libro()
    {
        return $this->belongsTo(Book::class);
    }
}
