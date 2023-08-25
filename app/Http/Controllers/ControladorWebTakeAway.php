<?php

namespace App\Http\Controllers;

use App\Entidades\Carrito;
use App\Entidades\Carrito_producto;
use App\Entidades\Producto;
use App\Entidades\Sucursal;
use Illuminate\Http\Request;
use Session;

class ControladorWebTakeAway extends Controller
{
    public function index()
    {
        //Instancia la entidad producto
        $productos = new Producto();
        //Guardar en el array aProductos, todas los productos de la entidad
        $aProductos = $productos->obtenerTodos();
        // Instancia la entidad Sucursal
        $sucursal = new Sucursal();
        // Obtener todos los registros de la base de datos
        $aSucursales = $sucursal->obtenerTodos();
        //enviar por compact

        $idCliente = Session::get("idcliente");
        if ($idCliente > 0) {
            $carrito = new Carrito();
            $carrito->obtenerPorCliente($idCliente);

            if ($carrito->idcarrito > 0) {
                $carrito_producto = new Carrito_producto();
                $aCarritoProductos = $carrito_producto->obtenerPorCarrito($carrito->idcarrito);
                return view("web.take-away", compact('aProductos', 'aSucursales', 'aCarritoProductos'));
            }
        }
        return view("web.take-away", compact('aProductos', 'aSucursales'));
    }

    public function agregarCarrito(Request $request)
    {
        $idProducto = $request->input("txtIdProducto");
        $cantidad = $request->input("txtCantidad");
        //id del cliente
        $idCliente = Session::get("idcliente");

        if ($idCliente > 0) {

            $carrito = new Carrito();
            if (isset($_REQUEST["btnAumentar"])) {
                $cantidad++;
            }
            if (isset($_REQUEST["btnDisminuir"])) {
                if($cantidad > 0){
                    $cantidad--;
                }
            }

            if ($carrito->obtenerPorCliente($idCliente)) {

                $carrito_producto = new Carrito_producto();
                $carrito_producto->obtenerPorCarritoProducto($carrito->idcarrito, $idProducto);

                //Si existe el producto en el carrito, aumentamos la cantidad
                if ($carrito_producto->idcarrito_producto > 0) {
                    $carrito_producto->cantidad = $cantidad;
                    $carrito_producto->guardar($idProducto, $carrito->idcarrito);
                } else {
                    //Sino insertamos el producto en el carrito
                    $carrito_producto->fk_idproducto = $idProducto;
                    $carrito_producto->fk_idcarrito = $carrito->idcarrito;
                    $carrito_producto->cantidad = 1;
                    $carrito_producto->insertar();

                }
                return redirect("/take-away");

            } else {
                $carrito->fk_idcliente = $idCliente;
                $carrito->insertar();

                $carrito_producto = new Carrito_producto();
                $carrito_producto->fk_idproducto = $idProducto;
                $carrito_producto->fk_idcarrito = $carrito->idcarrito;
                $carrito_producto->cantidad = $cantidad;
                $carrito_producto->insertar();
                return redirect("/take-away");
            }

        } else {
            return redirect("/login");
        }

    }

}
