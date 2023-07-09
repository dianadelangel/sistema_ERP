<?php

if(!empty($_POST))
{
    $alert="";
    if(empty($_POST['nombre']))
    {
        $alert='<p class="msg_error">Todos los campos son obligatorios</p>';  
    }else{
        include '../../php/conexion.php';
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
        

             $query_insert=mysqli_query($conexion,"CALL insertarProductos('$categoria', '$clasificacion', '$nombre',
                                        '$color', '$material', '$detalles', '$mono', '$follaje', '$cantidad', '$preciodtr',
                                        '$precio','$cantidad')");

             if($query_insert){
                $alert='<p class="msg_save">El producto ha sido registrado de manera exitosa.</p>';
                header("Location:new_product.php");
             }else{
                $alert='<p class="msg_error">El producto no se ha podido registrar.</p>';
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
                <i class="fa-solid fa-file-circle-plus"></i>
                <span class="nav-item">Clasificaciones</span>
            </a></li>
            <li><a href="productos.php">
                <i class="fa-sharp fa-solid fa-cart-plus"></i>
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
        <h1 class="lines-effect">Lista de Productos</h1>
    </div>

    <!-- Botón de registro-->

    <div class="register">
        <a href="../principal.html" class="btn-neon">
            <span id="span1"></span>
            <span id="span2"></span>
            <span id="span3"></span>
            <span id="span4"></span>
            Regresar
        </a>
    </div>

    <div class="container">
        <h3>Registro Nuevos Productos</h3>
        <div clas="alerta"><?php echo isset($alert) ? $alert: ''; ?></div>
        <form action="" method="post">
            <div class="entradas">
                <label for="nombre">
                    <span>Nombre del Producto</span>
                    <input type="text" name="nombre" id="nombre">
                </label>
                <label for="categoria">
                    <span>Categoría</span>
                    <input type="text" name="categoria" id="categoria" value="Regalos">
                </label>
            </div>
            <div class="entradas">
                <label for="clasificacion">
                    <span>Clasificación</span>
                    <input type="text" name="clasificacion" id="clasificacion">
                </label>
            </div>

            <div class="entradas">
                <label for="color">Color</label>
                <select name="color" id="color">
                    <option>Morado</option>
                    <option>Amarillo</option>
                    <option>Café</option>
                    <option>Blanco</option>
                    <option>Rojo</option>
                    <option>Azul</option>
                    <option selected="selected">Rosa</option>
                </select>
            </div>

                <div class="entradas">
                <label for="detalles">Detalles</label>
                <select name="detalles" id="detalles">
                    <option selected="selected">Tarjeta</option>
                    <option>Bolsa</option>
                    <option>Caja</option>
                    <option>Ninguno</option>
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
                    <option>Tela Malvavisco</option>
                    <option>Plata</option>
                    <option>Oro</option>
                    <option>Poliester</option>
                    <option>Plástico</option>
                    <option selected="selected">Ninguno</option>
                </select>
                </div>

                <div class="entradas">
                <label for="preciodtr">
                    <span>Precio De Compra</span>
                    <input type="text" name="preciodtr" id="preciodtr">
                </label>
            <label for="precio">
                    <span>Precio Publico</span>
                    <input type="text" name="precio" id="precio">
                </label>
                    </div>

                <label for="cantidad">
                    <span>Cantidad</span>
                    <input type="number" name="cantidad" id="cantidad">
                </label>
            <input type="submit" value="Guardar" class="submit-btn"> 
        </form>
    </div>

</body>
</html>