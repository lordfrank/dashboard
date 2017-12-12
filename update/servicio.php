<?php
include("../conection/config.php");

$salida=array();


		$nombre = mysqli_real_escape_string($mysqli,$_REQUEST['nombre']);
		$estado = mysqli_real_escape_string($mysqli,$_REQUEST['estado']);
		$id = mysqli_real_escape_string($mysqli,$_REQUEST['id']);
if (strlen($id)>0){		
$sql = "update  `servicios` set  `servicio`='$nombre', `estado`='$estado' where id=$id";

		$result=$mysqli->query($sql);
		 
		
		 echo json_encode(array("respuesta"=>"exito")); 
}else
{
	 echo json_encode(array("respuesta"=>"Error!!")); 
	 
	}
		
?>