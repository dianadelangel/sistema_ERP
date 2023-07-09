<?php

if(!empty($_POST))
{
    $alert="";
    if(empty($_POST['name']) || empty($_POST['descripcion']))
    {
        $alert='<p class="msg_error">Todos los campos son obligatorios</p>';  
    }else{
        include '../php/conexion.php';

        $id_category=$_POST['id_category'];
        $nombre=$_POST['name'];
        $descripcion=$_POST['descripcion'];

            $sql_update=mysqli_query($conexion,"UPDATE categorias SET nombre = '$nombre', descripcion = '$descripcion' WHERE num = '$id_category'");
           

             if($sql_update){
                $alert='<p class="msg_save">La categoría se ha actualizado de manera exitosa.</p>';
                header("Location:modificar.php");
             }else{
                $alert='<p class="msg_error">La categoría no se ha podido actualizar.</p>';
            }
        }
    }

?>

<?php
//mostrar datos
include '../php/conexion.php';
if(empty($_GET['id'])){
    header('Location:../pages/php/categoria.php');
}
$id_datos=$_GET['id'];
$sql=mysqli_query($conexion,"SELECT * FROM categorias WHERE num = '$id_datos';");

$result_sql=mysqli_num_rows($sql);

if($result_sql==0){
    header('Location:../pages/php/categoria.php');
}else{
    $option="";
    while($mostrar = mysqli_fetch_array($sql)){
        $id = $mostrar['num'];
        $nombre= $mostrar['Nombre'];
        $descripcion = $mostrar['Descripcion'];
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
        <h1 class="lines-effect">Modificar Categoría</h1>
    </div>

    <!-- Botón de registro-->
    <div class="register">
        <a href="../pages/php/categoria.php" class="btn-neon">
            <span id="span1"></span>
            <span id="span2"></span>
            <span id="span3"></span>
            <span id="span4"></span>
            Regresar
        </a>
    </div>

    <div class="container">
        <h3>Editar Categoría</h3>
        <div clas="alerta"><?php echo isset($alert) ? $alert: ''; ?></div>
        <form action="" method="post">
            <div class="entradas">
                    <input type="text" name="id_category" id="id_category"  style="visibility:hidden" value="<?php echo $id; ?>">
            </div>
            <label for="name">
                <span>Nombre de la categoría</span>
                <input type="text" id="name" name="name" value="<?php echo $nombre; ?>">
            </label>
            <label for="descripcion">
                <span>Descripcion de la Categoría</span>
                <input type="text" name="descripcion" id="descripcion" value="<?php echo $descripcion; ?>">
            </label>
            <input type="submit" value="Guardar" class="submit-btn"> 
        </form>
    </div>


    </body>
</html>