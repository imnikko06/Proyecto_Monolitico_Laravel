<?php

namespace App\Http\Controllers;
use App\Models\Category;
use App\Models\File;
use App\Models\Petition;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PetitionController extends Controller
{


    /*
     * Index
     * Obtiene 10 petitions por el paginate
     * Retorna la view con la variable que es un Array
     * */
    public function index()
    {
        $petitions = Petition::paginate(10);
        return view('petitions.index', compact('petitions'));
    }

    /*
     * Show(id)
     * Obtenemos la peticion mediante id, retornamos la peticion obtenida y el usuario que lo ha creado
     * */
    public function show($id)
    {
        try {
            $petition = Petition::findOrFail($id);
            $user = $petition->user;
            return view('petitions.show', compact('petition', 'user'));
        } catch (ModelNotFoundException $e) {
            return redirect()->route('petitions.index');
        }
    }

    /*
     * ListMine
     * Obtiene el usuario y pregunta por las petitionsCreated del Model Petition
     * Retorna la vista de petitions.index con la variable petitions, por lo que al ser el mismo nombre de variable
     * entonces hace las mismas cards
     * */
    public function listMine()
    {
        $petitions = Auth::user()->petitionsCreated;
        return view('petitions.mypetitions', compact('petitions'));
    }

    /*
     * Create
     * Esta funcion es para retornar una vista con la creacion de una peticion, obtiene las categorias
     * para poder ponerlas en un select y no estar inventandonoslas y retorna la vista de la creacion de
     * una peticion mandando el array categorias para el select
     */
    public function create(){
        //Si no hay user que redirecte al login, aunque en web esta el middleware auth pero no funciona properly
        $user = Auth::user();
        if ($user == null) {
            return redirect()->route('login');
        }
        $categorias = Category::all();

        return view('petitions.edit-add', compact('categorias'));
    }


    /*
     * sign(Req, $id)
     * Obtiene la peticion segun el id que le llega, obtenemos el usuario tambien, comprobamos si el usuario que
     * quiere firmar ha firmado con anterioridad, en caso de que si, devuelve la vista con un error, en caso de que no
     * se añade a la tabla intermedia petition_user el registro del usuario y que peticion ha firmado y se incrementa
     * el contador de signers, luego se devuelve la vista con success, de que se ha firmado correctametne
     */
    public function sign(Request $request, $id)
    {
        $petition = Petition::findOrFail($id);
        $user = Auth::user();

        //If el user ha firmado then back with errors porque ya se firmo
        if ($petition->signers()->where('user_id', $user->id)->exists()) {
            return back()->withErrors("Ya has firmado esta petición");
        }
        $petition->signers()->attach($user->id);

        $petition->increment('signers');

        return back()->with('success', 'Has firmado la petición exitosamente.');
    }

    /*
     * Store,
     * Almacena en base de datos la Request de add-edit.blade.php
     */
    public function store(Request $request)
    {
        $user = Auth::user();
        if (!$user){
            return redirect()->route('login');
        }
        $request->validate([
            'title' => 'required|max:255',
            'description' => 'required',
            'destinatary' => 'required',
            'category_id' => 'required|exists:categories,id',
            'file' => 'nullable|image|max:10240',
        ]);

        $petition = Petition::create([
            'title' => $request->title,
            'description' => $request->description,
            'destinatary' => $request->destinatary,
            'signers' => 0,
            'status' => 'pending',
            'user_id' => auth()->id(),
            'category_id' => $request->category_id
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

        return redirect()->route('home')->with('success', 'Petición creada con éxito.');
    }

    /*
     * SignedPetitions
     * Nos va a devolver la vista mysigns, la cual es una copia basicamente de petitions.index, pero con algo cambiado
     * y envia como variable petitions
     */
    public function signedPetitions(Request $request){
        $user = Auth::user();
        if (!$user){
            return redirect()->route('login');
        }
        $petitions = $user->signedPetitions;
        return view('petitions.mysigns', compact('petitions'));
    }

    public function edit($id)
    {
        $petition = Petition::findOrFail($id);
        $this->authorize('update', $petition);

        $categorias = Category::all();

        return view('petitions.edit-add', compact('petition', 'categorias'));
    }
    public function update(Request $request, $id)
    {
        $petition = Petition::findOrFail($id);
        $this->authorize('update', $petition);

        $request->validate([
            'title' => 'required|max:255',
            'description' => 'required',
            'destinatary' => 'required',
            'category_id' => 'required|exists:categories,id',
            'file' => 'nullable|image|max:10240',
        ]);

        $petition->update([
            'title' => $request->title,
            'description' => $request->description,
            'destinatary' => $request->destinatary,
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

        return redirect()->route('petitions.show', $petition->id)
            ->with('success', 'Petición actualizada correctamente.');
    }


    public function delete($id){
        $petition = Petition::findOrFail($id);

        $this->authorize('delete', $petition);

        $petition->signers()->detach();

        foreach ($petition->files as $file) {
            if (file_exists(public_path($file->file_path))) {
                unlink(public_path($file->file_path));
            }
            $file->delete();
        }

        $petition->delete();

        return redirect()->route('petitions.index')
            ->with('success', 'Petición eliminada correctamente.');

    }
}
