<?php
include("../conection/config.php");

$salida=array();


		$evento_id = mysqli_real_escape_string($mysqli,$_REQUEST['evento']);
		$id_servicio = mysqli_real_escape_string($mysqli,$_REQUEST['servicio']);
	    $fecha = mysqli_real_escape_string($mysqli,$_REQUEST['fecha']);
		$hora = mysqli_real_escape_string($mysqli,$_REQUEST['hora']);
		$estado_id = mysqli_real_escape_string($mysqli,$_REQUEST['estado']);
		$detalle = mysqli_real_escape_string($mysqli,$_REQUEST['detalle']);
		$estado_evento = mysqli_real_escape_string($mysqli,$_REQUEST['estado_evento']);
		$id = mysqli_real_escape_string($mysqli,$_REQUEST['id']);
		$estado = mysqli_real_escape_string($mysqli,$_REQUEST['estado']);
		
$sql = "update  `servicio_eventos`  set `fecha`='$fecha $hora', `estado_evento`= (SELECT nombre FROM `estados` where id=$estado_evento), `detalle`='$detalle',`estado_id`='$estado_evento', estado='$estado' where id=$id ";
        
		$result=$mysqli->query($sql);
	 
 if ($mysqli->affected_rows>0){
		
		 echo json_encode(array("respuesta"=>"<strong>Exito!!</strong> Se ha actualizado el estado exitosamente!","tipo"=>"success")); 
 }else
 {
	  echo json_encode(array("respuesta"=>"No se ha realizado ninguna actualizacion","tipo"=>"info")); 
	 }
	 
	   
		 
		
?>