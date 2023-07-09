<?php
require('../../pdf/fpdf.php');
require('../../php/conexion.php');

class PDF extends FPDF
{
// Cabecera de página
function Header()
{
    // Logo
    $this->Image('../../images/envia_flores.png',16,8,44);
    // Arial bold 15
    $this->SetFont('Arial','B',12);
    // Movernos a la derecha
    $this->Cell(60);
    // Título
    $this->Cell(70,15,'SISTEMA DE VENTAS FLORERIA',0,0,'C');
    // Salto de línea
    $this->Ln(4);
    $conexion=mysqli_connect("localhost","root","usbw","inventarios");
    $datos = mysqli_query($conexion,"SELECT * FROM configuracion");
    $mostrar = mysqli_fetch_array($datos);
    $this->SetFont('Arial','',8);
    $this->Cell(190,15,$mostrar['direccion'],0,0,'C');
    $this->Ln(4);
    $this->Cell(188,15,"Telefono:+(52) ".$mostrar['telefono'],0,0,'C');
    $this->Ln(4);
    $this->Cell(190,15,"Email: ".$mostrar['email'],0,0,'C');
}

function cabeceraHorizontal($cabecera)
    {
        $this->SetXY(155, 10);
        $this->SetFont('Arial','B',10);
        $this->SetFillColor(249,11,200);//Fondo rosa de celda
        $this->SetTextColor(240, 255, 240); //Letra color blanco
        foreach($cabecera as $fila)
        {
            //Atención!! el parámetro true rellena la celda con el color elegido
            $this->Cell(40,7, utf8_decode($fila),1, 0 , 'C', true);
        }
    }
function datosHorizontal($datos)
    {
        $this->SetXY(155,17);
        $this->SetFont('Arial','',8);
        $this->SetFillColor(255, 255, 255); //Gris tenue de cada fila
        $this->SetTextColor(3, 3, 3); //Color del texto: Negro
        $bandera = false; //Para alternar el relleno
        foreach($datos as $fila)
        {
            //El parámetro badera dentro de Cell: true o false
            //true: Llena  la celda con el fondo elegido
            //false: No rellena la celda
            $this->MultiCell(40,7, utf8_decode($fila['nombre']),1, 0 , 'L', $bandera );
            //$this->Ln();//Salto de línea para generar otra fila
        }
    }

    function tablaHorizontal($cabeceraHorizontal, $datosHorizontal)
    {
        $this->cabeceraHorizontal($cabeceraHorizontal);
        $this->datosHorizontal($datosHorizontal);
    }

    //segunda tabla

    function nuevaCabecera($n_cabecera)
    {
        $this->SetXY(15, 60);
        $this->SetFont('Arial','B',10);
        $this->SetFillColor(249,11,200);//Fondo rosa de celda
        $this->SetTextColor(240, 255, 240); //Letra color blanco
        foreach($n_cabecera as $filas)
        {
            //Atención!! el parámetro true rellena la celda con el color elegido
            $this->Cell(180,7, utf8_decode($filas),1, 0 , 'C', true);
        }
    }
function nuevosDatos($datos_n)
    {
        $this->SetXY(15,67);
        $this->SetFont('Arial','',8);
        $this->SetFillColor(255, 255, 255); //Gris tenue de cada fila
        $this->SetTextColor(3, 3, 3); //Color del texto: Negro
        $bandera = false; //Para alternar el relleno
        foreach($datos_n as $filas)
        {
            //El parámetro badera dentro de Cell: true o false
            //true: Llena  la celda con el fondo elegido
            //false: No rellena la celda
            $this->MultiCell(180,7, utf8_decode($filas['nombre']),1, 1, 'R', $bandera );
            //$this->Ln();//Salto de línea para generar otra fila
        }
    }

    function nuevaTabla($nuevaCabecera, $nuevosDatos)
    {
        $this->nuevaCabecera($nuevaCabecera);
        $this->nuevosDatos($nuevosDatos);
    }

    //Tercera tabla datos de la compra

    function cabeceraVentas($cabecera_ventas)
    {
        $this->SetXY(15, 100);
        $this->SetFont('Arial','B',10);
        $this->SetFillColor(249,11,200);//Fondo rosa de celda
        $this->SetTextColor(240, 255, 240); //Letra color blanco
        foreach($cabecera_ventas as $filas_ventas)
        {
            //Atención!! el parámetro true rellena la celda con el color elegido
            $this->Cell(180,7, utf8_decode($filas_ventas),1, 1 , 'L', true);
        }
    }
function datosVentas($datos_ventas)
    {
        $this->SetXY(15,107);
        $this->SetFont('Arial','',8);
        $this->SetFillColor(255, 255, 255); //Gris tenue de cada fila
        $this->SetTextColor(3, 3, 3); //Color del texto: Negro
        $bandera = false; //Para alternar el relleno
        foreach($datos_ventas as $filas_ventas)
        {
            //El parámetro badera dentro de Cell: true o false
            //true: Llena  la celda con el fondo elegido
            //false: No rellena la celda
            $this->MultiCell(180,7, utf8_decode($filas_ventas['nombre']),1, 1, 'R', $bandera );
            //$this->Ln();//Salto de línea para generar otra fila
        }
    }

    function tablaVentas($cabecera_ventas, $datos_ventas)
    {
        $this->cabeceraVentas($cabecera_ventas);
        $this->datosVentas($datos_ventas);
    }

}


// Creación del objeto de la clase heredada
$pdf = new PDF('P','mm','A4');
$pdf->AliasNbPages();
$pdf->AddPage();
$pdf->SetFont('Times','B',9);

if(empty($_GET['id'])){
    header('Location:principal.php');
}
$id_datos=$_GET['id'];
$conexion=mysqli_connect("localhost","root","usbw","inventarios");

$consulta="SELECT f.nofactura, DATE_FORMAT(f.fecha, '%d/%m/%Y') as fecha, DATE_FORMAT(f.fecha,'%H:%i:%s') 
as  hora, f.codcliente, f.estatus,
     v.nombre as vendedor,
     cl.rfc, cl.nombre, cl.telefono,cl.direccion
FROM factura f
INNER JOIN users v
ON f.usuario = v.num_empleado
INNER JOIN cliente cl
ON f.codcliente = cl.rfc
WHERE f.nofactura = $id_datos";

$resultado= mysqli_query($conexion,$consulta);
$fila = mysqli_fetch_array($resultado);

$miCabecera = array('Factura');
 
$misDatos = array(
            array('nombre' => 'No. Factura: '.$id_datos."\nFecha: ".$fila['fecha']."\nHora: ".$fila['hora']."\nVendedor: ".$fila['vendedor']),
            );
 
$pdf->tablaHorizontal($miCabecera, $misDatos);

//Datos del cliente

$newCabecera = array('Cliente');

$Datos_n = array(
    array('nombre' => '          RFC: '.$fila['rfc']."                                                                             Telefono: ".$fila['telefono'].
    "\n          Nombre: ".$fila['nombre']."                                                                      Dirección: ".$fila['direccion']),
    );
 
$pdf->nuevaTabla($newCabecera,$Datos_n);

//Datos de la venta

$ventas = mysqli_query($conexion, "SELECT d.nofactura, d.codproducto, d.cantidad, d.precio_venta FROM detallefactura d INNER JOIN factura f ON 
d.nofactura = f.nofactura WHERE  d.nofactura = $id_datos");


$cabecera_sale = array('   Cant.          Cod. Producto                                                                              Precio Unitario        Precio Total');

while($muestra = mysqli_fetch_array($ventas)){
$cantidad= $muestra['cantidad'];
$p_venta = $muestra['precio_venta'];
$p_total = $cantidad * $p_venta;
$Datos_sale = array(
    array('nombre' => "         ".$muestra['cantidad']."                   ".$muestra['codproducto'].
    "                                                                                                                        $ ".$muestra['precio_venta']."                            $ ".$p_total),
    );
}
$pdf->tablaVentas($cabecera_sale,$Datos_sale);

$pdf->Output();
?>