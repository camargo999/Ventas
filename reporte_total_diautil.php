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
$query_total = "
SELECT   SUM(`facturas`.`total_fact`)as total, 
pos.id_caja,pos.nomb_caja,facturas.id_fact,   facturas.fecha_fact 
FROM   facturas INNER JOIN pos ON (facturas.id_caja = pos.id_caja) 
WHERE   facturas.activo = 2 or 1 or 3 or 0 and facturas.fecha_fact
 BETWEEN '$fecha 00:00:00' AND '$fecha 23:59:00' GROUP by `pos`.`id_caja`";
$total = mysql_query($query_total, $conn) or die(mysql_error());
$row_total = mysql_fetch_assoc($total);
$totalRows_total = mysql_num_rows($total);
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
<p><br />                     
  <br />
</p>
<p>&nbsp;</p>
<p>&nbsp;</p>
<p>Reporte Total Facturado<br />
  Fecha desde:<? echo $fecha ?>&nbsp;&nbsp; Hasta:&nbsp;<? echo $fecha ?><br />
</p>
<table border="0">
  <tr class="letter"  bgcolor="#00A9EC" valign="baseline">
    <td width="121">Caja</td>
    <td width="100">total venta</td>
    <td width="100">total compras</td>                                                                          
    <td width="100">utilidad</td>
  </tr>                                                       
  <?php do { ?>
    <tr bgcolor="#CCCCCC"
 onmouseover="this.style.backgroundColor='#00CCFF';"
 onmouseout="this.style.backgroundColor='#CCCCCC';">
      <td><?php echo $row_total['nomb_caja']; ?></td>
      <td align="right"><?php echo number_format($row_total['total']); ?></td>
      
       <?

$idcaja=$row_total['id_caja'];
$sqldevo="SELECT SUM( ventas.cant * articulos.precio_compra ) AS compras
FROM ventas
INNER JOIN articulos ON ( articulos.id_product = ventas.id_product ) 
INNER JOIN facturas ON ( ventas.id_fact = facturas.id_fact && facturas.fecha_fact
BETWEEN  '$fecha 00:00:00'
AND  '$fecha 23:59:00' )";
  $resuldevo=mysql_query($sqldevo);
  $rowdevo=mysql_fetch_array($resuldevo);
 
$totalfin=$row_total['total'] - $rowdevo['compras'];
	
	  ?>
     
      <td align="right">&nbsp;<? echo number_format($rowdevo['compras']); ?></td>
      <td align="right">&nbsp;&nbsp;<? echo number_format($totalfin); ?></td>
    </tr>
    <?php
	
	 } 
	 
	 while ($row_total = mysql_fetch_assoc($total));
	 
	  ?>
</table>
<?
$sql="SELECT 
  SUM(facturas.total_fact) AS totalfinal
FROM
  facturas
  INNER JOIN pos ON (facturas.id_caja = pos.id_caja)
WHERE
  facturas.activo = 0 or 1 or 3 or 0 and facturas.fecha_fact BETWEEN '$fecha 00:00:00' AND '$fecha 23:00:00'";
  $resultado=mysql_query($sql);
  $row=mysql_fetch_array($resultado);
?>
<div class="total"> $ <? echo number_format($row['totalfinal']); ?></div>
<!-- InstanceEndEditable -->
</body>
<!-- InstanceEnd --></html>
<?php
mysql_free_result($total);
?>
