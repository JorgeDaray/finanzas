@extends('layouts.app')

@section('content')
<div class="container">
    @if (session('error'))
        <div class="alert alert-danger">
            {{ session('error') }}
        </div>
    @endif

    <h1>Detalles del Usuario</h1>

    <div class="card">
        <div class="card-body">
            <h5 class="card-title">Usuario: {{ $user->name }}</h5>
            <p><strong>Correo Electrónico:</strong> {{ $user->email }}</p>

            <h5 class="mt-3">Roles del Usuario:</h5>
            <ul>
                @foreach ($roles as $role)
                    <li>{{ $role->name }}</li> <!-- Muestra el nombre de cada rol -->
                @endforeach
            </ul>
        </div>
    </div>

    <a href="{{ route('users.index') }}" class="btn btn-secondary mt-3">Volver a la lista de usuarios</a>
</div>
@endsection
