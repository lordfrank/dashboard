<?php
include("../conection/config.php");

$salida=array();
$id = mysqli_real_escape_string($mysqli,$_REQUEST['id']);

if (strlen($id)>0){
$sql = "SELECT id, login, nombre, mail, estado FROM `usuarios` where id=$id";
}else{
$sql = "SELECT id, login, nombre, mail, estado FROM `usuarios` order by id asc";
}
		$result=$mysqli->query($sql);
		$rows = $result->num_rows;
		
		if($rows > 0) {
			while($row = $result->fetch_assoc())
			{
				$salida[]=$row;
				} 
		}
		
		print json_encode(array("usuarios"=>$salida));
		
?>