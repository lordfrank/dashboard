<?php

$dia=$_REQUEST["dia"];

if (strlen($dia)==0){
	$f=date("Y-m-d");
	$fo=date("d/m/y",strtotime("$f"));
}else{
   $f=date($dia);
   $f=date("Y-m-d",strtotime("$f"));
   $fo=date("d/m/y",strtotime("$f"));
	}
$salida=array();
for( $i = 6; $i > 0; $i-- ){
$salida[]=array("fecha"=>date("d/m/y", strtotime("$f   -$i day")),"original"=>date("Y-m-d", strtotime("$f   -$i day")));
}
$salida[]=array("fecha"=>$fo,"original"=>$f);


if (date("Y-m-d")==$f){
	echo json_encode(array("calendario"=>$salida,
                 "fechas"=>array(
				 "hoy"=>date("Y-m-d"),
				 "anterior"=>date("Y-m-d", strtotime("$f -7 day")),
				 "siguiente"=>""
				 ))
				 );
}else{
echo json_encode(array("calendario"=>$salida,
                 "fechas"=>array(
				 "hoy"=>date("Y-m-d"),
				 "anterior"=>date("Y-m-d", strtotime("$f -7 day")),
				 "siguiente"=>date("Y-m-d", strtotime("$f +7 day"))
				 ))
				 );
}
?>