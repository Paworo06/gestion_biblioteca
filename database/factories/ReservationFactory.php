<?php

namespace Database\Factories;

use App\Models\Book;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class ReservationFactory extends Factory
{
    public function definition(): array
    {
        // Genera una fecha de inicio aleatoria en los últimos 30 días
        $fecha_inicio = fake()->dateTimeBetween('-30 days', 'now');
        // La fecha de fin es entre 7 y 30 días después de la de inicio
        $fecha_fin   = fake()->dateTimeBetween($fecha_inicio, '+30 days');

        return [
            'user_id' => User::where('role', 'alumno')->inRandomOrder()->first()->id,
            'book_id' => Book::inRandomOrder()->first()->id,
            'fecha_inicio' => $fecha_inicio,
            'fecha_fin' => $fecha_fin,
            'estado' => fake()->randomElement(['pendiente', 'confirmada', 'devuelta', 'cancelada']),
            'recogido' => null,
        ];
    }

    // Estado para crear una reserva pendiente
    public function pendiente(): static
    {
        return $this->state(fn () => [
            'estado' => 'pendiente',
            'recogido' => null,
        ]);
    }

    // Estado para crear una reserva confirmada
    // Registra también la fecha de recogida
    public function confirmada(): static
    {
        return $this->state(fn () => [
            'estado' => 'confirmada',
            'recogido' => now(),
        ]);
    }

    // Estado para crear una reserva ya devuelta
    public function devuelta(): static
    {
        return $this->state(fn () => [
            'estado' => 'devuelta',
            'recogido' => fake()->dateTimeBetween('-20 days', '-5 days'),
        ]);
    }
}