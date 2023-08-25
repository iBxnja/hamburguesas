<?php

namespace App\Http\Controllers;

use App\Entidades\Sistema\Patente;
use App\Entidades\Sistema\Usuario;
use Illuminate\Http\Request;

require app_path() . '/start/constants.php';

class ControladorPatente extends Controller
{
    public function index()
    {
        $titulo = "Patentes";
        if (Usuario::autenticado() == true) {
            if (!Patente::autorizarOperacion("PATENTESCONSULTA")) {
                $codigo = "PATENTESCONSULTA";
                $mensaje = "No tiene permisos para la operaci&oacute;n.";
                return view('sistema.pagina-error', compact('titulo', 'codigo', 'mensaje'));
            } else {
                return view('sistema.patente-listar', compact('titulo'));
            }
        } else {
            return redirect('admin/login');
        }
    }

    public function cargarGrilla()
    {
        $request = $_REQUEST;

        $entidadPatente = new Patente();
        $aPatentes = $entidadPatente->obtenerFiltrado(); //preguntar si puede ser 'obtenerTodosPorFamilia'

        $data = array();

        $inicio = $request['start'];
        $registros_por_pagina = $request['length'];

        if (count($aPatentes) > 0) {
            $cont = 0;
        }

        for ($i = $inicio; $i < count($aPatentes) && $cont < $registros_por_pagina; $i++) {
            $row = array();
            $row[] = $aPatentes[$i]->nombre;
            $row[] = $aPatentes[$i]->modulo;
            $row[] = $aPatentes[$i]->submodulo;
            $row[] = $aPatentes[$i]->descripcion;
            $row[] = "<a href='/admin/patente/nuevo/" . $aPatentes[$i]->idpatente . "'><i class='fas fa-search'></i></a>";
            $cont++;
            $data[] = $row;
        }

        $json_data = array(
            "draw" => intval($request['draw']),
            "recordsTotal" => count($aPatentes), //cantidad total de registros sin paginar
            "recordsFiltered" => count($aPatentes), //cantidad total de registros en la paginacion
            "data" => $data,
        );
        return json_encode($json_data);
    }

    public function nuevo()
    {
        $titulo = "Nueva Patente";
        if (Usuario::autenticado() == true) {
            if (!Patente::autorizarOperacion("PATENTEALTA")) {
                $codigo = "PATENTEALTA";
                $mensaje = "No tiene pemisos para la operaci&oacute;n.";
                return view('sistema.pagina-error', compact('titulo', 'codigo', 'mensaje'));
            } else {
                $patente = new Patente();
                return view('sistema.patente-nuevo', compact('patente', 'titulo'));
            }
        } else {
            return redirect('admin/login');
        }
    }

    public function editar($id)
    {
        $titulo = "Modificar Patente";
        if (Usuario::autenticado() == true) {
            if (!Patente::autorizarOperacion("PATENTESMODIFICACION")) {
                $codigo = "PATENTESMODIFICACION";
                $mensaje = "No tiene pemisos para la operaci&oacute;n.";
                return view('sistema.pagina-error', compact('titulo', 'codigo', 'mensaje'));
            } else {
                $patente = new Patente();
                $patente->obtenerPorId($id);

                return view('sistema.patente-nuevo', compact('patente', 'titulo'));
            }
        } else {
            return redirect('admin/login');
        }
    }

    public function guardar(Request $request)
    {
        try {
            //Define la entidad servicio
            $titulo = "Modificar patente";
            $entidad = new Patente();
            $entidad->cargarDesdeRequest($request);

            //validaciones
            if ($entidad->nombre == "") {
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
                $_POST["id"] = $entidad->idpatente;
                return view('sistema.patente-listar', compact('titulo', 'msg'));
            }
        } catch (Exception $e) {
            $msg["ESTADO"] = MSG_ERROR;
            $msg["MSG"] = ERRORINSERT;
        }

        $id = $entidad->idpatente;
        $patente = new Patente();
        $patente->obtenerPorId($id);

        return view('sistema.patente-nuevo', compact('msg', 'patente', 'titulo')) . '?id=' . $patente->idpatente;
    }

    public function eliminar(Request $request)
    {
        if (Usuario::autenticado() == true) {
            if (Patente::autorizarOperacion("PATENTESBAJA")) {
                $entidad = new Patente();
                $entidad->cargarDesdeRequest($request);
                $entidad->eliminar();
                $aResultado["err"] = EXIT_SUCCESS; //eliminado correctamente

            } else {
                $codigo = "PATENTESBAJA";
                $aResultado["err"] = "No tiene pemisos para la operaci&oacute;n.";
            }
            echo json_encode($aResultado);
        } else {
            return redirect('admin/login');
        }
    }
}
