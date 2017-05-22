<?php 

include "validarUsuario.php";

 ?>
<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Administración de gastos</title>
	<!-- BOOTSTRAP STYLES-->
    <link href="assets/css/bootstrap.css" rel="stylesheet" />

     <!-- FONTAWESOME STYLES-->
    <link href="assets/css/font-awesome.css" rel="stylesheet" />

        <!-- CUSTOM STYLES-->
    <link href="assets/css/custom.css" rel="stylesheet" />

     <!-- GOOGLE FONTS-->
   <link href="https://fonts.googleapis.com/css?family=Ubuntu" rel="stylesheet">
   <link href='http://fonts.googleapis.com/css?family=Open+Sans' rel='stylesheet' type='text/css' />

   <!-- SCRIPTS -AT THE BOTOM TO REDUCE THE LOAD TIME-->
    <!-- JQUERY SCRIPTS -->
   <script src="assets/js/jquery-3.2.1.js"></script>

      <!-- BOOTSTRAP SCRIPTS -->
    <script src="assets/js/bootstrap.min.js"></script>
    <!-- METISMENU SCRIPTS -->
    <script src="assets/js/jquery.metisMenu.js"></script>
      <!-- CUSTOM SCRIPTS -->
    <script src="assets/js/custom.js"></script>
</head>
<body>
    <div id="wrapper">
        <nav class="navbar navbar-default navbar-cls-top " role="navigation" style="margin-bottom: 0">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".sidebar-collapse">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand">Junta Vecinal Doña Juanita</a> 
            </div>
  <div style="color: white;
padding: 15px 50px 5px 50px;
float: right;
font-size: 16px;"> Bienvenido : <?php echo $_SESSION['nombre']; ?>   &nbsp; <a href="logout.php" class="btn btn-danger square-btn-adjust">Cerrar Sesion</a> </div>
        </nav>   
           <!-- /. NAV TOP  -->
                <nav class="navbar-default navbar-side" role="navigation">
            <div class="sidebar-collapse">
                <ul class="nav" id="main-menu">
				<li class="text-center">
                    <img src="assets/img/find_user.png" class="user-image img-responsive"/>
					</li>

                    <li>
                        <a  href="inicio.php"><i class="fa fa-dashboard fa-2x"></i>Inicio</a>
                    </li>

                     <li>
                        <a  href="#"><i class="fa fa-users fa-2x"></i>Gestionar Usuario<span class="fa arrow"></span></a>
                        <ul class="nav nav-second-level">
                            <li>
                                <a href="RegistrarUsuario.php">Agregar Usuarios</a>
                            </li>
                            <li>
                                <a href="#">Editar Usuarios</a>
                            </li>
                        </ul>
                    </li>

                     <li>
                        <a  href=""><i class="fa fa-qrcode fa-2x"></i>Gestionar Gastos<span class="fa arrow fa-1x"></a>
                        <ul class="nav nav-second-level">
                            <li>
                                <a href="#">Agregar Gasto</a>
                            </li>
                            <li>
                                <a href="#">Editar Gasto</a>
                            </li>
                        </ul>
                    </li>

                     <li>
                        <a  href="#"><i class="fa fa-indent fa-2x"></i>--</a>
                    </li>

                     <li>
                        <a  href="#"><i class="fa fa-caret-square-o-down fa-2x"></i>--</a>
                    </li>

                       <li>
                        <a href="#"><i class="fa fa-sitemap fa-2x"></i><span class="fa arrow"></span></a>
                        <ul class="nav nav-second-level">
                            <li>
                                <a href="#"></a>
                            </li>
                            <li>
                                <a href="#"></a>
                            </li>
                            <li>
                                <a href="#">Second Level Link<span class="fa arrow"></span></a>
                                <ul class="nav nav-third-level">
                                    <li>
                                        <a href="#">Third Level Link</a>
                                    </li>
                                    <li>
                                        <a href="#">Third Level Link</a>
                                    </li>
                                    <li>
                                        <a href="#">Third Level Link</a>
                                    </li>
                                </ul>
                            </li>
                        </ul>
                      </li>  

                    <li>
                        <a  href="#"><i class="fa fa-qrcode fa-2x"></i>#</a>
                    </li>
						   <li  >
                        <a  href="#"><i class="fa fa-bar-chart-o fa-2x"></i>#</a>
                    </li>	
                      <li  >
                        <a  href="#"><i class="fa fa-table fa-2x"></i>#</a>
                    </li>
                    <li  >
                        <a  href="#"><i class="fa fa-edit fa-2x"></i>#</a>
                    </li>				

                  <li>
                        <a class="active-menu"  href="blank.html"><i class="fa fa-square-o fa-2x"></i>#</a>
                    </li>	
                </ul>
            </div>
        </nav>  
       <!-- /. NAV SIDE  -->
        <div id="page-wrapper" >