<?php

namespace App\Http\Controllers;

use App\Entidades\Sucursal;
use App\Entidades\Cliente;
use Illuminate\Http\Request;

class ControladorWebOlvideClave extends Controller
{
    public function index()
    {
        $sucursal = new Sucursal();
        $aSucursales = $sucursal->obtenerTodos();
        return view("web.olvide-clave", compact("aSucursales"));
    }

    public function cambiarClave(Request $request)
    {
        // Genera un código de recuperación aleatorio
        $codigoRecu = rand(1000, 9999);

        //Actualizar para el cliente cuyo correo se ingresó esta nueva clave
        //Obtener el correo electrónico ingresado por el usuario
        $correoUsuario = $request->input('txtCorreo');

        //Buscar al cliente en la base de datos por correo electrónico
        $cliente = Cliente::where('correo', $correoUsuario)->first();

        if ($cliente) {
            // Generar la nueva clave y guardarla en la base de datos
            $nuevaClave = bcrypt((string)$codigoRecu);

            // Actualizar la clave del cliente en la base de datos
            $cliente->update(['clave' => $nuevaClave]);

            $sucursal = new Sucursal();
            $aSucursales = $sucursal->obtenerTodos();
            return view("web.olvide-clave", compact("aSucursales", "codigoRecu"));
        } else {
            $msg = 'Correo electrónico no encontrado. Por favor, verifica tu correo e intenta nuevamente.';
            return view("web.olvide-clave", compact("msg"));
        }
    }
}
