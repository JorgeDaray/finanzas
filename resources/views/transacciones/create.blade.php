@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Agregar Nueva Transacción</h1>

    <form action="{{ route('transacciones.store') }}" method="POST">
        @csrf
        <div class="form-group">
            <label for="usuario_id">Usuario</label>
            <select name="usuario_id" id="usuario_id" class="form-control" required>
                <option value="">Selecciona un usuario</option>
                @foreach($usuarios as $usuario)
                    <option value="{{ $usuario->id }}">{{ $usuario->name }}</option>  <!-- Cambié nombre por name -->
                @endforeach
            </select>
        </div>

        <div class="form-group">
            <label for="categoria_id">Categoría</label>
            <select name="categoria_id" id="categoria_id" class="form-control" required>
                <option value="">Selecciona una categoría</option>
                @foreach($categorias as $categoria)
                    <option value="{{ $categoria->id }}">{{ $categoria->nombre }}</option>
                @endforeach
            </select>
        </div>

        <div class="form-group">
            <label for="tipo">Tipo de transacción</label>
            <select name="tipo" id="tipo" class="form-control" required>
                <option value="ingreso">Ingreso</option>
                <option value="gasto">Gasto</option>
            </select>
        </div>

        <div class="form-group">
            <label for="monto">Monto</label>
            <input type="number" name="monto" id="monto" class="form-control" required step="0.01">
        </div>

        <div class="form-group">
            <label for="descripcion">Descripción</label>
            <textarea name="descripcion" id="descripcion" class="form-control" rows="3"></textarea>
        </div>

        <div class="form-group">
            <label for="fecha">Fecha</label>
            <input type="date" name="fecha" id="fecha" class="form-control" required>
        </div>

        <button type="submit" class="btn btn-primary mt-3">Guardar Transacción</button>
    </form>
</div>
@endsection
