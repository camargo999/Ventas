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

if ((isset($_POST["MM_insert"])) && ($_POST["MM_insert"] == "form3")) {
  $insertSQL = sprintf("INSERT INTO proveedores (id_proveedor, nit_proveedor, nombre_proveedor, tel_proveedor, dir_proveedor) VALUES (%s, %s, %s, %s, %s)",
                       GetSQLValueString($_POST['id_proveedor'], "int"),
                       GetSQLValueString($_POST['nit_proveedor'], "int"),
                       GetSQLValueString($_POST['nombre_proveedor'], "text"),
                       GetSQLValueString($_POST['tel_proveedor'], "text"),
                       GetSQLValueString($_POST['dir_proveedor'], "text"));

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
$query_Recordset1 = "SELECT * FROM proveedores";
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
.Estilo10 {color: #FFFF00; }
.Estilo17 {color: #FFFF00; font-size: 12px; }
.Estilo20 {color: #FF0000; font-size: 24px; }
</style>
<link href="SpryAssets/SpryMenuBarHorizontal.css" rel="stylesheet" type="text/css" />
<script src="SpryAssets/SpryMenuBar.js" type="text/javascript"></script>

<table width="1172" border="0" align="left" cellpadding="0" cellspacing="0">
  <tr>
    <td width="1172"><div align="center" class="Estilo20">
      <ul id="MenuBar1" class="MenuBarHorizontal">
        <li><a class="MenuBarItemSubmenu" href="#">ARTICULOS</a>
          <ul>
            <li><a href="articulos.php">CREAR</a></li>
            <li><a href="promociones.php">CAMBIAR PRECIOS</a></li>
</ul>
        </li>
        <li><a href="usuarios.php" class="MenuBarItemSubmenu">USUARIOS</a>
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
            <li><a href="nominasin foto.php" class="MenuBarItemSubmenu">NOMINA</a>
              <ul>
                <li><a href="CREAREMPLEADO.PHP">CREAR EMPLEADO</a></li>
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
                <li><a href="consultarclientenit.html">VER ESTADO</a></li>
              </ul>
            </li>
            <li><a href="#" class="MenuBarItemSubmenu">PROVEEDOR</a>
              <ul>
                <li><a href="crearproveedor.php">CREAR</a></li>
                <li><a href="modificarproveedor.html">MODIFICAR</a></li>
                <li><a href="listarproveedor.php">LISTAR</a></li>
                <li><a href="estadoproveedor.html">ESTADO DE PROVEEDOR</a></li>
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
<script type="text/javascript">
var MenuBar1 = new Spry.Widget.MenuBar("MenuBar1", {imgDown:"SpryAssets/SpryMenuBarDownHover.gif", imgRight:"SpryAssets/SpryMenuBarRightHover.gif"});
</script>
<form method="post" name="form2">
  <p>&nbsp;</p>
  <p>&nbsp;</p>
  <p>&nbsp;</p>
</form>
<p align="center" class="Estilo10">POR FAVOR INGRESE LOS DATOS DEL PROVEEDOR </p>

    <form method="post" name="form3" action="<?php echo $editFormAction; ?>">
      <table width="580" align="center">

        <tr valign="baseline">
          <td width="125" align="right" nowrap>Nit:</td>
          <td width="422"><input type="text" name="nit_proveedor" value="" size="32"></td>
        </tr>
        <tr valign="baseline">
          <td nowrap align="right">Nombre:</td>
          <td><input type="text" name="nombre_proveedor" value="" size="70"></td>
        </tr>
        <tr valign="baseline">
          <td nowrap align="right">Telefonor:</td>
          <td><input type="text" name="tel_proveedor" value="" size="32"></td>
        </tr>
        <tr valign="baseline">
          <td nowrap align="right">Direcci&oacute;n:</td>
          <td><input type="text" name="dir_proveedor" value="" size="70"></td>
        </tr>
        <tr valign="baseline">
          <td nowrap align="right">&nbsp;</td>
          <td><input type="submit" value="Insertar registro"></td>
        </tr>
      </table>
      <input type="hidden" name="MM_insert" value="form3">
    </form>
    <p>&nbsp;</p>
    <?php
mysql_free_result($Recordset1);
?>
