<?php
include("../conection/config.php");
session_start();

if ($_SESSION['id']*1<1) {
	echo json_encode(array("respuesta"=>"Sin permisos","tipo"=>"danger"));
	}
$salida=array();

$id = mysqli_real_escape_string($mysqli,$_REQUEST['id']);
$nombre = mysqli_real_escape_string($mysqli,$_REQUEST['nombre']);
$mail = mysqli_real_escape_string($mysqli,$_REQUEST['mail']);
$login = mysqli_real_escape_string($mysqli,$_REQUEST['login']);
$password = mysqli_real_escape_string($mysqli,$_REQUEST['password']);
$estado = mysqli_real_escape_string($mysqli,$_REQUEST['estado']);
if ($id==1){
	$estado="vigente";
	}
if (strlen($password)>0){
	$pass =password_hash($password, PASSWORD_DEFAULT);
	$sql = "update  `usuarios`  set `login`='$login',`nombre`='$nombre', `mail`='$mail', pass='$pass',estado='$estado' where id=$id ";
}else{
	$sql = "update  `usuarios`  set `login`='$login',`nombre`='$nombre', `mail`='$mail', estado='$estado' where id=$id ";
}
$result=$mysqli->query($sql);
 if ($mysqli->affected_rows>0){		 
		echo json_encode(array("respuesta"=>"<strong>Exito!!</strong> Se ha actualizado el usuario exitosamente!","tipo"=>"success")); 
 }else{
		echo json_encode(array("respuesta"=>"No se realizo la actualizacion","tipo"=>"info")); 	 
 }
?>