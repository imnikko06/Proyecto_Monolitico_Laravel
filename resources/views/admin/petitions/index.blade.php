@extends('layouts.admin')

@section('content')
    <div class="card">
        <div class="card-header bg-danger text-white d-flex justify-content-between align-items-center">
            <h5 class="mb-0">Peticiones</h5>
            <a href="{{ route('admin.petitions.create') }}" class="btn btn-sm btn-success">
                <i class="fas fa-plus"></i> Crear Petición
            </a>
        </div>

        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table table-striped mb-0 align-middle">
                    <thead class="table-dark">
                    <tr>
                        <th>ID</th>
                        <th>Título</th>
                        <th>Usuario</th>
                        <th>Firmas</th>
                        <th>Estado</th>
                        <th>Fecha</th>
                        <th class="text-center">Acciones</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($petitions as $petition)
                        <tr>
                            <td>{{ $petition->id }}</td>
                            <td>{{ $petition->title }}</td>
                            <td>{{ $petition->user->name }}</td>
                            <td>{{ $petition->signers ?? 0 }}</td>
                            <td>
                            <span class="badge {{ $petition->status == 'accepted' ? 'bg-success' : 'bg-secondary' }}">
                                {{ $petition->status }}
                            </span>
                            </td>
                            <td>{{ $petition->created_at }}</td>
                            <td class="text-center">
                                <a href="{{ route('admin.petitions.show', $petition->id) }}" class="btn btn-sm btn-primary">Ver</a>
                                <a href="{{ route('admin.petitions.edit', $petition->id) }}" class="btn btn-sm btn-warning">Editar</a>
                                <form action="{{ route('admin.petitions.delete', $petition->id) }}" method="POST" class="d-inline">
                                    @csrf
                                    @method('DELETE')
                                    <button class="btn btn-sm btn-danger" onclick="return confirm('¿Eliminar esta petición?')">Eliminar</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>

        <div class="card-footer">
            {{ $petitions->links() }}
        </div>
    </div>
@endsection
