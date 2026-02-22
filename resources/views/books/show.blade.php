<x-app-layout>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>{{ $book->title }}</title>
    <style>
        body { font-family: Arial, sans-serif; background: #f4f4f4; margin: 0; padding: 20px; }
        .card { background: #fff; max-width: 600px; margin: 0 auto; padding: 30px; border-radius: 8px; box-shadow: 0 2px 6px rgba(0,0,0,0.1); }
        h1 { margin-top: 0; color: #222; }
        p { color: #555; }
        .disponible { color: green; font-weight: bold; }
        .no-disponible { color: red; font-weight: bold; }
        .btn { display: inline-block; margin-top: 16px; padding: 10px 20px; background: #3b82f6; color: #fff; border-radius: 4px; text-decoration: none; }
        .btn:hover { background: #2563eb; }
        .sin-stock { color: red; font-weight: bold; margin-top: 16px; }
    </style>
</head>
<body>
    <div class="card">
        <h1>{{ $book->titulo }}</h1>
        <p><strong>Autor:</strong> {{ $book->autor }}</p>
        <p><strong>ISBN:</strong> {{ $book->isbn ?? 'No disponible' }}</p>
        <p>{{ $book->descripcion }}</p>
        <p>
            Copias disponibles:
            <span class="{{ $book->isDisponible() ? 'disponible' : 'no-disponible' }}">
                {{ $book->copiasDisponibles() }}
            </span>
        </p>

        @if($book->isDisponible())
            <a href="{{ route('reservations.create', $book) }}" class="btn">Reservar libro</a>
        @else
            <p class="sin-stock">Este libro no está disponible actualmente.</p>
        @endif
    </div>
</body>
</html>
</x-app-layout>