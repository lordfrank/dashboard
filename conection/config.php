<?php
 // prueba 
$dbhost = getenv("MYSQL_SERVICE_HOST");
$dbport = getenv("MYSQL_SERVICE_PORT");
$login=getenv('MYSQL_USER');
$pass=getenv('MYSQL_PASSWORD');
$basedatos=getenv('MYSQL_DATABASE');

$mysqli=new mysqli($dbhost,$login,$pass,$basedatos); 
	
if(mysqli_connect_errno()){
	echo 'Conexion Fallida : ', mysqli_connect_error();
	exit();
}
?>
