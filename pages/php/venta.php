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
    <link rel="stylesheet" href="../../css/ventas.css">
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

    <!--Creacion de la venta-->
    <section id="container">
        <div class="title_page">
            <h2><i class="fa-solid fa-cart-circle-plus"></i>Nueva Venta</h2>
        </div>
        <div class="datos_cliente">
            <div class="action_cliente">
                <h4>Datos del Cliente</h4>
                <a href="#" class="btn_new btn_new_cliente"><i class="fas fa-plus"></i>Nuevo Cliente</a>
            </div>

            <form name="form_new_cliente_venta" id="form_new_cliente_venta" class="datos">
                <input type="hidden" name="action" value="addCliente">
                <input type="hidden" id="idcliente" name="idcliente" value="" required>
                <div class="wd30">
                    <label>RFC</label>
                    <input type="text" name="nit_cliente" id="nit_cliente">
                </div>
                <div class="wd30">
                    <label>Nombre</label>
                    <input type="text" name="nom_cliente" id="nom_cliente" disabled required>
                </div>
                <div class="wd30">
                    <label>Telefono</label>
                    <input type="text" name="tel_cliente" id="tel_cliente" disabled required>
                </div>
                <div class="wd100">
                    <label>Dirección</label>
                    <input type="text" name="dir_cliente" id="dir_cliente" disabled required>
                </div>
                <div id="div_registro_cliente" class="wd100">
                    <button type="submit" class="btn_save"><i class="far fa-save fa-lg"></i>Guardar</button>
                </div>
            </form>
        </div>
        <div class="datos_venta">
            <h4>Datos de venta</h4>
            <div class="datos">
                <div class="wd50">
                    <label>Vendedor</label>
                    <p><?php echo $_SESSION['empleado'] ?></p>
                </div>
                <div class="wd50">
                    <label>Acciones</label>
                    <div id="acciones_venta">
                        <a href="#" class="btn_ok textcenter" id="btn_anular_venta">
                            <i class="fa-solid fa-ban"></i>Anular</a>
                        <a href="#" class="btn_new textcenter" id="btn_facturar_venta" style="display: none;">
                        <i class="fas fa-edit"></i>Procesar</a>
                    </div>
                </div>
            </div>
        </div>

        <table class="tbl_venta">
            <thead>
                <tr>
                    <th width="100px">Código</th>
                    <th>Nombre</th>
                    <th>Categoria</th>
                    <th>Existencia</th>
                    <th width="100px">Cantidad</th>
                    <th class="textright">Precio</th>
                    <th class="textright">Precio Total</th>
                    <th>Acción</th>
                </tr>
                <tr>
                    <td><input type="text" name="txt_cod_producto" id="txt_cod_producto"></td>
                    <td id="text_nombre">-</td>
                    <td id="text_categoria">-</td>
                    <td id="text_existencia">-</td>
                    <td><input type="text" name="txt_cant_producto" id="txt_cant_producto" value="0" min="1" disabled></td>
                    <td id="txt_precio" class="textright">0.00</td>
                    <td id="txt_precio_total" class="textright">0.00</td>
                    <td><a href="#" id="add_product_venta" class="link_add"><i class="fa-solid fa-plus"></i>Agregar</a></td>
                </tr>

                <tr>
                    <th>Código</th>
                    <th colspan="2">Descripción</th>
                    <th>Categoria</th>
                    <th>Cantidad</th>
                    <th class="textright">Precio</th>
                    <th class="textright">Precio Total</th>
                    <th> Acción</th>
                </tr>
            </thead>

            <tbody id="detalle_venta">
                <!--Contenido en AJAX-->
            </tbody>

            <tfoot id="detalle_totales">
              <!--Contenido AJAX-->
            </tfoot>
        </table>
</section>


        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
        <script src="../../js/functions.js"></script>
    </body>
</html>