<?php
include("../conection/config.php");

$salida=array();
$codigo = isset($_REQUEST['codigo']) ? (int)$_REQUEST['codigo'] : 0;

if ($codigo > 0) {
    $sql = "SELECT color, fecha, detalle, (SELECT servicio FROM servicios WHERE servicios.id = id_servicio) AS servicio, servicio_eventos.estado 
            FROM `servicio_eventos`, estados  
            WHERE estado_id = estados.id AND (servicio_eventos.evento_id = ? OR servicio_eventos.id = ?)  
            ORDER BY fecha DESC";
    $stmt = $mysqli->prepare($sql);
    $stmt->bind_param("ii", $codigo, $codigo);
} else {
    $sql = "SELECT * FROM `servicio_eventos` ORDER BY servicio_eventos.evento_id DESC";
    $stmt = $mysqli->prepare($sql);
}

		$stmt->execute();
		$result = $stmt->get_result();
		$rows = $result->num_rows;
		
		if($rows > 0) {
			while($row = $result->fetch_assoc())
			{
				$salida[]=$row;
				} 
		}
		
		print json_encode(array("eventos"=>$salida));
		
?>