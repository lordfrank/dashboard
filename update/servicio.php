<?php
include("../conection/config.php");
session_start();

if ($_SESSION['id']*1<1) {
	echo json_encode(array("respuesta"=>"Sin permisos","tipo"=>"danger"));
	}
$salida=array();


		$nombre = mysqli_real_escape_string($mysqli,$_REQUEST['nombre']);
		$estado = mysqli_real_escape_string($mysqli,$_REQUEST['estado']);
		$id = mysqli_real_escape_string($mysqli,$_REQUEST['id']);
if (strlen($id)>0){		
$sql = "update  `servicios` set  `servicio`='$nombre', `estado`='$estado' where id=$id";

		$result=$mysqli->query($sql);
		 
		
		 echo json_encode(array("respuesta"=>"<strong>Exito!!</strong> Se ha actualizado el estado exitosamente!","tipo"=>"success")); 
}else
{
	 echo json_encode(array("respuesta"=>"No se ha realizado ninguna actualizacion","tipo"=>"info")); 
	 
	}
		
?>