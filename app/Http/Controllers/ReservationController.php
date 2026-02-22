<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Reservation;
use App\Models\Book;
use Illuminate\Support\Facades\Auth;

class ReservationController extends Controller
{
    //
    public function create(Book $book)
    {
        return view('reservations.create', compact('book'));
    }

    // Guarda una nueva reserva (solo disponibles para alumnos)
    public function store(Request $request)
    {
        $request->validate([
            'book_id' => 'required|exists:books,id',
            'fecha_inicio' => 'required|date|after_or_equal:today',
            'fecha_fin' => 'required|date|after:fecha_inicio',
        ]);

        $book = Book::findOrFail($request->book_id);

        if (!$book->isDisponible()) {
            return back()->withErrors(['book_id' => 'El libro no está disponible en este momento.']);
        }

        Reservation::create([
            'user_id' => Auth::id(),
            'book_id' => $request->book_id,
            'fecha_inicio' => $request->fecha_inicio,
            'fecha_fin' => $request->fecha_fin,
            'estado' => 'pendiente',
        ]);

        return redirect()->route('reservations.index')->with('success', 'Reserva realizada correctamente.');
    }

    // Muestra el listado de reservas del alumno autenticado
    public function index()
    {
        $reservations = Reservation::with('book')
            ->where('user_id', Auth::id())
            ->orderBy('fecha_inicio', 'desc')
            ->get();

        return view('reservations.index', compact('reservations'));
    }

    // Muestra el formulario de edición (solo visible por profesores)
    public function edit(Reservation $reservation)
    {
        return view('reservations.edit', compact('reservation'));
    }

    // Confirma la recogida (solo visible por profesores)
    public function update(Request $request, Reservation $reservation)
    {
        $request->validate([
            'estado' => 'required|in:pendiente,confirmada,devuelta,cancelada',
        ]);

        $reservation->update([
            'estado' => $request->estado,
            'recogido' => $request->estado === 'confirmada' ? now() : $reservation->recogido,
        ]);

        return redirect()->route('reservations.gestionar')->with('success', 'Reserva actualizada correctamente.');
    }

    // Consulta de reservas por periodo (solo visible por profesores)
    public function gestionar(Request $request)
    {
        $query = Reservation::with(['user', 'book']);

        if ($request->filled('fecha_inicio') && $request->filled('fecha_fin')) {
            $query->whereBetween('fecha_inicio', [$request->fecha_inicio, $request->fecha_fin]);
        }

        $reservations = $query->orderBy('fecha_inicio', 'desc')->get();

        return view('reservations.gestionar', compact('reservations'));
    }

    // Muestra el informe de préstamos no devueltos (solo visible por profesores)
    public function pendiente()
    {
        $reservations = Reservation::with(['user', 'book'])
            ->whereIn('estado', ['pendiente', 'confirmada'])
            ->orderBy('fecha_fin', 'asc')
            ->get();

        return view('reservations.pendiente', compact('reservations'));
    }
}
