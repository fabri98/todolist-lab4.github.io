@extends('index')

@section('content')
@if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif
<div class="container mt-4">
    <!-- Información del tablero -->
    <h1>{{ $tablero->name }}</h1>
    <p>{{ $tablero->descripcion }}</p>

    <!-- Botón para agregar lista -->
    <button class="btn btn-primary mb-4" data-bs-toggle="modal" data-bs-target="#agregarListaModal">
        Agregar Lista
    </button>

    <!-- Modal para agregar lista -->
    <div class="modal fade" id="agregarListaModal" tabindex="-1" aria-labelledby="agregarListaModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="agregarListaModalLabel">Agregar Nueva Lista</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="{{ route('listas.store') }}" method="POST">
                        @csrf
                        <input type="hidden" name="id_tablero" value="{{ $tablero->id }}">
                        <div class="mb-3">
                            <label for="nombre" class="form-label">Nombre de la Lista</label>
                            <input type="text" class="form-control" id="nombre" name="nombre" required>
                        </div>
                        <button type="submit" class="btn btn-primary">Agregar Lista</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Listas del tablero -->
    <h2>Listas</h2>
    @foreach($tablero->listas as $lista)
        <div class="card mb-3">
            <div class="card-header d-flex justify-content-between align-items-center">
                {{ $lista->nombre }}
                <!-- Botón para expandir/contraer lista -->
                <button class="btn btn-primary btn-sm expand-list-btn" onclick="toggleList({{ $lista->id }}, this)">
                    <span id="arrow-icon-lista-{{ $lista->id }}" class="bi bi-arrow-down"></span>
                </button>
            </div>

            <div class="card-body" id="contenedor-lista-{{ $lista->id }}" style="display: none;">
                <!-- Tareas -->
                <ul class="tareas" id="tareas-{{ $lista->id }}">
                    @foreach($lista->tareas as $tarea)
                        <li class="clickable" data-bs-toggle="modal" data-bs-target="#tareaModal-{{ $tarea->id }}">
                            <strong>{{ $tarea->titulo }}</strong> - {{ $tarea->estado }}
                        </li>

                        <!-- Modal para detalles de la tarea -->
                        <div class="modal fade" id="tareaModal-{{ $tarea->id }}" tabindex="-1" aria-labelledby="tareaModalLabel" aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="tareaModalLabel">Detalles de la Tarea</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                        <p><strong>Título:</strong> {{ $tarea->titulo }}</p>
                                        <p><strong>Descripción:</strong> {{ $tarea->descripcion }}</p>
                                        <p><strong>Estado:</strong> {{ $tarea->estado }}</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </ul>

                <!-- Botón para agregar tarea -->
                <button class="btn btn-secondary mt-2 agregar-tarea-btn d-none" data-bs-toggle="modal" data-bs-target="#agregarTareaModal-{{ $lista->id }}">
                    Agregar Tarea
                </button>

                <!-- Modal para agregar tarea -->
                <div class="modal fade" id="agregarTareaModal-{{ $lista->id }}" tabindex="-1" aria-labelledby="agregarTareaModalLabel" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="agregarTareaModalLabel">Agregar Tarea a {{ $lista->nombre }}</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <form action="{{ route('tareas.store') }}" method="POST">
                                    @csrf
                                    <input type="hidden" name="id_lista" value="{{ $lista->id }}">
                                    <div class="mb-3">
                                        <label for="titulo" class="form-label">Título</label>
                                        <input type="text" class="form-control" id="titulo" name="titulo" required>
                                    </div>
                                    <div class="mb-3">
                                        <label for="descripcion" class="form-label">Descripción</label>
                                        <textarea class="form-control" id="descripcion" name="descripcion" required></textarea>
                                    </div>
                                    <div class="mb-3">
                                        <label for="estado" class="form-label">Estado</label>
                                        <select class="form-control" id="estado" name="estado" required>
                                            <option value="Pendiente">Pendiente</option>
                                            <option value="En Progreso">En Progreso</option>
                                            <option value="Finalizada">Completado</option>
                                        </select>
                                    </div>
                                    <button type="submit" class="btn btn-primary">Agregar Tarea</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endforeach
</div>
@endsection

<script>
    function toggleList(listaId, button) {
        const listaContainer = document.getElementById(`contenedor-lista-${listaId}`);
        const agregarTareaBtn = document.querySelector(`#contenedor-lista-${listaId} .agregar-tarea-btn`);
        const arrowIcon = document.getElementById(`arrow-icon-lista-${listaId}`);

        if (listaContainer && agregarTareaBtn && arrowIcon) {
            if (listaContainer.style.display === "none") {
                listaContainer.style.display = "block";
                agregarTareaBtn.classList.remove("d-none");
                arrowIcon.classList.replace("bi-arrow-down", "bi-arrow-up");
            } else {
                listaContainer.style.display = "none";
                agregarTareaBtn.classList.add("d-none");
                arrowIcon.classList.replace("bi-arrow-up", "bi-arrow-down");
            }
        }
    }
</script>
