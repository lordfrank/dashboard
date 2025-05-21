<?php
include("../conection/config.php");

$salida=array();
$id = isset($_REQUEST['id']) ? $_REQUEST['id'] : '';

if (strlen($id) > 0) {
    $sql = "SELECT * FROM servicios WHERE id = ?";
    $stmt = $mysqli->prepare($sql);
    $stmt->bind_param("s", $id);
} else {
    $sql = "SELECT servicios.id, servicios.servicio, estados.color, servicios.estado_servicio, servicios.estado, servicios.estado_id 
            FROM servicios, estados 
            WHERE estados.id = estado_id 
            ORDER BY servicio ASC";
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
		
		print json_encode(array("servicios"=>$salida));
		

?>