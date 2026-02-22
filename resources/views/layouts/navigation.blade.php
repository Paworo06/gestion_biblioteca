<style>
    * { box-sizing: border-box; margin: 0; padding: 0; }
    body { font-family: Arial, sans-serif; background: #f4f4f4; }

    nav {
        background: #1e3a5f;
        padding: 0 30px;
        display: flex;
        align-items: center;
        justify-content: space-between;
        height: 60px;
    }

    .nav-brand {
        color: #fff;
        font-size: 18px;
        font-weight: bold;
        text-decoration: none;
    }

    .nav-links {
        display: flex;
        gap: 20px;
        align-items: center;
    }

    .nav-links a {
        color: #cbd5e1;
        text-decoration: none;
        font-size: 14px;
        padding: 6px 10px;
        border-radius: 4px;
        transition: background 0.2s;
    }

    .nav-links a:hover {
        background: #2d5080;
        color: #fff;
    }

    .nav-links a.active {
        background: #2d5080;
        color: #fff;
    }

    .nav-user {
        display: flex;
        align-items: center;
        gap: 12px;
    }

    .nav-user span {
        color: #94a3b8;
        font-size: 13px;
    }

    .nav-user .role-badge {
        background: #3b82f6;
        color: #fff;
        font-size: 11px;
        padding: 2px 8px;
        border-radius: 10px;
        text-transform: capitalize;
    }

    .nav-user form button {
        background: transparent;
        border: 1px solid #475569;
        color: #94a3b8;
        padding: 5px 12px;
        border-radius: 4px;
        cursor: pointer;
        font-size: 13px;
    }

    .nav-user form button:hover {
        background: #2d5080;
        color: #fff;
    }
</style>

<nav>
    <a href="{{ auth()->check() ? route('books.index') : url('/') }}" class="nav-brand">Biblioteca</a>

    <div class="nav-links">
        @auth
            <a href="{{ route('books.index') }}"
               class="{{ request()->routeIs('books.*') ? 'active' : '' }}">
                Catálogo
            </a>

            <a href="{{ route('reservations.index') }}"
               class="{{ request()->routeIs('reservations.index') ? 'active' : '' }}">
                Mis reservas
            </a>

            @if(auth()->user()->isProfesor())
                <a href="{{ route('reservations.gestionar') }}"
                   class="{{ request()->routeIs('reservations.gestionar') ? 'active' : '' }}">
                    Gestión de reservas
                </a>

                <a href="{{ route('reservations.pendiente') }}"
                   class="{{ request()->routeIs('reservations.pendiente') ? 'active' : '' }}">
                    Préstamos pendientes
                </a>
            @endif
        @else
            <a href="{{ route('login') }}" class="{{ request()->routeIs('login') ? 'active' : '' }}">Iniciar sesión</a>
            <a href="{{ route('register') }}" class="{{ request()->routeIs('register') ? 'active' : '' }}">Registrarse</a>
        @endauth
    </div>

    @auth
        <div class="nav-user">
            <span>{{ auth()->user()->name }}</span>
            <span class="role-badge">{{ auth()->user()->role }}</span>

            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button type="submit">Cerrar sesión</button>
            </form>
        </div>
    @endauth
</nav>