<?php 
include("resources/conexion.php");
   session_start();
   //$error=" ";
   if($_SERVER["REQUEST_METHOD"] == "POST") 
   {
      // username and password sent from form  
      $userRut = mysqli_real_escape_string($conn,$_POST['usuario']);
      $password = mysqli_real_escape_string($conn,$_POST['password']); 
      $sql = "SELECT * FROM usuario WHERE rut = '$userRut' and pass = '$password' and activo = '1'";
      $result = mysqli_query($conn,$sql);
      $row = mysqli_fetch_array($result,MYSQLI_ASSOC);
      $count = mysqli_num_rows($result);
                
      if($count == 1) 
      {
       //print_r($row);
       //echo $row['pass'];
        $_SESSION['nombre'] = $row['nombre'];
        $_SESSION['rut'] = $row['rut'];
        $_SESSION['direccion'] = $row['direccion'];
        header("location: inicio.php");
      }
      else 
      {
         $_SESSION['error'] = 'Usuario o contraseña incorrecta';
         header("location: index.php");
      }
  }
   //$conn->close();
 ?>