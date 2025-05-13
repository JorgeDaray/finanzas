<!-- resources/views/categorias/index.blade.php -->
@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Lista de Categorías</h1>

    <!-- Mostrar cualquier mensaje de error -->
    @if(session('error'))
        <div class="alert alert-danger">
            {{ session('error') }}
        </div>
    @endif

    <!-- Mostrar las categorías -->
    <ul>
        @foreach ($categorias as $categoria)
            <li>{{ $categoria->nombre }}</li>
        @endforeach
    </ul>

    <!-- Botón para crear una nueva categoría -->
    <a href="{{ route('categorias.create') }}" class="btn btn-primary">Agregar Categoría</a>
</div>
@endsection
