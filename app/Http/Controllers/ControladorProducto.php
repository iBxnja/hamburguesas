<?php

namespace App\Http\Controllers;

use App\Entidades\Categoria;
use App\Entidades\Marca;
use App\Entidades\Pedido;
use App\Entidades\Producto;
use App\Entidades\Sistema\Patente;
use App\Entidades\Sistema\Usuario;
use Illuminate\Http\Request;

require app_path() . '/start/constants.php';

class ControladorProducto extends Controller
{
    public function nuevo()
    {
        $titulo = "Nuevo producto";
        if (Usuario::autenticado() == true) {
            if (!Patente::autorizarOperacion("PRODUCTOSALTA")) {
                $codigo = "PRODUCTOSALTA";
                $mensaje = "No tiene pemisos para la operación.";
                return view('sistema.pagina-error', compact('titulo', 'codigo', 'mensaje'));
            } else {
                $marca = new Marca();
                $array_marcas = $marca->obtenerTodos();

                $categoria = new Categoria();
                $array_categorias = $categoria->obtenerTodos();

                $producto = new Producto();
                return view('producto.producto-nuevo', compact('titulo', "producto", "array_marcas", "array_categorias"));
            }
        } else {
            return redirect('admin/login');

        }
    }

    public function index()
    {
        $titulo = "Listado de productos";

        if (Usuario::autenticado() == true) { // :: es método estático
            if (!Patente::autorizarOperacion("PRODUCTOCONSULTA")) {
                $codigo = "PRODUCTOCONSULTA"; //busco el código en listado de patentes
                $mensaje = "No tiene permisos para la operación.";
                return view('sistema.pagina-error', compact('titulo', 'codigo', 'mensaje'));
            } else {
                return view("producto.producto-listar", compact("titulo"));
            }
        } else {
            return redirect('admin/login');
        }
    }

    public function guardar(Request $request)
    {
        try {
            //Define la entidad servicio
            $titulo = "Modificar producto";
            $entidad = new Producto();
            $entidad->cargarDesdeRequest($request);
            
            if($_FILES["archivo"]["error"] === UPLOAD_ERR_OK) { //Se agrega imagen
               $extension = pathinfo($_FILES["archivo"]["name"], PATHINFO_EXTENSION);
               $nombre = date("Ymdhmsi") . ".$extension";
               $archivo = $_FILES["archivo"]["tmp_name"];
               move_uploaded_file($archivo, env('APP_PATH') . "/public/files/$nombre"); //guardaelarchivo
               $entidad->imagen = $nombre;
            }
     
            //validaciones
            if ($entidad->nombre == "" || $entidad->cantidad == "" || $entidad->precio == "" || $entidad->fk_idcategoria == "" || $entidad->fk_idmarca == "") {
                $msg["ESTADO"] = MSG_ERROR;
                $msg["MSG"] = "Complete todos los datos";
            } else {
                if ($_POST["id"] > 0) {
                    $productAnt = new Producto();
                    $productAnt->obtenerPorId($entidad->idproducto);

                    if ($_FILES["archivo"]["error"] === UPLOAD_ERR_OK) {
                        //Eliminar imagen anterior
                        @unlink(env('APP_PATH') . "/public/files/$productAnt->imagen");
                    } else {
                        $entidad->imagen = $productAnt->imagen;
                    }

                    //Es actualizacion
                    $entidad->guardar();

                    $msg["ESTADO"] = MSG_SUCCESS;
                    $msg["MSG"] = OKINSERT;
                } else {
                    //Es nuevo
                    $entidad->insertar();

                    $msg["ESTADO"] = MSG_SUCCESS;
                    $msg["MSG"] = OKINSERT;
                }

                $_POST["id"] = $entidad->idproducto;
                return view('producto.producto-listar', compact('titulo', 'msg'));
            }
        } catch (Exception $e) {
            $msg["ESTADO"] = MSG_ERROR;
            $msg["MSG"] = ERRORINSERT;
        }

        $id = $entidad->idproducto;
        $cliente = new Producto();
        $cliente->obtenerPorId($id);

        $marca = new Marca();
        $array_marcas = $marca->obtenerTodos();

        $categoria = new Categoria();
        $array_categorias = $categoria->obtenerTodos();

        return view('producto.producto-nuevo', compact('msg', 'producto', 'titulo', "array_marcas", "array_categorias")) . '?id=' . $producto->idproducto;
    }
    public function cargarGrilla()
    {
        $request = $_REQUEST;

        $entidad = new Producto();
        $aProductos = $entidad->obtenerFiltrado();

        $data = array();
        $cont = 0;

        $inicio = $request['start'];
        $registros_por_pagina = $request['length'];

        for ($i = $inicio; $i < count($aProductos) && $cont < $registros_por_pagina; $i++) {
            $row = array();
            $row[] = '<a href="/admin/producto/' . $aProductos[$i]->idproducto . '">' . $aProductos[$i]->nombre . '</a>';
            $row[] = $aProductos[$i]->cantidad;
            $row[] = $aProductos[$i]->precio;
            $row[] = "<img src='/files/".$aProductos[$i]->imagen."' class='img-thumbnail'/>";
            $row[] = $aProductos[$i]->descripcion;
            $cont++;
            $data[] = $row;
        }

        $json_data = array(
            "draw" => intval($request['draw']),
            "recordsTotal" => count($aProductos), //cantidad total de registros sin paginar
            "recordsFiltered" => count($aProductos), //cantidad total de registros en la paginacion
            "data" => $data,
        );
        return json_encode($json_data);
    }

    public function editar($id)
    {
        $titulo = "Editar producto";

        if (Usuario::autenticado() == true) {
            if (!Patente::autorizarOperacion("PRODUCTOEDITAR")) {
                $codigo = "PRODUCTOEDITAR";
                $mensaje = "No tiene pemisos para la operación.";
                return view('sistema.pagina-error', compact('titulo', 'codigo', 'mensaje'));
            } else {

                $marca = new Marca();
                $array_marcas = $marca->obtenerTodos();

                $categoria = new Categoria();
                $array_categorias = $categoria->obtenerTodos();

                $producto = new Producto();
                $producto->obtenerPorId($id);
                return view("producto.producto-nuevo", compact("titulo", "producto", "array_marcas", "array_categorias"));
            }
        } else {
            return redirect('admin/login');
        }
    }

    public function eliminar(Request $request)
    {
        $id = $request->input('id');

        if (Usuario::autenticado() == true) {
            if (Patente::autorizarOperacion("PRODUCTOELIMINAR")) {

                //Elimino si el producto no está asociado a un pedido
                $pedido = new Pedido();
                if (count($pedido->obtenerPorProducto($id)) == 0) {
                    $entidad = new Producto();
                    $entidad->cargarDesdeRequest($request);
                    $entidad->eliminar();
                    $aResultado["err"] = EXIT_SUCCESS; //eliminado correctamente
                } else {
                    $aResultado["err"] = "No se puede eliminar un producto con pedidos asociados.";
                }
            } else {
                $aResultado["err"] = "No tiene pemisos para la operación.";
            }

        } else {
            $aResultado["err"] = "Usuario no logueado.";
        }
        echo json_encode($aResultado);
    }
}
