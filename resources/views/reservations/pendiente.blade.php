<x-app-layout>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Préstamos pendientes</title>
    <style>
        body { font-family: Arial, sans-serif; background: #f4f4f4; margin: 0; padding: 20px; }
        h1 { color: #333; }
        table { width: 100%; border-collapse: collapse; background: #fff; border-radius: 8px; overflow: hidden; box-shadow: 0 2px 6px rgba(0,0,0,0.1); }
        thead { background: #e5e7eb; }
        th, td { padding: 12px 16px; text-align: left; font-size: 14px; border-bottom: 1px solid #e5e7eb; }
        th { font-weight: bold; color: #374151; }
        td { color: #555; }
        .vencido { background-color: #fee2e2; }
        .empty { text-align: center; color: #999; padding: 20px; }
        a.editar { color: #3b82f6; text-decoration: none; font-size: 13px; }
        a.editar:hover { text-decoration: underline; }
    </style>
</head>
<body>
    <h1>Préstamos pendientes de devolución</h1>

    <table>
        <thead>
            <tr>
                <th>Alumno</th>
                <th>Libro</th>
                <th>Recogida</th>
                <th>Devolución prevista</th>
                <th>Estado</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            @forelse($reservations as $reservation)
                <tr class="{{ $reservation->fecha_fin->isPast() ? 'vencido' : '' }}">
                    <td>{{ $reservation->user->name }}</td>
                    <td>{{ $reservation->book->titulo }}</td>
                    <td>{{ $reservation->fecha_inicio->format('d/m/Y') }}</td>
                    <td>{{ $reservation->fecha_fin->format('d/m/Y') }}</td>
                    <td>{{ ucfirst($reservation->estado) }}</td>
                    <td><a href="{{ route('reservations.edit', $reservation) }}" class="editar">Editar</a></td>
                </tr>
            @empty
                <tr><td colspan="6" class="empty">No hay préstamos pendientes.</td></tr>
            @endforelse
        </tbody>
    </table>
</body>
</html>
</x-app-layout>