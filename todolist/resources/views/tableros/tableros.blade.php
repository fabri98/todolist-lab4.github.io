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
                <div class="card position-relative">
                    <div class="card-body d-flex flex-column">
                        <h5 class="card-title mb-0">{{ $tablero->name }}</h5>

                        <!-- Contenedor de información adicional (oculto por defecto) -->
                        <div id="tablero-info-{{ $tablero->id }}" style="display: none; margin-top: 10px;">
                            <p>Información adicional del tablero:</p>
                            <p>Descripción: {{ $tablero->descripcion ?? 'Sin descripción' }}</p>
                            <p>Creado el: {{ $tablero->created_at }}</p>

                            <!-- Mostrar listas aquí -->
                            <div class="listas mt-3" id="listas-{{ $tablero->id }}" style="display: none;">
                                @foreach($tablero->listas as $lista)
                                    <div class="lista"
                                        style="border: 1px solid #ddd; padding: 15px; margin-bottom: 15px; border-radius: 8px; background-color: #f9f9f9;">
                                        <h6>{{ $lista->nombre }}</h6>

                                        <!-- Botón para expandir la lista -->
                                        <button class="btn btn-secondary mt-2 expand-list-btn"
                                            onclick="toggleList({{ $lista->id }}, this)">

                                            <span id="arrow-icon-lista-{{ $lista->id }}" class="bi bi-arrow-down"></span>

                                        </button>


                                        <!-- Contenedor de tareas, oculto por defecto -->
                                        <div class="tareas d-none" id="tareas-{{ $lista->id }}">
                                            @foreach($lista->tareas as $tarea)
                                                <div class="tarea border rounded p-3 mb-2 clickable" data-bs-toggle="modal"
                                                    data-bs-target="#tareaModal-{{ $tarea->id }}">
                                                    <p><strong>Título:</strong> {{ $tarea->titulo }}</p>
                                                    <p><strong>Estado:</strong> {{ $tarea->estado }}</p>
                                                </div>
                                                <div class="modal fade" id="tareaModal-{{ $tarea->id }}" tabindex="-1"
                                                    aria-labelledby="tareaModalLabel" aria-hidden="true">
                                                    <!-- Modal para ver los detalles de las tareas -->
                                                    <div class="modal-dialog">
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                                <h5 class="modal-title" id="tareaModalLabel">Detalles de la Tarea
                                                                </h5>
                                                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                                    aria-label="Close"></button>
                                                            </div>
                                                            <div class="modal-body">
                                                                <p><strong>Título:</strong> {{ $tarea->titulo }}</p>
                                                                <p><strong>Descripción:</strong> {{ $tarea->descripcion }}</p>
                                                                <p><strong>Estado:</strong> {{ $tarea->estado }}</p>
                                                                <p><strong>Prioridad:</strong> {{ $tarea->prioridad }}</p>
                                                                <p><strong>Fecha Límite:</strong> {{ $tarea->fecha_limite }}</p>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            @endforeach
                                        </div>


                                        <!-- Botón para agregar tarea, oculto por defecto -->

                                        <button class="btn btn-secondary mt-2 agregar-tarea-btn d-none" data-bs-toggle="modal"
                                            data-bs-target="#agregarTareaModal-{{ $lista->id }}"> Agregar Tarea
                                        </button>

                                        <!-- Modal para agregar tarea -->
                                        <div class="modal fade" id="agregarTareaModal-{{ $lista->id }}" tabindex="-1"
                                            aria-labelledby="agregarTareaModalLabel" aria-hidden="true">
                                            <div class="modal-dialog">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title" id="agregarTareaModalLabel">Agregar Tarea</h5>
                                                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                            aria-label="Close"></button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <form action="{{ route('tareas.store') }}" method="POST">
                                                            @csrf
                                                            <input type="hidden" name="id_lista" value="{{ $lista->id }}">

                                                            <div class="form-group">
                                                                <label for="titulo">Título de la Tarea</label>
                                                                <input type="text" name="titulo" class="form-control" required>
                                                            </div>
                                                            <div class="form-group">
                                                                <label for="descripcion">Descripción de la Tarea</label>
                                                                <input type="text" name="descripcion" class="form-control"
                                                                    required>
                                                            </div>
                                                            <div class="form-group">
                                                                <label for="fecha_limite">Fecha Límite</label>
                                                                <input type="date" name="fecha_limite" class="form-control"
                                                                    required>
                                                            </div>
                                                            <div class="form-group">
                                                                <label for="estado">Estado</label>
                                                                <select name="estado" class="form-control" required>
                                                                    <option value="pendiente">Pendiente</option>
                                                                    <option value="completada">Completada</option>
                                                                    <option value="en_progreso">En Progreso</option>
                                                                </select>
                                                            </div>
                                                            <div class="form-group">
                                                                <label for="prioridad">Prioridad</label>
                                                                <select name="prioridad" class="form-control" required>
                                                                    <option value="baja">Baja</option>
                                                                    <option value="media">Media</option>
                                                                    <option value="alta">Alta</option>
                                                                </select>
                                                            </div>
                                                            <button type="submit" class="btn btn-secondary mt-2">Agregar
                                                                Tarea</button>
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            </div>

                            <!-- Botón para agregar lista, visible solo cuando el tablero está expandido -->
                            <button class="btn btn-secondary mt-3" id="agregar-lista-{{ $tablero->id }}"
                                style="display: none;" data-bs-toggle="modal"
                                data-bs-target="#agregarListaModal-{{ $tablero->id }}">Agregar Lista</button>

                            <!-- Modal para agregar lista -->
                            <div class="modal fade" id="agregarListaModal-{{ $tablero->id }}" tabindex="-1"
                                aria-labelledby="agregarListaModalLabel" aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="agregarListaModalLabel">Agregar Lista</h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body">
                                            <form action="{{ route('listas.store') }}" method="POST">
                                                @csrf
                                                <input type="hidden" name="id_tablero" value="{{ $tablero->id }}">
                                                <div class="form-group">
                                                    <label for="nombre">Nombre de la Lista</label>
                                                    <input type="text" name="nombre" class="form-control" required>
                                                </div>
                                                <button type="submit" class="btn btn-primary mt-3">Agregar Lista</button>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>

                        </div>

                        <!-- Botones -->
                        <div class="d-flex justify-content-end mt-2">
                            <!-- Botón de Expandir -->
                            <button class="btn btn-primary expand-btn" onclick="toggleExpand({{ $tablero->id }})"
                                id="expand-btn-{{ $tablero->id }}">
                                <span id="arrow-icon-{{ $tablero->id }}" class="bi bi-arrow-down"></span>
                            </button>

                            <!-- Formulario para eliminar el tablero -->
                            <form action="{{ route('tableros.destroy', $tablero->id) }}" method="POST"
                                style="display: inline;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger btn-sm ms-2"
                                    onclick="return confirm('¿Estás seguro de que deseas eliminar este tablero?');">
                                    Borrar
                                </button>
                            </form>
                        </div>

                    </div>
                </div>
            </div>
        @endforeach
    </div>

    <!-- Modal para crear un tablero -->
    <div class="modal fade" id="crearTableroModal" tabindex="-1" aria-labelledby="crearTableroModalLabel"
        aria-hidden="true">
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
                            <input type="text" name="name" class="form-control" placeholder="Nombre del tablero"
                                required>
                        </div>
                        <div class="form-group mt-3">
                            <label for="descripcion">Descripción del Tablero</label>
                            <input type="text" name="descripcion" class="form-control"
                                placeholder="Descripción del tablero" required>
                        </div>
                        <button type="submit" class="btn btn-primary mt-3">Crear Tablero</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection

<!-- Script para manejar la expansión -->
<script>
    function toggleExpand(tableroId) {
        console.log("Ejecutando toggleExpand para tableroId:", tableroId); // Para depuración

        const infoContainer = document.getElementById(`tablero-info-${tableroId}`);
        const listasContainer = document.getElementById(`listas-${tableroId}`);
        const agregarListaBtn = document.getElementById(`agregar-lista-${tableroId}`);
        const arrowIcon = document.getElementById(`arrow-icon-${tableroId}`);

        if (infoContainer && listasContainer && agregarListaBtn) {
            if (infoContainer.style.display === "none") {
                infoContainer.style.display = "block";
                listasContainer.style.display = "block";
                agregarListaBtn.style.display = "inline";
                arrowIcon.classList.replace("bi-arrow-down", "bi-arrow-up");
            } else {
                infoContainer.style.display = "none";
                listasContainer.style.display = "none";
                agregarListaBtn.style.display = "none";
                arrowIcon.classList.replace("bi-arrow-up", "bi-arrow-down");
            }
        } else {
            console.log("No se encontraron algunos de los elementos requeridos");
        }
    }

    function toggleList(listaId, button) {
        console.log("Ejecutando toggleList para listaId:", listaId); // Para depuración

        const tareasContainer = document.getElementById(`tareas-${listaId}`);
        const agregarTareaBtn = document.querySelector(`#tareas-${listaId} ~ .agregar-tarea-btn`);
        const arrowIcon = document.getElementById(`arrow-icon-lista-${listaId}`);

        if (tareasContainer && agregarTareaBtn && arrowIcon) {
            tareasContainer.classList.toggle("d-none");
            agregarTareaBtn.classList.toggle("d-none");

            // Cambiar el icono de flecha
            if (tareasContainer.classList.contains("d-none")) {
                arrowIcon.classList.replace("bi-arrow-up", "bi-arrow-down");
            } else {
                arrowIcon.classList.replace("bi-arrow-down", "bi-arrow-up");
            }
        } else {
            console.log("No se encontraron algunos de los elementos requeridos para la lista");
        }
    }


</script>