<?php

namespace App\Http\Controllers;

use App\Entidades\Cliente;
use App\Entidades\Sucursal;
use Illuminate\Http\Request;
use Session;

class ControladorWebLogin extends Controller
{
    public function index()
    {
        $sucursal = new Sucursal();
        $aSucursales = $sucursal->obtenerTodos();
        return view("web.login", compact('aSucursales'));
    }

    public function ingresar(Request $request)
    {
        $correo = $request->input("txtCorreo");
        $clave = $request->input("txtClave");

        $sucursal = new Sucursal();
        $aSucursales = $sucursal->obtenerTodos();

        if ($correo != "" && $clave != "") {
            $cliente = new Cliente();
            if ($aClientes = $cliente->verificarMail($correo)) {
                if ($cliente->validarClave($clave, $aClientes[0]->clave)) {
                    Session::put("idcliente", $aClientes[0]->idcliente);
                    return redirect("/take-away");
                } else {
                    $msg = "Credenciales incorrectas";
                    return view("web.login", compact('aSucursales', 'msg'));
                }
            } else {
                $msg = "Credenciales incorrectas";
                return view("web.login", compact('aSucursales', 'msg'));
            }
        } else {
            exit;
        }
    }

    public function salir()
    {
        Session::flush();
        return redirect('/');
    }
}
