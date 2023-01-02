<?php
//require 'PHPMailer/PHPMailerAutoload.php';
require 'PHPMailer/class.phpmailer.php';
require "PHPMailer/class.smtp.php"; 
//echo 'hola';exit;
function sendemail($codigo,$correo){
	$mail = new PHPMailer;
	$mail->isSMTP();                            // Establecer el correo electrónico para utilizar SMTP
	$mail->Host = 'smtp.gmail.com';             // Especificar el servidor de correo a utilizar 
	//$mail->Host = 'localhost';             // Especificar el servidor de correo a utilizar 
	$mail->SMTPAuth = true;                     // Habilitar la autenticacion con SMTP
	$mail->Username = 'speedservicetym@gmail.com';          // Correo electronico saliente ejemplo: tucorreo@gmail.com
	$mail->Password = 'wwaqhqxppiswetqq'; 		// Tu contraseña de gmail
	$mail->SMTPSecure = 'tls';                  // Habilitar encriptacion, `ssl` es aceptada
	$mail->Port = 587;                          // Puerto TCP  para conectarse 
	$mail->setFrom('speedservicetym@gmail.com');//Introduzca la dirección de la que debe aparecer el correo electrónico. Puede utilizar cualquier dirección que el servidor SMTP acepte como válida. El segundo parámetro opcional para esta función es el nombre que se mostrará como el remitente en lugar de la dirección de correo electrónico en sí.
	$mail->addReplyTo('speedservicetym@gmail.com');//Introduzca la dirección de la que debe responder. El segundo parámetro opcional para esta función es el nombre que se mostrará para responder
	$mail->addAddress($correo);   // Agregar quien recibe el e-mail enviado
	/*$message = file_get_contents($template);
	$message = str_replace('{{first_name}}', $mail_setFromName, $message);
	$message = str_replace('{{message}}', $txt_message, $message);
	$message = str_replace('{{customer_email}}', $mail_setFromEmail, $message);*/
	$mail->isHTML(true);  // Establecer el formato de correo electrónico en HTML
	
	$mail->Subject = 'CODIGO DE VERIFICACION';
	$mail->msgHTML('ESTE ES EL CODIGO DE VERIFICACION "'.$codigo.'"');
	
	if(!$mail->send()) {
		return false;
	}else{
		return true;
	}
}
?>