<?php

include('conexion.php');

$usuario = $_POST['empleado'];
$contraseña = $_POST['password'];

session_start();

$_SESSION['empleado']=$usuario;


$consulta = mysqli_query($conexion, "SELECT * FROM users WHERE num_empleado='$usuario' AND contraseña='$contraseña'");

$filas=mysqli_fetch_array($consulta);

if($filas['ID_rol']==1){ //Administrador
    header("location:../pages/php/admin.php");
}else if($filas['ID_rol']==2){  //empleados
    header("location:../pages/principal.html");
}else{
    ?>
    <?php
    header("location:../index.html");
    ?>
    <h1 class="bad">Error en la autenticacion</h1>
    <?php
}

mysqli_free_result($consulta);
mysqli_close($conexion);

?>