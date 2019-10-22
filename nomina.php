<?php require_once('Connections/conn.php'); ?>
<?php
mysql_select_db($database_conn, $conn);
$query_Recordset1 = "SELECT * FROM nomina";
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
.Estilo20 {color: #FF0000; font-size: 24px; }
</style>
<link href="SpryAssets/SpryMenuBarHorizontal.css" rel="stylesheet" type="text/css" />
<script src="SpryAssets/SpryMenuBar.js" type="text/javascript"></script>
<style type="text/css">
<!--
.Estilo23 {color: #FFFFFF; font-weight: bold; }
-->
</style>
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
                  <li><a href="consultaclientenit.html">VER ESTADO</a></li>
                </ul>
            </li>
            <li><a href="#" class="MenuBarItemSubmenu">PROVEEDOR</a>
                <ul>
                  <li><a href="crearproveedor.php">CREAR</a></li>
                  <li><a href="modificarproveedor.html">MODIFICAR</a></li>
                  <li><a href="listarproveedor.php">LISTAR</a></li>
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
<p align="center">&nbsp;</p>
<p>&nbsp;</p>
<p>Sábado Julio 4, 2015 0:27 AM </p>

<table width="1000" border="2" cellpadding="1" cellspacing="1" bordercolor="#666666">
  <tr bgcolor="#003300">
    <td width="140"><div align="center" class="Estilo23">nombre</div></td>
    <td width="133"><div align="center" class="Estilo23">cedula</div></td>
    <td width="133"><div align="center" class="Estilo23">salario</div></td>
    <td width="80"><div align="center" class="Estilo23">dias</div></td>
    <td width="35"><div align="center" class="Estilo23">sub_trans</div></td>
    <td width="35"><div align="center" class="Estilo23">salud</div></td>
    <td width="35"><div align="center" class="Estilo23">pension</div></td>
    <td width="35"><div align="center" class="Estilo23">horas_extras</div></td>
    <td width="37"><div align="center" class="Estilo23">total</div></td>
    <td width="91"><span class="Estilo23">FIRMA EMPLEADO </span></td>
  </tr>
  <?php do { $total=o;
  $salario=$row_Recordset1['salario'];
  $sub_trans=$row_Recordset1['sub_trans'];
  $salud=$row_Recordset1['salud'];
  $pension=$row_Recordset1['pension'];
  $horas_extras=$row_Recordset1['horas_extras'];
  $valor_hora=4500;
  $dias=$row_Recordset1['dias'];
  $costo_dia=$salario/30;
  $total=($costo_dia*$dias)+$sub_trans+($horas_extras*$valor_hora) - $pension- $salud;?>
    <tr bgcolor="#FFFF99">
      <td align="left"><div align="right"><?php echo $row_Recordset1['nombre']; ?></div></td>
      <td><div align="right"><?php echo $row_Recordset1['cedula']; ?></div></td>
      <td><div align="right"><?php echo number_format($row_Recordset1['salario']); ?></div></td>
      <td><div align="right"><?php echo $row_Recordset1['dias']; ?></div></td>
      <td><div align="right"><?php echo number_format($row_Recordset1['sub_trans']); ?></div></td>
      <td><div align="right"><?php echo number_format($row_Recordset1['salud']); ?></div></td>
      <td><div align="right"><?php echo number_format($row_Recordset1['pension']); ?></div></td>
      <td><div align="right"><?php echo $row_Recordset1['horas_extras']; ?></div></td>
      <td><div align="right"><?PHP echo "$".$total ?></div></td>
      <td><div align="right"></div></td>
    </tr>
	<?php
	 ?>
  <td height="7"></td>
    <?php } while ($row_Recordset1 = mysql_fetch_assoc($Recordset1)); ?>
</table>
<blockquote>
  <p>&nbsp;</p>
  <p>&nbsp;</p>
</blockquote>
<?php
mysql_free_result($Recordset1);
?>
