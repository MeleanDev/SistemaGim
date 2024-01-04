<?php

namespace App\Http\Controllers;

use App\Models\personal;
use Illuminate\Http\Request;

class PersonalController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $datos = personal::all();
        return view('admin.personal')->with("datos", $datos);
    }

    public function editar(Request $dat, personal $id)
    {
        $id->update($dat->all());
        return back();
    }

    public function guardar(Request $datos)
    {
        personal::create($datos->all());
        return back();
    }

    public function eliminar($id){
        $usuario = personal::find($id); // Obtén el modelo del registro que deseas eliminar
        $usuario->delete(); // Elimina el registro de la base de datos
        return back();
    }
}
