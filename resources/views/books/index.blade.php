<x-app-layout>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Catálogo de libros</title>
    <style>
        body { font-family: Arial, sans-serif; background: #f4f4f4; margin: 0; padding: 20px; }
        h1 { color: #333; }
        .grid { display: grid; grid-template-columns: repeat(3, 1fr); gap: 20px; margin-top: 20px; }
        .card { background: #fff; border-radius: 8px; padding: 20px; box-shadow: 0 2px 6px rgba(0,0,0,0.1); }
        .card h3 { margin: 0 0 8px; color: #222; }
        .card p { margin: 4px 0; color: #555; font-size: 14px; }
        .disponible { color: green; font-weight: bold; }
        .no-disponible { color: red; font-weight: bold; }
        .btn { display: inline-block; margin-top: 12px; padding: 8px 16px; background: #3b82f6; color: #fff; border-radius: 4px; text-decoration: none; font-size: 14px; }
        .btn:hover { background: #2563eb; }
        .alert-success { background: #d1fae5; color: #065f46; padding: 12px; border-radius: 6px; margin-bottom: 16px; }
    </style>
</head>
<body>
    <h1>Catálogo de libros</h1>

    @if(session('success'))
        <div class="alert-success">{{ session('success') }}</div>
    @endif

    <div class="grid">
        @foreach($books as $book)
            <div class="card">
                <h3>{{ $book->titulo }}</h3>
                <p><strong>Autor:</strong> {{ $book->autor }}</p>
                <p>{{ $book->descripcion }}</p>
                <p>
                    Disponibles:
                    <span class="{{ $book->copiasDisponibles() ? 'disponible' : 'no-disponible' }}">
                        {{ $book->copiasDisponibles() }} / {{ $book->stock }}
                    </span>
                </p>
                <a href="{{ route('books.show', $book) }}" class="btn">Ver detalle</a>
            </div>
        @endforeach
    </div>
</body>
</html>
</x-app-layout>