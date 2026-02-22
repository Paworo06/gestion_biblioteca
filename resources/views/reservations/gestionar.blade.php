<x-app-layout>

    <title>Gestión de reservas</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background: #f4f4f4;
            margin: 0;
            padding: 20px;
        }

        h1 {
            color: #333;
        }

        .filtros {
            display: flex;
            gap: 12px;
            margin-bottom: 20px;
            align-items: center;
        }

        .filtros input[type="date"] {
            padding: 8px;
            border: 1px solid #ccc;
            border-radius: 4px;
        }

        .filtros button {
            padding: 8px 16px;
            background: #3b82f6;
            color: #fff;
            border: none;
            border-radius: 4px;
            cursor: pointer;
        }

        .filtros button:hover {
            background: #2563eb;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            background: #fff;
            border-radius: 8px;
            overflow: hidden;
            box-shadow: 0 2px 6px rgba(0, 0, 0, 0.1);
        }

        thead {
            background: #e5e7eb;
        }

        th,
        td {
            padding: 12px 16px;
            text-align: left;
            font-size: 14px;
            border-bottom: 1px solid #e5e7eb;
        }

        th {
            font-weight: bold;
            color: #374151;
        }

        td {
            color: #555;
        }

        .empty {
            text-align: center;
            color: #999;
            padding: 20px;
        }

        a.editar {
            color: #3b82f6;
            text-decoration: none;
            font-size: 13px;
        }

        a.editar:hover {
            text-decoration: underline;
        }
    </style>

    <h1>Gestión de reservas</h1>

    <form method="GET" action="{{ route('reservations.gestionar') }}" class="filtros">
        <input type="date" name="fecha_inicio" value="{{ request('fecha_inicio') }}">
        <input type="date" name="fecha_fin" value="{{ request('fecha_fin') }}">
        <button type="submit">Filtrar</button>
    </form>

    <table>
        <thead>
            <tr>
                <th>Alumno</th>
                <th>Libro</th>
                <th>Recogida</th>
                <th>Devolución</th>
                <th>Estado</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            @forelse($reservations as $reservation)
            <tr>
                <td>{{ $reservation->user->name }}</td>
                <td>{{ $reservation->book->titulo }}</td>
                <td>{{ $reservation->fecha_inicio->format('d/m/Y') }}</td>
                <td>{{ $reservation->fecha_fin->format('d/m/Y') }}</td>
                <td>{{ ucfirst($reservation->estado) }}</td>
                <td><a href="{{ route('reservations.edit', $reservation) }}" class="editar">Editar</a></td>
            </tr>
            @empty
            <tr>
                <td colspan="6" class="empty">No hay reservas.</td>
            </tr>
            @endforelse
        </tbody>
    </table>

</x-app-layout>