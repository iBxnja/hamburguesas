<?php

namespace App\Http\Controllers;

use App\Entidades\Sistema\Patente;
use App\Entidades\Sistema\Usuario;
use App\Entidades\Sucursal;

use Session;

class ControladorWebHome extends Controller
{
    public function index()
    {
        $sucursal = new Sucursal();
        // Obtener todos los registros de la base de datos
        $aSucursales = $sucursal->obtenerTodos();

        return view('web.index', compact('aSucursales'));
    }
}
