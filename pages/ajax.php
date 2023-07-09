<?php

    include '../php/conexion.php';

    session_start();
error_reporting(0);
$varsesion= $_SESSION['empleado'];
if($varsesion== null || $varsesion=''){
    header("location:../../index.html");
    die();
}

    //print_r($_POST);exit;

    if(!empty($_POST)){

        //Extraer datos de los productos
        if($_POST['action'] == 'infoProducto'){
            $producto_id = $_POST['producto'];

            $query = mysqli_query($conexion,"SELECT num_pro,producto FROM productos WHERE num_pro=$producto_id");

            mysqli_close($conexion);

            $result = mysqli_num_rows($query);
            if($result > 0){
                $data = mysqli_fetch_assoc($query);
                echo json_encode($data,JSON_UNESCAPED_UNICODE);
                exit;
            }
            echo 'error';
            exit;
        }

        //Busqueda de productos para la venta

            //Extraer datos de los productos
            if($_POST['action'] == 'infoProductos'){
                $producto_id = $_POST['producto'];
    
                $query = mysqli_query($conexion,"SELECT * FROM productos WHERE ID_producto LIKE '$producto_id'");
    
                mysqli_close($conexion);
    
                $result = mysqli_num_rows($query);
                if($result > 0){
                    $data = mysqli_fetch_assoc($query);
                    echo json_encode($data,JSON_UNESCAPED_UNICODE);
                    exit;
                }
                echo 'error';
                exit;
            }

        //Agregar datos de los productos a entrada
    if($_POST['action'] == 'addProduct'){
        if(!empty($_POST['cantidad']) || !empty($_POST['producto_id'])){
            $cantidad = $_POST['cantidad'];
            $producto_id = $_POST['producto_id'];

                //Ejecutar procedimiento almacenado

                $query_upd=mysqli_query($conexion, "CALL actualizar_precio_producto($cantidad, $producto_id)");
                $result_pro=mysqli_num_rows($query_upd);
                if($result_pro>0){
                    $data = mysqli_fetch_assoc($query_upd);
                    $data['producto_id']=$producto_id;
                    echo json_encode($data,JSON_UNESCAPED_UNICODE);
                exit;
                }
            }else{
                echo "error";
            }
            mysqli_close($conexion);
        exit;
    }


    /*Agregar productos a la tabla detalle*/
        if($_POST['action'] == 'addProductoDetalle'){
            if(empty($_POST['producto']) || empty($_POST['cantidad'])){
                echo 'error';
            }else{
                $codproducto = $_POST['producto'];
                $cantidad = $_POST['cantidad'];
                $categoria = $_POST['categoria'];
                $token = md5($_SESSION['empleado']);

                $query_st = mysqli_query($conexion,"SELECT * FROM productos WHERE ID_producto LIKE '$codproducto'");
                $info_stock = mysqli_fetch_assoc($query_st);
                    
                        $nuevo_stock = 0;
                        $actual_stock = 0;
                        $actual_stock = $info_stock['total_stock'];
                        $actual_venta = $info_stock['total_vendido'];
                        $nuevo_stock = ($actual_stock - $cantidad);
                        $nueva_cantidad = ($actual_venta + $cantidad);
                    
                        $query_update = mysqli_query($conexion,"UPDATE productos
                                                    SET  total_stock = $nuevo_stock, total_vendido = $nueva_cantidad
                                                    WHERE ID_producto LIKE '$codproducto'");


                $query_detalle_temp = mysqli_query($conexion, "CALL add_detalle_temp('$codproducto',$cantidad,'$token', '$categoria')");
                $result = mysqli_num_rows($query_detalle_temp);

                $detalleTabla = '';
                $sub_total = 0;
                $total = 0;
                $arrayData = array();

                if($result > 0){
                    while($data = mysqli_fetch_assoc($query_detalle_temp)){
                        $precioTotal = round($data['cantidad']*$data['precio_venta'], 2);
                        $sub_total = round($sub_total + $precioTotal, 2);
                        $total = round($total + $precioTotal, 2);

                        $detalleTabla .= '<tr>
                                            <td>'.$data['ID_producto'].'</td>
                                            <td colspan="2">'.$data['producto'].'</td>
                                            <td class="textcenter">'.$data['categoria'].'</td>
                                            <td class="textcenter">'.$data['cantidad'].'</td>
                                            <td class="textright">'.$data['precio_venta'].'</td>
                                            <td class="textright">'.$precioTotal.'</td>
                                            <td class="">
                                                <a class="link_delete" href="#" onclick="event.preventDefault(); del_product_detalle('.$data['num'].');">
                                                <i class="fa-solid fa-trash"></i></a>
                                            </td>
                                        </tr>';
                    }

                    $impuesto = round($sub_total*.16,2);
                    $tl_sniva = round($sub_total - $impuesto,2);
                    $total = round($tl_sniva + $impuesto,2);

                    $detalleTotales = '  <tr>
                                            <td colspan="5" class="textright">Subtotal $</td>
                                            <td class="textright">'.$tl_sniva.'</td>
                                        </tr>
                                        <tr>
                                            <td colspan="5" class="textright">IVA (16%)</td>
                                            <td class="textright">'.$impuesto.'</td>
                                        </tr>
                                        <tr>
                                            <td colspan="5" class="textright">Total $</td>
                                            <td class="textright">'.$total.'</td>
                                        </tr>';

                    $arrayData['detalle'] = $detalleTabla;
                    $arrayData['totales'] = $detalleTotales;

                    echo json_encode($arrayData,JSON_UNESCAPED_UNICODE);

                }else{
                    echo "error";
                }
                mysqli_close($conexion);
            }
            exit;
        }

    }

    

    if($_POST['action'] == 'delProductoDetalle'){
        if(empty($_POST['id_detalle']) ){
            echo 'error';
        }else{
            $id_detalle = $_POST['id_detalle'];
            $token = md5($_SESSION['empleado']);

            $query_stdet = mysqli_query($conexion,"SELECT ID_producto,cantidad FROM detalle_temp WHERE num = $id_detalle");
		 		$info_stockdet = mysqli_fetch_assoc($query_stdet);

		 		$nuevo_stock = 0;
		 		$actual_stock = 0;
		 		$detalle_stock = $info_stockdet['cantidad'];
		 		$detalle_cod = $info_stockdet['ID_producto'];
                $detalle_vendido = $infostockdet['cantidad'];
                $vendido = $detalle_vendido - $info_stock;



		 		$query_st = mysqli_query($conexion,"SELECT total_stock FROM productos WHERE ID_producto = '$detalle_cod'");
		 		$info_stock = mysqli_fetch_assoc($query_st);
		 		$actual_stock =$info_stock['total_stock'];

		 		$nuevo_stock = ($detalle_stock + $actual_stock);
		 	
		 		$query_update = mysqli_query($conexion,"UPDATE productos
													SET total_stock = $nuevo_stock, total_vendido = $vendido
													WHERE ID_producto = '$detalle_cod'");

            $query_detalle_temp = mysqli_query($conexion, "CALL del_detalle_temporal($id_detalle,'$token')");
            $result = mysqli_num_rows($query_detalle_temp);

            $detalleTabla = '';
            $sub_total = 0;
            $total = 0;
            $arrayData = array();

            if($result > 0){
                while($data = mysqli_fetch_assoc($query_detalle_temp)){
                    $precioTotal = round($data['cantidad']*$data['precio_venta'], 2);
                    $sub_total = round($sub_total + $precioTotal, 2);
                    $total = round($total + $precioTotal, 2);

                    $detalleTabla .= '<tr>
                                        <td>'.$data['ID_producto'].'</td>
                                        <td colspan="2">'.$data['Nombre'].'</td>
                                        <td class="textcenter">'.$data['categoria'].'</td>
                                        <td class="textcenter">'.$data['cantidad'].'</td>
                                        <td class="textright">'.$data['precio_venta'].'</td>
                                        <td class="textright">'.$precioTotal.'</td>
                                        <td class="">
                                            <a class="link_delete" href="#" onclick="event.preventDefault(); del_product_detalle('.$data['num'].');">
                                            <i class="fa-solid fa-trash"></i></a>
                                        </td>
                                    </tr>';
                }

                $impuesto = round($sub_total*.16,2);
                $tl_sniva = round($sub_total - $impuesto,2);
                $total = round($tl_sniva + $impuesto,2);

                $detalleTotales = '  <tr>
                                        <td colspan="5" class="textright">Subtotal $</td>
                                        <td class="textright">'.$tl_sniva.'</td>
                                    </tr>
                                    <tr>
                                        <td colspan="5" class="textright">IVA (16%)</td>
                                        <td class="textright">'.$impuesto.'</td>
                                    </tr>
                                    <tr>
                                        <td colspan="5" class="textright">Total $</td>
                                        <td class="textright">'.$total.'</td>
                                    </tr>';

                $arrayData['detalle'] = $detalleTabla;
                $arrayData['totales'] = $detalleTotales;

                echo json_encode($arrayData,JSON_UNESCAPED_UNICODE);
            }else{
                echo "error";
            }
            mysqli_close($conexion);
        }
        exit;
    }

    //Buscar Cliente 
    if($_POST['action'] == "searchCliente"){
        if(!empty($_POST['cliente'])){
            $rfc = $_POST['cliente'];

            $query_cl=mysqli_query($conexion,"SELECT * FROM cliente WHERE rfc LIKE '$rfc'");
            mysqli_close($conexion);
            $result = mysqli_num_rows($query_cl);

            $data = '';
            if($result>0){
                $data = mysqli_fetch_assoc($query_cl);
            }else{
                $data = 0;
            }
            echo json_encode($data,JSON_UNESCAPED_UNICODE);
        }
        exit;
    }

    //Registro Cliente
    if($_POST['action'] == "addCliente"){
        $rfc = $_POST['nit_cliente'];
        $nombre = $_POST['nom_cliente'];
        $telefono = $_POST['tel_cliente'];
        $direccion = $_POST['dir_cliente'];
        $usuario_id = $_SESSION['empleado'];
        

        $query_empleado = mysqli_query($conexion, "INSERT INTO cliente (idcliente, rfc, nombre, telefono, direccion, usuario_id)
                                        VALUES (NULL, '$rfc', '$nombre', '$telefono', '$direccion','$usuario_id')");
        
    }
    

    //Anular venta

    if($_POST['action'] == 'anularVenta'){

        $token = md5($_SESSION['empleado']);

         // REPONER STOCK DE PRODUCTOS 
			$query_stdeta = mysqli_query($conexion,"SELECT ID_producto ,cantidad FROM detalle_temp WHERE token_user = '$token'");

            while ($data = mysqli_fetch_assoc($query_stdeta))
            {
        
            $stock_rep = 0;


            $cod_deta   = $data['ID_producto'];
            $stock_deta = $data['cantidad'];
            $venta = $data['cantidad'];
            $ventas = $venta - $stock_deta;

            $query_stpro = mysqli_query($conexion,"SELECT * FROM productos WHERE ID_producto = '$cod_deta'");
            $produ = mysqli_fetch_assoc($query_stpro);
            $stock_pro = $produ['total_stock'];
            $stock_rep = round($stock_deta + $stock_pro);
            $query_update = mysqli_query($conexion,"UPDATE productos
                                                SET total_stock = $stock_rep, total_vendido = $ventas
                                                WHERE ID_producto = '$cod_deta'");
            }

        // fin reponer stock
        $query_del = mysqli_query($conexion, "DELETE FROM detalle_temp WHERE token_user= '$token'");
        mysqli_close($conexion);

        if($query_del){
            echo 'ok';
        }else{
            echo 'error';
        }
        exit;
    }
    

    //Procesar venta
    if($_POST['action'] == 'procesarVenta'){
        $codcliente = $_POST['codcliente'];
        $usuario = $_SESSION['empleado'];
        $token = md5($_SESSION['empleado']);
        $total_compra=0;
        $totales = 0;

        $query_temp=mysqli_query($conexion,"SELECT * FROM detalle_temp WHERE token_user = '$token'");
        $resultado = mysqli_num_rows($query_temp);

        if($resultado > 0){
            $query_procesar = mysqli_query($conexion,"CALL procesar_venta('$usuario','$codcliente','$token')");
            $result_detalle = mysqli_num_rows($query_procesar);

            if($result_detalle > 0){
                $data = mysqli_fetch_assoc($query_procesar);
                echo json_encode($data,JSON_UNESCAPED_UNICODE);
            }else{
                echo "error";
            }
        }else{
            echo "error";
        }
        mysqli_close($conexion);
        exit;
    }
    
?>