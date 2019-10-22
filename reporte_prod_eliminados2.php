<?php
	

?>
<?php require_once('Connections/conn.php'); ?>
<?php
if (!function_exists("GetSQLValueString")) {
function GetSQLValueString($theValue, $theType, $theDefinedValue = "", $theNotDefinedValue = "") 
{
  if (PHP_VERSION < 6) {
    $theValue = get_magic_quotes_gpc() ? stripslashes($theValue) : $theValue;
  }

  $theValue = function_exists("mysql_real_escape_string") ? mysql_real_escape_string($theValue) : mysql_escape_string($theValue);

  switch ($theType) {
    case "text":
      $theValue = ($theValue != "") ? "'" . $theValue . "'" : "NULL";
      break;    
    case "long":
    case "int":
      $theValue = ($theValue != "") ? intval($theValue) : "NULL";
      break;
    case "double":
      $theValue = ($theValue != "") ? doubleval($theValue) : "NULL";
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
}

mysql_select_db($database_conn, $conn);
$idfact=$_GET['idfact'];
$query_eliminados = "SELECT    articulos.cod_product,   articulos.nomb_product,   ventas.peso,   ventas.cant,   ventas.valor_unitario,   ventas.precio,   ventas.valor_iva FROM   ventas   INNER JOIN facturas ON (ventas.id_fact = facturas.id_fact)   INNER JOIN articulos ON (ventas.id_product = articulos.id_product) WHERE   ventas.activo = 0 AND    facturas.id_fact =$idfact";
$eliminados = mysql_query($query_eliminados, $conn) or die(mysql_error());
$row_eliminados = mysql_fetch_assoc($eliminados);
$totalRows_eliminados = mysql_num_rows($eliminados);
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml"><!-- InstanceBegin template="/Templates/inicio.dwt.php" codeOutsideHTMLIsLocked="false" -->
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<!-- InstanceBeginEditable name="doctitle" -->
<title>SKYNET</title>
<!-- InstanceEndEditable -->
<link href="estilo.css" rel="stylesheet" type="text/css">
<!-- InstanceBeginEditable name="head" -->
<style type="text/css">
.letra_menu {
	color: #FFF;
}
.tabla {
	font-size:12px;

}
</style>
<!-- InstanceEndEditable -->
</head>

<body>
<!-- InstanceBeginEditable name="EditRegion3" -->
<?php include('menu.php'); ?>
<p>
  <?
$idfact=$_GET['idfact'];
$fecha=$_GET['fecha'];
$fecha2=$_GET['fecha2'];
?>
  <br />
</p>
<p>&nbsp;</p>
<p>&nbsp;</p>
<p><a href="reporte_prod_eliminados.php?fecha=<? echo $fecha; ?>&fecha2=<? echo $fecha2; ?>">Regresar</a><br />
  <br />
  Productos Eliminados Factura N° <? echo $idfact ?>
</p>
<table border="0" class="tabla">
  <tr class="letter"  bgcolor="#00A9EC" valign="baseline">
    <td>cod_product</td>
    <td>nomb_product</td>
    <td>peso</td>
    <td>cant</td>
    <td>valor_unitario</td>
    <td>precio</td>
    <td>valor_iva</td>
  </tr>
  <?php do { ?>
  <tr bgcolor="#CCCCCC"
 onmouseover="this.style.backgroundColor='#00CCFF';"
 onmouseout="this.style.backgroundColor='#CCCCCC';">
    <td><?php echo $row_eliminados['cod_product']; ?></td>
    <td><?php echo $row_eliminados['nomb_product']; ?></td>
    <td><?php echo $row_eliminados['peso']; ?></td>
    <td><?php echo $row_eliminados['cant']; ?></td>
    <td align="right"><?php echo number_format($row_eliminados['valor_unitario']); ?></td>
    <td align="right"><?php echo number_format($row_eliminados['precio']); ?></td>
    <td align="right"><?php echo number_format($row_eliminados['valor_iva']); ?></td>
  </tr>
  <?php } while ($row_eliminados = mysql_fetch_assoc($eliminados)); ?>
</table>
<br />


<!-- InstanceEndEditable -->
</body>
<!-- InstanceEnd --></html>
<?php
mysql_free_result($eliminados);
?>
