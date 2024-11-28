@extends('index')

@section('content')
<!-- Mostrar errores -->
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
    <div class="d-flex justify-content-between align-items-center">
        <h1 class="titulo-tableros">{{ $tablero->name }}</h1>

        <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#agregarListaModal">
            Agregar Lista
        </button>
    </div>

    <hr>

    <!-- Modal para agregar lista -->
    <div class="modal fade" id="agregarListaModal" tabindex="-1" aria-labelledby="agregarListaModalLabel"
        aria-hidden="true">
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
    <div class="text-center mt-4 mb-3">
    <h2 class="fw-bold text-primary">Listas</h2>
    <div class="mx-auto bg-primary rounded" style="width: 60px; height: 3px;"></div>
</div>


    @foreach($tablero->listas as $lista)
        <div class="card mb-3">
            <div class="card-header d-flex justify-content-between align-items-center">
                <div>
                    <span>{{ $lista->nombre }}: </span>
                    <span>{{ $lista->porcentajeCompletado }}% completado</span>
                </div>
                <div>
                    <!-- Botón para agregar tarea -->
                    <button class="btn btn-secondary btn-sm" data-bs-toggle="modal"
                        data-bs-target="#agregarTareaModal-{{ $lista->id }}">
                        Agregar Tarea
                    </button>

                    <!-- Botón para eliminar lista -->
                    <form action="{{ route('lista.eliminar', $lista->id) }}" method="POST" class="d-inline"
                        onsubmit="return confirm('¿Estás seguro de que quieres eliminar esta lista? Esta acción no se puede deshacer.')">
                        @csrf
                        @method('DELETE')
                        <button class="btn btn-danger btn-sm">Eliminar Lista</button>
                    </form>

                    <!-- Botón para mostrar/ocultar lista -->
                    <button class="btn btn-primary btn-sm" onclick="toggleList({{ $lista->id }}, this)">
                        <span id="arrow-icon-lista-{{ $lista->id }}" class="bi bi-arrow-down"></span>
                    </button>
                </div>
            </div>

            <div class="card-body" id="contenedor-lista-{{ $lista->id }}" style="display: none;">
                <!-- Tareas -->
                <ul class="tareas">
                    @foreach($lista->tareas as $tarea)
                        <li class="clickable" data-bs-toggle="modal" data-bs-target="#tareaModal-{{ $tarea->id }}">
                            <strong>{{ $tarea->titulo }}</strong> - {{ $tarea->estado }}
                        </li>
                    @endforeach
                </ul>
            </div>
        </div>

        <!-- Modal para agregar tarea -->
        <div class="modal fade" id="agregarTareaModal-{{ $lista->id }}" tabindex="-1"
            aria-labelledby="agregarTareaModalLabel" aria-hidden="true">
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
                                <label for="fecha_limite">Fecha Límite</label>
                                <input type="date" name="fecha_limite" class="form-control" required>
                            </div>
                            <div class="mb-3">
                                <label for="estado" class="form-label">Estado</label>
                                <select class="form-control" id="estado" name="estado" required>
                                    <option value="Pendiente">Pendiente</option>
                                    <option value="En Progreso">En Progreso</option>
                                    <option value="Finalizada">Finalizada</option>
                                </select>
                            </div>
                            <button type="submit" class="btn btn-primary">Agregar Tarea</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        <!-- Modal para detalles de la tarea -->
        @foreach($lista->tareas as $tarea)
            <div class="modal fade" id="tareaModal-{{ $tarea->id }}" tabindex="-1" aria-labelledby="tareaModalLabel"
                aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="tareaModalLabel">Detalles de la Tarea</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <p><strong>Título:</strong> {{ $tarea->titulo }}</p>
                            <p><strong>Descripción:</strong> {{ $tarea->descripcion }}</p>
                            <p><strong>Estado:</strong></p>
                            <form action="{{ route('tareas.update', $tarea->id) }}" method="POST" class="d-inline">
                                @csrf
                                @method('PUT')
                                <select name="estado" class="form-select" onchange="this.form.submit()">
                                    <option value="Pendiente" {{ $tarea->estado == 'Pendiente' ? 'selected' : '' }}>Pendiente
                                    </option>
                                    <option value="En Progreso" {{ $tarea->estado == 'En Progreso' ? 'selected' : '' }}>En
                                        Progreso</option>
                                    <option value="Finalizada" {{ $tarea->estado == 'Finalizada' ? 'selected' : '' }}>Finalizada
                                    </option>
                                </select>
                            </form>
                        </div>
                        <div class="modal-footer">
                            <form action="{{ route('tareas.destroy', $tarea->id) }}" method="POST"
                                onsubmit="return confirm('¿Estás seguro de que deseas eliminar esta tarea?');">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger">Eliminar Tarea</button>
                            </form>
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                        </div>
                    </div>
                </div>
            </div>
        @endforeach
    @endforeach
</div>
@endsection

<script>
    function toggleList(listaId, button) {
        const listaContainer = document.getElementById(`contenedor-lista-${listaId}`);
        const arrowIcon = document.getElementById(`arrow-icon-lista-${listaId}`);

        if (listaContainer.style.display === "none") {
            listaContainer.style.display = "block";
            arrowIcon.classList.replace("bi-arrow-down", "bi-arrow-up");
        } else {
            listaContainer.style.display = "none";
            arrowIcon.classList.replace("bi-arrow-up", "bi-arrow-down");
        }
    }
</script>