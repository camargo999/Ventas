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
$query_Recordset1 = sprintf("SELECT clientes.Nombres, clientes.Nit, facturas.total_fact, estado, fecha_fact, facturas.id_fact, ventas.id_product, articulos.nomb_product, ventas.precio FROM clientes INNER JOIN facturas ON clientes.id_Cliente = facturas.id_Cliente AND clientes.Nit =%s AND facturas.estado =1 INNER JOIN ventas ON ventas.id_fact = facturas.id_fact INNER JOIN articulos ON articulos.id_product = ventas.id_product ORDER BY Nit", $varNit_Recordset1);
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
      <td bgcolor="#003300"><div align="center" class="Estilo21">Nombres</div></td>
      <td bgcolor="#003300"><div align="center" class="Estilo21">Nit</div></td>
      <td bgcolor="#003300"><div align="center" class="Estilo21">Fecha de la factura</div></td>
      <td bgcolor="#003300"><div align="center" class="Estilo21">Factura No. </div></td>
      <td bgcolor="#003300"><div align="center" class="Estilo21">Articulo vendido </div></td>
      <td bgcolor="#003300"><div align="center" class="Estilo21">Precio articulo </div></td>
      <td bgcolor="#003300"><div align="center" class="Estilo21">Total Factura </div></td>
    </tr>
    <?php $total=0; do { ?>
      <tr bgcolor="#FFFF99">
        <td><?php echo $row_Recordset1['Nombres']; ?></td>
        <td><?php echo $row_Recordset1['Nit']; ?></td>
        <td><?php echo $row_Recordset1['fecha_fact']; ?></td>
        <td><?php echo $row_Recordset1['id_fact']; ?></td>
        <td><?php echo $row_Recordset1['nomb_product']; ?></td>
        <td><div align="right"><?php echo number_format($row_Recordset1['precio']); ?></div></td>
        <td><div align="right"><?php echo number_format($row_Recordset1['total_fact']); ?></div></td>
      </tr>
      <?php  $total=$total+$row_Recordset1['precio'];
	  $Nit=$row_Recordset1['Nit']; } while ($row_Recordset1 = mysql_fetch_assoc($Recordset1));
	  
	   ?>
	  <?php $b=$total; ?>
	 <tr>
  </table>
  <table width="355" border="1" cellspacing="1">
    <tr>
      <td width="171" bgcolor="#003300">TOTAL ABONOS </td>
      <td width="171" bgcolor="#003300">TOTAL FACTURAS </td>
    </tr>
    <tr bgcolor="#996600">
      <td><div align="right"><?php echo number_format($row_Recordset4['SUM( abonos.abono )']); $a= "".$row_Recordset4['SUM( abonos.abono )'];
	
	  $c=$b-$a;?></div></td>
      <td><div align="right"><span class="Estilo22"><?PHP echo number_format( $c )?></span></div></td>
    </tr>
  </table>
  
  <p><a href="abonoscliente.php" class="Estilo23"></a>CONSULTAR ABONOS DEL CLIENTE
    <label>
    <input name="Nit" type="text" id="Nit" value="<?php echo "".$Nit; ?>"  />
    </label>
    <label>
    <input type="submit" name="Submit2" value="CONSULTAR ABONOS" />
    </label>
  </p>
  <p>&nbsp;  </p>
</form>
<form method="post" name="form4" action="<?php echo $editFormAction; ?>">
  <table align="center">
        <tr valign="baseline">
          <td nowrap align="right">Nit:</td>
          <td><input type="text" name="Nit" value="<?php echo "".$Nit; ?>" size="32" readonly="readonly"></td>
        </tr>
        <tr valign="baseline">
          <td nowrap align="right">Abono:</td>
          <td><input type="text" name="abono" value="" size="32"></td>
        </tr>
        <tr valign="baseline">
          <td nowrap align="right">Fecha_Abono:</td>
          <td><input type="text" name="fecha_Abono" value="" size="32"></td>
        </tr>
        <tr valign="baseline">
          <td nowrap align="right">&nbsp;</td>
          <td><input type="submit" value="Insertar registro"></td>
        </tr>
  </table>
      <input type="hidden" name="MM_insert" value="form4">
</form>
    <p>&nbsp;</p>
    <p>&nbsp;</p>
<p>&nbsp;</p>
    <?php
mysql_free_result($Recordset3);

mysql_free_result($Recordset4);
?>
