<?php require_once('Connections/conn.php'); ?>
<?php
mysql_select_db($database_conn, $conn);
$query_Recordset1 = "SELECT * FROM  gastos";
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
<style type="text/css">
<!--
.Estilo21 {
	color: #FFFFFF;
	font-weight: bold;
}
.Estilo22 {color: #000000; font-weight: bold; }
-->
</style>
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
               
                <li><a href="nomina.php">GESTION DE NOMINA</a></li>
                <li><a href="#">MODIFICAR</a></li>
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
                <li><a href="modificarproveedor.php">MODIFICAR</a></li>
                <li><a href="listarproveedor.php">LISTAR</a></li>
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
</script></p>
<p align="center" class="Estilo10">LISTADO DE GASTOS </p>
<form id="form2" name="form2" method="post" action="">
  <table width="891" border="1" align="center" bordercolor="#003333">
    <tr bgcolor="#003300">
      <td width="154"><div align="center" class="Estilo21">FECHA DE GASTO</div></td>
      <td width="551"><div align="center" class="Estilo21">DETALLE</div></td>
      <td width="164"><div align="center" class="Estilo21">PAGO</div></td>
    </tr>
    <?php do { ?>
      <tr bgcolor="#FFFF99">
        <td><div align="center" class="Estilo22"><?php echo $row_Recordset1['fecha_gasto']; ?></div></td>
        <td><div align="center" class="Estilo22"><?php echo $row_Recordset1['detalle_gasto']; ?></div></td>
        <td><div align="center" class="Estilo22"><?php echo $row_Recordset1['gasto']; ?></div></td>
      </tr>
      <?php } while ($row_Recordset1 = mysql_fetch_assoc($Recordset1)); ?>
  </table>
</form>
<p align="center">&nbsp;</p>


<h1>
  <?php
mysql_free_result($Recordset1);
?>
</h1>
