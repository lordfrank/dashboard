<?php
include("../conection/config.php");
session_start();

if ($_SESSION['id']*1<1) {
	echo json_encode(array("respuesta"=>"Sin permisos","tipo"=>"danger"));
	}
$salida=array();


		$nombre = mysqli_real_escape_string($mysqli,$_REQUEST['nombre']);
		$login = mysqli_real_escape_string($mysqli,$_REQUEST['login']);
		$password = mysqli_real_escape_string($mysqli,$_REQUEST['password']);
		$mail = mysqli_real_escape_string($mysqli,$_REQUEST['mail']);
		$pass =password_hash($password, PASSWORD_DEFAULT);
$sql = "INSERT INTO `usuarios` ( `login`, `pass`,  `nombre`, mail) VALUES ('$login', '$pass', '$nombre','$mail')";

		$result=$mysqli->query($sql);
		 
		 if ($mysqli->affected_rows>0){	
		 	echo json_encode(array("respuesta"=>"<strong>Exito!!</strong> Se ha ingresado el usuario exitosamente!","tipo"=>"success")); 
		 }else
		 {
			   echo json_encode(array("respuesta"=>"Error al grabar:".$mysqli->error,"tipo"=>"danger"));  
			   
			 }
		
?>