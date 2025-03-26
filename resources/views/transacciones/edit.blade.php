@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Editar Transacción</h1>

    <form action="{{ route('transacciones.update', $transaccion->id) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="form-group">
            <label for="usuario_id">Usuario</label>
            <select name="usuario_id" id="usuario_id" class="form-control" required>
                <option value="">Selecciona un usuario</option>
                @foreach($usuarios as $usuario)
                    <option value="{{ $usuario->id }}" {{ $usuario->id == $transaccion->usuario_id ? 'selected' : '' }}>{{ $usuario->nombre }}</option>
                @endforeach
            </select>
        </div>

        <div class="form-group">
            <label for="categoria_id">Categoría</label>
            <select name="categoria_id" id="categoria_id" class="form-control" required>
                <option value="">Selecciona una categoría</option>
                @foreach($categorias as $categoria)
                    <option value="{{ $categoria->id }}" {{ $categoria->id == $transaccion->categoria_id ? 'selected' : '' }}>{{ $categoria->nombre }}</option>
                @endforeach
            </select>
        </div>

        <div class="form-group">
            <label for="tipo">Tipo de transacción</label>
            <select name="tipo" id="tipo" class="form-control" required>
                <option value="ingreso" {{ $transaccion->tipo == 'ingreso' ? 'selected' : '' }}>Ingreso</option>
                <option value="gasto" {{ $transaccion->tipo == 'gasto' ? 'selected' : '' }}>Gasto</option>
            </select>
        </div>

        <div class="form-group">
            <label for="monto">Monto</label>
            <input type="number" name="monto" id="monto" class="form-control" required step="0.01" value="{{ $transaccion->monto }}">
        </div>

        <div class="form-group">
            <label for="descripcion">Descripción</label>
            <textarea name="descripcion" id="descripcion" class="form-control" rows="3">{{ $transaccion->descripcion }}</textarea>
        </div>

        <div class="form-group">
            <label for="fecha">Fecha</label>
            <input type="date" name="fecha" id="fecha" class="form-control" required value="{{ $transaccion->fecha }}">
        </div>

        <button type="submit" class="btn btn-primary mt-3">Actualizar Transacción</button>
    </form>
</div>
@endsection
