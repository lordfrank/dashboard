<?php
include("../conection/config.php");

$salida=array();
 
$id_servicio = mysqli_real_escape_string($mysqli,$_REQUEST['servicio']);
$id = mysqli_real_escape_string($mysqli,$_REQUEST['id']);
$fechai = mysqli_real_escape_string($mysqli,$_REQUEST['fechai']);
 

if (strlen($id_servicio)>0) {
$sql="SELECT id_servicio,servicio_eventos.id,evento_id, max(estado_id) estado_id, min(fecha) fecha,max(fecha) fechafin,color,date(min(fecha)) original,servicio_eventos.estado,estado_evento,detalle  FROM `servicio_eventos`,estados where estado_id=estados.id and id_servicio=$id_servicio group by evento_id";

}else if (strlen($id)>0) {
	$sql="SELECT y.*,(select servicio from servicios where id=id_servicio) nombre_servicio,if (y.evento_id=y.id,'Nuevo evento',(select concat(fecha,'- ',estado_evento,' ', detalle) from servicio_eventos x where x.id=y.evento_id)) nombre_evento,date_format(fecha,'%H:%i') hora,date_format(fecha,'%Y-%m-%d') fechaformato   FROM `servicio_eventos` y,estados where estado_id=estados.id  and y.id=$id";
}else{
	
$sql="SELECT id_servicio,servicio_eventos.id,evento_id, max(estado_id) estado_id, min(fecha) fecha,max(fecha) fechafin,color,date(min(fecha)) original,servicio_eventos.estado  FROM `servicio_eventos`,estados where estado_id=estados.id and fecha>'".$fechai."' group by id_servicio,evento_id,servicio_eventos.id,color,servicio_eventos.estado";
}

		$result=$mysqli->query($sql);
		$rows = $result->num_rows;
		
		if($rows > 0) {
			while($row = $result->fetch_assoc())
			{
				$salida[]=$row;
				} 
		}
		
		
		$salida2=array();
 

 
$sql = "SELECT * FROM `estados` order by id asc";
 
		$result=$mysqli->query($sql);
		$rows = $result->num_rows;
		
		if($rows > 0) {
			while($row = $result->fetch_assoc())
			{
				$salida2[]=$row;
				} 
		}
		
		
		
		print json_encode(array("eventos"=>$salida,"estados"=>$salida2));
		
		
?>