<?php
include("../conection/config.php");

$salida=array();


		$nombre = mysqli_real_escape_string($mysqli,$_REQUEST['nombre']);
		$estado = mysqli_real_escape_string($mysqli,$_REQUEST['estado']);
		$estado_id = mysqli_real_escape_string($mysqli,$_REQUEST['estado_id']);
		
$sql = "INSERT INTO `servicios` ( `servicio`, `estado_servicio`,  `estado_id`) VALUES ('$nombre', (SELECT nombre FROM `estados` where id=1), 1)";

		$result=$mysqli->query($sql);
		 
		
		 echo json_encode(array("respuesta"=>"exito")); 
		 
		
?>