<?php
/**
 * Created by PhpStorm.
 * User: jherrera
 * Date: 18/01/17
 * Time: 10:08 AM
 */

// Mostrar errores, si existen
error_reporting(E_ALL);

// Archivo de configuración para Emails
require_once("config_emails.php");

// Si el campo email ha sido enviado
if (isset($_POST)) {
	// Cliente
	$cliente = trim($_POST['cliente']);

	require 'PHPMailer/PHPMailerAutoload.php';
	//Create a new PHPMailer instance

	$mail = new PHPMailer(true);

	// Set PHPMailer to use the sendmail transport
	//$mail->isSendmail();

	//Set who the message is to be sent from
	$mail->setFrom(EMAIL_CONTACTO_FROM);

	//Set an alternative reply-to address
	//$mail->addReplyTo('replyto@example.com', 'First Last');

	//Set who the message is to be sent to
	$mail->addAddress(EMAIL_CONTACTO_TO);

	// Chartset
	$mail->CharSet = "UTF-8";

	// Type

	// Enviar los mails con copia
	foreach ($email_contacto_array as $key => $value) {
		$mail->addAddress($value);
	}

	// Contenido de datos
	$contacto = strtoupper( 'Contacto - ' . $cliente );
	$html = '<strong>' . $contacto . '</strong><br><br>';
	foreach ($_POST as $key2 => $value2) {
		if( strtolower( $key2 ) != "submit" && strtolower( $key2 ) != 'cliente' ) {
			$keyNew = str_replace( "-", " ", $key2 );

			$html .= "<strong>" . strtoupper( $keyNew ) . ": </strong>" . strtoupper( $value2 ) . '<br>';
		}
	}

	//echo $html;

	//Set the subject line
	$mail->Subject = $contacto;
	$mail->AltBody = $contacto;
	$mail->Body = $html;
	$mail->IsHTML(true);

	//print_r($_POST);

	//send the message, check for errors
	if (!$mail->send()) {
		echo json_encode( array( "success" => 0, "errorMessage" => $mail->ErrorInfo ) );
		//echo "Mailer Error: " . $mail->ErrorInfo;
	}
	else {
		echo json_encode( array( "success" => 1, "errorMessage" => "" ) );
	}
}