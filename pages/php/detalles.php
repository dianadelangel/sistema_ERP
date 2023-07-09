<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <script src="https://kit.fontawesome.com/6418fbc3a7.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="../../css/productos.css">
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
        <h1 class="lines-effect">Inforamación de ventas</h1>
    </div>

    <!-- Comienza tabla-->

    <div class="datatable-container">
    <table class="datatable">
            <thead>
                <tr>
                    <th>N°</th>
                    <th>Fecha</th>
                    <th>Usuario</th>
                    <th>RFC Cliente</th>
                    <th>Monto total</th>
                </tr>
            </thead>
            <tbody>
                <?php
                include('../../php/conexion.php');

                $sql_register=mysqli_query($conexion,"SELECT COUNT(*) AS total_registro FROM factura");
                $result_register = mysqli_fetch_array($sql_register);
                $total_registro=$result_register['total_registro'];
                $por_pagina = 5;

                if(empty($_GET['pagina'])){
                    $pagina = 1;
                }else{
                    $pagina = $_GET['pagina'];
                }

                $desde = ($pagina-1) * $por_pagina;
                $total_paginas= ceil($total_registro/$por_pagina);

                $sql="SELECT * FROM factura ORDER BY nofactura ASC
                LIMIT $desde,$por_pagina;";
                $result=mysqli_query($conexion,$sql);
                while($mostrar=mysqli_fetch_array($result)){
                ?>
                <tr>
                    <td><?php echo $mostrar['nofactura']?></td>
                    <td><?php echo $mostrar['fecha']?></td>
                    <td><?php echo $mostrar['usuario']?></td>
                    <td><?php echo $mostrar['codcliente']?></td>
                    <td>$<?php echo $mostrar['totalfactura']?></td>
                    <td><a href="pdf.php?id=<?php echo $mostrar["nofactura"]; ?>"><i class="fas fa-file" title="Factura" style="color:white"></i></a></td>
                </tr>
                <?php
                }
                ?>
            </tbody> <!--Llenar datos con mysql-->
        </table>
        
        <div class="paginador">
                <ul>
                    <li><a href="?pagina=<?php echo 1;?>">|<</a></li>
                    <li><a href="?pagina=<?php echo $pagina-1;?>"><<</a></li>
                <?php
                    for($i=1; $i<=$total_paginas; $i++){
                        if($i==$pagina){
                            echo '<li class="pageSelected">'.$i.'</li>';
                        }else{
                        echo '<li><a href="?pagina='.$i.'">'.$i.'</a></li>';
                    }
                }
                ?>
                    <li><a href="?pagina=<?php echo $pagina+1;?>">>></a></li>
                    <li><a href="?pagina=<?php echo $total_paginase;?>">>|</a></li>
                </ul>
        </div>
        
    </div>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <script src="../../js/functions.js"></script>
</body>
</html>