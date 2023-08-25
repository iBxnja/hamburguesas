<?php

namespace App\Http\Controllers;

use App\Entidades\Cliente;
use App\Entidades\Pedido;
use Illuminate\Http\Request;
use Session;
require app_path() . '/start/constants.php';

class ControladorWebMiCuenta extends Controller
{
    public function index()
    {
        $idCliente = Session::get("idcliente");

        if ($idCliente) {
            $clientes = new Cliente();
            $cliente = $clientes->obtenerPorId($idCliente);

            if ($cliente) {                               //si el cliente fue encontrado entonces...
                $pedido = new Pedido();
                $aPedidos = $pedido->obtenerPorCliente($idCliente);

                return view("web.mi-cuenta", compact('cliente', 'aPedidos'));
            }
        }

        return redirect("/login");
    }

  
    public function guardar(Request $request)
    {
        $idCliente = Session::get("idcliente");

         $pedido = new Pedido();
        $aPedidos = $pedido->obtenerPorCliente($idCliente);

        if ($idCliente) {
            $cliente = new Cliente();
        
            // Cargar datos desde el form
            $cliente->idcliente = $idCliente;
            $cliente->nombre = $request->input('txtNombre');
            $cliente->apellido = $request->input('txtApellido');
            $cliente->correo = $request->input('txtCorreo');
            $cliente->documento = $request->input('txtDocumento');
            $cliente->celular = $request->input('txtTelefono');
            $cliente->clave = $request->input('txtClave');           //modificar clave ¿?
            // Validar los campos
            if (
                $cliente->nombre == "" ||
                $cliente->apellido == "" ||
                $cliente->correo == "" ||
                $cliente->documento == "" ||
                $cliente->celular == "" ||
                $cliente->clave == ""
            ) {

                $msg["ESTADO"] = MSG_ERROR;
                $msg["MSG"] = "Complete todos los campos.";
                return view("web.mi-cuenta", compact('cliente', 'msg', 'aPedidos'));
            } else {

                // Guardar los cambios en BBDD
                $cliente->guardar();
                $msg["ESTADO"] = MSG_SUCCESS;
                $msg["MSG"] = OKINSERT;

                return view("web.mi-cuenta", compact('cliente', 'msg', 'aPedidos'));

            }
        } else {
            return redirect("/login");
        }
    }
}
