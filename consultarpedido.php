<?php require_once('../Connections/PEDIDOS.php'); ?>
<?php
mysql_select_db($database_PEDIDOS, $PEDIDOS);
$query_Recordset1 = "SELECT * FROM pedidos";
$Recordset1 = mysql_query($query_Recordset1, $PEDIDOS) or die(mysql_error());
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
<table width="822" border="0" align="left" cellpadding="0" cellspacing="0">
  <tr>
    <td colspan="23"><div align="center" class="Estilo20">SKYNET 3.2 </div></td>
  </tr>
  <tr>
    <td colspan="23"><div align="center" class="Estilo17">ING. FERNEY GOMEZ RODRIGUEZ </div></td>
  </tr>
  <tr>
    <td width="75"><div align="center"><a href="usuarios.php"><img src="img/usuarios.jpg" width="40" height="40" /></a></div></td>
    <td width="5">&nbsp;</td>
    <td width="81"><div align="center"><a href="articulos.php"><img src="img/frutas.jpg" width="40" height="40" /></a></div></td>
    <td width="6">&nbsp;</td>
    <td width="79"><div align="center"><span class="Estilo2"><a href="promociones.php"><img src="img/cambio precios.jpg" width="40" height="40" border="0" /></a></span></div></td>
    <td width="6">&nbsp;</td>
    <td width="52"><div align="center"><span class="Estilo2"><a href="eliminar_producto.php"><img src="img/borrar.jpg" width="40" height="40" /></a></span></div></td>
    <td width="5">&nbsp;</td>
    <td width="75"><div align="center"><span class="Estilo2"><a href="cargar_inventario.php"><img src="img/INVENTARIO.jpg" width="40" height="40" border="0" /></a></span></div></td>
    <td width="6">&nbsp;</td>
    <td width="79"><div align="center"><span class="Estilo2"><a href="devoluciones.php"><img src="img/devoluciones.jpg" width="40" height="40" /></a></span></div></td>
    <td width="5">&nbsp;</td>
    <td width="63"><div align="center"><span class="Estilo2"><a href="reportes.php"><img src="img/Troubleshooting.png" width="40" height="35" /></a></span></div></td>
    <td width="5">&nbsp;</td>
    <td width="45"><div align="center"><span class="Estilo2"><a href="cajas.php"><img src="img/red.jpg" width="40" height="40" /></a></span></div></td>
    <td width="5"><div align="center"></div></td>
    <td width="51"><a href="pedidos.html"><img src="img/&iacute;ndice.jpg" width="40" height="40" border="0" /></a></td>
    <td width="6">&nbsp;</td>
    <td width="56"><div align="center"><span class="Estilo10"><a href="CLIENTES.PHP"><img src="img/PAGAR.jpg" width="40" height="40" border="0" /></a></span></div></td>
    <td width="4">&nbsp;</td>
    <td width="52"><div align="center"><span class="Estilo10"><a href="nominasin foto.php"><img src="img/COBRAR.jpg" width="40" height="40" border="0" /></a></span></div></td>
    <td width="6">&nbsp;</td>
    <td width="55"><div align="center"><span class="Estilo2"><a href="fin.php"><img src="img/salir.jpg" width="40" height="40" align="absmiddle" /></a></span></div></td>
  </tr>
  <tr>
    <td><div align="center"><span class="Estilo17">CREAR USUARIOS</span></div></td>
    <td><div align="center"></div></td>
    <td><p align="center" class="Estilo2"><span class="Estilo17">CREAR</span><span class="Estilo17">PRODUCTO</span></p>    </td>
    <td><div align="center"></div></td>
    <td><div align="center"><span class="Estilo17">CAMBIAR PRECIOS </span></div></td>
    <td><div align="center"></div></td>
    <td><div align="center"><span class="Estilo17">BORRAR</span></div></td>
    <td><div align="center"></div></td>
    <td><div align="center"><span class="Estilo17">INVENTARIO</span></div></td>
    <td><div align="center"></div></td>
    <td><div align="center"><span class="Estilo2"><span class="Estilo17">DEVOLUCION</span></span></div></td>
    <td><div align="center"></div></td>
    <td><div align="center"><span class="Estilo17">INFORMES</span></div></td>
    <td><div align="center"></div></td>
    <td><div align="center"><span class="Estilo17">IP</span></div></td>
    <td height="5"><div align="center"></div></td>
    <td><span class="Estilo17">PEDIDOS</span></td>
    <td>&nbsp;</td>
    <td><div align="center"><span class="Estilo17">GESTION</span></div></td>
    <td><div align="center"></div></td>
    <td><div align="center"><span class="Estilo17">NOMINA</span></div></td>
    <td><div align="center"></div></td>
    <td><div align="center"><span class="Estilo17">SALIR</span></div></td>
  </tr>
</table>







<p>&nbsp;</p>
<p>&nbsp;</p>
<p>&nbsp;</p>
<p>&nbsp;</p>
<p>&nbsp;</p>
<form id="form1" name="form1" method="post" action="pedidos.php">
  <label></label>
  <p>&nbsp;</p>
  <p>&nbsp;</p>
  <p>&nbsp;</p>

  <table border="1">
    <tr>
      <td>id_pedido</td>
      <td>id_product</td>
      <td>cod_product</td>
      <td>nomb_product</td>
      <td>precio_venta</td>
      <td>cantidad</td>
    </tr>
    <?php do { ?>
      <tr>
        <td><?php echo $row_Recordset1['id_pedido']; ?></td>
        <td><?php echo $row_Recordset1['id_product']; ?></td>
        <td><?php echo $row_Recordset1['cod_product']; ?></td>
        <td><?php echo $row_Recordset1['nomb_product']; ?></td>
        <td><?php echo $row_Recordset1['precio_venta']; ?></td>
        <td><?php echo $row_Recordset1['cantidad']; ?></td>
      </tr>
      <?php } while ($row_Recordset1 = mysql_fetch_assoc($Recordset1)); ?>
  </table>
</form>
<p>&nbsp;</p>
<?php
mysql_free_result($Recordset1);
?>
