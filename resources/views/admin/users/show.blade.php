@extends('layouts.admin')

@section('content')
    <div class="card">
        <div class="card-header bg-primary text-white">
            <h5 class="mb-0">Detalle del Usuario #{{ $user->id }}</h5>
        </div>

        <div class="card-body">
            <p><strong>Nombre:</strong> {{ $user->name }}</p>
            <p><strong>Email:</strong> {{ $user->email }}</p>
            <p><strong>Rol:</strong> {{ $user->role_id == 2 ? 'Admin' : 'Usuario' }}</p>
            <p><strong>Creado:</strong> {{ $user->created_at }}</p>
            <p><strong>Actualizado:</strong> {{ $user->updated_at }}</p>
        </div>

        <div class="card-footer">
            <a href="{{ route('admin.users.index') }}" class="btn btn-secondary">Volver</a>
            <a href="{{ route('admin.users.edit', $user->id) }}" class="btn btn-warning">Editar</a>
        </div>
    </div>
@endsection
