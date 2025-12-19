@extends('layouts.admin')

@section('content')
    <div class="card">
        <div class="card-header bg-primary text-white">
            <h5 class="mb-0">Detalle de la Categoría #{{ $category->id }}</h5>
        </div>

        <div class="card-body">
            <p><strong>Nombre:</strong> {{ $category->name }}</p>
            <p><strong>Creado:</strong> {{ $category->created_at }}</p>
            <p><strong>Actualizado:</strong> {{ $category->updated_at }}</p>
        </div>

        <div class="card-footer">
            <a href="{{ route('admin.categories.index') }}" class="btn btn-secondary">Volver</a>
            <a href="{{ route('admin.categories.edit', $category->id) }}" class="btn btn-warning">Editar</a>
        </div>
    </div>
@endsection
