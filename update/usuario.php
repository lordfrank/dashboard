<?php
include("../conection/config.php");
session_start();

if ($_SESSION['id']*1<1) {
	echo json_encode(array("respuesta"=>"Sin permisos","tipo"=>"danger"));
	}
$salida=array();

$id = isset($_REQUEST['id']) ? (int)$_REQUEST['id'] : 0;
$nombre = isset($_REQUEST['nombre']) ? $mysqli->real_escape_string($_REQUEST['nombre']) : '';
$mail = isset($_REQUEST['mail']) ? $mysqli->real_escape_string($_REQUEST['mail']) : '';
$login = isset($_REQUEST['login']) ? $mysqli->real_escape_string($_REQUEST['login']) : '';
$password = isset($_REQUEST['password']) ? $_REQUEST['password'] : ''; // Do not escape password before hashing, if provided
$estado = isset($_REQUEST['estado']) ? $mysqli->real_escape_string($_REQUEST['estado']) : '';

if ($id <= 0) {
    echo json_encode(array("respuesta"=>"ID de usuario no válido o no proporcionado.","tipo"=>"warning"));
    exit;
}

if (empty($nombre) || empty($mail) || empty($login) || empty($estado)) {
    echo json_encode(array("respuesta"=>"Nombre, mail, login y estado no pueden estar vacíos.","tipo"=>"warning"));
    exit;
}

if (!filter_var($mail, FILTER_VALIDATE_EMAIL)) {
    echo json_encode(array("respuesta"=>"Formato de correo electrónico no válido.","tipo"=>"warning"));
    exit;
}

// Special condition for user ID 1
if ($id == 1) {
    $estado = "vigente";
}

$params = array();
$types = "";

if (strlen($password) > 0) {
    $pass_hashed = password_hash($password, PASSWORD_DEFAULT);
    if ($pass_hashed === false) {
        echo json_encode(array("respuesta"=>"Error al procesar la contraseña.","tipo"=>"danger"));
        exit;
    }
    $sql = "UPDATE `usuarios` SET `login` = ?, `nombre` = ?, `mail` = ?, `pass` = ?, `estado` = ? WHERE `id` = ?";
    $types = "sssssi"; // login, nombre, mail, pass_hashed, estado, id
    $params[] = $login;
    $params[] = $nombre;
    $params[] = $mail;
    $params[] = $pass_hashed;
    $params[] = $estado;
    $params[] = $id;
} else {
    $sql = "UPDATE `usuarios` SET `login` = ?, `nombre` = ?, `mail` = ?, `estado` = ? WHERE `id` = ?";
    $types = "ssssi"; // login, nombre, mail, estado, id
    $params[] = $login;
    $params[] = $nombre;
    $params[] = $mail;
    $params[] = $estado;
    $params[] = $id;
}

$stmt = $mysqli->prepare($sql);

if ($stmt) {
    $stmt->bind_param($types, ...$params);

    if ($stmt->execute()) {
        if ($stmt->affected_rows > 0) {
            echo json_encode(array("respuesta"=>"<strong>Exito!!</strong> Se ha actualizado el usuario exitosamente!","tipo"=>"success"));
        } else if ($stmt->affected_rows == 0) {
            echo json_encode(array("respuesta"=>"No se realizaron cambios en el usuario (datos idénticos o usuario no encontrado).","tipo"=>"info"));
        } else {
            echo json_encode(array("respuesta"=>"Error al actualizar, affected_rows reportó un valor inesperado.","tipo"=>"danger"));
        }
    } else {
        // Check for unique constraint violation (error code 1062)
        if ($mysqli->errno == 1062) {
             echo json_encode(array("respuesta"=>"Error: El login o email ya está en uso por otro usuario.","tipo"=>"danger"));
        } else {
             echo json_encode(array("respuesta"=>"Error al ejecutar la actualización del usuario: " . $stmt->error,"tipo"=>"danger"));
        }
    }
    $stmt->close();
} else {
    echo json_encode(array("respuesta"=>"Error al preparar la consulta de actualización del usuario: " . $mysqli->error,"tipo"=>"danger"));
}
?>