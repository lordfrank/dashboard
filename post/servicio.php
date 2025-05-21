<?php
include("../conection/config.php");
session_start();

if (!isset($_SESSION['id']) || (int)$_SESSION['id'] < 1) {
    echo json_encode(array("respuesta"=>"Sin permisos","tipo"=>"danger"));
    exit; 
}
$salida=array();

$nombre = isset($_REQUEST['nombre']) ? $_REQUEST['nombre'] : ''; // mysqli_real_escape_string removed
// $estado = isset($_REQUEST['estado']) ? $mysqli->real_escape_string($_REQUEST['estado']) : ''; // Not used in current logic
// $estado_id_req = isset($_REQUEST['estado_id']) ? (int)$_REQUEST['estado_id'] : 0; // Not used in current logic

if (empty($nombre)) {
    echo json_encode(array("respuesta"=>"El nombre del servicio no puede estar vacío.","tipo"=>"warning"));
    exit;
}

// Fetch the 'estado_servicio' name for estado_id = 1, as per original logic
$estado_servicio_nombre = '';
$hardcoded_estado_id = 1;
$sql_estado_nombre = "SELECT nombre FROM `estados` WHERE id = ?";
$stmt_estado_nombre = $mysqli->prepare($sql_estado_nombre);
$stmt_estado_nombre->bind_param("i", $hardcoded_estado_id);
$stmt_estado_nombre->execute();
$result_estado_nombre = $stmt_estado_nombre->get_result();
if ($row_estado = $result_estado_nombre->fetch_assoc()) {
    $estado_servicio_nombre = $row_estado['nombre'];
}
$stmt_estado_nombre->close();

if (empty($estado_servicio_nombre)) {
    // This case should ideally not happen if estado with ID 1 always exists and has a name
    echo json_encode(array("respuesta"=>"Error: No se pudo determinar el nombre del estado predeterminado.","tipo"=>"danger"));
    exit;
}

$sql_insert = "INSERT INTO `servicios` (`servicio`, `estado_servicio`, `estado_id`) VALUES (?, ?, ?)";
$stmt_insert = $mysqli->prepare($sql_insert);
// Bind parameters: $nombre (string), $estado_servicio_nombre (string), $hardcoded_estado_id (integer)
$stmt_insert->bind_param("ssi", $nombre, $estado_servicio_nombre, $hardcoded_estado_id);

if ($stmt_insert->execute()) {
    if ($stmt_insert->affected_rows > 0) {
        echo json_encode(array("respuesta"=>"<strong>Exito!!</strong> Se ha ingresado el servicio exitosamente!","tipo"=>"success"));
    } else {
        // This might happen if the query executes but nothing is inserted (e.g. unique constraint violation, though not expected here)
        echo json_encode(array("respuesta"=>"Servicio no ingresado, es posible que ya exista o no se hayan realizado cambios.","tipo"=>"warning"));
    }
} else {
    // Consider logging $stmt_insert->error for debugging
    echo json_encode(array("respuesta"=>"Error al grabar en la base de datos: " . $stmt_insert->error,"tipo"=>"danger"));
}
$stmt_insert->close();
		
?>