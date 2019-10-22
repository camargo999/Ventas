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

$fecha_precio_compra_dia = "-1";
if (isset($_GET['fecha'])) {
  $fecha_precio_compra_dia = $_GET['fecha'];
}
mysql_select_db($database_conn, $conn);
$query_precio_compra_dia = sprintf("SELECT SUM( ventas.cant * articulos.precio_compra ) AS compras FROM ventas INNER JOIN articulos ON ( articulos.id_product = ventas.id_product )  INNER JOIN facturas ON ( ventas.id_fact = facturas.id_fact && facturas.fecha_fact BETWEEN  '$%s 00:00:00' AND  $%s 23:59:00' )", GetSQLValueString($fecha_precio_compra_dia, "int"),GetSQLValueString($fecha_precio_compra_dia, "int"));
$precio_compra_dia = mysql_query($query_precio_compra_dia, $conn) or die(mysql_error());
$row_precio_compra_dia = mysql_fetch_assoc($precio_compra_dia);
$totalRows_precio_compra_dia = mysql_num_rows($precio_compra_dia);
?>
<style type="text/css">
.letra_menu {
	color: #FFF;
}
body {
	background-image: url(img/fondo
%20(2).jpg);
	background-image: url(img/Fondo-color-verde-688051.jpeg);
}
.Estilo10 {
	color: #FFFF00;
	font-size: 14px;
}
.Estilo17 {color: #FFFF00; font-size: 12px; }
.Estilo20 {color: #FF0000; font-size: 24px; }
</style>
<link href="SpryAssets/SpryMenuBarHorizontal.css" rel="stylesheet" type="text/css" />
<script src="SpryAssets/SpryMenuBar.js" type="text/javascript"></script>

<form id="form1" name="form1" method="post" action="">
  <div align="center" class="Estilo20">
    <ul id="MenuBar1" class="MenuBarHorizontal">
<li><a class="MenuBarItemSubmenu" href="#">ARTICULOS</a>
  <ul>
    <li><a href="articulos.php">CREAR</a></li>
    <li><a href="promociones.php">CAMBIAR PRECIOS</a></li>
  </ul>
</li>
      <li><a href="#" class="MenuBarItemSubmenu">USUARIOS</a>
          <ul>
            <li><a href="usuarios.php">CREAR</a></li>
            <li><a href="cajas.php">IP</a></li>
            <li><a href="usuarios.php">USUARIOS</a></li>
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
          </ul>
      </li>
      <li><a href="#" class="MenuBarItemSubmenu">GESTION</a>
          <ul>
            <li><a href="cargar_inventario.php">INVENTARIOS</a></li>
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
<?php
mysql_free_result($precio_compra_dia);
?>
<table width="657" height="77" border="1">
  <tr>
    <td width="497" bgcolor="#CC9900">VALOR DE COMPRA DE LOS PRODUCTOS VENDIDOS:
      <label for="textarea2"></label>
    <label for="textfield"></label></td>
    <td width="144"><input type="text" name="textfield" id="textfield" /></td>
  </tr>
  <tr>
    <td bgcolor="#CC9900">VALOR DE PRODUCTOS VENDIDOS:
    <label for="textfield2"></label></td>
    <td><input type="text" name="textfield2" id="textfield2" /></td>
  </tr>
  <tr>
    <td bgcolor="#CC9900">UTILIDAD GENERADA EN EL DIA:
    <label for="textfield3"></label></td>
    <td><input type="text" name="textfield3" id="textfield3" /></td>
  </tr>
</table>
