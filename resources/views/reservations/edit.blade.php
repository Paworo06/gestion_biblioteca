<x-app-layout>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Editar reserva</title>
    <style>
        body { font-family: Arial, sans-serif; background: #f4f4f4; margin: 0; padding: 20px; }
        .card { background: #fff; max-width: 500px; margin: 0 auto; padding: 30px; border-radius: 8px; box-shadow: 0 2px 6px rgba(0,0,0,0.1); }
        h1 { margin-top: 0; color: #222; }
        p { color: #555; font-size: 14px; }
        label { display: block; margin-bottom: 6px; font-weight: bold; color: #444; font-size: 14px; }
        select { width: 100%; padding: 8px; border: 1px solid #ccc; border-radius: 4px; margin-bottom: 16px; box-sizing: border-box; }
        button { padding: 10px 20px; background: #3b82f6; color: #fff; border: none; border-radius: 4px; cursor: pointer; font-size: 14px; }
        button:hover { background: #2563eb; }
    </style>
</head>
<body>
    <div class="card">
        <h1>Editar reserva</h1>
        <p><strong>Alumno:</strong> {{ $reservation->user->name }}</p>
        <p><strong>Libro:</strong> {{ $reservation->book->titulo }}</p>
        <p><strong>Fecha recogida:</strong> {{ $reservation->fecha_inicio->format('d/m/Y') }}</p>
        <p><strong>Fecha devolución:</strong> {{ $reservation->fecha_fin->format('d/m/Y') }}</p>

        <form action="{{ route('reservations.update', $reservation) }}" method="POST" style="margin-top: 20px;">
            @csrf
            @method('PUT')

            <label for="estado">Estado</label>
            <select id="estado" name="estado">
                @foreach(['pendiente', 'confirmada', 'devuelta', 'cancelada'] as $estado)
                    <option value="{{ $estado }}" {{ $reservation->estado === $estado ? 'selected' : '' }}>
                        {{ ucfirst($estado) }}
                    </option>
                @endforeach
            </select>

            <button type="submit">Guardar cambios</button>
        </form>
    </div>
</body>
</html>
</x-app-layout>