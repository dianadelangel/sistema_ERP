<?php

include ('conexion.php');

$nombre=$_POST['nombre'];
$apellido=$_POST['apellido'];
$empleado=$_POST['empleado'];
$contraseña=$_POST['contraseña'];
$rol=$_POST['rol'];

$sql=mysqli_query($conexion,"INSERT INTO users (ID, nombre, apellido, num_empleado, contraseña, ID_rol) 
VALUES (NULL, '$nombre', '$apellido', '$empleado', '$contraseña', '$rol')");
    if($sql){
        sleep(2);
        header("Location:../pages/php/empleado.php");
    }
?>