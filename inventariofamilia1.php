<?php require_once('Connections/conn.php'); ?>
<?php
if (!function_exists("GetSQLValueString")) {
function GetSQLValueString($theValue, $theType, $theDefinedValue = "", $theNotDefinedValue = "") 
{
  if (PHP_VERSION < 6) {
    $theValue = get_magic_quotes_gpc() ? stripslashes($theValue) : $theValue;
  }

  $theValue = function_exists("mysql_real_escape_string") ? mysql_real_escape_string($theValue) : mysql_escape_string($theValue);

  switch ($theType) {
    case "text":
      $theValue = ($theValue != "") ? "'" . $theValue . "'" : "NULL";
      break;    
    case "long":
    case "int":
      $theValue = ($theValue != "") ? intval($theValue) : "NULL";
      break;
    case "double":
      $theValue = ($theValue != "") ? doubleval($theValue) : "NULL";
      break;
    case "date":
      $theValue = ($theValue != "") ? "'" . $theValue . "'" : "NULL";
      break;
    case "defined":
      $theValue = ($theValue != "") ? $theDefinedValue : $theNotDefinedValue;
      break;
  }
  return $theValue;
}
}

function GetSQLValueString($theValue, $theType, $theDefinedValue = "", $theNotDefinedValue = "") 
{
  $theValue = (!get_magic_quotes_gpc()) ? addslashes($theValue) : $theValue;

  switch ($theType) {
    case "text":
      $theValue = ($theValue != "") ? "'" . $theValue . "'" : "NULL";
      break;    
    case "long":
	
    case "int":
      $theValue = ($theValue != "") ? intval($theValue) : "NULL";
      break;
    case "double":
      $theValue = ($theValue != "") ? "'" . doubleval($theValue) . "'" : "NULL";
      break;
    case "date":
      $theValue = ($theValue != "") ? "'" . $theValue . "'" : "NULL";
      break;
    case "defined":
      $theValue = ($theValue != "") ? $theDefinedValue : $theNotDefinedValue;
      break;
  }
  return $theValue;
}

$editFormAction = $_SERVER['PHP_SELF'];
if (isset($_SERVER['QUERY_STRING'])) {
  $editFormAction .= "?" . htmlentities($_SERVER['QUERY_STRING']);
}

if ((isset($_POST["MM_insert"])) && ($_POST["MM_insert"] == "form5")) {
  $insertSQL = sprintf("INSERT INTO clientes (abono) VALUES (%s)",
                       GetSQLValueString($_POST['abono'], "text"));

  mysql_select_db($database_conn, $conn);
  $Result1 = mysql_query($insertSQL, $conn) or die(mysql_error());

  $insertGoTo = "consultarclientenit.php";
  if (isset($_SERVER['QUERY_STRING'])) {
    $insertGoTo .= (strpos($insertGoTo, '?')) ? "&" : "?";
    $insertGoTo .= $_SERVER['QUERY_STRING'];
  }
  header(sprintf("Location: %s", $insertGoTo));
}

if ((isset($_POST["MM_insert"])) && ($_POST["MM_insert"] == "form5")) {
  $insertSQL = sprintf("INSERT INTO abonos (Nit, abono, fecha_Abono) VALUES (%s, %s, %s)",
                       GetSQLValueString($_POST['Nit'], "text"),
                       GetSQLValueString($_POST['abono'], "text"),
                       GetSQLValueString($_POST['fecha_Abono'], "date"));

  mysql_select_db($database_conn, $conn);
  $Result1 = mysql_query($insertSQL, $conn) or die(mysql_error());
}

if ((isset($_POST["MM_insert"])) && ($_POST["MM_insert"] == "form5")) {
  $insertSQL = sprintf("INSERT INTO abonos (Nit, abono, fecha_Abono) VALUES (%s, %s, %s)",
                       GetSQLValueString($_POST['Nit'], "text"),
                       GetSQLValueString($_POST['abono'], "text"),
                       GetSQLValueString($_POST['fecha_Abono'], "text"));

  mysql_select_db($database_conn, $conn);
  $Result1 = mysql_query($insertSQL, $conn) or die(mysql_error());
}

if ((isset($_POST["MM_insert"])) && ($_POST["MM_insert"] == "form5")) {
  $insertSQL = sprintf("INSERT INTO abonos (Nit, abono, fecha_Abono) VALUES (%s, %s, %s)",
                       GetSQLValueString($_POST['Nit'], "text"),
                       GetSQLValueString($_POST['abono'], "text"),
                       GetSQLValueString($_POST['fecha_Abono'], "text"));

  mysql_select_db($database_conn, $conn);
  $Result1 = mysql_query($insertSQL, $conn) or die(mysql_error());
}

if ((isset($_POST["MM_insert"])) && ($_POST["MM_insert"] == "form4")) {
  $insertSQL = sprintf("INSERT INTO abonos (Nit, abono, fecha_Abono) VALUES (%s, %s, %s)",
                       GetSQLValueString($_POST['Nit'], "text"),
                       GetSQLValueString($_POST['abono'], "text"),
                       GetSQLValueString($_POST['fecha_Abono'], "text"));

  mysql_select_db($database_conn, $conn);
  $Result1 = mysql_query($insertSQL, $conn) or die(mysql_error());

  $insertGoTo = "menu.php";
  if (isset($_SERVER['QUERY_STRING'])) {
    $insertGoTo .= (strpos($insertGoTo, '?')) ? "&" : "?";
    $insertGoTo .= $_SERVER['QUERY_STRING'];
  }
  header(sprintf("Location: %s", $insertGoTo));
}

$varNit_Recordset1 = "-1";
if (isset($_GET[Nit])) {
  $varNit_Recordset1 = (get_magic_quotes_gpc()) ? $_GET[Nit] : addslashes($_GET[Nit]);
}
mysql_select_db($database_conn, $conn);
$query_Recordset1 = sprintf("SELECT clientes.Nombres, clientes.Nit, facturas.total_fact, facturas.estado, facturas.fecha_fact, facturas.id_fact, ventas.id_product, articulos.nomb_product, ventas.precio FROM clientes INNER JOIN facturas ON clientes.id_Cliente = facturas.id_Cliente AND clientes.Nit =%s AND facturas.estado =1 INNER JOIN ventas ON ventas.id_fact = facturas.id_fact INNER JOIN articulos ON articulos.id_product = ventas.id_product ORDER BY Nit", $varNit_Recordset1);
$Recordset1 = mysql_query($query_Recordset1, $conn) or die(mysql_error());
$row_Recordset1 = mysql_fetch_assoc($Recordset1);
$totalRows_Recordset1 = mysql_num_rows($Recordset1);

mysql_select_db($database_conn, $conn);
$query_Recordset2 = "SELECT precio FROM ventas";
$Recordset2 = mysql_query($query_Recordset2, $conn) or die(mysql_error());
$row_Recordset2 = mysql_fetch_assoc($Recordset2);
$totalRows_Recordset2 = mysql_num_rows($Recordset2);

mysql_select_db($database_conn, $conn);
$query_Recordset3 = "SELECT * FROM abonos";
$Recordset3 = mysql_query($query_Recordset3, $conn) or die(mysql_error());
$row_Recordset3 = mysql_fetch_assoc($Recordset3);
$totalRows_Recordset3 = mysql_num_rows($Recordset3);

$maxRows_Recordset4 = 10;
$pageNum_Recordset4 = 0;
if (isset($_GET['pageNum_Recordset4'])) {
  $pageNum_Recordset4 = $_GET['pageNum_Recordset4'];
}
$startRow_Recordset4 = $pageNum_Recordset4 * $maxRows_Recordset4;

$varNit_Recordset4 = "-1";
if (isset($_GET['Nit'])) {
  $varNit_Recordset4 = (get_magic_quotes_gpc()) ? $_GET['Nit'] : addslashes($_GET['Nit']);
}
mysql_select_db($database_conn, $conn);
$query_Recordset4 = sprintf("SELECT SUM( abonos.abono ) FROM abonos WHERE abonos.Nit =%s", $varNit_Recordset4);
$query_limit_Recordset4 = sprintf("%s LIMIT %d, %d", $query_Recordset4, $startRow_Recordset4, $maxRows_Recordset4);
$Recordset4 = mysql_query($query_limit_Recordset4, $conn) or die(mysql_error());
$row_Recordset4 = mysql_fetch_assoc($Recordset4);

if (isset($_GET['totalRows_Recordset4'])) {
  $totalRows_Recordset4 = $_GET['totalRows_Recordset4'];
} else {
  $all_Recordset4 = mysql_query($query_Recordset4);
  $totalRows_Recordset4 = mysql_num_rows($all_Recordset4);
}
$totalPages_Recordset4 = ceil($totalRows_Recordset4/$maxRows_Recordset4)-1;

$var1_Recordset5 = "-1";
if (isset($_GET[familia])) {
  $var1_Recordset5 = $_GET[familia];
}
mysql_select_db($database_conn, $conn);
$query_Recordset5 = sprintf("SELECT articulos.nomb_product, articulos.familia, articulos.inventario, medida.cantidad_medida FROM articulos INNER JOIN medida ON ( medida.id_medida = articulos.id_medida AND articulos.familia = %s )", GetSQLValueString($var1_Recordset5, ""));
$Recordset5 = mysql_query($query_Recordset5, $conn) or die(mysql_error());
$row_Recordset5 = mysql_fetch_assoc($Recordset5);
$totalRows_Recordset5 = mysql_num_rows($Recordset5);
?><style type="text/css">
.letra_menu {
	color: #FFF;
}
body {
	background-image: url(img/Fondo-color-verde-688051.jpeg);
}
.Estilo10 {
	color: #FFFF00;
	font-size: 24px;
}
.Estilo17 {color: #FFFF00; font-size: 12px; }
.Estilo20 {color: #FF0000; font-size: 24px; }
</style>
<link href="SpryAssets/SpryMenuBarHorizontal.css" rel="stylesheet" type="text/css" />
<script src="SpryAssets/SpryMenuBar.js" type="text/javascript"></script>

<!-- TemplateBeginEditable name="head" --><!-- TemplateEndEditable -->
<style type="text/css">
<!--
.Estilo21 {
	color: #FFFFFF;
	font-weight: bold;
}
.Estilo22 {color: #FFFFFF}
.Estilo23 {
	color: #FFFF00;
	font-weight: bold;
}
.Estilo24 {color: #FFFF00}
#form3 p {
	color: #FF0;
}
-->
</style>
<table width="1327" border="0" align="left" cellpadding="0" cellspacing="0">
  <tr>
    <td width="1172" height="45"><p align="center" class="Estilo10">SKYNET INGENIERIA </p>
    <p align="center">&nbsp;</p>
    </td>
  </tr>
  <tr>
    <td><div align="center" class="Estilo17"></div></td>
  </tr>
</table>
<form id="form1" name="form1" method="post" action="">
  <div align="center" class="Estilo20">
    <ul id="MenuBar1" class="MenuBarHorizontal">
      <li></li>
      <li></li>
      <li></li>
      <li></li>
     <li><a class="MenuBarItemSubmenu" href="#">ARTICULOS</a>
  <ul>
    <li><a href="add_producto.php">CREAR</a></li>
    <li><a href="promociones.php">CAMBIAR PRECIOS</a></li>
  </ul>
</li>
      <li><a href="#" class="MenuBarItemSubmenu">USUARIOS</a>
          <ul>
<li><a href="cajas.php">IP</a></li>
<li><a href="usuarios.php">USUARIOS</a></li>
<li><a href="mantenimiento.php">REPARAR TABLAS</a></li>
          </ul>
      </li>
      <li><a class="MenuBarItemSubmenu" href="#">FACTURAS</a>
          <ul>
            <li><a href="eliminar_producto.php">BORRAR PRODUCTO</a></li>
            <li><a href="devoluciones.php">DEVOLUCION</a></li>
            <li><a href="ELIMINARFACTURA.HTML">ELIMINAR FACTURA</a></li>
          </ul>
      </li>
      <li><a href="#" class="MenuBarItemSubmenu">INFORMES</a>
          <ul>
            <li><a href="reporte4.php">TOTAL FACTURADO</a></li>
            <li><a href="buscardia.php">VENTA DIA</a></li>
            <li><a href="buscardiautilidad.php">UTILIDAD DIA</a></li>
            <li><a href="reportes1.php">PRODUCTOS VENDIDOS</a></li>
            <li><a href="reporte_az.php">A-Z CAJERO</a></li>
            <li><a href="reporte_facturas.php">FACTURA POR CAJERO</a></li>
            <li><a href="CONSULTARGASTOS.PHP">GASTOS</a></li>
          </ul>
      </li>
      <li><a href="#" class="MenuBarItemSubmenu">GESTION</a>
          <ul>
            <li><a href="cargar_inventario.php">INVENTARIOS</a>            </li>
            <li><a href="inventariofamilia.php" class="MenuBarItemSubmenu">FAMILIAS</a>
              <ul>
                <li><a href="#">CERRAR VIGENCIA</a></li>
              </ul>
            </li>
            <li><a href="#" class="MenuBarItemSubmenu">NOMINA</a>
              <ul>
                <li><a href="CREAREMPLEADO.PHP">GESTION DE NOMINA</a></li>
                <li><a href="modificarempleado.php">MODIFICAR</a></li>
                <li><a href="listarempleados.php">LISTAR</a></li>
                <li><a href="nomina.php">GENERAR NOMINA</a></li>
              </ul>
            </li>
            <li><a href="buscarcliente.html" class="MenuBarItemSubmenu">CLIENTES</a>
                <ul>
                  <li><a href="CREARCLIENTE.PHP">CREAR</a></li>
                  <li><a href="CONSULTARCLIENTES.PHP">LISTAR CLIENTE</a></li>
                  <li><a href="buscarcliente.html">MODIFICAR</a></li>
                  <li><a href="consultaclientenit.html">VER ESTADO</a></li>
                </ul>
            </li>
            <li><a href="#" class="MenuBarItemSubmenu">PROVEEDOR</a>
              <ul>
                <li><a href="crearproveedor.php">CREAR</a></li>
                <li><a href="modificarproveedor.html">MODIFICAR</a></li>
                <li><a href="listarproveedor.php">LISTAR</a></li>
                <li><a href="estadoproveedor.html">ESTADO DEL PROVEEDOR</a></li>
                <li><a href="ingresarcompra.php">INGRESAR COMPRA</a></li>
              </ul>
            </li>
            <li><a href="#MANTENIMIENTO">MANTENIMIENTO</a></li>
          </ul>
      </li>
      <li><a href="index.php">SALIR</a> </li>
      <p>&nbsp;</p>
    </ul>
    <p>
      <script type="text/javascript">
var MenuBar1 = new Spry.Widget.MenuBar("MenuBar1", {imgDown:"SpryAssets/SpryMenuBarDownHover.gif", imgRight:"SpryAssets/SpryMenuBarRightHover.gif"});
      </script>
</p>
  </div>
</form>
<p>&nbsp;</p>
    <form id="form3" name="form3" method="post" action="">
      <p>&nbsp;</p>
      <table width="1032" border="1">
        <tr>
          <td width="418">nomb_product</td>
          <td width="127">familia</td>
          <td width="147">inventario</td>
          <td width="192">cantidad_medida</td>
          <td width="114">total</td>
        </tr>
        <?php   do { ?>
          <tr>
            <td><?php echo $row_Recordset5['nomb_product']; ?></td>
            <td><?php echo $row_Recordset5['familia']; ?></td>
            <td><?php echo $row_Recordset5['inventario']; ?></td>
            <td><?php echo $row_Recordset5['cantidad_medida']; ?></td>
           <?php $inven=$row_Recordset5['inventario'];
           $canti=$row_Recordset5['cantidad_medida'];
           $total1=$inven*$canti;
           $subtotal=$total1;
		   $r+=$subtotal?>
         
            <td><?php echo number_format($subtotal,6); ?>&nbsp;</td>
          </tr>
          <?php } while ($row_Recordset5 = mysql_fetch_assoc($Recordset5)); ?>
      </table>
      <p>TOTAL GALONES EN INVENTARIO DE LA FAMILIA</p>
      <table width="179" border="1" cellspacing="1">
        <tr>
          <td width="171" bgcolor="#003300">TOTAL GALONES </td>
            
        </tr>
        <tr bgcolor="#996600">
          <td><div align="right"><span class="Estilo22"><?PHP echo number_format( $r,6 )?></span></div></td>
        </tr>
      </table>
      <p>&nbsp;</p>
      <p>&nbsp;</p>
    </form>
    <p>&nbsp;</p>
<p>&nbsp;</p>
    <?php
mysql_free_result($Recordset3);

mysql_free_result($Recordset4);

mysql_free_result($Recordset5);
?>
