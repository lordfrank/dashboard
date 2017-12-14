<?php
include("../conection/config.php");
session_start();

if ($_SESSION['id']*1<1) {
	echo json_encode(array("respuesta"=>"Sin permisos","tipo"=>"danger"));
	}
$salida=array();


		$nombre = mysqli_real_escape_string($mysqli,$_REQUEST['nombre']);
		$estado = mysqli_real_escape_string($mysqli,$_REQUEST['estado']);
		$estado_id = mysqli_real_escape_string($mysqli,$_REQUEST['estado_id']);
		
$sql = "INSERT INTO `servicios` ( `servicio`, `estado_servicio`,  `estado_id`) VALUES ('$nombre', (SELECT nombre FROM `estados` where id=1), 1)";

		$result=$mysqli->query($sql);
		 
		 if ($mysqli->affected_rows>0){	
		 echo json_encode(array("respuesta"=>"<strong>Exito!!</strong> Se ha ingresado el servicio exitosamente!","tipo"=>"success")); 
		 }else
		 {
			   echo json_encode(array("respuesta"=>"Error al grabar","tipo"=>"danger"));  
			   
			 }
		
?>