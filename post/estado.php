<?php
include("../conection/config.php");

$salida=array();


		$nombre = mysqli_real_escape_string($mysqli,$_REQUEST['nombre']);
		$color = mysqli_real_escape_string($mysqli,$_REQUEST['color']);
		
$sql = "INSERT INTO `estados` (`nombre`, `color`) VALUES ( '$nombre', '$color')";

		$result=$mysqli->query($sql);
		 
	 if ($mysqli->affected_rows>0){	
		echo json_encode(array("respuesta"=>"<strong>Exito!!</strong> Se ha ingresado el estado exitosamente!","tipo"=>"success")); 
	 }else
	 {
		   echo json_encode(array("respuesta"=>"error al grabar  ","tipo"=>"danger")); 
		 }
		
?>