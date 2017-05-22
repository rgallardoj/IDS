<?php
$provinciaid = $_POST["provinciaid"];
include "resources/conexion.php";

$sql2 = "SELECT comuna_id, comuna_nombre from comunas where provincia_id=".$provinciaid.";";
$result2 = $conn->query($sql2);
$comu = '<option value="0"> Elige una Comuna</option>';
while( $row2 = $result2->fetch_array() )
{
	$comu.='<option value="'.$row2["comuna_id"].'">'.utf8_encode($row2["comuna_nombre"]).'</option>';
}
echo $comu;

?>