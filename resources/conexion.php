<?php


		$server = "localhost";
		$user = "root";
		$pass = "";
		$db = "cgg";
		
		//Conexion
		$conn = new mysqli ($server, $user, $pass, $db);

		// Validar
		if($conn->connect_error){
		        die("Fallo en la conexion: ". $conn->conect_error);
		} 

?>