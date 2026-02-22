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
     * 
     */
    protected $casts = [
        'fecha_inicio' => 'date',
        'fecha_fin' => 'date',
        'recodigo' => 'datetime',
    ];

    /**
     * 
     */
    public function usuario()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * 
     */
    public function libro()
    {
        return $this->belongsTo(Book::class);
    }
}
