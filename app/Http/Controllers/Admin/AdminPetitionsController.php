<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\File;
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
        $request->validate([
            'title' => 'required|max:255',
            'description' => 'required',
            'destinatary' => 'required',
            'signers' => 'required|integer|min:0',
            'status' => 'required|in:accepted,pending',
            'user_id' => 'required|exists:users,id',
            'category_id' => 'required|exists:categories,id',
            'file' => 'nullable|image|max:10240',
        ]);

        $petition = Petition::create([
            'title' => $request->title,
            'description' => $request->description,
            'destinatary' => $request->destinatary,
            'signers' => $request->signers,
            'status' => $request->status,
            'user_id' => $request->user_id,
            'category_id' => $request->category_id,
        ]);

        if ($request->hasFile('file')) {
            $file = $request->file('file');
            $filename = time() . '_' . $file->getClientOriginalName();
            $destinationPath = public_path('assets/img');

            if (!file_exists($destinationPath)) {
                mkdir($destinationPath, 0755, true);
            }

            $file->move($destinationPath, $filename);

            File::create([
                'name' => $file->getClientOriginalName(),
                'file_path' => 'assets/img/' . $filename,
                'petition_id' => $petition->id,
            ]);
        }

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

        $request->validate([
            'title' => 'required|max:255',
            'description' => 'required',
            'destinatary' => 'required',
            'signers' => 'required|integer|min:0',
            'status' => 'required|in:accepted,pending',
            'user_id' => 'required|exists:users,id',
            'category_id' => 'required|exists:categories,id',
            'file' => 'nullable|image|max:10240',
        ]);

        $petition->update([
            'title' => $request->title,
            'description' => $request->description,
            'destinatary' => $request->destinatary,
            'signers' => $request->signers,
            'status' => $request->status,
            'user_id' => $request->user_id,
            'category_id' => $request->category_id,
        ]);

        if ($request->hasFile('file')) {
            $file = $request->file('file');
            $filename = time() . '_' . $file->getClientOriginalName();
            $destinationPath = public_path('assets/img');

            if (!file_exists($destinationPath)) {
                mkdir($destinationPath, 0755, true);
            }

            $file->move($destinationPath, $filename);

            if ($petition->files()->exists()) {
                $oldFile = $petition->files()->first();

                if (file_exists(public_path($oldFile->file_path))) {
                    unlink(public_path($oldFile->file_path));
                }

                $oldFile->update([
                    'name' => $file->getClientOriginalName(),
                    'file_path' => 'assets/img/' . $filename,
                ]);
            } else {
                File::create([
                    'name' => $file->getClientOriginalName(),
                    'file_path' => 'assets/img/' . $filename,
                    'petition_id' => $petition->id,
                ]);
            }
        }

        return redirect()->route('admin.petitions.index')
            ->with('success', 'Petición actualizada correctamente.');
    }

// Eliminar una petición
    public function delete($id)
    {
        $petition = Petition::findOrFail($id);

        $petition->signers()->detach();

        if ($petition->files()->exists()) {
            foreach ($petition->files as $file) {
                $filePath = public_path($file->file_path);

                if (file_exists($filePath)) {
                    unlink($filePath);
                }

                $file->delete();
            }
        }

        $petition->delete();

        return redirect()->route('admin.petitions.index')
            ->with('success', 'Petición y firmas eliminadas correctamente.');
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
