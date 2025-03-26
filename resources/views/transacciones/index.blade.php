@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Lista de Transacciones</h1>

    <a href="{{ route('transacciones.create') }}" class="btn btn-primary mb-3">Agregar Transacción</a>

    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    <table class="table">
        <thead>
            <tr>
                <th>Fecha</th>
                <th>Usuario</th>
                <th>Categoría</th>
                <th>Tipo</th>
                <th>Monto</th>
                <th>Descripción</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            @foreach($transacciones as $transaccion)
                <tr>
                    <td>{{ $transaccion->fecha }}</td>
                    <td>{{ $transaccion->usuario->nombre }}</td>
                    <td>{{ $transaccion->categoria->nombre }}</td>
                    <td>{{ ucfirst($transaccion->tipo) }}</td>
                    <td>${{ number_format($transaccion->monto, 2) }}</td>
                    <td>{{ $transaccion->descripcion }}</td>
                    <td>
                        <a href="{{ route('transacciones.show', $transaccion->id) }}" class="btn btn-info btn-sm">Ver</a>
                        <a href="{{ route('transacciones.edit', $transaccion->id) }}" class="btn btn-warning btn-sm">Editar</a>
                        <form action="{{ route('transacciones.destroy', $transaccion->id) }}" method="POST" style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('¿Estás seguro de eliminar esta transacción?')">Eliminar</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
