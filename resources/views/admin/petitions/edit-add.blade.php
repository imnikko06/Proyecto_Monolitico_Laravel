@extends('layouts.admin')

@section('content')
    <div class="card">
        <div class="card-header bg-success text-white">
            <h5 class="mb-0">{{ isset($petition) ? 'Editar Petición' : 'Crear Nueva Petición' }}</h5>
        </div>

        <div class="card-body">
            <form action="{{ isset($petition) ? route('admin.petitions.update', $petition->id) : route('admin.petitions.store') }}"
                  method="POST"
                  enctype="multipart/form-data">
                @csrf
                @if(isset($petition))
                    @method('PUT')
                @endif

                <div class="mb-3">
                    <label for="title" class="form-label">Título</label>
                    <input type="text" name="title" id="title" class="form-control" value="{{ old('title', $petition->title ?? '') }}" required>
                </div>

                <div class="mb-3">
                    <label for="description" class="form-label">Descripción</label>
                    <textarea name="description" id="description" class="form-control" rows="4" required>{{ old('description', $petition->description ?? '') }}</textarea>
                </div>

                <div class="mb-3">
                    <label for="destinatary" class="form-label">Destinatario</label>
                    <input type="text" name="destinatary" id="destinatary" class="form-control" value="{{ old('destinatary', $petition->destinatary ?? '') }}" required>
                </div>

                <div class="mb-3">
                    <label for="signers" class="form-label">Firmas</label>
                    <input type="number" name="signers" id="signers" class="form-control" value="{{ old('signers', $petition->signers ?? 0) }}" min="0" required>
                </div>

                <div class="mb-3">
                    <label for="status" class="form-label">Estado</label>
                    <select name="status" id="status" class="form-select" required>
                        <option value="pending" {{ (old('status', $petition->status ?? '') == 'pending') ? 'selected' : '' }}>Pendiente</option>
                        <option value="accepted" {{ (old('status', $petition->status ?? '') == 'accepted') ? 'selected' : '' }}>Aceptada</option>
                    </select>
                </div>

                <div class="mb-3">
                    <label for="user_id" class="form-label">Usuario</label>
                    <select name="user_id" id="user_id" class="form-select" required>
                        @foreach(\App\Models\User::all() as $user)
                            <option value="{{ $user->id }}" {{ (old('user_id', $petition->user_id ?? '') == $user->id) ? 'selected' : '' }}>
                                {{ $user->name }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <div class="mb-3">
                    <label for="category_id" class="form-label">Categoría</label>
                    <select name="category_id" id="category_id" class="form-select" required>
                        @foreach(\App\Models\Category::all() as $category)
                            <option value="{{ $category->id }}" {{ (old('category_id', $petition->category_id ?? '') == $category->id) ? 'selected' : '' }}>
                                {{ $category->name }}
                            </option>
                        @endforeach
                    </select>
                </div>
                <div class="mb-3">
                    <label for="file" class="form-label">Imagen</label>
                    <input type="file" name="file" id="file" class="form-control">

                    @if(isset($petition) && $petition->files->first())
                        <div class="mt-2">
                            <p class="mb-1 text-muted">Imagen actual:</p>
                            <img
                                src="{{ asset($petition->files->first()->file_path) }}"
                                class="img-thumbnail"
                                style="max-width: 200px;"
                                alt="Imagen actual"
                            >
                        </div>
                    @endif
                </div>

                <button type="submit" class="btn btn-success">{{ isset($petition) ? 'Actualizar' : 'Crear' }}</button>
                <a href="{{ route('admin.petitions.index') }}" class="btn btn-secondary">Cancelar</a>
            </form>
        </div>
    </div>
@endsection
