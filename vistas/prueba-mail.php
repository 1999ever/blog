<?php

$destinatario = "fabete5259@inbov03.com";
$asunto = "prueba de email";
$mensaje = "Esto es una prueba";

$exito = mail($destinatario, $asunto, $mensaje);

if ($exito) {
    echo 'email enviado';
} else {
    echo 'envio fallido';
}

//SMTP