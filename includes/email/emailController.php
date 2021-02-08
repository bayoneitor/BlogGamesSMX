<?php

require_once 'vendor/autoload.php';
require_once 'dbh.inc.php';
// Create the Transport
$transport = (new Swift_SmtpTransport('smtp.gmail.com', 465, 'ssl'))
    //la contraseña y el usuario estan en dbh.inc.php
    ->setUsername(EMAIL)
    ->setPassword(PASSWORD);

// Create the Mailer using your created Transport
$mailer = new Swift_Mailer($transport);

//----------------Verificacion Email
function sendVerificationEmail($email, $token)
{
    //tengo que poner el siguiente codigo para que reconozca el comando
    global $mailer;

    $body = '<!DOCTYPE html>
    <html lang="en">
    
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <title>Verifica el correo</title>
    </head>
    
    <body>
        <div class="wrapper">
            <p>Gracias por registrarte en nuestra página web. Por favor haz clic en el enlace de abajo para verificar tu correo electrónico.
            </p>
            <a href=http://25.63.114.63/BlogGames/user/verify_email.php?token=' . $token . ' > Verifica tu correo electronico</a>
    
        </div>
    </body>
    
    </html>';
    // Create a message
    $message = (new Swift_Message('Confirma tu correo electrónico'))
        ->setFrom(EMAIL)
        ->setTo($email)
        ->setBody($body, 'text/html');

    // Send the message
    $result = $mailer->send($message);
}

//----------------RecuperarContraseña
function sendRecoveryPasswordEmail($userEmail, $url)
{
    //tengo que poner el siguiente codigo para que reconozca el comando
    global $mailer;

    $body = '<!DOCTYPE html>
    <html lang="en">
    
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <title>Verifica el correo</title>
    </head>
    
    <body>
        <p>Hemos recibido una solicitud de restablecimiento de contraseña. El enlace para restablecer su contraseña está abajo. 
            Si usted no hizo esta solicitud, puede ignorar este correo electrónico.</p>
        <p> Aquí está su enlace de reinicio de contraseña:</p>
        <p> <a href="'.$url.'"> Recuperar contraseña </a></p>
    </body>
    
    </html>';
    // Aquí ponemos el titulo
    $message = (new Swift_Message('Reiniciar Contraseña'))
        ->setFrom(EMAIL)
        ->setTo($userEmail)
        ->setBody($body, 'text/html');

    // Send the message
    $result = $mailer->send($message);
}
