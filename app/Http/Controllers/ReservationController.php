<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

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
            'book_id'    => 'required|exists:books,id',
            'start_date' => 'required|date|after_or_equal:today',
            'end_date'   => 'required|date|after:start_date',
        ]);

        $book = Book::findOrFail($request->book_id);

        if (!$book->isAvailable()) {
            return back()->withErrors(['book_id' => 'El libro no está disponible en este momento.']);
        }

        Reservation::create([
            'user_id'    => Auth::id(),
            'book_id'    => $request->book_id,
            'start_date' => $request->start_date,
            'end_date'   => $request->end_date,
            'status'     => 'pendiente',
        ]);

        return redirect()->route('reservations.index')->with('success', 'Reserva realizada correctamente.');
    }

    // Muestra el listado de reservas del alumno autenticado
    public function index()
    {
        $reservations = Reservation::with('book')
            ->where('user_id', Auth::id())
            ->orderBy('start_date', 'desc')
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
            'status' => 'required|in:pendiente,confirmada,devuelta,cancelada',
        ]);

        $reservation->update([
            'status'      => $request->status,
            'picked_up_at' => $request->status === 'confirmada' ? now() : $reservation->picked_up_at,
        ]);

        return redirect()->route('reservations.manage')->with('success', 'Reserva actualizada correctamente.');
    }

    // Consulta de reservas por periodo (solo visible por profesores)
    public function gestionar(Request $request)
    {
        $query = Reservation::with(['user', 'book']);

        if ($request->filled('start_date') && $request->filled('end_date')) {
            $query->whereBetween('start_date', [$request->start_date, $request->end_date]);
        }

        $reservations = $query->orderBy('start_date', 'desc')->get();

        return view('reservations.gestionar', compact('reservations'));
    }

    // Muestra el informe de préstamos no devueltos (solo visible por profesores)
    public function pendiente()
    {
        $reservations = Reservation::with(['user', 'book'])
            ->whereIn('status', ['pendiente', 'confirmada'])
            ->orderBy('end_date', 'asc')
            ->get();

        return view('reservations.pendiente', compact('reservations'));
    }
}
