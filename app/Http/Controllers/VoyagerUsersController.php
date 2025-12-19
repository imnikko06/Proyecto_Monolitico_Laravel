<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class VoyagerUsersController extends Controller
{
    public function peticionesFirmadas(Request $request)
    {
        try {
            $id = Auth::id();
            $usuario = User::findOrFail($id);
            $peticiones = $usuario->signs;
        }catch (\Exception $exception){
            return back()->withError( $exception->getMessage())->withInput();
}
        return view('petitions.index', compact('peticiones'));
    }

}
