<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;

class AdminCategoriesController extends Controller
{
    // Listar todas las categorías
    public function index()
    {
        $categories = Category::latest()->paginate(10);
        return view('admin.categories.index', compact('categories'));
    }

    // Mostrar una categoría específica
    public function show($id)
    {
        $category = Category::findOrFail($id);
        return view('admin.categories.show', compact('category'));
    }

    // Mostrar formulario de creación
    public function create()
    {
        return view('admin.categories.edit-add');
    }

    // Guardar nueva categoría
    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => 'required|string|max:255|unique:categories,name',
        ]);

        Category::create($data);

        return redirect()->route('admin.categories.index')
            ->with('success', 'Categoría creada correctamente.');
    }

    // Mostrar formulario de edición
    public function edit($id)
    {
        $category = Category::findOrFail($id);
        return view('admin.categories.edit-add', compact('category'));
    }

    // Actualizar categoría
    public function update(Request $request, $id)
    {
        $category = Category::findOrFail($id);

        $data = $request->validate([
            'name' => 'required|string|max:255|unique:categories,name,' . $id,
        ]);

        $category->update($data);

        return redirect()->route('admin.categories.index')
            ->with('success', 'Categoría actualizada correctamente.');
    }

    // Eliminar categoría
    public function delete($id)
    {
        $category = Category::findOrFail($id);

        if ($category->petitions()->count() > 0) {
            return redirect()->route('admin.categories.index')
                ->with('error', 'No se puede eliminar la categoría porque tiene peticiones asociadas.');
        }

        $category->delete();

        return redirect()->route('admin.categories.index')
            ->with('success', 'Categoría eliminada correctamente.');
    }
}
