<?php
include("../conection/config.php");
session_start();

if ($_SESSION['id']*1<1) {
	echo json_encode(array("respuesta"=>"Sin permisos","tipo"=>"danger"));
	}
$salida=array();

// Input validation and sanitization
$id = isset($_REQUEST['id']) ? (int)$_REQUEST['id'] : 0;
$fecha = isset($_REQUEST['fecha']) ? $_REQUEST['fecha'] : '';
$hora = isset($_REQUEST['hora']) ? $_REQUEST['hora'] : '';
$estado_evento_id = isset($_REQUEST['estado_evento']) ? (int)$_REQUEST['estado_evento'] : 0; // ID for state lookup and 'estado_id' column
$detalle = isset($_REQUEST['detalle']) ? $mysqli->real_escape_string($_REQUEST['detalle']) : '';
$estado_string = isset($_REQUEST['estado']) ? $mysqli->real_escape_string($_REQUEST['estado']) : ''; // Textual status e.g. "vigente"

// Unused variables from original code, kept for reference, can be removed
// $evento_id = isset($_REQUEST['evento']) ? $mysqli->real_escape_string($_REQUEST['evento']) : '';
// $id_servicio = isset($_REQUEST['id_servicio']) ? $mysqli->real_escape_string($_REQUEST['id_servicio']) : '';


if ($id <= 0) {
    echo json_encode(array("respuesta"=>"ID de evento no válido o no proporcionado.","tipo"=>"warning"));
    exit;
}

if (empty($fecha) || empty($hora) || $estado_evento_id <= 0 || empty($estado_string)) {
    echo json_encode(array("respuesta"=>"Datos incompletos. Fecha, hora, estado del evento y estado (string) son requeridos.","tipo"=>"warning"));
    exit;
}

// Fetch estado_nombre for 'estado_evento' column
$estado_evento_nombre = '';
$sql_estado_nombre = "SELECT nombre FROM `estados` WHERE id = ?";
$stmt_estado_nombre = $mysqli->prepare($sql_estado_nombre);

if (!$stmt_estado_nombre) {
    echo json_encode(array("respuesta"=>"Error al preparar consulta de nombre de estado: " . $mysqli->error,"tipo"=>"danger"));
    exit;
}
$stmt_estado_nombre->bind_param("i", $estado_evento_id);
$stmt_estado_nombre->execute();
$result_estado_nombre = $stmt_estado_nombre->get_result();
if ($row_estado = $result_estado_nombre->fetch_assoc()) {
    $estado_evento_nombre = $row_estado['nombre'];
}
$stmt_estado_nombre->close();

if (empty($estado_evento_nombre)) {
    echo json_encode(array("respuesta"=>"Estado (para 'estado_evento') no válido o no encontrado.","tipo"=>"danger"));
    exit;
}

$fecha_completa = "$fecha $hora";

$sql_update = "UPDATE `servicio_eventos` SET `fecha` = ?, `estado_evento` = ?, `detalle` = ?, `estado_id` = ?, `estado` = ? WHERE `id` = ?";
$stmt_update = $mysqli->prepare($sql_update);

if ($stmt_update) {
    // Bind parameters: fecha_completa (string), estado_evento_nombre (string), detalle (string), estado_evento_id (int), estado_string (string), id (int)
    $stmt_update->bind_param("sssisi", $fecha_completa, $estado_evento_nombre, $detalle, $estado_evento_id, $estado_string, $id);

    if ($stmt_update->execute()) {
        if ($stmt_update->affected_rows > 0) {
            echo json_encode(array("respuesta"=>"<strong>Exito!!</strong> Se ha actualizado el evento exitosamente!","tipo"=>"success"));
        } else if ($stmt_update->affected_rows == 0) {
            echo json_encode(array("respuesta"=>"No se realizaron cambios en el evento (datos idénticos o evento no encontrado).","tipo"=>"info"));
        } else {
            echo json_encode(array("respuesta"=>"Error al actualizar, affected_rows reportó un valor inesperado.","tipo"=>"danger"));
        }
    } else {
        echo json_encode(array("respuesta"=>"Error al ejecutar la actualización del evento: " . $stmt_update->error,"tipo"=>"danger"));
    }
    $stmt_update->close();
} else {
    echo json_encode(array("respuesta"=>"Error al preparar la consulta de actualización del evento: " . $mysqli->error,"tipo"=>"danger"));
}
?>