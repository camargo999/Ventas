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

if ((isset($_POST["MM_insert"])) && ($_POST["MM_insert"] == "form2")) {
  $insertSQL = sprintf("INSERT INTO clientes (Id_Cliente, Nombres, Nit, Direccion, Telefono) VALUES (%s, %s, %s, %s, %s)",
                       GetSQLValueString($_POST['Id_Cliente'], "int"),
                       GetSQLValueString($_POST['Nombres'], "text"),
                       GetSQLValueString($_POST['Nit'], "text"),
                       GetSQLValueString($_POST['Direccion'], "text"),
                       GetSQLValueString($_POST['Telefono'], "text"));

  mysql_select_db($database_conn, $conn);
  $Result1 = mysql_query($insertSQL, $conn) or die(mysql_error());

  $insertGoTo = "menu.php";
  if (isset($_SERVER['QUERY_STRING'])) {
    $insertGoTo .= (strpos($insertGoTo, '?')) ? "&" : "?";
    $insertGoTo .= $_SERVER['QUERY_STRING'];
  }
  header(sprintf("Location: %s", $insertGoTo));
}

mysql_select_db($database_conn, $conn);
$query_Recordset1 = "SELECT * FROM clientes";
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
.Estilo2 {color: #000033; }
.Estilo10 {color: #FFFF00; }
.Estilo17 {color: #FFFF00; font-size: 12px; }
.Estilo20 {color: #FF0000; font-size: 24px; }
</style>
<link href="SpryAssets/SpryMenuBarHorizontal.css" rel="stylesheet" type="text/css" />
<script src="SpryAssets/SpryMenuBar.js" type="text/javascript"></script>

<table width="1248" border="0" align="left" cellpadding="0" cellspacing="0">
  <tr>
    <td width="1248"><div align="center" class="Estilo20">
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
            <li><a href="nominasin foto.php" class="MenuBarItemSubmenu">NOMINA</a>
              <ul>
                <li><a href="#">EMPLEADOS</a></li>
                <li><a href="#">CREAR EMPLEADO</a></li>
                <li><a href="#">MODIFICAR</a></li>
                <li><a href="#">PAGOS</a></li>
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
                <li><a href="modificarproveedor.php">MODIFICAR</a></li>
                <li><a href="proveedores.php">LISTAR</a></li>
              </ul>
            </li>
          </ul>
        </li>
        <li><a href="index.php">SALIR</a>      </li>
      </ul>
      <p>&nbsp;</p>
    </div></td>
  </tr>
  <tr>
    <td><div align="center" class="Estilo17"></div></td>
  </tr>
</table>
<form id="form1" name="form1" method="post" action="">
  <p>&nbsp;</p>
  <p>&nbsp;</p>
</form>
<p>
  <script type="text/javascript">
var MenuBar1 = new Spry.Widget.MenuBar("MenuBar1", {imgDown:"SpryAssets/SpryMenuBarDownHover.gif", imgRight:"SpryAssets/SpryMenuBarRightHover.gif"});
</script>
  <?php
mysql_free_result($Recordset1);
?>
</p>
<p>&nbsp;</p>
<p>POR FAVOR INGRESE LOS DATOS DEL CLIENTE </p>

    <form method="post" name="form2" action="<?php echo $editFormAction; ?>">
      <table width="436" align="center" bordercolor="#006633" bgcolor="#99FFFF">

        <tr valign="baseline">
          <td nowrap align="right">Nombres:</td>
          <td><input type="text" name="Nombres" value="" size="80"></td>
        </tr>
        <tr valign="baseline">
          <td nowrap align="right">Nit:</td>
          <td><input type="text" name="Nit" value="" size="32"></td>
        </tr>
        <tr valign="baseline">
          <td nowrap align="right">Direccion:</td>
          <td><input type="text" name="Direccion" value="" size="80"></td>
        </tr>
        <tr valign="baseline">
          <td nowrap align="right">Telefono:</td>
          <td><input type="text" name="Telefono" value="" size="50"></td>
        </tr>
        <tr valign="baseline">
          <td nowrap align="right">&nbsp;</td>
          <td><input type="submit" value="Insertar registro"></td>
        </tr>
      </table>
      <input type="hidden" name="MM_insert" value="form2">
    </form>
    <p>&nbsp;</p>
