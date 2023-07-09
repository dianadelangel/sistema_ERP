<?php
    include('../../php/conexion.php');

     if(!empty($_POST))
     {
        $id = $_POST['num'];
        $query_delete = mysqli_query($conexion,"DELETE FROM categorias WHERE num=$id");
 
        if($query_delete){
            header("location:categoria.php");
        }else{
            echo "Error al eliminar";
        }
    }
    if(empty($_REQUEST['id']))
     {
         header("location:eliminar_category.php");
     }else{
        
        
        $id= $_REQUEST['id'];

        $query = mysqli_query($conexion,"SELECT * FROM categorias WHERE num=$id");

        $result = mysqli_num_rows($query);

        if($result>0){
            while($mostrar = mysqli_fetch_array($query)){
                                           $id_category= $mostrar['ID_category'];
                                           $nombre= $mostrar['Nombre'];
                                           $descripcion = $mostrar['Descripcion'];
            }
        }else{
                header('location:categoria.php');
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
        <h1 class="lines-effect">Eliminar Categoría</h1>
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

    <div class="mostrar_delete">

        <br><br><br><br><h4><b>¿Está seguro de eliminar la sig. categoría?</b></h4><br>
        <p><b>ID Categoría: </b><span><?php echo $id_category; ?></span></p>
        <p><b>Nombre: </b><span><?php echo $nombre; ?></span></p>
        <p><b>Descripción: </b><span><?php echo $descripcion; ?></span></p>

        <form method="post" action="">
            <input type="hidden" name="num" value="<?php echo $id; ?>">
            <a href="categoria.php
            " class="btn_cancel">Cancelar</a>
            <input type="submit" value="Aceptar" class="btn_ok">
        </form>
    </div>

    </body>
</html>