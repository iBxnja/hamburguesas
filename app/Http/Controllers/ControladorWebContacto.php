<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Entidades\Sucursal;
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

class ControladorWebContacto extends Controller
{
    public function index()
    {   
        $sucursal = new Sucursal();

        $aSucursales = $sucursal->obtenerTodos();
        return view("web.contacto", compact("aSucursales"));
    }

    public function enviar(Request $request){
        $nombre = $request->input("txtNombre");
        $correo = $request->input("txtCorreo");
        $telefono = $request->input("txtTelefono");
        $mensaje = $request->input("txtMensaje");
        
        //Instancia y configuraciones de PHPMailer
        $mail = new PHPMailer(true);
        $mail->SMTPDebug = 0;
        $mail->isSMTP();
        $mail->Host = env('MAIL_HOST');
        $mail->SMTPAuth = true;
        $mail->Username = env('MAIL_USERNAME');
        $mail->Password = env('MAIL_PASSWORD');
        $mail->SMTPSecure = env('MAIL_ENCRYPTION');
        $mail->Port = env('MAIL_PORT');

        //Remitente
        $mail->setFrom("admin@burger.com", "Burger"); //Dirección desde
        
        //Destinatarios
        $mail->addAddress("admin@burger.com"); //Dirección para
        $mail->addReplyTo($correo); //Dirección de reply no-reply
        $mail->addBCC($correo); //Dirección de CCO

        //Contenido del mail
        $mail->isHTML(true);
        $mail->Subject = "Has recibido un mensaje desde la página web";
        $mail->Body = "Nombre: $nombre<br>
                       Correo: $correo<br>
                       Teléfono: $telefono<br>
                       Mensaje:<br>$mensaje
                       ";
        //$mail->send();
        $sucursal = new Sucursal();
        $aSucursales = $sucursal->obtenerTodos();
        return view("web.contacto-gracias", compact("aSucursales"));
    }
}
