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

    <!-- Creación del modal-->
    <div class="modal">
        <div class="bodyModal">
            <form action="" method="post" name="form_add_product" id="form_add_product" onsubmit="event.preventDefault(); sendDataProduct();">
                <h2><i class="fa-solid fa-cubes" style="font-size:45pt;"></i><br>Agregar en Stock<h2>
                <h3 class="nameProducto"></h3><br>
                <input type="number" name="cantidad" id="txtCantidad" placeholder="Cantidad del Producto" required><br>
                <input type="hidden" name="producto_id" id="producto_id" required>
                <input type="hidden" name="action" value="addProduct" required>
                <div class="alert alertAddProduct"></div>
                <button type="submit" class="btn_new"><i class="fa-solid fa-plus"></i>Agregar</button>
                <a href="#" class="btn_ok closeModal" onclick="closerModal();"><i class="fa-solid fa-ban"></i>Cerrar</a>
            </div>
    </div>

    <!-- Creación del titulo-->
    <div class="title">
        <h1 class="lines-effect">Lista de Productos</h1>
    </div>

    <!-- Botón de registro-->

    <div class="register">
        <a href="new_vinos.php" class="btn-neon">
            <span id="span1"></span>
            <span id="span2"></span>
            <span id="span3"></span>
            <span id="span4"></span>
            Añadir Producto
        </a>
    </div>

    
    <!-- Comienza tabla-->

    <div class="datatable-container">
    <table class="datatable">
            <thead>
                <tr>
                    <th>ID Producto</th>
                    <th>Categoría</th>
                    <th>Clasificación</th>
                    <th>Nombre</th>
                    <th>Color</th>
                    <th>Material</th>
                    <th>Detalles</th>
                    <th>Moño</th>
                    <th>Papel</th>
                    <th>Total</th>
                    <th>Total Stock</th>
                    <th>Total Vendido</th>
                    <th>Precio Distr</th>
                    <th>Precio Venta</th>
                </tr>
            </thead>
            <tbody>
                <?php
                include('../../php/conexion.php');

                $sql_register=mysqli_query($conexion,"SELECT COUNT(*) AS total_registro FROM productos WHERE clasificacion = 'Botanas y Dulces'");
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

                $sql="SELECT * FROM productos WHERE clasificacion='Botanas y Dulces' ORDER BY num_pro ASC
                LIMIT $desde,$por_pagina;";
                $result=mysqli_query($conexion,$sql);
                while($mostrar=mysqli_fetch_array($result)){
                ?>
                <tr class="row<?php echo $mostrar['num_pro']?>">
                    <td><?php echo $mostrar['ID_producto']?></td>
                    <td><?php echo $mostrar['categoria']?></td>
                    <td><?php echo $mostrar['clasificacion']?></td>
                    <td><?php echo $mostrar['producto']?></td>
                    <td><?php echo $mostrar['color']?></td>
                    <td><?php echo $mostrar['material']?></td>
                    <td><?php echo $mostrar['detalles']?></td>
                    <td><?php echo $mostrar['mono']?></td>
                    <td><?php echo $mostrar['follaje']?></td>
                    <td><?php echo $mostrar['total']?></td>
                    <td><?php echo $mostrar['total_stock']?></td>
                    <td><?php echo $mostrar['total_vendido']?></td>
                    <td>$<?php echo $mostrar['precio_distribuidor']?></td>
                    <td>$<?php echo $mostrar['precio_venta']?></td>
                    <td><a class="add_product" product="<?php echo $mostrar["num_pro"]; ?>" href="#"><i class="fa-solid fa-plus fa-lg" title="Agregar" style="color:white"></i></a></td>
                    <td><a href="../../php/modificar_product.php?id=<?php echo $mostrar["num_pro"]; ?>"><i class="fa-solid fa-pen-to-square fa-lg" title="Editar" style="color:white"></i></a></td>
                    <td><a href="eliminar_product.php?id=<?php echo $mostrar["num_pro"]; ?>"><i class="fa-sharp fa-solid fa-trash fa-lg" title="Eliminar" style="color:white"></i></a></td>
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
        <div class=ganancia>
            <h3>Ganancia del día</h3>
            <?php
            include('../../php/conexion.php');
                $sql_v =mysqli_query($conexion, "SELECT * FROM productos WHERE clasificacion='Botanas y Dulces'");
                $ganancia =0;
                while($data = mysqli_fetch_assoc($sql_v)){
                    $total=$data['total'];
                    $t_venta = $data['total_vendido'];
                    $p_venta = $data['precio_venta'];
                    $p_distr = $data['precio_distribuidor'];
    
                    $ganancia = $ganancia+($t_venta*($p_venta-$p_distr));
                    if($t_venta==$total){
                        echo '<script>alert("Necesita comprar más producto")</script>';
                    }
                    }
                echo("$".$ganancia.".00 pesos");
                
            ?>
        </div>
    </div>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <script src="../../js/functions.js"></script>
</body>
</html>