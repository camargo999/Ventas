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
$fecha=$_GET['fecha'];
$fecha2=$_GET['fecha2'];
$query_facturas = "SELECT    ventas.id_fact, facturas.fecha_fact,  pos.nomb_caja,   usuarios.nombre FROM   ventas   INNER JOIN facturas ON (ventas.id_fact = facturas.id_fact)   INNER JOIN articulos ON (ventas.id_product = articulos.id_product)   INNER JOIN pos ON (ventas.id_caja = pos.id_caja)   INNER JOIN usuarios ON (ventas.id_usuarios = usuarios.id_usuarios) WHERE   ventas.activo = 0 AND    facturas.fecha_fact BETWEEN '$fecha 00:00:00' AND '$fecha2 23:59:00'   group by `facturas`.`id_fact`";
$facturas = mysql_query($query_facturas, $conn) or die(mysql_error());
$row_facturas = mysql_fetch_assoc($facturas);
$totalRows_facturas = mysql_num_rows($facturas);
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
<p><br />
  <br />
</p>
<p>&nbsp;</p>
<p>&nbsp;</p>
<p>Productos Borrados 
  <br />
Fecha desde :<? echo $fecha; ?> hasta <? echo $fecha2; ?>
<br />
</p>
<table width="600" border="0" class="tabla">
  <tr class="letter"  bgcolor="#00A9EC" valign="baseline">
    <td width="100">id_fact</td>
    <td width="177">Fecha</td>
    <td width="100">caja</td>
    <td width="200">nombre</td>
    <td width="13"></td>
  </tr>
  <?php do { ?>
    <tr bgcolor="#CCCCCC"
 onmouseover="this.style.backgroundColor='#00CCFF';"
 onmouseout="this.style.backgroundColor='#CCCCCC';">
      <td><?php echo $row_facturas['id_fact']; ?></td>
      <td><?php echo $row_facturas['fecha_fact']; ?></td>
      <td><?php echo $row_facturas['nomb_caja']; ?></td>
      <td><?php echo $row_facturas['nombre']; ?></td>
      <td><a href="reporte_prod_eliminados2.php?idfact=<? echo $row_facturas['id_fact']; ?>&fecha=<? echo $fecha; ?>&fecha2=<? echo $fecha2; ?>"><img src="img/bd_select.png" width="16" height="16" border="0" /></a></td>
    </tr>
    <?php } while ($row_facturas = mysql_fetch_assoc($facturas)); ?>
</table>
<!-- InstanceEndEditable -->
</body>
<!-- InstanceEnd --></html>
<?php
mysql_free_result($facturas);
?>
