<?php 
//$regionid = $_GET["regionid"];
if(isset($_POST["regionid"])){
	$regionid = $_POST["regionid"];
include "resources/conexion.php";
$sql = "SELECT provincia_id,provincia_nombre,region_id from provincias where region_id=".$regionid.";";
$result = $conn->query($sql); 
$prov = '<option value="0"> Elige una Provincia</option>';
while( $row = $result->fetch_array() )
{
	$prov.='<option value="'.$row["provincia_id"].'">'.utf8_encode($row["provincia_nombre"]).'</option>';
}
echo $prov;
}
?>
