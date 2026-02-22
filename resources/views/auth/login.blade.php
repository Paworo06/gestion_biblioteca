<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Iniciar sesión - Biblioteca</title>
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=source-sans-3:400,500,600,700&display=swap" rel="stylesheet">
    <style>
        * { box-sizing: border-box; margin: 0; padding: 0; }
    body {
        font-family: 'Source Sans 3', system-ui, sans-serif;
        background: linear-gradient(145deg, #1e3a5f 0%, #2c5282 50%, #1a365d 100%);
        min-height: 100vh;
        display: flex;
        justify-content: center;
        align-items: center;
        padding: 20px;
    }
    .auth-card {
        background: #fff;
        padding: 2.5rem 2.5rem 2rem;
        border-radius: 12px;
        box-shadow: 0 25px 50px -12px rgba(0, 0, 0, 0.25);
        width: 100%;
        max-width: 400px;
    }
    .auth-header {
        text-align: center;
        margin-bottom: 1.75rem;
    }
    .auth-title {
        font-size: 1.5rem;
        font-weight: 700;
        color: #1e3a5f;
        letter-spacing: -0.02em;
    }
    .auth-subtitle {
        color: #64748b;
        font-size: 0.875rem;
        margin-top: 0.25rem;
    }
    label {
        display: block;
        font-size: 0.8125rem;
        font-weight: 600;
        color: #334155;
        margin-bottom: 0.375rem;
    }
    input[type="email"],
    input[type="password"] {
        width: 100%;
        padding: 0.625rem 0.75rem;
        border: 1px solid #e2e8f0;
        border-radius: 8px;
        font-size: 0.9375rem;
        margin-bottom: 1rem;
        transition: border-color 0.15s, box-shadow 0.15s;
    }
    input:focus {
        outline: none;
        border-color: #2563eb;
        box-shadow: 0 0 0 3px rgba(37, 99, 235, 0.12);
    }
    .remember-row {
        display: flex;
        align-items: center;
        gap: 0.5rem;
        margin-bottom: 1.25rem;
    }
    .remember-row label {
        margin: 0;
        font-weight: 500;
        color: #475569;
    }
    button[type="submit"] {
        width: 100%;
        padding: 0.75rem 1rem;
        background: #1e3a5f;
        color: #fff;
        border: none;
        border-radius: 8px;
        font-size: 0.9375rem;
        font-weight: 600;
        cursor: pointer;
        transition: background 0.15s;
    }
    button[type="submit"]:hover {
        background: #2d4a6f;
    }
    .auth-footer {
        text-align: center;
        margin-top: 1.25rem;
        font-size: 0.8125rem;
        color: #64748b;
    }
    .auth-footer a {
        color: #2563eb;
        text-decoration: none;
        font-weight: 500;
    }
    .auth-footer a:hover {
        text-decoration: underline;
    }
    .alert-error {
        background: #fef2f2;
        color: #991b1b;
        padding: 0.75rem 1rem;
        border-radius: 8px;
        margin-bottom: 1rem;
        font-size: 0.8125rem;
        border: 1px solid #fecaca;
    }
    .alert-error p { margin: 0; }
    </style>
</head>
<body>
    <div class="auth-card">
        <div class="auth-header">
            <h1 class="auth-title">Biblioteca</h1>
            <p class="auth-subtitle">Inicia sesión para continuar</p>
        </div>

        @if($errors->any())
            <div class="alert-error">
                @foreach($errors->all() as $error)
                    <p>{{ $error }}</p>
                @endforeach
            </div>
        @endif

        <form method="POST" action="{{ route('login') }}">
            @csrf
            <label for="email">Correo electrónico</label>
            <input type="email" id="email" name="email" value="{{ old('email') }}" required autofocus>

            <label for="password">Contraseña</label>
            <input type="password" id="password" name="password" required>

            <div class="remember-row">
                <input type="checkbox" id="remember" name="remember">
                <label for="remember">Recordarme</label>
            </div>

            <button type="submit">Iniciar sesión</button>
        </form>

        <p class="auth-footer">
            ¿No tienes cuenta? <a href="{{ route('register') }}">Regístrate aquí</a>
        </p>
    </div>
</body>
</html>
