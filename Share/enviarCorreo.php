<?php
require '../../Share/PhpMailer/src/PHPMailer.php';
require '../../Share/PhpMailer/src/SMTP.php';

    function correoClave( $correo, $usuario, $clave){
        //envio de correo
        $mail=new PHPMailer();
        $mail->CharSet = 'UTF-8';
        $body = "Usuario: ".$usuario.". Su contraseña a cambiado a: ".$clave." Gracias por preferirnos!";
        $mail->IsSMTP();
        $mail->Host       = 'smtp.gmail.com';
        $mail->SMTPSecure = 'tls';
        $mail->Port       = 587;
        $mail->SMTPDebug  = 1;
        $mail->SMTPAuth   = true;
        $mail->Username   = 'kanfevaluaciones@gmail.com';
        $mail->Password   = 'Kanf12345678';
        $mail->SetFrom('kanfevaluaciones@info.com', "KANF Evaluaciones");
        $mail->AddReplyTo('no-reply@info.com','no-reply');
        $mail->Subject    = 'Cambio de Contraseña';
        $mail->MsgHTML($body);

        $mail->AddAddress($correo);
        $mail->send();
    }

    function correoUsuario( $correo, $usuario, $clave, $nombre){
        //envio de correo
        //envio de correo
        $mail=new PHPMailer();
        $mail->CharSet = 'UTF-8';
        $body = "Sr./Sra. ".$nombre.". Sus Credenciales de Ingreso a nuestro portal con el usuario: ".$usuario." y contraseña: ".$clave." Gracias por preferirnos!";
        $mail->IsSMTP();
        $mail->Host       = 'smtp.gmail.com';
        $mail->SMTPSecure = 'tls';
        $mail->Port       = 587;
        $mail->SMTPDebug  = 1;
        $mail->SMTPAuth   = true;
        $mail->Username   = 'kanfevaluaciones@gmail.com';
        $mail->Password   = 'Kanf12345678';
        $mail->SetFrom('kanfevaluaciones@info.com', "KANF Evaluaciones");
        $mail->AddReplyTo('no-reply@info.com','no-reply');
        $mail->Subject    = 'Credenciales Registro';
        $mail->MsgHTML($body);

        $mail->AddAddress($correo);
        $mail->send();
    }

?>
