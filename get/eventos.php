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
	

$sql="
SELECT z.evento_id id,min(z.id_servicio) id_servicio,z.evento_id, z.estado_id, z.fecha,(select max(x.fecha) from servicio_eventos x where x.evento_id=z.evento_id) fechafin,e.color,date(z.fecha) original,z.estado FROM `servicio_eventos` z,estados e where z.estado_id=e.id and z.id=z.evento_id and z.fecha>'".$fechai."'  group by z.evento_id";
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
		setlocale(LC_ALL, 'es_CL.UTF-8');
	date_default_timezone_set("America/Santiago");
		
$sql=	"SELECT if(max(last) is null,'Sin eventos recientes',UNIX_TIMESTAMP(max(last))) salida FROM `servicio_eventos` WHERE estado='vigente'";
$result=$mysqli->query($sql);
		$rows = $result->num_rows;
		
		if($rows > 0) {
			while($row = $result->fetch_assoc())
			{
				$salida3=$row["salida"];
				} 
		}
		if ($salida3!="Sin eventos recientes") {
		print json_encode(array("eventos"=>$salida,"estados"=>$salida2,"update"=>   strftime(" %e de %B de %G , %H:%M:%S ",$salida3*1) ));
		}else
		{
				print json_encode(array("eventos"=>$salida,"estados"=>$salida2,"update"=>  $salida3 ));	
			}
		
?>