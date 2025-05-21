<?php
include("../conection/config.php");

$salida=array();
$id = isset($_REQUEST['id']) ? $_REQUEST['id'] : '';

if (strlen($id) > 0) {
    $sql = "SELECT * FROM `estados` WHERE id = ?";
    $stmt = $mysqli->prepare($sql);
    $stmt->bind_param("s", $id);
} else {
    $sql = "SELECT * FROM `estados` ORDER BY id ASC";
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
		
		print json_encode(array("estados"=>$salida));
		
?>