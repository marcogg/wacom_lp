<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<title>Newsletter</title>
</head>

<body>
<?php 

error_reporting( E_ALL );

define( 'EMAIL_CONTACTO_FROM', 'info@testingit.com.mx' );
// $_POST[ 'email2' ] = '1@1.com.mx';

if( isset( $_POST[ 'email2' ] ) ) {
	flush();
	echo '<div style="font-family:Arial; font-size:13px;" align="center"><br>Enviando su email, espere por favor...</div>';
	
	$email_to = $_POST[ 'email2' ];
	$alert_message = '¡¡Gracias por registrarte!!\nEn breve recibirás nuestra información al correo que proporcionaste.';
	
	//-------------------------------
	//-------Integracion con YMLP----
	//-------------------------------
	
	require_once("YMLP_API_CUSTOM.php");

	// variables: la clave del api y el usuario
	$ApiKey = "CMBR523QZ9JY0HBGQBWH";
	$ApiUsername = "sk08";
	$nombreGrupo = "Testing IT*";
	
	$ymlp = new YMLP_API_CUSTOM($ApiKey, $ApiUsername);
	
	$ymlp->AgregarALista($email_to, $ymlp->ListaGrupos($nombreGrupo));
	
	echo '	<script languaje="javascript">
				alert( "' . $alert_message . '" ); 
				location.href="' . $_SERVER['HTTP_REFERER'] . '";
			</script>';

	//echo "Agregando";
	echo '<script type="text/javascript">alert("¡¡Gracias!!\n\n- Su Email se envió correctamente."); location.href="' . $_SERVER['HTTP_REFERER'] . '";</script>';
} else {
	echo '<script type="text/javascript">location.href="/";</script>';
}
?>
</body>
</html>
