<?php

    include "resources/conexion.php";
    $rut_user = intval($_GET['rut']);
    $sql = mysqli_query($conn,"SELECT rut, pass, nombre, apellido_paterno, apellido_materno, direccion, numCasa, idperfil, comuna_id, activo FROM usuario where rut = '$rut_user'");
    
    $result = mysqli_query($conn,$sql);
    $nombre="";
    while($row = mysqli_fetch_array($result)) {
        $nombre = $row['nombre'];
        /*cho "<tr>";
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