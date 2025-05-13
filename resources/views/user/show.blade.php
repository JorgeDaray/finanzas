<!-- resources/views/user/show.blade.php -->
@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Detalles del Usuario</h1>

    <div class="card">
        <div class="card-body">
            <h5 class="card-title">Usuario: {{ $user->name }}</h5>
            <p><strong>Email:</strong> {{ $user->email }}</p>
            <p><strong>Roles:</strong> 
                @foreach ($roles as $role)
                    {{ $role->name }}@if (!$loop->last), @endif
                @endforeach
            </p>
        </div>
    </div>

    <a href="{{ route('users.index') }}" class="btn btn-secondary mt-3">Volver a la lista</a>
</div>
@endsection
