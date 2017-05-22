<?php 
include "resources/conexion.php";  
session_start();
 ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>CGG</title>
<!-- CUSTOM STYLES-->
    <link href="assets/css/login.css" rel="stylesheet" />
    <!-- BOOTSTRAP STYLES-->
    <link href="assets/css/bootstrap.css" rel="stylesheet" />
</head>
<body style="background:#FFFF00">
<div class = "container ">
	<div class="wrapper">
		<form action="login.php" method="post" name="Login_Form" class="form-signin">       
		    <h3 class="form-signin-heading">Bienvenido Sistema Administración de gastos</h3>
			  <hr class="colorgraph"><br>
			  
			  <input type="text" class="form-control" name="usuario" placeholder="Email" required="" autofocus="" />
			  <input type="password" class="form-control" name="password" placeholder="Contraseña" required=""/>     		  
			 
			  <button class="btn btn-lg btn-primary btn-block"  name="Submit" value="Login" type="Submit">Iniciar Sesión</button> 
			  <br />
			 	<?php if(isset($_SESSION['error'])): ?>
				<div class="alert alert-danger">
				       <center><p> <?php echo $_SESSION['error']; ?>
				</p></center>
				<?php endif; ?>

		</div>
		</form>	
	</div>
</div>
<script src="assets/js/bootstrap.min.js"></script>
</body>
</html>