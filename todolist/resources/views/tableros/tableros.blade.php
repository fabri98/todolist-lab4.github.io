@extends('index')

@section('content')

<div class="container">
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
                    <div class="card-body">
                        <h5 class="card-title">{{ $tablero->name }}</h5>
                    </div>
                </div>
            </div>
        @endforeach
    </div>

    <!-- Botón para abrir el modal de agregar tablero -->
    

    <!-- Modal -->
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
                        <button type="submit" class="btn btn-primary mt-3">Crear Tablero</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
