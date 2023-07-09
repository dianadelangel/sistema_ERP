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
                <span class="nav-item">Tabla Vendedores</span>
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
        <h1 class="lines-effect">Usuarios</h1>
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
                    <th>N°</th>
                    <th>Num Emp</th>
                    <th>Nombre</th>
                    <th>Apellido</th>
                    <th>Contraseña</th>
                    <th>Rol</th>
                </tr>
            </thead>
            <tbody>
                <?php
                include('../../php/conexion.php');
                $sql="SELECT * FROM users u INNER JOIN roles r ON u.ID_rol = r.ID_rol WHERE u.ID_rol = '2';";
                $result=mysqli_query($conexion,$sql);
                while($mostrar=mysqli_fetch_array($result)){
                ?>
                <tr>
                    <td><span class="available"></td>
                    <td><?php echo $mostrar['ID']?></td>
                    <td><?php echo $mostrar['num_empleado']?></td>
                    <td><?php echo $mostrar['nombre']?></td>
                    <td><?php echo $mostrar['apellido']?></td>
                    <td><?php echo $mostrar['contraseña']?></td>
                    <td><?php echo $mostrar['rol']?></td>
                    <td><a href="../../php/modificar_empleado.php?id=<?php echo $mostrar["ID"]; ?>"><i class="fa-solid fa-pen-to-square fa-lg" style="color:white"></i></a></td>
                    <td><a href="eliminar_empleado.php?id=<?php echo $mostrar["ID"]; ?>"><i class="fa-sharp fa-solid fa-trash fa-lg" style="color:white"></i></a></td>
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