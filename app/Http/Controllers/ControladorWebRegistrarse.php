<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Entidades\Sistema\Usuario;
use App\Entidades\Cliente;
use App\Entidades\Sucursal;
require app_path().'/start/constants.php';

class ControladorWebRegistrarse extends Controller
{
    public function index()
    {
        $request = new Cliente();
        $sucursal = new Sucursal();

        $aSucursales = $sucursal->obtenerTodos();
        return view("web.registrarse", compact('request', "aSucursales"));
    }

    public function guardar(Request $request)
    {
        try{   
        
            if($request->txtNombre!='' && $request->txtApellido!='' && $request->txtCelular!='' && $request->txtCorreo!='' && $request->txtClave!='' && $request->txtRepetir!=''){

                    $verificar = strcmp($request->txtClave, $request->txtRepetir);
                    
                    if($verificar === 0 ){
                    $cliente = new  Cliente();
                    
                    $cliente->cargarDesdeRequest($request);
                    $claveEncriptada = $cliente->encriptarClave($request->txtClave);
                    $cliente->clave = $claveEncriptada;

                    
                    if($cliente->verificarMail($cliente->correo)==null){ 

                            $cliente->insertar();
                            $msg["ESTADO"] = MSG_SUCCESS;
                            $msg["MSG"] = OKINSERT;
                            return view("web.login", compact('msg'));
                    
                    }else{
                        $msg["ESTADO"] = MSG_ERROR;
                        $msg["MSG"] = 'El correo ya esta vinculado a otro cliente';
                        return view("web.registrarse", compact('msg','request'));
                    }
                
                }else{
                    $msg["ESTADO"] = MSG_ERROR;
                        $msg["MSG"] = 'La contraseña no coincide';
                        return view("web.registrarse", compact('msg','request'));
                }
            }else{
                $msg["ESTADO"] = MSG_ERROR;
                $msg["MSG"] = 'Faltan datos, complete los campos que faltan';
                return view("web.registrarse", compact('msg','request'));
            }
        }catch(Exception $e){
         return view("web.registrarse", compact('request'));
        }
    }
}
