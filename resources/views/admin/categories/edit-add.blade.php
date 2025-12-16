@extends('layouts.admin')

@section('content')
    <div class="card">
        <div class="card-header bg-success text-white">
            <h5 class="mb-0">{{ isset($category) ? 'Editar Categoría' : 'Crear Categoría' }}</h5>
        </div>

        <div class="card-body">
            <form action="{{ isset($category) ? route('admin.categories.update', $category->id) : route('admin.categories.store') }}" method="POST">
                @csrf
                @if(isset($category))
                    @method('PUT')
                @endif

                <div class="mb-3">
                    <label for="name" class="form-label">Nombre</label>
                    <input type="text" name="name" id="name" class="form-control" value="{{ old('name', $category->name ?? '') }}" required>
                </div>

                <button type="submit" class="btn btn-success">{{ isset($category) ? 'Actualizar' : 'Crear' }}</button>
                <a href="{{ route('admin.categories.index') }}" class="btn btn-secondary">Cancelar</a>
            </form>
        </div>
    </div>
@endsection
