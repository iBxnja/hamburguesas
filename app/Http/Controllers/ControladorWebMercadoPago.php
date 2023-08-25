<?php

//Creación de controlador.

namespace App\Http\Controllers;

use App\Entidades\Pedido;

class ControladorWebMercadoPago extends Controller
{
    public function aprobado($idPedido)
    {
        //Cambiar el estado
        $pedido = new Pedido();
        $pedido->idpedido = $idPedido;
        $pedido->fk_idestado = 5;
        $pedido->guardarEstado();
        //Redireccionar a mi cuenta
        return redirect("/mi-cuenta");
    }
    public function pendiente($idPedido)
    {
        //Cambiar el estado
        $pedido = new Pedido();
        $pedido->idpedido = $idPedido;
        $pedido->fk_idestado = 1;
        $pedido->guardarEstado();
        //Redireccionar a mi cuenta
        return redirect("/mi-cuenta");

    }
    public function error($idPedido)
    {
        //Cambiar el estado
        $pedido = new Pedido();
        $pedido->idpedido = $idPedido;
        $pedido->fk_idestado = 4;
        $pedido->guardarEstado();
        //Redireccionar a mi cuenta
        return redirect("/mi-cuenta");

    }

}
