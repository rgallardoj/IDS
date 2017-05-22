<?php 
include("resources/conexion.php");
   session_start();
   $error=" ";
   if($_SERVER["REQUEST_METHOD"] == "POST") {
      // username and password sent from form 
      
      $userRut = mysqli_real_escape_string($conn,$_POST['usuario']);
      $password = mysqli_real_escape_string($conn,$_POST['pass']); 
      
      $sql = "SELECT rut FROM usuario WHERE rut = '$userRut' and pass = '$password' and activo = '1'";
      $result = mysqli_query($conn,$sql);
      $row = mysqli_fetch_array($result,MYSQLI_ASSOC);

      //$active = $row['active'];
      
      $count = mysqli_num_rows($result);
                
      if($count == 1) {
         //session_register("$userRut");
         $_SESSION['login_user'] = $userRut;
         
         header("location: index.php");
      }else {
         $error = "Usuario o contraseña invalido";
      }
   }

 ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Login</title>


</head>

<body>
    <?php include "menu.php" ?>
<div>

        <div>
     
        
       <form  method="post" id="login-form">
      
        <h2 >Ingreso CGG.</h2><hr />
        
        <div id="error">
        
        </div>
        
        <div >
        <input type="text" class="form-control" required="true" placeholder="Rut" name="usuario" id="usuario" />
        <span id="check-e"></span>
        </div>
        
        <div >
        <input type="password"  placeholder="Password" required="true" name="pass" id="pass" />
        </div>
       
        <hr />
        
        <div >
            <button type="submit" name="btn-login" id="btn-login">
                <span ></span> &nbsp; Ingresar
                        </button> 
        </div>  
        <div style = "font-size:11px; color:#cc0000; margin-top:10px"> <?php echo $error; ?></div>
      
      </form>

    </div>
    
</div>
    

</body>
</html>