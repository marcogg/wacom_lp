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
//$_POST[ 'email' ] = 'jesherch2011@gmail.com';

if( isset( $_POST[ 'email' ] ) ) {
	flush();
	echo '<div style="font-family:Arial; font-size:13px;" align="center"><br>Enviando su email, espere por favor...</div>';
	
	$email_to = $_POST[ 'email' ];
	$alert_message = '¡¡Gracias por registrarte!!\nEn breve recibirás nuestra información al correo que proporcionaste.';
	
	$file_content	   = $_SERVER[ 'DOCUMENT_ROOT' ] . '/ecards/lead-Magnet-Testing-autoresponse.html';
	$file_read_content = file_get_contents( $file_content ); 
	
	//$file_attachment = $_SERVER[ 'DOCUMENT_ROOT' ] . '/ecards/lead-Magnet-Testing.pdf';
	//echo $email_to . '<br>';
	
	require 'PHPMailer/PHPMailerAutoload.php';
	$title = 'Newsletter - Lead Magnet';
	$alert_message = '-1';
	$mail = new PHPMailer;
	
	//$mail->SMTPDebug = 3;                               // Enable verbose debug output
	
	//$mail->isSMTP();                                      // Set mailer to use SMTP
	//$mail->Host = 'smtp1.example.com;smtp2.example.com';  // Specify main and backup SMTP servers
	//$mail->SMTPAuth = true;                               // Enable SMTP authentication
	//$mail->Username = 'user@example.com';                 // SMTP username
	//$mail->Password = 'secret';                           // SMTP password
	//$mail->SMTPSecure = 'tls';                            // Enable TLS encryption, `ssl` also accepted
	//$mail->Port = 587;                                    // TCP port to connect to
	
	$mail->setFrom( EMAIL_CONTACTO_FROM, $title );
	$mail->addAddress( $email_to );     								// Add a recipient
	//$mail->addAddress( 'jesherch2011@gmail.com' );     				// Add a recipient
	//$mail->addAddress( 'dg.adelice@hotmail.com' );     				// Add a recipient
	
	//$mail->addAddress( 'ellen@example.com' );               	// Name is optional
	//$mail->addReplyTo( 'info@example.com', 'Information' );
	//$mail->addCC( 'cc@example.com' );
	//$mail->addBCC( 'bcc@example.com' );
	
	//$mail->addAttachment( $file_attachment );         		// Add attachments
	//$mail->addAttachment('/tmp/image.jpg', 'new.jpg');    	// Optional name
	$mail->isHTML( true );                                  		// Set email format to HTML
	
	$mail->Subject = $title;
	$mail->Body    = $file_read_content . '<br><br>';
	//$mail->AltBody = 'This is the body in plain text for non-HTML mail clients';
	
	if( $mail->send() ) {
		$alert_message = '¡¡Gracias por registrarte!!\nEn breve recibirás nuestra información al correo que proporcionaste.';
	}
	
	
	//-------------------------------
	//-------Integracion con YMLP----
	//-------------------------------
	
	require_once("YMLP_API_CUSTOM.php");

	// variables: la clave del api y el usuario
	$ApiKey = "CMBR523QZ9JY0HBGQBWH";
	$ApiUsername = "sk08";
	$nombreGrupo = "LM Testing IT*";
	
	$ymlp = new YMLP_API_CUSTOM($ApiKey, $ApiUsername);
	
	$ymlp->AgregarALista($email_to, $ymlp->ListaGrupos($nombreGrupo));
	
	echo '	<script languaje="javascript">
				alert( "' . $alert_message . '" ); 
				location.href="' . $_SERVER['HTTP_REFERER'] . '";
			</script>';

	//echo "Agregando";
	//echo '<script type="text/javascript">alert("¡¡Gracias!!\n\n- Su Email se envió correctamente."); location.href="' . $_SERVER['HTTP_REFERER'] . '";</script>';
}
else {
	echo '<script type="text/javascript">location.href="/";</script>';
}
?>
</body>
</html>
