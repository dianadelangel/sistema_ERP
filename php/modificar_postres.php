<?php

if(!empty($_POST))
{
    $alert="";
    if(empty($_POST['id_producto']) || empty($_POST['nombre']))
    {
        $alert='<p class="msg_error">Todos los campos son obligatorios</p>';  
    }else{
        include 'conexion.php';

        $id=$_POST['id_producto'];
        $nombre=$_POST['nombre'];
        $clasificacion=$_POST['clasificacion'];
        $color=$_POST['color'];
        $material=$_POST['material'];
        $detalles=$_POST['detalles'];
        $mono=$_POST['mono'];
        $follaje=$_POST['follaje'];
        $precio=$_POST['precio'];
        $cantidad=$_POST['cantidad'];

            $sql_update=mysqli_query($conexion,"UPDATE productos SET Nombre = '$nombre',
            color='$color', material='$material',detalles='$detalles', mono='$mono', follaje='$follaje', clasificacion='$clasificacion',
            precio='$precio', existencia='$cantidad' WHERE ID_producto = '$id'");


             if($sql_update){
                $alert='<p class="msg_save">La categoría se ha actualizado de manera exitosa.</p>';
                header("Location:modificar_postres.php");
             }else{
                $alert='<p class="msg_error">La categoría no se ha podido actualizar.</p>';
            }
        }
    }

?>

<?php
//mostrar datos
include 'conexion.php';
if(empty($_GET['id'])){
    header('Location:../pages/postres.html');
}
$id_datos=$_GET['id'];
$sql=mysqli_query($conexion,"SELECT * FROM productos WHERE num_pro = '$id_datos';");

$result_sql=mysqli_num_rows($sql);

if($result_sql==0){
    header('Location:../pages/postres.html');
}else{
    $option="";
    while($mostrar = mysqli_fetch_array($sql)){
        $id = $mostrar['ID_producto'];
        $nombre= $mostrar['Nombre'];
        $precio=$mostrar['precio'];
        $cantidad=$mostrar['existencia'];
        
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
            <li><a href="../pages/php/categoria.php">
                <i class="fa-solid fa-folder-plus"></i>
                <span class="nav-item">Categorías</span>
            </a></li>
            <li><a href="../pages/php/clasificacion.php">
                <i class="fa-solid fa-file-circle-plus"></i>
                <span class="nav-item">Clasificaciones</span>
            </a></li>
            <li><a href="../pages/php/productos.php">
                <i class="fa-sharp fa-solid fa-cart-plus"></i>
                <span class="nav-item">Productos</span>
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
        <h1 class="lines-effect">Productos Combinados</h1>
    </div>

    <!-- Botón de registro-->

    <div class="register">
        <a href="../pages/postres.html" class="btn-neon">
            <span id="span1"></span>
            <span id="span2"></span>
            <span id="span3"></span>
            <span id="span4"></span>
            Regresar
        </a>
    </div>

    <div class="container">
        <h3>Modificar Productos</h3>
        <div clas="alerta"><?php echo isset($alert) ? $alert: ''; ?></div>
        <form action="" method="post">
            <div class="entradas">
                <label for="id_producto">
                    <span>ID del Producto</span>
                    <input type="text" name="id_producto" id="id_producto" value="<?php echo $id; ?>">
                </label>
            </div>
                <label for="nombre">
                    <span>Nombre del Producto</span>
                    <input type="text" name="nombre" id="nombre" value="<?php echo $nombre; ?>">
                </label>
            <label for="clasificacion">Clasificación</label>
                <?php
                include 'conexion.php';
                     $query_act=mysqli_query($conexion,"SELECT *FROM clasificaciones where categoria=2");
                     $result_act=mysqli_num_rows($query_act);
                ?>
                <select name="clasificacion" id="clasificacion">
                    <?php
                if($result_act>0){
                     while($clasificaciones=mysqli_fetch_array($query_act)){
                         ?>
                         <option value="<?php echo $clasificaciones["num_cl"]; ?>"><?php echo $clasificaciones["nombre_cl"] ?></option>
                         <?php
                     }
                     }
                ?></select>

            <label for="color">Color</label>
                <?php
                include 'conexion.php';
                     $query_act=mysqli_query($conexion,"SELECT *FROM colores");
                     $result_act=mysqli_num_rows($query_act);
                ?>
                <select name="color" id="color">
                    <?php
                if($result_act>0){
                     while($categoria=mysqli_fetch_array($query_act)){
                         ?>
                         <option value="<?php echo $categoria["num_color"]; ?>"><?php echo $categoria["Nombre_c"] ?></option>
                         <?php
                     }
                     }
                ?></select>

                <label for="material">Material</label>
                <?php
                include 'conexion.php';
                     $query_act=mysqli_query($conexion,"SELECT *FROM material");
                     $result_act=mysqli_num_rows($query_act);
                ?>
                <select name="material" id="material">
                    <?php
                if($result_act>0){
                     while($categoria=mysqli_fetch_array($query_act)){
                         ?>
                         <option value="<?php echo $categoria["num_material"]; ?>"><?php echo $categoria["material"] ?></option>
                         <?php
                     }
                     }
                ?></select>

                <label for="detalles">Detalles</label>
                <?php
                include 'conexion.php';
                     $query_act=mysqli_query($conexion,"SELECT *FROM detalles");
                     $result_act=mysqli_num_rows($query_act);
                ?>
                <select name="detalles" id="detalles">
                    <?php
                if($result_act>0){
                     while($categoria=mysqli_fetch_array($query_act)){
                         ?>
                         <option value="<?php echo $categoria["num_detalles"]; ?>"><?php echo $categoria["detalles"] ?></option>
                         <?php
                     }
                     }
                ?></select>

                <label for="mono">Moño</label>
                <?php
                include 'conexion.php';
                     $query_act=mysqli_query($conexion,"SELECT *FROM mono");
                     $result_act=mysqli_num_rows($query_act);
                ?>
                <select name="mono" id="mono">
                    <?php
                if($result_act>0){
                     while($categoria=mysqli_fetch_array($query_act)){
                         ?>
                         <option value="<?php echo $categoria["num_mono"]; ?>"><?php echo $categoria["mono"] ?></option>
                         <?php
                     }
                     }
                ?></select>

                
                <label for="follaje">Papel</label>
                <?php
                include 'conexion.php';
                     $query_act=mysqli_query($conexion,"SELECT *FROM follaje");
                     $result_act=mysqli_num_rows($query_act);
                ?>
                <select name="follaje" id="follaje">
                    <?php
                if($result_act>0){
                     while($categoria=mysqli_fetch_array($query_act)){
                         ?>
                         <option value="<?php echo $categoria["num_follaje"]; ?>"><?php echo $categoria["follaje"] ?></option>
                         <?php
                     }
                     }
                ?></select>
                <label for="precio">
                    <span>Precio</span>
                    <input type="number" name="precio" id="precio" value="<?php echo $precio; ?>">
                </label>
                <label for="cantidad">
                    <span>Cantidad de existencias</span>
                    <input type="number" name="cantidad" id="cantidad" value="<?php echo $cantidad; ?>">
                </label>

            <input type="submit" value="Guardar" class="submit-btn"> 
        </form>
    </div>


    </body>
</html>