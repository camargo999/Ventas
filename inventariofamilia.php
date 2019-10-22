<?php virtual('/skynet/Connections/conn.php'); ?>
<?php
mysql_select_db($database_conn, $conn);
$query_Recordset1 = "SELECT * FROM articulos WHERE familia=1";
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
.Estilo20 {
	color: #FF0000;
	font-size: 24px;
	text-align: left;
}
</style>
<link href="SpryAssets/SpryMenuBarHorizontal.css" rel="stylesheet" type="text/css" />
<script src="SpryAssets/SpryMenuBar.js" type="text/javascript"></script>

<style type="text/css">
<!--
.Estilo21 {color: #FFFF00}
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
      </script></p>
  </div>
</form>
<form id="form3" name="form3" method="get" action="inventariofamilia1.php#$familia">
  <p>&nbsp;</p>
  <p>&nbsp;</p>
  <p class="Estilo21">INGRESE EL NOMBRE DEL PRODUCTO DE LA FAMILIA QUE DESE VER EL INVENTAIRO:</p>
  <p>
    <label>
    <input name="familia" type="text" id="familia" />
    </label>
    <label>
    <input type="submit" name="Submit2" value="BUSCAR FAMILIA" />
    </label>
  </p>
</form>
<?php
mysql_free_result($Recordset1);
?>
