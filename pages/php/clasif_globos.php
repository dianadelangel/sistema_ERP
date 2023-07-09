<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <script src="https://kit.fontawesome.com/6418fbc3a7.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="../../css/categoria.css">
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
        <h1 class="lines-effect">Clasificación Globos</h1>
    </div>

    <!-- Botón de registro-->

    <div class="register">
        <a href="new_class.php" class="btn-neon">
            <span id="span1"></span>
            <span id="span2"></span>
            <span id="span3"></span>
            <span id="span4"></span>
            Nueva Clasificación
        </a>
    </div>

    <div class="datatable-container">
        <div class="header-tools">
            <div class="search">
                <input type="text" name="" id="" class="search-input">
            </div>
        </div>
        <table class="datatable">
            <thead>
                <tr>
                    <th>   </th>
                    <th>ID Clasificación</th>
                    <th>Nombre</th>
                    <th>Categoría</th>
                </tr>
            </thead>
            <tbody>
                <?php
                include('../../php/conexion.php');
                $sql="SELECT * FROM clasificaciones WHERE categoria='Globos'";
                $result=mysqli_query($conexion,$sql);
                while($mostrar=mysqli_fetch_array($result)){
                ?>
                <tr>
                    <td><span class="available"></td>
                    <td><?php echo $mostrar['ID_clasificacion']?></td>
                    <td><?php echo $mostrar['nombre_cl']?></td>
                    <td><?php echo $mostrar['categoria']?></td>
                    <td><a href="../../php/modificar_clglobos.php?id=<?php echo $mostrar["num_cl"]; ?>"><i class="fa-solid fa-pen-to-square fa-lg" style="color:white"></i></a></td>
                    <td><a href="eliminar_clglobos.php?id=<?php echo $mostrar["num_cl"]; ?>"><i class="fa-sharp fa-solid fa-trash fa-lg" style="color:white"></i></a></td>
                </tr>
                <?php
                }
                ?>
            </tbody> <!--Llenar datos con mysql-->
        </table>
        <div class="footer-tools">
            <div class="list-items">
                Show
                <select name="n-entries" id="n-enties" class="n-entries">
                    <option value="5">5</option>
                    <option value="10" selected>10</option>
                    <option value="15">15</option>
                </select>
            </div>

            <div class="pages">
                <ul>
                    <li><span class="active">1</span></li>
                    <li><button>2</button></li>
                    <li><button>3</button></li>
                    <li><button>4</button></li>
                    <li><span>...</span></li>
                    <li><button>9</button></li>
                    <li><button>10</button></li>
                </ul>
            </div>
        </div>
    </div>

</body>
</html>