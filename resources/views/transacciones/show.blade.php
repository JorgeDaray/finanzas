@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Detalles de la Transacción</h1>

    <div class="card">
        <div class="card-body">
            <h5 class="card-title">Transacción ID: {{ $transaccion->id }}</h5>
            <p><strong>Fecha:</strong> {{ $transaccion->fecha }}</p>
            <p><strong>Usuario:</strong> {{ $transaccion->usuario->nombre }}</p>
            <p><strong>Categoría:</strong> {{ $transaccion->categoria->nombre }}</p>
            <p><strong>Tipo:</strong> {{ ucfirst($transaccion->tipo) }}</p>
            <p><strong>Monto:</strong> ${{ number_format($transaccion->monto, 2) }}</p>
            <p><strong>Descripción:</strong> {{ $transaccion->descripcion }}</p>
        </div>
    </div>

    <a href="{{ route('transacciones.index') }}" class="btn btn-secondary mt-3">Volver a la lista</a>
</div>
@endsection
