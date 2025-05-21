<?php

session_start();

// Ensure session ID exists and is valid before using it.
if (!isset($_SESSION['id']) || (int)$_SESSION['id'] < 1) {
    echo json_encode(array("respuesta"=>"Sin permisos","tipo"=>"danger"));
    // It's good practice to exit here if permissions are denied.
    exit; 
}

include("../conection/config.php");

$salida=array();
$id = isset($_REQUEST['id']) ? $_REQUEST['id'] : '';

if (strlen($id) > 0) {
    $sql = "SELECT id, login, nombre, mail, estado FROM `usuarios` WHERE id = ?";
    $stmt = $mysqli->prepare($sql);
    $stmt->bind_param("s", $id);
} else {
    $sql = "SELECT id, login, nombre, mail, estado FROM `usuarios` ORDER BY id ASC";
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
		
		print json_encode(array("usuarios"=>$salida));
		
?>
