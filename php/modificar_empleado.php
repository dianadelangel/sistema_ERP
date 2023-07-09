<?php

if(!empty($_POST))
{
    $alert="";
    if(empty($_POST['id_empleado']) || empty($_POST['name']))
    {
        $alert='<p class="msg_error">Todos los campos son obligatorios</p>';  
    }else{
        include 'conexion.php';

        $id=$_POST['id_empleado'];
        $nombre=$_POST['name'];
        $apellido=$_POST['apellido'];
        $num=$_POST['num_empleado'];
        $contraseña=$_POST['contraseña'];

            $sql_update=mysqli_query($conexion,"UPDATE users SET nombre ='$nombre', apellido = '$apellido', num_empleado = '$num', 
            contraseña = '$contraseña' WHERE ID = '$id'");
           

             if($sql_update){
                $alert='<p class="msg_save">El empleado se ha actualizado de manera exitosa.</p>';
                header("Location:../pages/php/admin.php");
             }else{
                $alert='<p class="msg_error">El empleado no se ha podido actualizar.</p>';
            }
        }
    }

?>

<?php
//mostrar datos
include 'conexion.php';
if(empty($_GET['id'])){
    header('Location:../pages/php/admin.php');
}
$id_datos=$_GET['id'];
$sql=mysqli_query($conexion,"SELECT * FROM users
 WHERE ID = '$id_datos';");

$result_sql=mysqli_num_rows($sql);

if($result_sql==0){
    header('Location:../pages/php/admin.php');
}else{
    $option="";
    while($mostrar = mysqli_fetch_array($sql)){
        $id =$mostrar['ID'];
        $nombre= $mostrar['nombre'];
        $apellido= $mostrar['apellido'];
        $num = $mostrar['num_empleado'];
        $contraseña= $mostrar['contraseña'];
}
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <script src="https://kit.fontawesome.com/6418fbc3a7.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="../../css/new_category.css">
    <title>Sistema de Inventario</title>
</head>
<body>

   <!-- Creación del navbar-->

 <nav>
        <ul>
            <li>
                <div class="logo">
                <a href="#">
                    <img src="../../images/logo.png" alt="">
                    <span class="nav-text">Florería</span>
                </a>
            </div></li>
            <div class="items">
            <li><a href="../pages/php/admin.php">
                <i class="fa-solid fa-house"></i>
                <span class="nav-item">Inicio</span>
            </a></li>
            <li><a href="../pages/php/empleado.php">
                <i class="fa-sharp fa-solid fa-cart-plus"></i>
                <span class="nav-item">Nuevo Empleado</span>
            </a></li>
            <li><a href="#">
                <i class="fa-solid fa-file"></i>
                <span class="nav-item">Documentos</span>
            </a></li>
            <li><a href="#">
                <i class="fa-solid fa-screwdriver-wrench"></i>
                <span class="nav-item">Configuración</span>
            </a></li>
            <li><a href="../index.html">
                <i class="fa-solid fa-arrow-right-from-bracket"></i>
                <span class="nav-item">Cerrar Sesión</span>
            </a></li>
        </div></ul>
    </nav>

    <!-- Creación del titulo-->
    <div class="title">
        <h1 class="lines-effect">Usuarios</h1>
    </div>

    <div class="register">
        <a href="../pages/php/admin.php" class="btn-neon">
            <span id="span1"></span>
            <span id="span2"></span>
            <span id="span3"></span>
            <span id="span4"></span>
            Regresar
        </a>
    </div>

    <div class="container">
        <h3>Editar Empleados</h3>
        <div clas="alerta"><?php echo isset($alert) ? $alert: ''; ?></div>
        <form action="" method="post">
            <div class="entradas">
                <label for="id_category">
                    <span>ID</span>
                    <input type="text" name="id_empleado" id="id_empleado" value="<?php echo $id; ?>">
                </label>
            </div>
            <label for="name">
                <span>Nombre</span>
                <input type="text" id="name" name="name" value="<?php echo $nombre; ?>">
            </label>
            <label for="apellido">
                <span>Apellido</span>
                <input type="text" id="apellido" name="apellido" value="<?php echo $apellido; ?>">
            </label>
            <label for="num_empleado">
                <span>Numero de Empleado</span>
                <input type="text" id="num_empleado" name="num_empleado" value="<?php echo $num; ?>">
            </label>
            <label for="contraseña">
                <span>Contraseña</span>
                <input type="text" id="contraseña" name="contraseña" value="<?php echo $contraseña; ?>">
            </label>

            <input type="submit" value="Guardar" class="submit-btn"> 
        </form>
    </div>


    </body>
</html>