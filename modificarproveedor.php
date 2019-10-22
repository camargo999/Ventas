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

if ((isset($_POST["MM_update"])) && ($_POST["MM_update"] == "form4")) {
  $updateSQL = sprintf("UPDATE proveedores SET id_proveedor=%s, nombre_proveedor=%s, tel_proveedor=%s, dir_proveedor=%s WHERE nit_proveedor=%s",
                       GetSQLValueString($_POST['id_proveedor'], "int"),
                       GetSQLValueString($_POST['nombre_proveedor'], "text"),
                       GetSQLValueString($_POST['tel_proveedor'], "text"),
                       GetSQLValueString($_POST['dir_proveedor'], "text"),
                       GetSQLValueString($_POST['nit_proveedor'], "int"));

  mysql_select_db($database_conn, $conn);
  $Result1 = mysql_query($updateSQL, $conn) or die(mysql_error());

  $updateGoTo = "menu.php";
  if (isset($_SERVER['QUERY_STRING'])) {
    $updateGoTo .= (strpos($updateGoTo, '?')) ? "&" : "?";
    $updateGoTo .= $_SERVER['QUERY_STRING'];
  }
  header(sprintf("Location: %s", $updateGoTo));
}

if ((isset($_POST["MM_update"])) && ($_POST["MM_update"] == "form5")) {
  $updateSQL = sprintf("UPDATE proveedores SET id_proveedor=%s, nombre_proveedor=%s, tel_proveedor=%s, dir_proveedor=%s WHERE nit_proveedor=%s",
                       GetSQLValueString($_POST['id_proveedor'], "int"),
                       GetSQLValueString($_POST['nombre_proveedor'], "text"),
                       GetSQLValueString($_POST['tel_proveedor'], "text"),
                       GetSQLValueString($_POST['dir_proveedor'], "text"),
                       GetSQLValueString($_POST['nit_proveedor'], "int"));

  mysql_select_db($database_conn, $conn);
  $Result1 = mysql_query($updateSQL, $conn) or die(mysql_error());
}

if ((isset($_POST["MM_update"])) && ($_POST["MM_update"] == "form6")) {
  $updateSQL = sprintf("UPDATE proveedores SET id_proveedor=%s, nombre_proveedor=%s, tel_proveedor=%s, dir_proveedor=%s WHERE nit_proveedor=%s",
                       GetSQLValueString($_POST['id_proveedor'], "int"),
                       GetSQLValueString($_POST['nombre_proveedor'], "text"),
                       GetSQLValueString($_POST['tel_proveedor'], "text"),
                       GetSQLValueString($_POST['dir_proveedor'], "text"),
                       GetSQLValueString($_POST['nit_proveedor'], "int"));

  mysql_select_db($database_conn, $conn);
  $Result1 = mysql_query($updateSQL, $conn) or die(mysql_error());

  $updateGoTo = "menu.php";
  if (isset($_SERVER['QUERY_STRING'])) {
    $updateGoTo .= (strpos($updateGoTo, '?')) ? "&" : "?";
    $updateGoTo .= $_SERVER['QUERY_STRING'];
  }
  header(sprintf("Location: %s", $updateGoTo));
}

$varNit_Recordset1 = "-1";
if (isset($_GET[Nit])) {
  $varNit_Recordset1 = (get_magic_quotes_gpc()) ? $_GET[Nit] : addslashes($_GET[Nit]);
}
mysql_select_db($database_conn, $conn);
$query_Recordset1 = sprintf("SELECT * FROM proveedores WHERE nit_proveedor =%s", $varNit_Recordset1);
$Recordset1 = mysql_query($query_Recordset1, $conn) or die(mysql_error());
$row_Recordset1 = mysql_fetch_assoc($Recordset1);
$totalRows_Recordset1 = mysql_num_rows($Recordset1);
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
            <li><a href="eliminarfactura.html">ELIMINAR FACTURA</a></li>
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
                  <li><a href="estadoproveedor.html">ESTADO DELPROVEEDOR</a></li>
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
    <p>&nbsp;</p>
  </div>
</form>
<form id="form2" name="form2" method="post" action="">
  <p>&nbsp;</p>
</form>
<form id="form3" name="form3" method="post" action="">
</form>
<?php
mysql_free_result($Recordset1);
?>
<form method="post" name="form4" action="<?php echo $editFormAction; ?>">
  <input type="hidden" name="MM_update" value="form4">
  <input type="hidden" name="nit_proveedor" value="<?php echo $row_Recordset1['nit_proveedor']; ?>">
</form>
<p>&nbsp;</p>

    <form method="post" name="form5" action="<?php echo $editFormAction; ?>">
      <input type="hidden" name="MM_update" value="form5">
      <input type="hidden" name="nit_proveedor" value="<?php echo $row_Recordset1['nit_proveedor']; ?>">
    </form>
    <p>&nbsp;</p>

    <form method="post" name="form6" action="<?php echo $editFormAction; ?>">
      <table align="center">
        <tr valign="baseline">
          <td nowrap align="right">Id_proveedor:</td>
          <td><input type="text" name="id_proveedor" value="<?php echo $row_Recordset1['id_proveedor']; ?>" size="32"></td>
        </tr>
        <tr valign="baseline">
          <td nowrap align="right">Nit_proveedor:</td>
          <td><?php echo $row_Recordset1['nit_proveedor']; ?></td>
        </tr>
        <tr valign="baseline">
          <td nowrap align="right">Nombre_proveedor:</td>
          <td><input type="text" name="nombre_proveedor" value="<?php echo $row_Recordset1['nombre_proveedor']; ?>" size="32"></td>
        </tr>
        <tr valign="baseline">
          <td nowrap align="right">Tel_proveedor:</td>
          <td><input type="text" name="tel_proveedor" value="<?php echo $row_Recordset1['tel_proveedor']; ?>" size="32"></td>
        </tr>
        <tr valign="baseline">
          <td nowrap align="right">Dir_proveedor:</td>
          <td><input type="text" name="dir_proveedor" value="<?php echo $row_Recordset1['dir_proveedor']; ?>" size="32"></td>
        </tr>
        <tr valign="baseline">
          <td nowrap align="right">&nbsp;</td>
          <td><input type="submit" value="Actualizar registro"></td>
        </tr>
      </table>
      <input type="hidden" name="MM_update" value="form6">
      <input type="hidden" name="nit_proveedor" value="<?php echo $row_Recordset1['nit_proveedor']; ?>">
    </form>
    <p>&nbsp;</p>
