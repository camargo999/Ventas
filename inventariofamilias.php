<?php require_once('Connections/conn.php'); ?>
<?php
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


  mysql_select_db($database_conn, $conn);
  $Result1 = mysql_query($insertSQL, $conn) or die(mysql_error());

  $insertGoTo = "inventariofamilias.php";
  if (isset($_SERVER['QUERY_STRING'])) {
    $insertGoTo .= (strpos($insertGoTo, '?')) ? "&" : "?";
    $insertGoTo .= $_SERVER['QUERY_STRING'];
  }

  
 
$varfamilia_Recordset1 = "-1";
if (isset($_GET[familia])) {
  $varfamilia_Recordset1 = (get_magic_quotes_gpc()) ? $_GET[familia] : addslashes($_GET[familia]);
}
mysql_select_db($database_conn, $conn);
$query_Recordset1 = sprintf( "SELECT nomb_product, inventario, cod_product, cantidad_medida
FROM articulos INNER JOIN medida ON medida.id_medida = articulos.id_medida AND familia =%s", $varfamilia_Recordset1);
$Recordset1 = mysql_query($query_Recordset1, $conn) or die(mysql_error());
$row_Recordset1 = mysql_fetch_assoc($Recordset1);
$totalRows_Recordset1 = mysql_num_rows($Recordset1);
$maxRows_Recordset4 = 10;
$pageNum_Recordset4 = 0;
if (isset($_GET['pageNum_Recordset4'])) {
  $pageNum_Recordset4 = $_GET['pageNum_Recordset4'];
}
$startRow_Recordset4 = $pageNum_Recordset4 * $maxRows_Recordset4;

$varfamilia_Recordset4 = "-1";
if (isset($_GET['familia'])) {
  $varfamilia_Recordset4 = (get_magic_quotes_gpc()) ? $_GET['familia'] : addslashes($_GET['familia']);
}
mysql_select_db($database_conn, $conn);
$query_Recordset4 = sprintf("SELECT SUM( cantidad_medida) FROM articulos WHERE articulos.familia =%s", $varfamilia_Recordset4);
$query_limit_Recordset4 = sprintf("%s LIMIT %d, %d", $query_Recordset4, $startRow_Recordset4, $maxRows_Recordset4);
$Recordset4 = mysql_query($query_limit_Recordset4, $conn) or die(mysql_error());
$row_Recordset4 = mysql_fetch_assoc($Recordset4);


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
          <li><a href="articulos.php">CREAR</a></li>
          <li><a href="promociones.php">CAMBIAR PRECIOS</a></li>
        </ul>
      </li>
      <li><a href="#" class="MenuBarItemSubmenu">USUARIOS</a>
          <ul>
            <li><a href="usuarios.php">CREAR</a></li>
            <li><a href="cajas.php">IP</a></li>
          </ul>
      </li>
      <li><a class="MenuBarItemSubmenu" href="#">FACTURAS</a>
          <ul>
            <li><a href="eliminar_producto.php">BORRAR PRODUCTO</a></li>
            <li><a href="devoluciones.php">DEVOLUCION</a></li>
          </ul>
      </li>
      <li><a href="#" class="MenuBarItemSubmenu">INFORMES</a>
          <ul>
            <li><a href="reporte4.php">TOTAL FACTURADO</a></li>
            <li><a href="reportes1.php">PRODUCTOS VENDIDOS</a></li>
            <li><a href="reporte_az.php">A-Z CAJERO</a></li>
            <li><a href="reporte_facturas.php">FACTURA POR CAJERO</a></li>
          </ul>
      </li>
      <li><a href="#" class="MenuBarItemSubmenu">GESTION</a>
          <ul>
            <li><a href="cargar_inventario.php">INVENTARIOS</a></li>
            <li><a href="nominasin foto.php">NOMINA</a></li>
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
                  <li><a href="proveedores.php">LISTAR</a></li>
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
<form id="form2" name="form2" method="post" action="abonoscliente.php?$Nit">
  <p>&nbsp;</p>
  <table border="1">
    <tr>
      <td bgcolor="#003300"><div align="center" class="Estilo21">Articulo</div></td>
      <td bgcolor="#003300"><div align="center" class="Estilo21">familia</div></td>
      <td bgcolor="#003300"><div align="center" class="Estilo21">inventario</div></td>
      <td bgcolor="#003300"><div align="center" class="Estilo21">Cantidad de medida</div></td>
      <td bgcolor="#003300">&nbsp;</td>
      <td bgcolor="#003300">&nbsp;</td>
      <td bgcolor="#003300">&nbsp;</td>
    </tr>
    <?php $total=0; do { ?>
      <tr bgcolor="#FFFF99">
        <td><?php echo $row_Recordset1['nomb_product']; ?></td>
        <td><?php echo $row_Recordset1['familia']; ?></td>
        <td><?php echo $row_Recordset1['inventario']; ?></td>
        <td><?php echo $row_Recordset1['cantidad_medida']; ?></td>
        <td>&nbsp;</td>
        <td><div align="right"></div></td>
        <td><div align="right"></div></td>
      </tr>
     
	   ?>
    <?php $b=$total; ?>
	 <tr>
  </table>
  <p><a href="abonoscliente.php" class="Estilo23"></a></p>
  <p>&nbsp;  </p>
</form>
<p>&nbsp;</p>
    <p>&nbsp;</p>
<form id="form3" name="form3" method="post" action="">
</form>
<p>&nbsp;</p>
