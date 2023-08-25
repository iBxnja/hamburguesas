<?php

//Creación de controlador.

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Entidades\Sucursal;
use App\Entidades\Sistema\Usuario;
use App\Entidades\Sistema\Patente;
use App\Entidades\Sistema\Menu;
use App\Entidades\Sistema\MenuArea;
use App\Entidades\Pedido;
require app_path() . '/start/constants.php';

class ControladorSucursal extends Controller
{

    //function nuevo.
    public function nuevo()
    {
        $titulo = "Nueva Sucursal";
        if (Usuario::autenticado() == true) {
            //permiso "SUCURSALALTA", si ponemos SUCURSALALTA1 no nos deja, ya que
            //no tenemos ese permiso

            //si no tiene permiso "SUCURSALALTA"
            if (!Patente::autorizarOperacion("SUCURSALALTA")) {
                //entonces 
                $codigo = "SUCURSALALTA";
                //mensaje...
                $mensaje = "No tiene pemisos para la operación.";
                //y retorname a
                return view('sistema.pagina-error', compact('titulo', 'codigo', 'mensaje'));
            } else {
                //si no es asi...
                $sucursal = new Sucursal();
                return view('sucursal.sucursal-nuevo', compact('titulo', 'sucursal'));
            }
        } else {
            return redirect('admin/login');
        }
    }
    public function index()
    {
        $titulo = "Listado de sucursales";

        if (Usuario::autenticado() == true) {
            if (!Patente::autorizarOperacion("SUCURSALCONSULTA")) {
                $codigo = "SUCURSALCONSULTA";
                $mensaje = "No tiene permisos para la operación.";
                return view('sistema.pagina-error', compact('titulo', 'codigo', 'mensaje'));
            } else {
                return view("sucursal.sucursal-listar", compact("titulo"));
            }
        } else {
            return redirect('admin/login');
        }
    }


    public function guardar(Request $request){
        try {
            //Define la entidad servicio
            $titulo = "Modificar Sucursal";
            $entidad = new Sucursal();
            $entidad->cargarDesdeRequest($request);

            //validaciones
            if ($entidad->nombre == "" && 
                $entidad->telefono == "" && 
                $entidad->direccion == "" && 
                $entidad->horario == "" && 
                $entidad->linkmapa == "") {
                $msg["ESTADO"] = MSG_ERROR;
                $msg["MSG"] = "Complete todos los datos";
            } else {
                if ($_POST["id"] > 0) {
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
  
                $_POST["id"] = $entidad->idsucursal;
                return view('sucursal.sucursal-listar', compact('titulo', 'msg'));
            }
        } catch (Exception $e) {
            $msg["ESTADO"] = MSG_ERROR;
            $msg["MSG"] = ERRORINSERT;
        }

        $id = $entidad->idsucursal;
        $sucursal = new Sucursal();
        $sucursal->obtenerPorId($id);

        return view('sucursal.sucursal-nuevo', compact('msg', 'sucursal', 'titulo')) . '?id=' . $sucursal->sucursal;
    }


    public function cargarGrilla(){
        
        $request = $_REQUEST;
        //nueva sucursal
        $entidad = new Sucursal();
        $aSucursales = $entidad->obtenerFiltrado();


        $data = array();
        $cont = 0;

        $inicio = $request['start'];
        $registros_por_pagina = $request['length'];

        //bucle for.
        for ($i = $inicio; $i < count($aSucursales) && $cont < $registros_por_pagina; $i++) {
            $row = array();
            //¿que necesito mostrar?.
            $row[] = '<a href="/admin/sucursal/' . $aSucursales[$i]->idsucursal . '">' . $aSucursales[$i]->nombre . '</a>';
            $row[] = $aSucursales[$i]->telefono;
            $row[] = $aSucursales[$i]->direccion;
            $row[] = $aSucursales[$i]->linkmapa;
            $cont++;
            $data[] = $row;
        }

        $json_data = array(
            "draw" => intval($request['draw']),
            "recordsTotal" => count($aSucursales), //cantidad total de registros sin paginar
            "recordsFiltered" => count($aSucursales), //cantidad total de registros en la paginacion
            "data" => $data,
        );
        return json_encode($json_data);
    }

    public function editar($id){
        //titulo
        $titulo = "Editar sucursal";
        {
            if (Usuario::autenticado() == true) {
                if (!Patente::autorizarOperacion("SUCURSALEDITAR")) {
                    $codigo = "SUCURSALEDITAR";
                    $mensaje = "No tiene permisos para la operación.";
                    return view('sistema.pagina-error', compact('titulo', 'codigo', 'mensaje'));
                } else {
                    $sucursal = new Sucursal();
                    $sucursal->obtenerPorId($id);
                    return view("sucursal.sucursal-nuevo", compact("titulo", "sucursal"));
                }
            } else {
                return redirect('admin/login');
            }
        }
        //vuelve a la vista
        return view("sucursal.sucursal-nuevo", compact("titulo", "sucursal"));
    }

    public function eliminar(Request $request)
    {
        $id = $request->input('id');

        if (Usuario::autenticado() == true) {
            if (Patente::autorizarOperacion("SUCURSALBAJA")) {
    
                //Elimino si el producto no está asociado a un pedido
                $pedido = new Pedido();
                if(count($pedido->obtenerPorSucursal($id)) == 0){
                    $entidad = new Sucursal();
                    $entidad->cargarDesdeRequest($request);
                    $entidad->eliminar();
                    $aResultado["err"] = EXIT_SUCCESS; //eliminado correctamente
                } else {
                    $aResultado["err"] = "No se puede eliminar una sucursal con pedidos asociados.";
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
