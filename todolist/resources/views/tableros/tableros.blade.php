@extends('index')

@section('content')

<div class="container">
    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    <div class="d-flex justify-content-between align-items-center">
        <h1 class="titulo-tableros">Tableros</h1>
        <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#crearTableroModal">
            Agregar Tablero
        </button>
    </div>
    <hr>

    <!-- Mostrar tableros existentes -->
    <div class="row">
        @foreach($tableros as $tablero)
            <div class="col-md-3 mb-3">
                <div class="card">
                    <div class="card-body text-center">
                        <!-- Título del tablero con enlace clickeable -->
                        <a href="{{ route('tableros.show', $tablero->id) }}" class="text-decoration-none">
                            <h5 class="card-title text-primary">{{ $tablero->name }}</h5>
                        </a>
                        <p class="text-muted">{{ $tablero->descripcion ?? 'Sin descripción' }}</p>
                        
                        <!-- Botones para acciones rápidas -->
                        <div class="d-flex justify-content-center mt-3">
                            <!-- Formulario para eliminar tablero -->
                            <form action="{{ route('tableros.destroy', $tablero->id) }}" method="POST" onsubmit="return confirm('¿Seguro que deseas eliminar este tablero?');">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger btn-sm me-2">Borrar</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        @endforeach
    </div>

    <!-- Modal para crear un tablero -->
    <div class="modal fade" id="crearTableroModal" tabindex="-1" aria-labelledby="crearTableroModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="crearTableroModalLabel">Agregar Tablero</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="{{ route('tableros.store') }}" method="POST">
                        @csrf
                        <div class="form-group">
                            <label for="name">Nombre del Tablero</label>
                            <input type="text" name="name" class="form-control" placeholder="Nombre del tablero" required>
                        </div>
                        <div class="form-group mt-3">
                            <label for="descripcion">Descripción del Tablero</label>
                            <input type="text" name="descripcion" class="form-control" placeholder="Descripción del tablero" required>
                        </div>
                        <button type="submit" class="btn btn-primary mt-3">Crear Tablero</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
