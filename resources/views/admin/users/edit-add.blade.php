@extends('layouts.admin')

@section('content')
    <div class="card">
        <div class="card-header bg-success text-white">
            <h5 class="mb-0">{{ isset($user) ? 'Editar Usuario' : 'Crear Usuario' }}</h5>
        </div>

        <div class="card-body">
            <form action="{{ isset($user) ? route('admin.users.update', $user->id) : route('admin.users.store') }}" method="POST">
                @csrf
                @if(isset($user))
                    @method('PUT')
                @endif

                <div class="mb-3">
                    <label for="name" class="form-label">Nombre</label>
                    <input type="text" name="name" id="name" class="form-control" value="{{ old('name', $user->name ?? '') }}" required>
                </div>

                <div class="mb-3">
                    <label for="email" class="form-label">Email</label>
                    <input type="email" name="email" id="email" class="form-control" value="{{ old('email', $user->email ?? '') }}" required>
                </div>

                <div class="mb-3">
                    <label for="role_id" class="form-label">Rol</label>
                    <select name="role_id" id="role_id" class="form-select" required>
                        <option value="1" {{ old('role_id', $user->role_id ?? '') == 1 ? 'selected' : '' }}>Usuario</option>
                        <option value="2" {{ old('role_id', $user->role_id ?? '') == 2 ? 'selected' : '' }}>Admin</option>
                    </select>
                </div>

                <div class="mb-3">
                    <label for="password" class="form-label">{{ isset($user) ? 'Nueva Contraseña (opcional)' : 'Contraseña' }}</label>
                    <input type="password" name="password" id="password" class="form-control" {{ isset($user) ? '' : 'required' }}>
                </div>

                <div class="mb-3">
                    <label for="password_confirmation" class="form-label">Confirmar Contraseña</label>
                    <input type="password" name="password_confirmation" id="password_confirmation" class="form-control" {{ isset($user) ? '' : 'required' }}>
                </div>

                <button type="submit" class="btn btn-success">{{ isset($user) ? 'Actualizar' : 'Crear' }}</button>
                <a href="{{ route('admin.users.index') }}" class="btn btn-secondary">Cancelar</a>
            </form>
        </div>
    </div>
@endsection
