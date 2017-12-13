<?php
include("../conection/config.php");

$salida=array();

$id = mysqli_real_escape_string($mysqli,$_REQUEST['id']);
$nombre = mysqli_real_escape_string($mysqli,$_REQUEST['nombre']);
$color = mysqli_real_escape_string($mysqli,$_REQUEST['color']);
$estado = mysqli_real_escape_string($mysqli,$_REQUEST['estado']);
		
$sql = "update  `estados`  set `nombre`='$nombre', `color`='$color', estado='$estado' where id=$id ";
$result=$mysqli->query($sql);
 if ($mysqli->affected_rows>0){		 
echo json_encode(array("respuesta"=>"<strong>Exito!!</strong> Se ha actualizado el estado exitosamente!","tipo"=>"success")); 
 }else{
		  echo json_encode(array("respuesta"=>"No se realizo la actualizacion","tipo"=>"info")); 	 
 }
?>