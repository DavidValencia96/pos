<?php
include_once '../modelo/Usuario.php';
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

// Load Composer's autoloader
require '../vendor/autoload.php';

$usuario = new Usuario();
if($_POST['funcion']=='verificar'){
    $email = $_POST['email'];
    $dni = $_POST['dni'];
    $usuario->verificar($email,$dni);
}
if($_POST['funcion']=='recuperar'){
    $email = $_POST['email'];
    $dni = $_POST['dni'];
    $codigo = generar(10);
    $usuario->reemplazar($codigo,$email,$dni);
    
    // Instantiation and passing `true` enables exceptions
    $mail = new PHPMailer(true);

    try {
        //Server settings
        $mail->SMTPDebug = SMTP::DEBUG_SERVER;                      // Enable verbose debug output
        $mail->isSMTP();                                            // Send using SMTP
        $mail->Host       = 'smtp.gmail.com';                    // Set the SMTP server to send through
        $mail->SMTPAuth   = true;                                   // Enable SMTP authentication
        $mail->Username   = 'juan.valenciaor@amigo.edu.co';                     // SMTP username
        $mail->Password   = '1017237749Juan';                               // SMTP password
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;         // Enable TLS encryption; `PHPMailer::ENCRYPTION_SMTPS` encouraged
        $mail->Port       = 587;                                    // TCP port to connect to, use 465 for `PHPMailer::ENCRYPTION_SMTPS` above

        //Recipients
        $mail->setFrom('juan.valenciaor@amigo.edu.co', 'Sistema Administrativo Farmacia');
        $mail->addAddress($email);     // Add a recipient
        //$mail->addAddress('ellen@example.com');               // Name is optional
        //$mail->addReplyTo('info@example.com', 'Information');
        //$mail->addCC('cc@example.com');
        //$mail->addBCC('bcc@example.com');

        // Attachments
        //$mail->addAttachment('/var/tmp/file.tar.gz');         // Add attachments
        //$mail->addAttachment('/tmp/image.jpg', 'new.jpg');    // Optional name

        // Content
        $mail->isHTML(true);                                  // Set email format to HTML
        $mail->Subject = 'Restablecer contraseña';
        $mail->Body    = 'La nueva contraseña es: "<b>'.$codigo.'</b>". <br>Recuerde cambiar su contraseña
                            una vez entre al sitema. <br><br><br> Atentamente, <br><br> Equipo de soporte.';
        //$mail->AltBody = 'This is the body in plain text for non-HTML mail clients';
        $mail->SMTPDebug = false;//con esto evitamos que nos muestre el codigo en consola y debug
        $mail->do_debug=false;
        $mail->send();
        echo 'enviado';
    } 
    catch (Exception $e) {
        echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
    }
}

//metodo de generar codigo aleatorio
function generar($longitud){
    $key='';
    $patron='1234567890abcdefghijklmnopqrstuvwxyz-+/*!#$%&'; //carateres que tendra el codigo
    $max=strlen($patron)-1; //con este sabemos cuanto queremos que mida el codigo
    for($i=0;$i<$longitud;$i++){
        $key.=$patron{mt_rand(0,$max)};
    }
    return $key;
}

?>