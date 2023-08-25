<?php

namespace App\Http\Controllers;

use App\Entidades\Carrito;
use App\Entidades\Carrito_Producto;
use App\Entidades\Cliente;
use App\Entidades\Pedido;
use App\Entidades\Pedido_Producto;
use App\Entidades\Sucursal;
use Illuminate\Http\Request;
use MercadoPago\Item;
use MercadoPago\Payer;
use MercadoPago\Preference;
use MercadoPago\SDK;
use Session;

class ControladorWebCarrito extends Controller
{
    public function index()
    {
        $sucursal = new Sucursal();
        $aSucursales = $sucursal->obtenerTodos();
        $idCliente = Session::get("idcliente");

        if ($idCliente > 0) {
            $carrito = new Carrito();
            $carrito->obtenerPorCliente($idCliente);

            $carrito_producto = new Carrito_producto();
            $aCarritoProductos = $carrito_producto->obtenerPorCarrito($carrito->idcarrito);

            return view("web.carrito", compact('aSucursales', 'aCarritoProductos'));
        }
    }

    public function agregarCarrito(Request $request)
    {
        if (isset($_REQUEST["btnFinalizar"])) {
            $this->finalizarPedido($request);
            exit;
        }
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
                if ($cantidad > 0) {
                    $cantidad--;
                }
            }

            if ($carrito->obtenerPorCliente($idCliente)) {

                $carrito_producto = new Carrito_producto();
                $carrito_producto->obtenerPorCarritoProducto($carrito->idcarrito, $idProducto);

                //Si existe el producto en el carrito, aumentamos la cantidad
                if ($carrito_producto->idcarrito_producto > 0) {

                    if ($cantidad > 0) {
                        $carrito_producto->cantidad = $cantidad;
                        $carrito_producto->guardar($idProducto, $carrito->idcarrito);
                    } else {
                        $carrito_producto->eliminar();
                    }
                } else {
                    //Sino insertamos el producto en el carrito
                    $carrito_producto->fk_idproducto = $idProducto;
                    $carrito_producto->fk_idcarrito = $carrito->idcarrito;
                    $carrito_producto->cantidad = 1;
                    $carrito_producto->insertar();

                }
                return redirect("/carrito");

            } else {
                $carrito->fk_idcliente = $idCliente;
                $carrito->insertar();

                $carrito_producto = new Carrito_producto();
                $carrito_producto->fk_idproducto = $idProducto;
                $carrito_producto->fk_idcarrito = $carrito->idcarrito;
                $carrito_producto->cantidad = $cantidad;
                $carrito_producto->insertar();
                return redirect("/carrito");
            }

        } else {
            return redirect("/login");
        }

    }

    public function finalizarPedido(Request $request)
    {
        $idSucursal = $request->input('lstSucursal');
        $medioDePago = $request->input('lstMedioDePago');
        $descripcion = $request->input('txtDescripcion');
        $idCliente = Session::get('idcliente');

        $carrito = new Carrito();
        $carrito->obtenerPorCliente($idCliente);

        $carrito_producto = new Carrito_producto();
        $carritoProductos = $carrito_producto->obtenerPorCarrito($carrito->idcarrito);

        $total = 0;
        foreach ($carritoProductos as $carritoProducto) {
            $total = $carritoProducto->precio * $carritoProducto->cantidad;
        }

        $pedido = new Pedido();
        $pedido->fecha = date("Y-m-d H:m:s");
        $pedido->descripcion = $descripcion;
        $pedido->total = $total;
        $pedido->fk_idsucursal = $idSucursal;
        $pedido->fk_idcliente = $idCliente;

        if ($medioDePago == "efectivo") {
            $pedido->fk_idestado = 1;
        } else {
            $pedido->fk_idestado = 5;
        }

        foreach ($carritoProductos as $carritoProducto) {
            $pedidoProducto = new Pedido_Producto();
            $pedidoProducto->cantidad = $carritoProducto->cantidad;
            $pedidoProducto->precio_unitario = $carritoProducto->precio;
            $pedidoProducto->total = $carritoProducto->cantidad * $carritoProducto->precio;
            $pedidoProducto->fk_idpedido = $pedido->idpedido;
            $pedidoProducto->fk_idproducto = $carritoProducto->fk_idproducto;
            $pedidoProducto->insertar();
        }
        if ($medioDePago == "efectivo") {
            return redirect("/mi-cuenta");
        } else {
            //El pago es por MercadoPago
            $access_token = ""; //Buscarlo en la coonfiguración de la web de MP
            SDK::setClientId(config("payment-methods.mercadopago.client"));
            SDK::setClientSecret(config("payment-methods.mercadopago.secret"));
            SDK::setAccessToken($access_token); //Es el token de la cuenta de MP donde se deposita el dinero

//Armado del producto ‘item’
            $item = new Item();
            $item->id = $pedido->idpedido;
            $item->title = "Burger SRL";
            $item->category_id = "products";
            $item->quantity = 1;
            $item->unit_price = $total;
            $item->currency_id = "ARS"; //”COP”

            $preference = new Preference();
            $preference->items = array($item);

            //Datos del comprador
            $payer = new Payer();
            $cliente = new Cliente();
            $cliente->obtenerPorId($idCliente);

            $payer->name = $cliente->nombre;
            $payer->surname = $cliente->apellido;
            $payer->email = $cliente->correo;
            $payer->date_created = date('Y-m-d H:m:s');
            $payer->identification = array(
                "type" => "Otro", //DNI, CC
                "number" => $cliente->documento,
            );
            $preference->payer = $payer;

            //URL de configuración para indicarle a MP
            $preference->back_urls = [
                "success" => "http://127.0.0.1:8000/mercado-pago/aprobado/" . $pedido->idpedido,
                "pending" => "http://127.0.0.1:8000/mercado-pago/pendiente/" . $pedido->idpedido,
                "failure" => "http://127.0.0.1:8000/mercado-pago/error/" . $pedido->idpedido,
            ];

            $preference->payment_methods = array("installments" => 6);
            $preference->auto_return = "all";
            $preference->notification_url = '';
            $preference->save(); //Ejecuta la transacción

        }

    }

}
