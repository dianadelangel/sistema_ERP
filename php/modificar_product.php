<?php

if(!empty($_POST))
{
    $alert="";
    if(empty($_POST['nombre']))
    {
        $alert='<p class="msg_error">Todos los campos son obligatorios</p>';  
    }else{
        include 'conexion.php';

        $id=$_POST['id_producto'];
        $nombre=$_POST['nombre'];
        $categoria=$_POST['categoria'];
        $clasificacion=$_POST['clasificacion'];
        $color=$_POST['color'];
        $material=$_POST['material'];
        $detalles=$_POST['detalles'];
        $mono=$_POST['mono'];
        $follaje=$_POST['follaje'];
        $precio=$_POST['precio'];
        $preciodtr=$_POST['preciodtr'];
        $cantidad=$_POST['cantidad'];

            $sql_update=mysqli_query($conexion,"UPDATE productos SET categoria = '$categoria', clasificacion='$clasificacion', producto = '$nombre',
            color='$color', material='$material',detalles='$detalles', mono='$mono', follaje='$follaje',
            total_stock='$cantidad', precio_distribuidor='$preciodtr', precio_venta='$precio' WHERE num_pro = '$id'");
           

             if($sql_update){
                $alert='<p class="msg_save">La categoría se ha actualizado de manera exitosa.</p>';
                header("Location:../pages/principal.html");
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
    header('Location:modificar_product.php');
}
$id_datos=$_GET['id'];
$sql=mysqli_query($conexion,"SELECT * FROM productos WHERE num_pro = '$id_datos';");

$result_sql=mysqli_num_rows($sql);

if($result_sql==0){
    header('Location:../pages/principal.html');
}else{
    $option="";
    while($mostrar = mysqli_fetch_array($sql)){
        $id = $mostrar['num_pro'];
        $nombre= $mostrar['producto'];
        $categoria = $mostrar['categoria'];
        $clasificacion = $mostrar['clasificacion'];
        $preciodtr=$mostrar['precio_distribuidor'];
        $precio=$mostrar['precio_venta'];
        $cantidad=$mostrar['total_stock'];
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
        <a href="../pages/principal.html" class="btn-neon">
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
                    <input type="text" name="id_producto" id="id_producto" style="visibility:hidden" value="<?php echo $id; ?>">
            </div>

            <div class="entradas">
                <label for="nombre">
                    <span>Nombre del Producto</span>
                    <input type="text" name="nombre" id="nombre" value="<?php echo $nombre; ?>">
                </label>
                <label for="categoria">
                    <span>Categoría</span>
                    <input type="text" name="categoria" id="categoria" value="<?php echo $categoria; ?>">
                </label>
            </div>

            <div class="entradas">
                <label for="clasificacion">
                    <span>Clasificación</span>
                    <input type="text" name="clasificacion" id="clasificacion" value="<?php echo $clasificacion; ?>">
                </label>
            </div>

            <div class="entradas">
                <label for="color">Color</label>
                <select name="color" id="color">
                    <option>Morado</option>
                    <option>Blanco</option>
                    <option>Rojo</option>
                    <option>Azul</option>
                    <option>Rosa</option>
                </select>
            </div>

            <div class="entradas">
                <label for="detalles">Detalles</label>
                <select name="detalles" id="detalles">
                    <option>Jarrón</option>
                    <option>Estampado</option>
                    <option selected="selected">Tarjeta</option>
                    <option>Bolsa</option>
                    <option>Caja</option>
                </select>

            <label for="mono">Moño</label>
                <select name="mono" id="mono">
                    <option>Chico</option>
                    <option>Mediano</option>
                    <option>Grande</option>
                    <option selected="selected">Ninguno</option>
                </select>
                </div>

                <div class="entradas">
                <label for="follaje">Papel</label>
                <select name="follaje" id="follaje">
                    <option>Ninguno</option>
                    <option>Liso</option>
                    <option selected="selected">Decorado</option>
                </select>

                <label for="material">Material</label>
                <select name="material" id="material">
                    <option>Betún</option>
                    <option>Nuez</option>
                    <option>Vinil</option>
                    <option>Polyester</option>
                    <option>Almendra</option>
                    <option selected="selected">Ninguno</option>
                </select>
                </div>

                <div class="entradas">
                    <label for="preciodtr">
                        <span>Precio de Compra</span>
                        <input type="number" name="preciodtr" id="preciodtr" value="<?php echo $preciodtr; ?>">
                    </label>
                    <label for="precio">
                        <span>Precio Público</span>
                        <input type="number" name="precio" id="precio" value="<?php echo $precio; ?>">
                    </label>
                </div>

                <label for="cantidad">
                    <span>Cantidad de existencias</span>
                    <input type="number" name="cantidad" id="cantidad" value="<?php echo $cantidad; ?>">
                </label>

            <input type="submit" value="Guardar" class="submit-btn"> 
        </form>
    </div>


    </body>
</html>