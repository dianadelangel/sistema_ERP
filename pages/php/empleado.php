<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://kit.fontawesome.com/6418fbc3a7.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="../../css/empleado.css">
    <title>Sistema de Inventarios</title>
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
        <h1 class="lines-effect">Usuarios</h1>
    </div>

    <!-- contenedor de Info.-->
    <div class="container">
        <h3>Añadir Empleados</h3>
        <div class="logo">
            <picture>
                <a href="admin.php"><img src="../../images/IM.png" alt="logo-inventario"/></a>
            </picture>
        </div>
        <div class="separator">
            <hr>
            <span>New Employment</span>
            <hr>
        </div>


        <div class="container">
        <h3>Registro Nuevo Empleado</h3>
        <div clas="alerta"><?php echo isset($alert) ? $alert: ''; ?></div>
        <form action="../../php/registrar.php" method="post">
            <div class="entradas">
                <label for="nombre">
                    <span>Nombre</span>
                    <input type="text" name="nombre" id="nombre">
                </label>
            </div>
            <label for="apellido">
                <span>Apellido</span>
                <input type="text" id="apellido" name="apellido">
            </label>
            <label for="empleado">
                <span>Numero de Empleado</span>
                <input type="text" id="empleado" name="empleado">
            </label>
            <label for="contraseña">
                <span>Contraseña</span>
                <input type="password" id="contraseña" name="contraseña">
            </label>
            <label for="rol">Rol</label>
                <?php
                include '../../php/conexion.php';
                     $query_act=mysqli_query($conexion,"SELECT *FROM roles");
                     $result_act=mysqli_num_rows($query_act);
                ?>
                <select name="rol" id="rol">
                    <?php
                if($result_act>0){
                     while($categoria=mysqli_fetch_array($query_act)){
                         ?>
                         <option value="<?php echo $categoria["ID_rol"]; ?>"><?php echo $categoria["rol"] ?></option>
                         <?php
                     }
                     }
                ?></select>
            

            <button type="submit" class="submit-btn" id="register" onclick="registrarUsuario()">Registrar</button>
        </form>
    </div>

    <script src="../../js/registro.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</body>
</html>