<?php include 'View/Header.php'; ?>

    <!-- /. PAGE WRAPPER  -->
            
        <?php
                include "resources/conexion.php";
                $sql = "SELECT region_id, region_nombre FROM regiones";
                $result = $conn->query($sql); 
                $reg = '<option value="0"> Elige una Región</option>';
                while( $row = $result->fetch_array() )
                {
                        $reg.='<option value="'.$row["region_id"].'">'.utf8_encode($row["region_nombre"]).'</option>';
                }
                
                $sql2 = "SELECT idperfil, descripcion FROM perfil";
                $result2 = $conn->query($sql2); 
                $perf = '<option value="0"> Elige un perfil </option>';
                while( $row = $result2->fetch_array() )
                {
                        $perf.='<option value="'.$row["idperfil"].'">'.utf8_encode($row["descripcion"]).'</option>';
                }

                $conn->close();
        ?>
        <script type="text/javascript">
                // Bloquear Comuna y Provincia
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
                $(document).ready(function(){   
                        $("#provincia").change(function(){
                                
                                        $.ajax({
                                                url:"comuna_load.php",
                                        type: "POST",
                                        data:"provinciaid="+$("#provincia").val(),
                                                success: function(comu){
                                                $("#comuna").html(comu);
                                                $("#comuna").prop('disabled',false);
                                                $("#comuna").append()
                                        }
                                        })
                        })
                        
                });
        </script>
        <script>
                // Validar largo de rut a 9
                function maxLengthCheck(object) {
                        if (object.value.length > object.maxLength)
                                object.value = object.value.slice(0, object.maxLength)
                }
                    
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
                $(document).ready(function(){
                        $('[data-toggle="popover"]').popover();   
                });
        </script>

<h1>Registro Usuario</h1>
                <form method="POST" id="formulario" class='form-inline'>
                        <div class="col-sm-10">
                                <label for="rut" class ='control-label col-sm-2'>Rut:</label> 
                                <input type="number" class="form-control" id="rut" required="true" onkeypress="return isNumeric(event)" oninput="maxLengthCheck(this)" maxlength = "9"
                                data-toggle="popover" data-trigger="focus" data-content="Sin puntos ni guión.">
                                
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
                        <div class="col-sm-10">
                                <label for="perfil" class ='control-label col-sm-2'>Perfil:</label>
                                <select id="perfil" class="form-control"><?php echo $perf; ?></select>
                        </div>
                        <div class="col-sm-offset-4 col-sm-10"><br>
                                <p id="bot"><input type="submit" class="btn" id="submit" name="submit" value="Guardar" class="boton"></p>
                        </div>
                </form>

    <!-- /. PAGE WRAPPER  -->
<?php include 'View/Footer.php'; ?>