<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Petition;
use Illuminate\Http\Request;

class AdminPetitionsController extends Controller
{
    // Listar todas las peticiones
    public function index()
    {
        $petitions = Petition::with(['user', 'category'])
            ->latest()
            ->paginate(10);

        return view('admin.petitions.index', compact('petitions'));
    }

    // Mostrar una petición específica
    public function show($id)
    {
        $petition = Petition::with(['user', 'category'])->findOrFail($id);
        return view('admin.petitions.show', compact('petition'));
    }

    // Mostrar formulario de creación
    public function create()
    {
        return view('admin.petitions.edit-add');
    }

    // Guardar nueva petición
    public function store(Request $request)
    {
        $data = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'destinatary' => 'required|string',
            'signers' => 'required|integer|min:0',
            'status' => 'required|in:accepted,pending',
            'user_id' => 'required|exists:users,id',
            'category_id' => 'required|exists:categories,id',
        ]);

        Petition::create($data);

        return redirect()->route('admin.petitions.index')
            ->with('success', 'Petición creada correctamente.');
    }

    // Mostrar formulario de edición
    public function edit($id)
    {
        $petition = Petition::findOrFail($id);
        return view('admin.petitions.edit-add', compact('petition'));
    }

    // Actualizar petición existente
    public function update(Request $request, $id)
    {
        $petition = Petition::findOrFail($id);

        $data = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'destinatary' => 'required|string',
            'signers' => 'required|integer|min:0',
            'status' => 'required|in:accepted,pending',
            'user_id' => 'required|exists:users,id',
            'category_id' => 'required|exists:categories,id',
        ]);

        $petition->update($data);

        return redirect()->route('admin.petitions.index')
            ->with('success', 'Petición actualizada correctamente.');
    }

    // Eliminar petición
    public function delete($id)
    {
        $petition = Petition::findOrFail($id);

        $petition->signers()->detach();

        $petition->delete();

        return redirect()->route('admin.petitions.index')
            ->with('success', 'Petición eliminada correctamente.');
    }


    // Cambiar estado de la petición (toggle)
    public function changeStatus($id)
    {
        $petition = Petition::findOrFail($id);
        $petition->status = $petition->status === 'accepted' ? 'pending' : 'accepted';
        $petition->save();

        return redirect()->route('admin.petitions.index')
            ->with('success', 'Estado de la petición actualizado correctamente.');
    }
}
