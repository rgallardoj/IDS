<?php 
  include "session.php";
 ?>
<!DOCTYPE html>
<html>
<head>
<link rel="stylesheet" href="resources/estilo-menu.css" >
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
</head>
<body>
<div style="float:right;">
  <a href="logout.php" class="btn btn-lg"> <span class="glyphicon glyphicon-log-out"></span> Cerrar Sesion</a>
</div>

<div id="mySidenav" class="sidenav">
  <a href="javascript:void(0)" class="closebtn" onclick="closeNav()">&times;</a>
  <a href="index.php" class="btn btn-lg"> <span class="glyphicon glyphicon-home"></span> Inicio</a>
  <a href="RegistrarUsuario.php" lass="btn btn-lg"><span class="glyphicon glyphicon-user"></span> Nuevo Usuario</a>
  <a href="EditarUsuario.php" lass="btn btn-lg"><span class="glyphicon glyphicon-edit"></span> Editar Usuario</a>

  <a href="logout.php" class="btn btn-lg"> <span class="glyphicon glyphicon-log-out"></span> Cerrar Sesion</a>
  
</div>

<div id="main">
  <span style="font-size:30px;cursor:pointer" onclick="openNav()">&#9776; Menu</span>
 
</div>

<script>
function openNav() {
    document.getElementById("mySidenav").style.width = "250px";
    document.getElementById("main").style.marginLeft = "250px";
}

function closeNav() {
    document.getElementById("mySidenav").style.width = "0";
    document.getElementById("main").style.marginLeft= "0";
}
</script>
     
</body>
 </html> 