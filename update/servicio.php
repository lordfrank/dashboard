<?php
include("../conection/config.php");
session_start();

if ($_SESSION['id']*1<1) {
	echo json_encode(array("respuesta"=>"Sin permisos","tipo"=>"danger"));
	}
$salida=array();

$id = isset($_REQUEST['id']) ? (int)$_REQUEST['id'] : 0;
$nombre = isset($_REQUEST['nombre']) ? $mysqli->real_escape_string($_REQUEST['nombre']) : '';
$estado = isset($_REQUEST['estado']) ? $mysqli->real_escape_string($_REQUEST['estado']) : '';

if ($id <= 0) {
    echo json_encode(array("respuesta"=>"ID de servicio no válido o no proporcionado.","tipo"=>"warning"));
    exit;
}

if (empty($nombre) || empty($estado)) {
    echo json_encode(array("respuesta"=>"El nombre del servicio y el estado no pueden estar vacíos.","tipo"=>"warning"));
    exit;
}

$sql = "UPDATE `servicios` SET `servicio` = ?, `estado` = ? WHERE `id` = ?";
$stmt = $mysqli->prepare($sql);

if ($stmt) {
    // Bind parameters: nombre (string), estado (string), id (integer)
    $stmt->bind_param("ssi", $nombre, $estado, $id);

    if ($stmt->execute()) {
        if ($stmt->affected_rows > 0) {
            echo json_encode(array("respuesta"=>"<strong>Exito!!</strong> Se ha actualizado el servicio exitosamente!","tipo"=>"success"));
        } else if ($stmt->affected_rows == 0) {
            echo json_encode(array("respuesta"=>"No se realizaron cambios en el servicio (datos idénticos o servicio no encontrado).","tipo"=>"info"));
        } else {
            // Should not happen for an UPDATE if execute() returned true
            echo json_encode(array("respuesta"=>"Error al actualizar, affected_rows reportó un valor inesperado.","tipo"=>"danger"));
        }
    } else {
        echo json_encode(array("respuesta"=>"Error al ejecutar la actualización del servicio: " . $stmt->error,"tipo"=>"danger"));
    }
    $stmt->close();
} else {
    echo json_encode(array("respuesta"=>"Error al preparar la consulta de actualización del servicio: " . $mysqli->error,"tipo"=>"danger"));
}
		
?>