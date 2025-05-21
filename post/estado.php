<?php
include("../conection/config.php");

session_start();

if ($_SESSION['id']*1<1) {
	echo json_encode(array("respuesta"=>"Sin permisos","tipo"=>"danger"));
	}
$salida=array();

$nombre = isset($_REQUEST['nombre']) ? $_REQUEST['nombre'] : '';
$color = isset($_REQUEST['color']) ? $_REQUEST['color'] : '';

if (!empty($nombre) && !empty($color)) {
    $sql = "INSERT INTO `estados` (`nombre`, `color`) VALUES (?, ?)";
    $stmt = $mysqli->prepare($sql);
    $stmt->bind_param("ss", $nombre, $color);
    $stmt->execute();

    if ($stmt->affected_rows > 0) {
        echo json_encode(array("respuesta"=>"<strong>Exito!!</strong> Se ha ingresado el estado exitosamente!","tipo"=>"success"));
    } else {
        // Consider logging $stmt->error here for debugging
        echo json_encode(array("respuesta"=>"Error al grabar o datos no cambiados.","tipo"=>"danger"));
    }
    $stmt->close();
} else {
    echo json_encode(array("respuesta"=>"Nombre y color no pueden estar vacíos.","tipo"=>"warning"));
}
		
?>