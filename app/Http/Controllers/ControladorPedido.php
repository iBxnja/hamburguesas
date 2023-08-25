<?php

namespace App\Http\Controllers;

use App\Entidades\Pedido;
use App\Entidades\Cliente;
use App\Entidades\Estado;
use App\Entidades\Sucursal;
use Illuminate\Http\Request;

require app_path() . '/start/constants.php';

class ControladorPedido extends Controller
{
    public function index(){
      $titulo = "Listado de pedidos";
      return view("pedido.pedido-listar", compact("titulo"));
    }

    public function cargarGrilla()
    {
        $request = $_REQUEST;

        $entidad = new Pedido();
        $aPedidos = $entidad->obtenerFiltrado();

        $data = array();
        $cont = 0;

        $inicio = $request['start'];
        $registros_por_pagina = $request['length'];

        for ($i = $inicio; $i < count($aPedidos) && $cont < $registros_por_pagina; $i++) {
            $row = array();
            $row[] = '<a href="/admin/pedido/' . $aPedidos[$i]->idpedido . '">' . $aPedidos[$i]->fecha . '</a>';
            $row[] = $aPedidos[$i]->descripcion;
            $row[] = $aPedidos[$i]->total;
            $row[] = $aPedidos[$i]->direccion_sucursal;
            $row[] = $aPedidos[$i]->nombre_cliente;
            $row[] = $aPedidos[$i]->nombre_estado;
            $cont++;
            $data[] = $row;
        }

        $json_data = array(
            "draw" => intval($request['draw']),
            "recordsTotal" => count($aPedidos), //cantidad total de registros sin paginar
            "recordsFiltered" => count($aPedidos), //cantidad total de registros en la paginacion
            "data" => $data,
        );
        return json_encode($json_data);
    }

    public function editar($id){
        $titulo = "Editar pedido";
        $pedido = new Pedido();
        $pedido->obtenerPorId($id);

        $sucursal = new Sucursal();
        $array_sucursales = $sucursal->obtenerTodos();

        $cliente = new Cliente();
        $array_clientes = $cliente->obtenerTodos();
        

        $estado = new Estado();
        $array_estados = $estado->obtenerTodos();
        
        return view('pedido.pedido-editar', compact('titulo', 'pedido', 'array_sucursales', 'array_clientes', 'array_estados'));
        

    }

    public function guardar(Request $request)
    {
        try {
            //Define la entidad servicio
            $titulo = "Modificar Pedido";
            $entidad = new Pedido();
            $entidad->cargarDesdeRequest($request);

                    //Es actualizacion
                    $entidad->guardarEstado();
                    $msg["ESTADO"] = MSG_SUCCESS;
                    $msg["MSG"] = OKINSERT;

                $_POST["id"] = $entidad->idpedido;
                return view('pedido.pedido-listar', compact('titulo', 'msg'));
        } catch (Exception $e) {
            $msg["ESTADO"] = MSG_ERROR;
            $msg["MSG"] = ERRORINSERT;
        }

        $id = $entidad->idpedido;
        $pedido = new Pedido();
        $pedido->obtenerPorId($id);

        return view('pedido.pedido-editar', compact('msg', 'pedido', 'titulo')) . '?id=' . $pedido->idpedido;
    }
}