<?php
include("../conection/config.php");
session_start();

if ($_SESSION['id']*1<1) {
	echo json_encode(array("respuesta"=>"Sin permisos","tipo"=>"danger"));
	}
$salida=array();

$id = isset($_REQUEST['id']) ? (int)$_REQUEST['id'] : 0;
$nombre = isset($_REQUEST['nombre']) ? $mysqli->real_escape_string($_REQUEST['nombre']) : '';
$color = isset($_REQUEST['color']) ? $mysqli->real_escape_string($_REQUEST['color']) : '';
$estado = isset($_REQUEST['estado']) ? $mysqli->real_escape_string($_REQUEST['estado']) : ''; // Assuming 'estado' is a string field

if ($id <= 0) {
    echo json_encode(array("respuesta"=>"ID de estado no válido o no proporcionado.","tipo"=>"warning"));
    exit;
}

if (empty($nombre) || empty($color) || empty($estado)) {
    echo json_encode(array("respuesta"=>"Nombre, color y estado no pueden estar vacíos.","tipo"=>"warning"));
    exit;
}

$sql = "UPDATE `estados` SET `nombre` = ?, `color` = ?, `estado` = ? WHERE `id` = ?";
$stmt = $mysqli->prepare($sql);

if ($stmt) {
    // Bind parameters: nombre (string), color (string), estado (string), id (integer)
    $stmt->bind_param("sssi", $nombre, $color, $estado, $id);

    if ($stmt->execute()) {
        if ($stmt->affected_rows > 0) {
            echo json_encode(array("respuesta"=>"<strong>Exito!!</strong> Se ha actualizado el estado exitosamente!","tipo"=>"success"));
        } else if ($stmt->affected_rows == 0) {
            echo json_encode(array("respuesta"=>"No se realizaron cambios en el estado (datos idénticos o estado no encontrado).","tipo"=>"info"));
        } else {
             // Should not happen for an UPDATE if execute() returned true, but as a fallback
            echo json_encode(array("respuesta"=>"Error al actualizar, affected_rows reportó un valor inesperado.","tipo"=>"danger"));
        }
    } else {
        echo json_encode(array("respuesta"=>"Error al ejecutar la actualización: " . $stmt->error,"tipo"=>"danger"));
    }
    $stmt->close();
} else {
    echo json_encode(array("respuesta"=>"Error al preparar la consulta de actualización: " . $mysqli->error,"tipo"=>"danger"));
}
?>