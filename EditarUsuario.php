<!DOCTYPE html>
<html lang="es">
<head>
        <meta charset="UTF-8">
        <script type="text/javascript" src="resources/js/jquery-3.2.1.js"></script>
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
        <title>Editar Usuario</title>
        <?php
                include "resources/conexion.php";
                $sql = "SELECT region_id, region_nombre FROM regiones";
                $result = $conn->query($sql); 
                $reg = '<option value="0"> Elige una Región</option>';
                while( $row = $result->fetch_array() )
                {
                        $reg.='<option value="'.$row["region_id"].'">'.utf8_encode($row["region_nombre"]).'</option>';
                }
                
                $conn->close();
        ?>
        <script type="text/javascript">
                // Carga de provincia
                $(document).ready(function(){

                        $("#provincia").prop('disabled', true);
                        $("#comuna").prop('disabled', true);
                        $("#region").change(function(){
                                $("#provincia").val("0");
                                $("#comuna").val("0");      
                                $.ajax({

                                        url:"provincia_load.php",
                                        type: "POST",
                                        data:"regionid="+$("#region").val(),
                                                success: function(prov){
                                                $("#provincia").html(prov);
                                                $("#provincia").prop('disabled',false);
                                                $("#comuna").prop('disabled', true);
                                        }
                                        })
                                        
                                });                      
                });
                // Carga de Comuna
                $(document).ready(function(){   
                        $("#provincia").change(function(){
                                
                                        $.ajax({
                                            url:"comuna_load.php",
                                            type: "POST",
                                            data:"provinciaid="+$("#provincia").val(),
                                                success: function(comu){
                                                $("#comuna").html(comu);
                                                $("#comuna").prop('disabled',false);
                                                $("#comuna").append();
                                            }
                                        })
                        })
                });
        </script>
        <!-- Script para campo rut -->
        <script>
                // Validar largo de rut a 9
                function maxLengthCheck(object) {
                        if (object.value.length > object.maxLength)
                                object.value = object.value.slice(0, object.maxLength)
                }
                // Validar numerico 0-9    
                function isNumeric (evt) {
                        var theEvent = evt || window.event;
                        var key = theEvent.keyCode || theEvent.which;
                        key = String.fromCharCode (key);
                        var regex = /[0-9]|\./;
                        if ( !regex.test(key) ) {
                                theEvent.returnValue = false;
                                if(theEvent.preventDefault) 
                                        theEvent.preventDefault();
                        }
                }
                // Mensaje en campo rut
                $(document).ready(function(){
                        $('[data-toggle="popover"]').popover();   
                });
                
        </script>

<?php
 // Buscar usuario
    include "resources/conexion.php";
    $rut_user = intval($_GET['rut']);
    $sql = mysqli_query($conn,"SELECT rut, pass, nombre, apellido_paterno, apellido_materno, direccion, numCasa, idperfil, comuna_id, activo FROM usuario where rut = '$rut_user'");
    
    $result = mysqli_query($conn,$sql);
    while($row = mysqli_fetch_array($result)) {
        $nombre = $row['nombre'];
        $apellido_paterno = $row['apellido_paterno'];
        $apellido_materno = $row['apellido_materno'];
        /*echo "<tr>";
        echo "<td>" . $row['FirstName'] . "</td>";
        echo "<td>" . $row['LastName'] . "</td>";
        echo "<td>" . $row['Age'] . "</td>";
        echo "<td>" . $row['Hometown'] . "</td>";
        echo "<td>" . $row['Job'] . "</td>";
        echo "</tr>";*/
    }
    //echo "</table>";
    echo $nombre;
    $conn->close();
?>        

</head>
<body>
<?php include "menu.php" ?>

        <div class="container">
                <h1>Editar Usuario</h1>
                <form method="GET" id="formulario" class='form-inline'>
                        <div class="col-sm-10">
                                <label for="rut" class ='control-label col-sm-2'>Rut:</label> 
                                <input type="number" class="form-control" id="rut" required="true" onkeypress="return isNumeric(event)" oninput="maxLengthCheck(this)" maxlength = "9" data-toggle="popover" data-trigger="focus" data-content="Sin puntos ni guión.">
                                <button type="button" class="btn btn-default btn-sm" id="btn-buscar" name="btn-buscar" >
                                    <span class="glyphicon glyphicon-search"></span> 
                                </button>
                                <br>
                        </div>
                        <div class="col-sm-10">
                                <label for="pass" class ='control-label col-sm-2'>Contraseña:</label>
                                <input type="password" class="form-control" id="pass" required="true"><br>
                                <label for="pass-confirmacion" class ='control-label col-sm-2'>Confirme: </label>
                                <input type="password" class="form-control" id="pass2" required="true" ><br>
                        </div>
                        <div class="col-sm-10">
                                <label for="nombre" class ='control-label col-sm-2'>Nombre</label>
                                <input type="text" class="form-control" id="nombre" ><br>
                        </div>
                        <div class="col-sm-10">
                                <label for="apellido_paterno" class ='control-label col-sm-2'>Apellido Paterno:</label>
                                <input type="text" class="form-control" id="apellido_paterno"><br>
                        </div>
                        <div class="col-sm-10">
                                <label for="apellido_materno" class ='control-label col-sm-2'>Apellido Materno:</label>
                                <input type="text" class="form-control" id="apellido_materno"><br>
                        </div>
                        <div class="col-sm-10">
                                <label for="direccion" class ='control-label col-sm-2'>Direccion:</label>
                                <input type="text" class="form-control" id="direccion"><br>
                        </div>
                        <div class="col-sm-10">
                                <label for="numeroCasa" class ='control-label col-sm-2'>Numero Casa:</label>
                                <input type="number" class="form-control" id="numeroCasa"><br>
                        </div>
                        <div class="col-sm-10">
                                <label for="region" class ='control-label col-sm-2'>Region:</label>
                                <select id="region" name ="region" required="true" class="form-control"><?php echo $reg; ?></select><br>
                        </div>
                        <div class="col-sm-10">
                                <label for="provincia" class ='control-label col-sm-2'>Provincia:</label>
                                <select id="provincia" required="true" class="form-control"><option value="0">Elige una Provincia</option></select><br>
                        </div>
                        <div class="col-sm-10">
                                <label for="comuna" class ='control-label col-sm-2'>Comuna:</label>
                                <select id="comuna" class="form-control"><option value="0">Elige una Comuna</option></select><br>
                        </div>
                        <div class="col-sm-offset-2 col-sm-10"><br>
                                <p id="bot"><input type="submit" class="btn" id="submit" name="submit" value="Guardar" class="boton"></p>
                        </div>
                </form>
                
        </div>
</body>
</html>
<?php

?>
