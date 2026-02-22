<x-app-layout>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Reservar libro</title>
    <style>
        body { font-family: Arial, sans-serif; background: #f4f4f4; margin: 0; padding: 20px; }
        .card { background: #fff; max-width: 500px; margin: 0 auto; padding: 30px; border-radius: 8px; box-shadow: 0 2px 6px rgba(0,0,0,0.1); }
        h1 { margin-top: 0; color: #222; }
        label { display: block; margin-bottom: 6px; font-weight: bold; color: #444; font-size: 14px; }
        input[type="date"] { width: 100%; padding: 8px; border: 1px solid #ccc; border-radius: 4px; margin-bottom: 16px; box-sizing: border-box; }
        button { padding: 10px 20px; background: #3b82f6; color: #fff; border: none; border-radius: 4px; cursor: pointer; font-size: 14px; }
        button:hover { background: #2563eb; }
        .alert-error { background: #fee2e2; color: #991b1b; padding: 12px; border-radius: 6px; margin-bottom: 16px; font-size: 14px; }
    </style>
</head>
<body>
    <div class="card">
        <h1>Reservar: {{ $book->titulo }}</h1>

        @if($errors->any())
            <div class="alert-error">
                @foreach($errors->all() as $error)
                    <p style="margin:0">{{ $error }}</p>
                @endforeach
            </div>
        @endif

        <form action="{{ route('reservations.store') }}" method="POST">
            @csrf
            <input type="hidden" name="book_id" value="{{ $book->id }}">

            <label for="fecha_inicio">Fecha de recogida</label>
            <input type="date" id="fecha_inicio" name="fecha_inicio" value="{{ old('fecha_inicio') }}">

            <label for="fecha_fin">Fecha de devolución</label>
            <input type="date" id="fecha_fin" name="fecha_fin" value="{{ old('fecha_fin') }}">

            <button type="submit">Confirmar reserva</button>
        </form>
    </div>
</body>
</html>
</x-app-layout>