<?php
$nombre = $_POST['Name'];
$email = $_POST['email'];
$asunto = $_POST['subject'];
$telefono = $_POST['phone'];
$servicio = $_POST['select-service'];
$mensaje = $_POST['message'];
$correo = "Esta informacion fue recolectada desde el sitio de MC <br/>"
          ."Nombre del Prospecto:"."<br/>".$nombre. "<br/>"
          ."Correo:"."<br/>". $email. "<br/>"
          ."Asunto:"."<br/>".$asunto. "<br/>"
          ."Telefono:"."<br/>". $telefono. "<br/>"
          ."Servicio de interes:"."<br/>". $servicio. "<br/>"
          ."Mensaje:"."<br/>". $mensaje;

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'PHPMailer/Exception.php';
require 'PHPMailer/PHPMailer.php';
require 'PHPMailer/SMTP.php';

$mail = new PHPMailer(true);

try {
    //Server settings
    $mail->SMTPDebug = 0;                                       //Enable verbose debug output
    $mail->isSMTP();                                            //Send using SMTP
    $mail->Host       = 'mail.ingarqmc.com.mx';                 //Set the SMTP server to send through
    $mail->SMTPAuth   = true;                                   //Enable SMTP authentication
    $mail->Username   = 'rsociales@ingarqmc.com.mx';            //SMTP username
    $mail->Password   = 'Sociales.123';                         //SMTP password
    $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;            //Enable implicit TLS encryption
    $mail->Port       = 465;                                    //TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`

    
    $mail->setFrom('rsociales@ingarqmc.com.mx', 'Nuevo prospecto de MC');//remitente (quien envia)
    $mail->addAddress('proyectos@ingarqmc.com.mx', 'Sitio de MC');     //aquien se envia

    //Content
    $mail->isHTML(true);                                  //Set email format to HTML
    $mail->Subject = $asunto;
    $mail->Body    = $correo;
    $mail->AltBody = 'This is the body in plain text for non-HTML mail clients';

    $mail->send();
    echo '
    <script>
	alert ("Gracias por enviar su informacion, en breve nos pondremos en contacto");
	window.history.go(-1);
	</script>
	';
} catch (Exception $e) {
    echo "Hubo un error al enviar correo: {$mail->ErrorInfo}";
}

?>