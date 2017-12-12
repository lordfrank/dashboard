<?php
include("../conection/config.php");

$salida=array();


		$nombre = mysqli_real_escape_string($mysqli,$_REQUEST['nombre']);
		$color = mysqli_real_escape_string($mysqli,$_REQUEST['color']);
		
$sql = "INSERT INTO `estados` (`nombre`, `color`) VALUES ( '$nombre', '$color')";

		$result=$mysqli->query($sql);
		 
		
		echo json_encode(array("respuesta"=>"exito")); 
		 
		
?>