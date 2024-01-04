<?php

namespace App\Http\Controllers;

use App\Models\Cliente;
use Illuminate\Http\Request;

class ClientesController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $datos = Cliente::all();
        return view('admin.cliente')->with("datos", $datos);
    }

    public function editar(Request $dat, Cliente $id)
    {
        $id->update($dat->all());
        return back();
    }

    public function guardar(Request $datos)
    {
        Cliente::create($datos->all());
        return back();
    }

    public function eliminar($id){
        $usuario = Cliente::find($id); // Obtén el modelo del registro que deseas eliminar
        $usuario->delete(); // Elimina el registro de la base de datos
        return back();
    }
}
