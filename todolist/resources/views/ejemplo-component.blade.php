@extends('index')

@section('content')
    <h1>Ejemplo de Component</h1>

    <x-card>
        <x-slot name="header">
            <h4>Título de la Tarjeta</h4>
        </x-slot>


        <x-slot name="body">
            <p>Contenido del body</p>
        </x-slot>

        <x-slot name="footer">
            Acá estaría el footer
        </x-slot>
    </x-card>
@endsection
