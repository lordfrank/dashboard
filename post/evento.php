<?php
include("../conection/config.php");

$salida=array();


		$evento_id = mysqli_real_escape_string($mysqli,$_REQUEST['evento']);
		$id_servicio = mysqli_real_escape_string($mysqli,$_REQUEST['servicio']);
	    $fecha = mysqli_real_escape_string($mysqli,$_REQUEST['fecha']);
		$hora = mysqli_real_escape_string($mysqli,$_REQUEST['hora']);
		$estado_id = mysqli_real_escape_string($mysqli,$_REQUEST['estado_evento']);
		$detalle = mysqli_real_escape_string($mysqli,$_REQUEST['detalle']);
	
		
$sql = "INSERT INTO `servicio_eventos` ( `id_servicio`, `fecha`, `estado_evento`, `detalle`,`estado_id`, `evento_id`) VALUES ( '$id_servicio', '$fecha $hora', (SELECT nombre FROM `estados` where id=$estado_id), '$detalle',  '$estado_id', '$evento_id')";
        
		$result=$mysqli->query($sql);
		$id=$mysqli->insert_id ;
		if ($id>0) {
			
		$sql = "update  `servicio_eventos`  set evento_id=$id where id=$id and evento_id=0";
		$result=$mysqli->query($sql);
		
		$sql = "update  `servicios`  set estado_id=$estado_id, estado_servicio=(SELECT nombre FROM `estados` where id=$estado_id) where id=$id_servicio ";
		$result=$mysqli->query($sql);
		
		 echo json_encode(array("respuesta"=>"exito")); 
		}else{
			 echo json_encode(array("respuesta"=>"error:".$sql)); 
			}
		
?>