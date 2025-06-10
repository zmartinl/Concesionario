<nav class="navbar navbar-expand-lg navbar-light bg-light p-0">
    <button class="navbar-toggler m-2" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse" id="navbarNav">
        <ul class="navbar-nav"> 
            <li class="nav-item me-3">
                <a class="nav-link {{ Route::currentRouteName() === 'admin' ? 'active' : '' }}" href="{{ route('admin') }}">Vehículos</a>
            </li>
            <li class="nav-item me-3">
                <a class="nav-link {{ Route::currentRouteName() === 'brand' ? 'active' : '' }}" href="{{ route('brand') }}">Marcas</a>
            </li>
            <li class="nav-item me-3">
                <a class="nav-link {{ Route::currentRouteName() === 'types' ? 'active' : '' }}" href="{{ route('types') }}">Tipos de Vehículos</a>
            </li>
            <li class="nav-item me-3">
                <a class="nav-link {{ Route::currentRouteName() === 'colors' ? 'active' : '' }}" href="{{ route('colors') }}">Colores</a>
            </li>
        </ul>
    </div>
</nav>
