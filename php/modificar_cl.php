<?php

if(!empty($_POST))
{
    $alert="";
    if(empty($_POST['name']) || empty($_POST['categoria']))
    {
        $alert='<p class="msg_error">Todos los campos son obligatorios</p>';  
    }else{
        include 'conexion.php';

        $id_clasificacion=$_POST['id_clasificacion'];
        $nombre=$_POST['name'];
        $categoria=$_POST['categoria'];

            $sql_update=mysqli_query($conexion,"UPDATE clasificaciones SET nombre_cl = '$nombre'  WHERE num_cl = '$id_clasificacion'");
           

             if($sql_update){
                $alert='<p class="msg_save">La clasificación se ha actualizado de manera exitosa.</p>';
                header("Location:../pages/php/clasif_flores.php");
             }else{
                $alert='<p class="msg_error">La clasificacion no se ha podido actualizar.</p>';
            }
        }
    }

?>

<?php
//mostrar datos
include 'conexion.php';
if(empty($_GET['id'])){
    header('Location:../pages/php/clasif_flores.php');
}
$id_datos=$_GET['id'];
$sql=mysqli_query($conexion,"SELECT * FROM clasificaciones
 WHERE num_cl = '$id_datos';");

$result_sql=mysqli_num_rows($sql);

if($result_sql==0){
    header('Location:../pages/php/clasif_flores.php');
}else{
    $option="";
    while($mostrar = mysqli_fetch_array($sql)){
        $id = $mostrar['num_cl'];
        $nombre= $mostrar['nombre_cl'];
        $categoria = $mostrar['categoria'];
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
            <li><a href="../pages/principal.html">
                <i class="fa-solid fa-house"></i>
                <span class="nav-item">Inicio</span>
            </a></li>
            <li><a href="../pages/php/categoria.php">
                <i class="fa-solid fa-folder-plus"></i>
                <span class="nav-item">Categorías</span>
            </a></li>
            <li><a href="../pages/php/clasificacion.php">
                <i class="fa-solid fa-folder-tree"></i>
                <span class="nav-item">Clasificaciones</span>
            </a></li>
            <li><a href="../pages/php/productos.php">
                <i class="fa-solid fa-boxes-stacked"></i>
                <span class="nav-item">Productos</span>
            </a></li>
            <li><a href="../pages/php/detalles.php">
                <i class="fa-solid fa-file"></i>
                <span class="nav-item">Informacion</span>
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
        <h1 class="lines-effect">Clasificación Flores</h1>
    </div>
    <div class="register">
        <a href="../pages/php/clasif_flores.php" class="btn-neon">
            <span id="span1"></span>
            <span id="span2"></span>
            <span id="span3"></span>
            <span id="span4"></span>
            Regresar
        </a>
    </div>

    <div class="container">
        <h3>Editar Clasificación</h3>
        <div clas="alerta"><?php echo isset($alert) ? $alert: ''; ?></div>
        <form action="" method="post">
            <div class="entradas">
                    <input type="text" name="id_clasificacion" id="id_clasificacion" style="visibility:hidden" value="<?php echo $id; ?>">
            </div>
            <label for="name">
                <span>Nombre de la clasificación</span>
                <input type="text" id="name" name="name" value="<?php echo $nombre; ?>">
            </label>
            <label for="categoria">
                <span>Categoria</span>
                <input type="text" id="categoria" name="categoria" value="<?php echo $categoria; ?>">
            </label>
            <input type="submit" value="Guardar" class="submit-btn"> 
        </form>
    </div>


    </body>
</html>