<?php
namespace Models;

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require '..' . DIRECTORY_SEPARATOR . 'vendor' . DIRECTORY_SEPARATOR . 'phpmailer' . DIRECTORY_SEPARATOR . 'phpmailer' . DIRECTORY_SEPARATOR . 'src' . DIRECTORY_SEPARATOR . 'Exception.php';
require '..' . DIRECTORY_SEPARATOR . 'vendor' . DIRECTORY_SEPARATOR . 'phpmailer' . DIRECTORY_SEPARATOR . 'phpmailer' . DIRECTORY_SEPARATOR . 'src' . DIRECTORY_SEPARATOR . 'PHPMailer.php';
require '..' . DIRECTORY_SEPARATOR . 'vendor' . DIRECTORY_SEPARATOR . 'phpmailer' . DIRECTORY_SEPARATOR . 'phpmailer' . DIRECTORY_SEPARATOR . 'src' . DIRECTORY_SEPARATOR . 'SMTP.php';

class Correo_modelo
{
    /**
     * @brief Envía un correo electrónico a la dirección especificada.
     *
     * @param string $email Dirección de correo electrónico del destinatario.
     * @param string $nombre Nombre del destinatario.
     * @param string $subjet Asunto del correo electrónico.
     * @param string $cuerpo Cuerpo del correo electrónico. Opcional, por defecto está vacío.
     *
     * @return void
     */
    public static function enviar_correo($email, $nombre, $subjet, $cuerpo = "")
    {
        $mail = new PHPMailer(true);
        try {
            //Server settings
            $mail->CharSet = 'UTF-8';
            $mail->Encoding = 'base64';
            $mail->isSMTP(); //Send using SMTP
            $mail->SMTPDebug = 0;
            $mail->SMTPAuth = true;
            $mail->Host = 'b21-daw2d-iesteis-gal.correoseguro.dinaserver.com'; //Set the SMTP server to send through
            $mail->SMTPAuth = true; //Enable SMTP authentication
            $mail->Username = 'bricoteis@b21.daw2d.iesteis.gal'; //SMTP username
            $mail->Password = 'Messi11.'; //SMTP password
            $mail->SMTPSecure = 'tls'; //Enable implicit TLS encryption
            $mail->Port = 587; //TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`
//Recipients
            $mail->setFrom('bricoteis@b21.daw2d.iesteis.gal', 'BricoTeis SL');
            $mail->addAddress($email, $nombre); //Add a recipient
//Content
            $mail->isHTML(true); //Set email format to HTML
            $mail->Subject = $subjet;
            $mail->Body = $cuerpo;
            //$mail->AltBody = 'This is the body in plain text for non-HTML mail clients';
            $mail->send();
        } catch (Exception $e) {
            echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
        }
    }
}
?>