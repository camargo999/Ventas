<?php require_once('Connections/conn.php'); ?>
<?php
$currentPage = $_SERVER["PHP_SELF"];

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

if ((isset($_POST["MM_update"])) && ($_POST["MM_update"] == "form2")) {
  $updateSQL = sprintf("UPDATE facturas SET id_caja=%s, id_usuarios=%s, fecha_fact=%s, total_fact=%s, efectivo=%s, cambio=%s, activo=%s, Id_Cliente=%s, estado=%s WHERE id_fact=%s",
                       GetSQLValueString($_POST['id_caja'], "int"),
                       GetSQLValueString($_POST['id_usuarios'], "int"),
                       GetSQLValueString($_POST['fecha_fact'], "date"),
                       GetSQLValueString($_POST['total_fact'], "double"),
                       GetSQLValueString($_POST['efectivo'], "double"),
                       GetSQLValueString($_POST['cambio'], "double"),
                       GetSQLValueString($_POST['activo'], "int"),
                       GetSQLValueString($_POST['Id_Cliente'], "int"),
                       GetSQLValueString($_POST['estado'], "int"),
                       GetSQLValueString($_POST['id_fact'], "int"));

  mysql_select_db($database_conn, $conn);
  $Result1 = mysql_query($updateSQL, $conn) or die(mysql_error());
}

if ((isset($_POST["MM_update"])) && ($_POST["MM_update"] == "form3")) {
  $updateSQL = sprintf("UPDATE ventas SET id_venta=%s, id_usuarios=%s, id_caja=%s, id_product=%s, peso=%s, cant=%s, valor_unitario=%s, precio=%s, valor_iva=%s, activo=%s, Nit=%s WHERE id_fact=%s",
                       GetSQLValueString($_POST['id_venta'], "int"),
                       GetSQLValueString($_POST['id_usuarios'], "int"),
                       GetSQLValueString($_POST['id_caja'], "int"),
                       GetSQLValueString($_POST['id_product'], "int"),
                       GetSQLValueString($_POST['peso'], "double"),
                       GetSQLValueString($_POST['cant'], "int"),
                       GetSQLValueString($_POST['valor_unitario'], "double"),
                       GetSQLValueString($_POST['precio'], "double"),
                       GetSQLValueString($_POST['valor_iva'], "double"),
                       GetSQLValueString($_POST['activo'], "int"),
                       GetSQLValueString($_POST['Nit'], "text"),
                       GetSQLValueString($_POST['id_fact'], "int"));

  mysql_select_db($database_conn, $conn);
  $Result1 = mysql_query($updateSQL, $conn) or die(mysql_error());
}

if ((isset($_POST["MM_update"])) && ($_POST["MM_update"] == "form4")) {
  $updateSQL = sprintf("UPDATE facturas SET fecha_fact=%s, total_fact=%s, estado=%s WHERE id_fact=%s",
                       GetSQLValueString($_POST['fecha_fact'], "date"),
                       GetSQLValueString($_POST['total_fact'], "double"),
                       GetSQLValueString($_POST['estado'], "int"),
                       GetSQLValueString($_POST['id_fact'], "int"));

  mysql_select_db($database_conn, $conn);
  $Result1 = mysql_query($updateSQL, $conn) or die(mysql_error());
}

$maxRows_Recordset1 = 1;
$pageNum_Recordset1 = 0;
if (isset($_GET['pageNum_Recordset1'])) {
  $pageNum_Recordset1 = $_GET['pageNum_Recordset1'];
}
$startRow_Recordset1 = $pageNum_Recordset1 * $maxRows_Recordset1;

$varNit_Recordset1 = "-1";
if (isset($_GET['Nit'])) {
  $varNit_Recordset1 = (get_magic_quotes_gpc()) ? $_GET['Nit'] : addslashes($_GET['Nit']);
}
mysql_select_db($database_conn, $conn);
$query_Recordset1 = sprintf("SELECT clientes.Nombres, clientes.Nit, facturas.total_fact, estado, fecha_fact, facturas.id_fact, ventas.id_product, articulos.nomb_product, ventas.precio FROM clientes INNER JOIN facturas ON clientes.id_Cliente = facturas.id_Cliente AND clientes.Nit =%s AND facturas.estado =1 INNER JOIN ventas ON ventas.id_fact = facturas.id_fact INNER JOIN articulos ON articulos.id_product = ventas.id_product ORDER BY Nit", $varNit_Recordset1);
$query_limit_Recordset1 = sprintf("%s LIMIT %d, %d", $query_Recordset1, $startRow_Recordset1, $maxRows_Recordset1);
$Recordset1 = mysql_query($query_limit_Recordset1, $conn) or die(mysql_error());
$row_Recordset1 = mysql_fetch_assoc($Recordset1);

if (isset($_GET['totalRows_Recordset1'])) {
  $totalRows_Recordset1 = $_GET['totalRows_Recordset1'];
} else {
  $all_Recordset1 = mysql_query($query_Recordset1);
  $totalRows_Recordset1 = mysql_num_rows($all_Recordset1);
}
$totalPages_Recordset1 = ceil($totalRows_Recordset1/$maxRows_Recordset1)-1;

$queryString_Recordset1 = "";
if (!empty($_SERVER['QUERY_STRING'])) {
  $params = explode("&", $_SERVER['QUERY_STRING']);
  $newParams = array();
  foreach ($params as $param) {
    if (stristr($param, "pageNum_Recordset1") == false && 
        stristr($param, "totalRows_Recordset1") == false) {
      array_push($newParams, $param);
    }
  }
  if (count($newParams) != 0) {
    $queryString_Recordset1 = "&" . htmlentities(implode("&", $newParams));
  }
}
$queryString_Recordset1 = sprintf("&totalRows_Recordset1=%d%s", $totalRows_Recordset1, $queryString_Recordset1);
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
<?php
mysql_free_result($Recordset1);
?>
<form method="post" name="form2" action="<?php echo $editFormAction; ?>">
  <input type="hidden" name="MM_update" value="form2">
  <input type="hidden" name="id_fact" value="<?php echo $row_Recordset1['id_fact']; ?>">
</form>
<p>&nbsp;</p>
<p>&nbsp;</p>
<p>&nbsp;</p>
<form method="post" name="form4" action="<?php echo $editFormAction; ?>">
      <table align="center">
        <tr valign="baseline">
          <td nowrap align="right">Id_fact:</td>
          <td><?php echo $row_Recordset1['id_fact']; ?></td>
        </tr>
        <tr valign="baseline">
          <td nowrap align="right">Fecha_fact:</td>
          <td><input type="text" name="fecha_fact" value="<?php echo $row_Recordset1['fecha_fact']; ?>" size="32"></td>
        </tr>
        <tr valign="baseline">
          <td nowrap align="right">Total_fact:</td>
          <td><input type="text" name="total_fact" value="<?php echo $row_Recordset1['total_fact']; ?>" size="32"></td>
        </tr>
        <tr valign="baseline">
          <td nowrap align="right">Estado:</td>
          <td><input type="text" name="estado" value="<?php echo $row_Recordset1['estado']; ?>" size="32"></td>
        </tr>
        <tr valign="baseline">
          <td nowrap align="right">&nbsp;</td>
          <td><input type="submit" value="Actualizar registro"></td>
        </tr>
      </table>
      <input type="hidden" name="MM_update" value="form4">
      <input type="hidden" name="id_fact" value="<?php echo $row_Recordset1['id_fact']; ?>">
</form>
    <p>
    <table border="0" width="50%" align="center">
      <tr>
        <td width="23%" align="center"><?php if ($pageNum_Recordset1 > 0) { // Show if not first page ?>
              <a href="<?php printf("%s?pageNum_Recordset1=%d%s", $currentPage, 0, $queryString_Recordset1); ?>">Primero</a>
              <?php } // Show if not first page ?>
        </td>
        <td width="31%" align="center"><?php if ($pageNum_Recordset1 > 0) { // Show if not first page ?>
              <a href="<?php printf("%s?pageNum_Recordset1=%d%s", $currentPage, max(0, $pageNum_Recordset1 - 1), $queryString_Recordset1); ?>">Anterior</a>
              <?php } // Show if not first page ?>
        </td>
        <td width="23%" align="center"><?php if ($pageNum_Recordset1 < $totalPages_Recordset1) { // Show if not last page ?>
              <a href="<?php printf("%s?pageNum_Recordset1=%d%s", $currentPage, min($totalPages_Recordset1, $pageNum_Recordset1 + 1), $queryString_Recordset1); ?>">Siguiente</a>
              <?php } // Show if not last page ?>
        </td>
        <td width="23%" align="center"><?php if ($pageNum_Recordset1 < $totalPages_Recordset1) { // Show if not last page ?>
              <a href="<?php printf("%s?pageNum_Recordset1=%d%s", $currentPage, $totalPages_Recordset1, $queryString_Recordset1); ?>">&Uacute;ltimo</a>
              <?php } // Show if not last page ?>
        </td>
      </tr>
    </table>
    </p>
<form method="post" name="form3" action="<?php echo $editFormAction; ?>">
      <input type="hidden" name="MM_update" value="form3">
      <input type="hidden" name="id_fact" value="<?php echo $row_Recordset1['id_fact']; ?>">
</form>
    <p>&nbsp;</p>
