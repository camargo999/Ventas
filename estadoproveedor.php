<?php require_once('Connections/conn.php'); ?>
<?php
$varNit_Recordset1 = "-1";
if (isset($_POST['Nit'])) {
  $varNit_Recordset1 = (get_magic_quotes_gpc()) ? $_POST['Nit'] : addslashes($_POST['Nit']);
}
mysql_select_db($database_conn, $conn);
$query_Recordset1 = sprintf("SELECT proveedores.nit_proveedor, proveedores.nombre_proveedor, compras.total_compra, compras.fecha_compra, compras.detalle FROM proveedores INNER JOIN compras ON compras.proveedor = proveedores.nombre_proveedor AND proveedores.Nit_proveedor =%s", $varNit_Recordset1);
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
<p>&nbsp;</p>
<p align="center">ESTADO DE COMPRAS REALIZADAS</p>
<form id="form2" name="form2" method="post" action="">
  <p>&nbsp;</p>
  
  <table border="2" cellpadding="1" cellspacing="2">
    <tr>
      <td>nit_proveedor</td>
      <td>nombre_proveedor</td>
      <td>total_compra</td>
      <td>fecha_compra</td>
      <td>detalle</td>
    </tr>
    <?php do { ?>
      <tr>
        <td><?php echo $row_Recordset1['nit_proveedor']; ?></td>
        <td><?php echo $row_Recordset1['nombre_proveedor']; ?></td>
        <td><?php echo $row_Recordset1['total_compra']; ?></td>
        <td><?php echo $row_Recordset1['fecha_compra']; ?></td>
        <td><?php echo $row_Recordset1['detalle']; ?></td>
      </tr>
      <?php } while ($row_Recordset1 = mysql_fetch_assoc($Recordset1)); ?>
  </table>
  <p>&nbsp;</p>
</form>
<p>&nbsp;</p>
<?php
mysql_free_result($Recordset1);
?>
