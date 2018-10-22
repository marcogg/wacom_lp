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
if ($_POST['email-newsletter']) {
	// Obtener la variable de Email
	$email_to = trim( $_POST['email-newsletter'] );

	// Nombre del grupo para guardar el correo en la base de datos
	$grupo_ymlp = trim( $_POST['grupo-newsletter'] );

	//-------------------------------
	//------- Integracion con YMLP, Base de datos donde se guardan los correos ----
	//-------------------------------

	// Clase para enviar el email a la base de datos
	require_once('classes/YMLP_API_CUSTOM.php');

	// Enviar la clave de api y el usuario
	$ApiKey = "CMBR523QZ9JY0HBGQBWH";
	$ApiUsername = "sk08";

	// Instanciar la clase de correos
	$ymlp = new YMLP_API_CUSTOM($ApiKey, $ApiUsername);

	// Enviar el correo
	$output = $ymlp->AgregarALista($email_to, $ymlp->ListaGrupos($grupo_ymlp), $grupo_ymlp);
	//print_r($output);

	echo json_encode( $output );

	/*
	// Si se envio correctamente
	if ($output->success) {
		echo $output->successCode;
		echo $output->successMessage;
	} else {
		echo $output->errorMessage;

	}
	*/

}