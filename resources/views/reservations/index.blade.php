<x-app-layout>

    <title>Mis reservas</title>
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

        .alert-success {
            background: #d1fae5;
            color: #065f46;
            padding: 12px;
            border-radius: 6px;
            margin-bottom: 16px;
        }
    </style>

    <h1>Mis reservas</h1>

    @if(session('success'))
    <div class="alert-success">{{ session('success') }}</div>
    @endif

    <table>
        <thead>
            <tr>
                <th>Libro</th>
                <th>Fecha recogida</th>
                <th>Fecha devolución</th>
                <th>Estado</th>
            </tr>
        </thead>
        <tbody>
            @forelse($reservations as $reservation)
            <tr>
                <td>{{ $reservation->book->titulo }}</td>
                <td>{{ $reservation->fecha_inicio->format('d/m/Y') }}</td>
                <td>{{ $reservation->fecha_fin->format('d/m/Y') }}</td>
                <td>{{ ucfirst($reservation->estado) }}</td>
            </tr>
            @empty
            <tr>
                <td colspan="4" class="empty">No tienes reservas.</td>
            </tr>
            @endforelse
        </tbody>
    </table>

</x-app-layout>