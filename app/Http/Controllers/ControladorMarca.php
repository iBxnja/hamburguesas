<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Entidades\Marca;
use App\Entidades\Sistema\Patente;
use App\Entidades\Sistema\Usuario;
use App\Entidades\Producto;

require app_path() . '/start/constants.php';

class ControladorMarca extends Controller
{
    public function nuevo()
    {

        $titulo = "Nueva marca";
        if (Usuario::autenticado() == true) {
            if (!Patente::autorizarOperacion("MARCAALTA")) {
                $codigo = "MARCAALTA";
                $mensaje = "No tiene pemisos para la operación.";
                return view('sistema.pagina-error', compact('titulo', 'codigo', 'mensaje'));
            } else {
                $marca = new Marca();
                return view('marca.marca-nuevo', compact('titulo', 'marca'));
            }
        } else {
            return redirect('admin/login');
        }

    }

    public function index()
    {
        $titulo = "Listado de marcas";

        if (Usuario::autenticado() == true) {
            if (!Patente::autorizarOperacion("MARCACONSULTA")) {
                $codigo = "MARCACONSULTA";
                $mensaje = "No tiene permisos para la operación.";
                return view('sistema.pagina-error', compact('titulo', 'codigo', 'mensaje'));
            } else {
                return view("marca.marca-listar", compact("titulo"));
            }
        } else {
            return redirect('admin/login');
        }
    }


    public function guardar(Request $request){
      try {
          //Define la entidad servicio
          $titulo = "Modificar marca";
          $entidad = new Marca();
          $entidad->cargarDesdeRequest($request);

          //validaciones
          if ($entidad->nombre == "" ) {
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

              $_POST["id"] = $entidad->idmarca;
              return view('marca.marca-listar', compact('titulo', 'msg'));
          }
      } catch (Exception $e) {
          $msg["ESTADO"] = MSG_ERROR;
          $msg["MSG"] = ERRORINSERT;
      }

      $id = $entidad->idmarca;
      $marca = new Marca();
      $marca->obtenerPorId($id);

      return view('marca.marca-nuevo', compact('msg', 'marca', 'titulo')) . '?id=' . $marca->idmarca;
    }
    public function cargarGrilla()
    {
        $request = $_REQUEST;

        $entidad = new Marca();
        $aMarcas = $entidad->obtenerFiltrado();

        $data = array();
        $cont = 0;

        $inicio = $request['start'];
        $registros_por_pagina = $request['length'];

        for ($i = $inicio; $i < count($aMarcas) && $cont < $registros_por_pagina; $i++) {
            $row = array();
            $row[] = '<a href="/admin/marca/' . $aMarcas[$i]->idmarca . '">' . $aMarcas[$i]->nombre . '</a>';
            $cont++;
            $data[] = $row;
        }

        $json_data = array(
            "draw" => intval($request['draw']),
            "recordsTotal" => count($aMarcas), //cantidad total de registros sin paginar
            "recordsFiltered" => count($aMarcas), //cantidad total de registros en la paginacion
            "data" => $data,
        );
        return json_encode($json_data);
    }
    
    public function editar($id){

        $titulo = "Editar marca";

        if (Usuario::autenticado() == true) {
            if (!Patente::autorizarOperacion("MARCAEDITAR")) {
                $codigo = "MARCAEDITAR";
                $mensaje = "No tiene pemisos para la operaci&oacute;n.";
                return view('sistema.pagina-error', compact('titulo', 'codigo', 'mensaje'));
            } else {
                $marca = new Marca();
                $marca->obtenerPorId($id);
                return view("marca.marca-nuevo", compact("titulo", "marca"));
            }
        } else {
            return redirect('admin/login');
        }
    }

    public function eliminar(Request $request)
    {
        $id = $request->input('id');

        if (Usuario::autenticado() == true) {
            if (Patente::autorizarOperacion("MARCAELIMINAR")) {

                //Elimino si el producto no está asociado a un pedido
                $producto = new Producto();
                if(count($producto->obtenerPorMarca($id)) == 0){
                    $entidad = new Marca();
                    $entidad->cargarDesdeRequest($request);
                    $entidad->eliminar();
                    $aResultado["err"] = EXIT_SUCCESS; //eliminado correctamente
                } else {
                    $aResultado["err"] = "No se puede eliminar una marca con productos asociados.";
                }
            } else {
                $codigo = "MARCAELIMINAR";
                $aResultado["err"] = "No tiene pemisos para la operaci&oacute;n.";
            }
 
        } else {
            $aResultado["err"] = "Usuario no logueado.";
        }
        echo json_encode($aResultado);
    }


}
