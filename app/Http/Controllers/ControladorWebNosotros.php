<?php

namespace App\Http\Controllers;

use App\Entidades\Postulacion;
use App\Entidades\Sucursal;
use Illuminate\Http\Request;

require app_path().'/start/constants.php';

class ControladorWebNosotros extends Controller
{
    public function index()
    {   
        $sucursal = new Sucursal();
        // Obtener todos los registros de la base de datos
        $aSucursales = $sucursal->obtenerTodos();
        return view("web.nosotros", compact('aSucursales'));
    }

    public function guardar(Request $request){
        
        try {

            $postulacion = new Postulacion();
            $nombre = "";
            $postulacion->cargarDesdeRequest($request);
            
            if ($_FILES["archivoCV"]["error"] === UPLOAD_ERR_OK)
            { //Se adjunta archivo
                $extension = pathinfo($_FILES["archivoCV"]["name"], PATHINFO_EXTENSION);
                $nombre = date("Ymdhmsi") . ".$extension";
                $archivo = $_FILES["archivoCV"]["tmp_name"];
                move_uploaded_file($archivo, env('APP_PATH') . "/public/files/$nombre"); //guarda el archivo
            }
            
            $postulacion->curriculum = $nombre;

            $postulacion->insertar();

            $msg["ESTADO"] = MSG_SUCCESS;
            $msg["MSG"] = OKINSERT;

        } catch (Exception $e) {
            $msg["ESTADO"] = MSG_ERROR;
            $msg["MSG"] = ERRORINSERT;
        }

        return view("web.nosotros-gracias", compact('msg'));
    }

}
