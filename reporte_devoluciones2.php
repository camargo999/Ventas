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
$cajero=$_GET['cajero'];
 $query_reporte = "SELECT 
  facturas.id_fact,
  pos.nomb_caja,
  usuarios.nombre,
  facturas.fecha_fact,
  facturas.total_fact
FROM
  facturas
  INNER JOIN pos ON (facturas.id_caja = pos.id_caja)
  INNER JOIN usuarios ON (facturas.id_usuarios = usuarios.id_usuarios)
  INNER JOIN ventas ON (facturas.id_fact = ventas.id_fact) WHERE   facturas.fecha_fact BETWEEN '$fecha 00:00:00' AND '$fecha 23:59:00' and  ventas.id_usuarios = $cajero AND    ventas.activo = 3  ";
$reporte = mysql_query($query_reporte, $conn) or die(mysql_error());
$row_reporte = mysql_fetch_assoc($reporte);
$totalRows_reporte = mysql_num_rows($reporte);
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

</style>
<!-- InstanceEndEditable -->
</head>

<body>
<!-- InstanceBeginEditable name="EditRegion3" -->
<?php include('menu.php'); ?>
<p>&nbsp;</p>
<p>&nbsp;</p>
<p>&nbsp;</p>
<p>&nbsp;</p>
<p><a href="reporte_devoluciones.php">Regresar </a>
  <?php
$fecha=$_GET['fecha'];
$cajero=$_GET['cajero'];

$sql="SELECT 
  usuarios.nombre
FROM
  usuarios
WHERE
  usuarios.id_usuarios=$cajero";
  $resultado=mysql_query($sql);
  $row=mysql_fetch_array($resultado);
?>
  <br />
  Reporte de Devoluciones Por Cajero
</p>
Fecha: <? echo $fecha; ?><br />
Cajero(a):<? echo $row['nombre']; ?>
<table border="0" class="tabla">
  <tr class="letter"  bgcolor="#00A9EC" valign="baseline">
    <td>Fecha Factura</td>
    <td>N° Factura</td>
    <td>Caja</td>
    <td>Total Factura</td>
    <td>Devoluciones</td>
    <td>Total</td>
    <td>&nbsp;</td>
  </tr>
  <?php do { ?>
    <tr bgcolor="#CCCCCC"
 onmouseover="this.style.backgroundColor='#00CCFF';"
 onmouseout="this.style.backgroundColor='#CCCCCC';">
      <td><?php echo $row_reporte['fecha_fact']; ?></td>
      <td><?php echo $row_reporte['id_fact']; ?></td>
      <td><?php echo $row_reporte['nomb_caja']; ?></td>
      <td align="right"><?php echo number_format($row_reporte['total_fact']); ?></td>
      <?

$idfact=$row_reporte['id_fact'];
 if ($idfact != NULL) {
$sqldevo="SELECT 
SUM(ventas.precio) as devoluciones
FROM
ventas
INNER JOIN facturas ON (ventas.id_fact = facturas.id_fact)
WHERE
facturas.id_fact = $idfact AND 
ventas.activo = 3 ";
  $resuldevo=mysql_query($sqldevo);
  $rowdevo=mysql_fetch_array($resuldevo);

$totalfinal=$row_reporte['total_fact'] - $rowdevo['devoluciones'];
 }
	  ?>
      <td align="right"><? echo number_format($rowdevo['devoluciones']); ?></td>
      <td align="right">&nbsp;<? echo number_format($totalfinal); ?></td>
      <td align="center"><a href="devolucion_cajero.php?idfact=<?php echo $row_reporte['id_fact']; ?>&cajero=<? echo $cajero; ?>&fecha=<? echo $fecha; ?>"><img src="img/bd_select.png" border="0" /></a></td>
    </tr>
    <?php } while ($row_reporte = mysql_fetch_assoc($reporte)); ?>
</table>
<p>&nbsp;</p>
<!-- InstanceEndEditable -->
</body>
<!-- InstanceEnd --></html>
<?php
mysql_free_result($reporte);
?>
