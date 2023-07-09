<?php 
//seguridad de sessiones paginacion
session_start();
error_reporting(0);
$varsesion= $_SESSION['empleado'];
if($varsesion== null || $varsesion=''){
    header("location:../../index.html");
    die();
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
            <li><a href="admin.php">
                <i class="fa-solid fa-house"></i>
                <span class="nav-item">Inicio</span>
            </a></li>
            <li><a href="empleado.php">
                <i class="fa-sharp fa-solid fa-cart-plus"></i>
                <span class="nav-item">Nuevo Empleado</span>
            </a></li>
            <li><a href="vendedores.php">
                <i class="fa-solid fa-file"></i>
                <span class="nav-item">Vendedores</span>
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
                    <th>Nombre</th>
                    <th>Apellido</th>
                    <th>Num Empleado</th>
                    <th>Categoria 1</th>
                    <th>Categoria 2</th>
                    <th>Categoria 3</th>
                    <th>Categoria 4</th>
                    <th>Categoria 5</th>
                </tr>
            </thead>
            <tbody>
                <?php
                include('../../php/conexion.php');

                $query = "SELECT SUM(cantidad) AS total FROM detallefactura WHERE categoria='Flores' AND token_user = '8174ee24b8764a0269c2eafafb74c313'";
                $resultado = mysqli_query($conexion,$query);
                $fila = mysqli_fetch_array($resultado);
                $total = $fila['total'];

                $query_p = "SELECT SUM(cantidad) AS total_p FROM detallefactura WHERE categoria='Postres' AND token_user = '8174ee24b8764a0269c2eafafb74c313'";
                $resultado_p = mysqli_query($conexion,$query_p);
                $fila_p = mysqli_fetch_array($resultado_p);
                $total_p = $fila_p['total_p'];

                $query_reg = "SELECT SUM(cantidad) AS total_reg FROM detallefactura WHERE categoria='Regalos' AND token_user = '8174ee24b8764a0269c2eafafb74c313'";
                $resultado_reg = mysqli_query($conexion,$query_reg);
                $fila_reg = mysqli_fetch_array($resultado_reg);
                $total_reg = $fila_reg['total_reg'];

                $query_gl = "SELECT SUM(cantidad) AS total_gl FROM detallefactura WHERE categoria='Globos'AND token_user ='8174ee24b8764a0269c2eafafb74c313'";
                $resultado_gl = mysqli_query($conexion,$query_gl);
                $fila_gl = mysqli_fetch_array($resultado_gl);
                $total_gl = $fila_gl['total_gl'];

                $query_vi = "SELECT SUM(cantidad) AS total_vi FROM detallefactura WHERE categoria='Botanas y Vinos' AND token_user = '8174ee24b8764a0269c2eafafb74c313'";
                $resultado_vi = mysqli_query($conexion,$query_vi);
                $fila_vi = mysqli_fetch_array($resultado_vi);
                $total_vi = $fila_vi['total_vi'];

                $suma = ($total+$total_p+$total_reg+$total_gl+$total_vi)/5;

                ?>
                <tr>
                    <td>Sara</td>
                    <td>Huero Diyarza</td>
                    <td>298465</td>
                    <td><?php echo $total?></td>
                    <td><?php echo $total_p?></td>
                    <td><?php echo $total_reg?></td>
                    <td><?php echo $total_gl?></td>
                    <td><?php echo $total_vi?></td>
                </tr>

                <?php
                 $query = "SELECT SUM(cantidad) AS total FROM detallefactura WHERE categoria='Flores' AND token_user = 'fc40b397aaa7f65ebb0059edff3162be'";
                 $resultado = mysqli_query($conexion,$query);
                 $fila = mysqli_fetch_array($resultado);
                 $total = $fila['total'];
 
                 $query_p = "SELECT SUM(cantidad) AS total_p FROM detallefactura WHERE categoria='Postres' AND token_user = 'fc40b397aaa7f65ebb0059edff3162be'";
                 $resultado_p = mysqli_query($conexion,$query_p);
                 $fila_p = mysqli_fetch_array($resultado_p);
                 $total_p = $fila_p['total_p'];
 
                 $query_reg = "SELECT SUM(cantidad) AS total_reg FROM detallefactura WHERE categoria='Regalos' AND token_user = 'fc40b397aaa7f65ebb0059edff3162be'";
                 $resultado_reg = mysqli_query($conexion,$query_reg);
                 $fila_reg = mysqli_fetch_array($resultado_reg);
                 $total_reg = $fila_reg['total_reg'];
 
                 $query_gl = "SELECT SUM(cantidad) AS total_gl FROM detallefactura WHERE categoria='Globos'AND token_user ='fc40b397aaa7f65ebb0059edff3162be'";
                 $resultado_gl = mysqli_query($conexion,$query_gl);
                 $fila_gl = mysqli_fetch_array($resultado_gl);
                 $total_gl = $fila_gl['total_gl'];
 
                 $query_vi = "SELECT SUM(cantidad) AS total_vi FROM detallefactura WHERE categoria='Botanas y Vinos' AND token_user = 'fc40b397aaa7f65ebb0059edff3162be'";
                 $resultado_vi = mysqli_query($conexion,$query_vi);
                 $fila_vi = mysqli_fetch_array($resultado_vi);
                 $total_vi = $fila_vi['total_vi'];

                $suma2 = ($total+$total_p+$total_reg+$total_gl+$total_vi)/5;

                 ?>

                <tr>
                    <td>Mauricio</td>
                    <td>Gonzalez</td>
                    <td>2498468</td>
                    <td><?php echo $total?></td>
                    <td><?php echo $total_p?></td>
                    <td><?php echo $total_reg?></td>
                    <td><?php echo $total_gl?></td>
                    <td><?php echo $total_vi?></td>
                </tr>

                <?php
                 $query = "SELECT SUM(cantidad) AS total FROM detallefactura WHERE categoria='Flores' AND token_user = 'b47056fc79e0950b203cdaafc81c4fd2'";
                 $resultado = mysqli_query($conexion,$query);
                 $fila = mysqli_fetch_array($resultado);
                 $total = $fila['total'];
 
                 $query_p = "SELECT SUM(cantidad) AS total_p FROM detallefactura WHERE categoria='Postres' AND token_user = 'b47056fc79e0950b203cdaafc81c4fd2'";
                 $resultado_p = mysqli_query($conexion,$query_p);
                 $fila_p = mysqli_fetch_array($resultado_p);
                 $total_p = $fila_p['total_p'];
 
                 $query_reg = "SELECT SUM(cantidad) AS total_reg FROM detallefactura WHERE categoria='Regalos' AND token_user = 'b47056fc79e0950b203cdaafc81c4fd2'";
                 $resultado_reg = mysqli_query($conexion,$query_reg);
                 $fila_reg = mysqli_fetch_array($resultado_reg);
                 $total_reg = $fila_reg['total_reg'];
 
 
                 $query_gl = "SELECT SUM(cantidad) AS total_gl FROM detallefactura WHERE categoria='Globos'AND token_user ='b47056fc79e0950b203cdaafc81c4fd2'";
                 $resultado_gl = mysqli_query($conexion,$query_gl);
                 $fila_gl = mysqli_fetch_array($resultado_gl);
                 $total_gl = $fila_gl['total_gl'];
 
                 $query_vi = "SELECT SUM(cantidad) AS total_vi FROM detallefactura WHERE categoria='Botanas y Vinos' AND token_user = 'b47056fc79e0950b203cdaafc81c4fd2'";
                 $resultado_vi = mysqli_query($conexion,$query_vi);
                 $fila_vi = mysqli_fetch_array($resultado_vi);
                 $total_vi = $fila_vi['total_vi'];

                 $suma3=($total+$total_p+$total_reg+$total_gl+$total_vi)/5;
 
                 ?>

                <tr>
                    <td>Carlos</td>
                    <td>Benitez</td>
                    <td>2978465</td>
                    <td><?php echo $total?></td>
                    <td><?php echo $total_p?></td>
                    <td><?php echo $total_reg?></td>
                    <td><?php echo $total_gl?></td>
                    <td><?php echo $total_vi?></td>
                </tr>

                <?php
                 $query = "SELECT SUM(cantidad) AS total FROM detallefactura WHERE categoria='Flores' AND token_user = '359e6b1844c1e9015347fda032e4d2f7'";
                 $resultado = mysqli_query($conexion,$query);
                 $fila = mysqli_fetch_array($resultado);
                 $total = $fila['total'];
 
                 $query_p = "SELECT SUM(cantidad) AS total_p FROM detallefactura WHERE categoria='Postres' AND token_user = '359e6b1844c1e9015347fda032e4d2f7'";
                 $resultado_p = mysqli_query($conexion,$query_p);
                 $fila_p = mysqli_fetch_array($resultado_p);
                 $total_p = $fila_p['total_p'];
 
                 $query_reg = "SELECT SUM(cantidad) AS total_reg FROM detallefactura WHERE categoria='Regalos' AND token_user = '359e6b1844c1e9015347fda032e4d2f7'";
                 $resultado_reg = mysqli_query($conexion,$query_reg);
                 $fila_reg = mysqli_fetch_array($resultado_reg);
                 $total_reg = $fila_reg['total_reg'];
 
 
                 $query_gl = "SELECT SUM(cantidad) AS total_gl FROM detallefactura WHERE categoria='Globos'AND token_user ='359e6b1844c1e9015347fda032e4d2f7'";
                 $resultado_gl = mysqli_query($conexion,$query_gl);
                 $fila_gl = mysqli_fetch_array($resultado_gl);
                 $total_gl = $fila_gl['total_gl'];
 
                 $query_vi = "SELECT SUM(cantidad) AS total_vi FROM detallefactura WHERE categoria='Botanas y Vinos' AND token_user = '359e6b1844c1e9015347fda032e4d2f7'";
                 $resultado_vi = mysqli_query($conexion,$query_vi);
                 $fila_vi = mysqli_fetch_array($resultado_vi);
                 $total_vi = $fila_vi['total_vi'];

                 $suma4=($total+$total_p+$total_reg+$total_gl+$total_vi)/5;
 
                 ?>

                <tr>
                    <td>Saul</td>
                    <td>Cortez</td>
                    <td>586435</td>
                    <td><?php echo $total?></td>
                    <td><?php echo $total_p?></td>
                    <td><?php echo $total_reg?></td>
                    <td><?php echo $total_gl?></td>
                    <td><?php echo $total_vi?></td>
                </tr>

                <?php
                 $query = "SELECT SUM(cantidad) AS total FROM detallefactura WHERE categoria='Flores' AND token_user = '973d8a0d9f2ebce9685e5cdacdf5dde3'";
                 $resultado = mysqli_query($conexion,$query);
                 $fila = mysqli_fetch_array($resultado);
                 $total = $fila['total'];
 
                 $query_p = "SELECT SUM(cantidad) AS total_p FROM detallefactura WHERE categoria='Postres' AND token_user = '973d8a0d9f2ebce9685e5cdacdf5dde3'";
                 $resultado_p = mysqli_query($conexion,$query_p);
                 $fila_p = mysqli_fetch_array($resultado_p);
                 $total_p = $fila_p['total_p'];
 
                 $query_reg = "SELECT SUM(cantidad) AS total_reg FROM detallefactura WHERE categoria='Regalos' AND token_user = '973d8a0d9f2ebce9685e5cdacdf5dde3'";
                 $resultado_reg = mysqli_query($conexion,$query_reg);
                 $fila_reg = mysqli_fetch_array($resultado_reg);
                 $total_reg = $fila_reg['total_reg'];
 
 
                 $query_gl = "SELECT SUM(cantidad) AS total_gl FROM detallefactura WHERE categoria='Globos'AND token_user ='973d8a0d9f2ebce9685e5cdacdf5dde3'";
                 $resultado_gl = mysqli_query($conexion,$query_gl);
                 $fila_gl = mysqli_fetch_array($resultado_gl);
                 $total_gl = $fila_gl['total_gl'];
 
                 $query_vi = "SELECT SUM(cantidad) AS total_vi FROM detallefactura WHERE categoria='Botanas y Vinos' AND token_user = '973d8a0d9f2ebce9685e5cdacdf5dde3'";
                 $resultado_vi = mysqli_query($conexion,$query_vi);
                 $fila_vi = mysqli_fetch_array($resultado_vi);
                 $total_vi = $fila_vi['total_vi'];

                 $suma5=($total+$total_p+$total_reg+$total_gl+$total_vi)/5;
 
                 ?>

                <tr>
                    <td>Diego</td>
                    <td>Ramirez</td>
                    <td>2968742</td>
                    <td><?php echo $total?></td>
                    <td><?php echo $total_p?></td>
                    <td><?php echo $total_reg?></td>
                    <td><?php echo $total_gl?></td>
                    <td><?php echo $total_vi?></td>
                </tr>
                
            </tbody> <!--Llenar datos con mysql-->
        </table>
        
    </div>

    <p>Sara Huero Diyarza tiene un porcentaje de: <?php echo $suma ?> %<p>
    <p>Mauricio González tiene un porcentaje de: <?php echo $suma2 ?> %<p>
    <p>Carlos Benitez tiene un porcentaje de: <?php echo $suma3 ?> %<p>
    <p>Saúl Cortez tiene un porcentaje de: <?php echo $suma4 ?> %<p>
    <p>Diego Ramirez tiene un porcentaje de: <?php echo $suma5 ?> %<p>

    <div id="top_x_div"></div>

</body>
<script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
    <script type="text/javascript">
        google.charts.load('current', {'packages':['bar']});
      google.charts.setOnLoadCallback(drawStuff);

      function drawStuff() {
        var data = new google.visualization.arrayToDataTable([
          ['Empleados', 'Porcentaje'],
          ['Sara Huero', <?php echo $suma ?>],
          ['Mauricio González', <?php echo $suma2 ?>],
          ['Carlos Benitez', <?php echo $suma3 ?>],
          ['Saúl Cortez', <?php echo $suma4 ?>],
          ['Diego Ramirez', <?php echo $suma5 ?>]

        ]);

        var options = {
          legend: { position: 'none' },
          bars: 'horizontal', // Required for Material Bar Charts.
          axes: {
            x: {
              0: { side: 'top', label: 'Porcentaje'} // Top x-axis.
            }
          },
          bar: { groupWidth: "90%" }
        };

        var chart = new google.charts.Bar(document.getElementById('top_x_div'));
        chart.draw(data, options);
      };
    </script>
</html>