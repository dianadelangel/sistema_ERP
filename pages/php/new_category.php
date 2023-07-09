<?php

if(!empty($_POST))
{
    $alert="";
    if(empty($_POST['name']) || empty($_POST['descripcion']))
    {
        $alert='<p class="msg_error">Todos los campos son obligatorios</p>';  
    }else{
        include('../../php/conexion.php');
        $nombre=$_POST['name'];
        $descripcion=$_POST['descripcion'];
        

        $query=mysqli_query($conexion,"SELECT * FROM categorias WHERE nombre='$nombre'");
        $result=mysqli_fetch_array($query);

        if($result>0){
            $alert='<p class="msg_error">La categoría ya existe.</p>';
        }else{
             $query_insert=mysqli_query($conexion,"CALL InsertarCategoria('$nombre','$descripcion')");

             if($query_insert){
                $alert='<p class="msg_save">La categoría ha sido registrada de manera exitosa.</p>';
                header("Location:categoria.php");
             }else{
                $alert='<p class="msg_error">La categoría no se ha podido registrar.</p>';
             }
        }
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
            <li><a href="../principal.html">
                <i class="fa-solid fa-house"></i>
                <span class="nav-item">Inicio</span>
            </a></li>
            <li><a href="categoria.php">
                <i class="fa-solid fa-folder-plus"></i>
                <span class="nav-item">Categorías</span>
            </a></li>
            <li><a href="clasificacion.php">
            <i class="fa-solid fa-folder-tree"></i>
                <span class="nav-item">Clasificaciones</span>
            </a></li>
            <li><a href="productos.php">
                <i class="fa-solid fa-boxes-stacked"></i>
                <span class="nav-item">Productos</span>
            </a></li>
            <li><a href="venta.php">
              <i class="fa-sharp fa-solid fa-cart-plus"></i>
              <span class="nav-item">Ventas</span>
          </a></li>
          <li><a href="detalles.php">
                <i class="fa-solid fa-file"></i>
                <span class="nav-item">Informacion</span>
            </a></li>
            <li><a href="#">
                <i class="fa-solid fa-screwdriver-wrench"></i>
                <span class="nav-item">Configuración</span>
            </a></li>
            <li><a href="../../index.html">
                <i class="fa-solid fa-arrow-right-from-bracket"></i>
                <span class="nav-item">Cerrar Sesión</span>
            </a></li>
        </div></ul>
    </nav>

    <!-- Creación del titulo-->
    <div class="title">
        <h1 class="lines-effect">Nueva Categoría</h1>
    </div>

    <!-- Botón de registro-->

    <div class="register">
        <a href="categoria.php" class="btn-neon">
            <span id="span1"></span>
            <span id="span2"></span>
            <span id="span3"></span>
            <span id="span4"></span>
            Regresar
        </a>
    </div>

    <div class="container">
        <h3>Registro Nueva Categoría</h3>
        <div clas="alerta"><?php echo isset($alert) ? $alert: ''; ?></div>
        <form action="" method="post">
            <div class="entradas">
            <label for="name">
                <span>Nombre de la categoría</span>
                <input type="text" id="name" name="name">
            </label>
            </div>
            <label for="descripcion">
                <span>Descripcion de la Categoría</span>
                <input type="text" name="descripcion" id="descripcion">
            </label>
            <input type="submit" value="Guardar" class="submit-btn"> 
        </form>
    </div>

</body>
</html>