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

  $theValue = function_exists("mysql_real_escape_string") ? mysqli_real_escape_string($theValue) : ($theValue);

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

mysqli_select_db($conn,$database);
$idfact=$_GET['idfact'];
$query_ventas = "SELECT   ventas.id_venta, articulos.nomb_product,   ventas.peso,   ventas.cant,   ventas.precio,   ventas.valor_unitario, ventas.activo,  ventas.valor_iva FROM   ventas   INNER JOIN facturas ON (ventas.id_fact = facturas.id_fact)   INNER JOIN articulos ON (ventas.id_product = articulos.id_product) WHERE   facturas.id_fact = $idfact and ventas.activo <> 0 ";
$ventas = mysqli_query($conn,$query_ventas) or die(mysql_error($conn));
$row_ventas = mysqli_fetch_assoc($ventas);
$totalRows_ventas = mysqli_num_rows($ventas);
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
.titulo {
	font-size: 18px;
	color: #F00;
}
.titulo strong {
	font-size: 24px;
}
}
body {
	background-image: url();
}
.Estilo2 {
	font-size: 24px;
	color: #000066;
	font-weight: bold;
}
</style>
<!-- InstanceEndEditable -->
</head>

<body>
<!-- InstanceBeginEditable name="EditRegion3" -->
<?php include('menu.php'); ?>
<p><br />
</p>
<p>&nbsp;</p>
<p>&nbsp;</p>
<p>&nbsp;</p>
<span class="Estilo2"> Devoluciones</span>
<p><br />
  <?
$idfact=$_GET['idfact'];
$sql="select * from facturas where id_fact=$idfact";
$resultado=mysqli_query($sql);
$row=mysqli_fetch_array($resultado);

$sql2="SELECT 
SUM(ventas.precio) AS TOTALDEVOL 
FROM ventas INNER JOIN facturas ON (ventas.id_fact = facturas.id_fact) 
WHERE VENTAS.ACTIVO = 3 And facturas.`id_fact`=$idfact";
$resultado2=mysqli_query($sql2);
$row2=mysqli_fetch_array($resultado2);

$totalfinal=$row['total_fact'] - $row2['TOTALDEVOL'];
?>
  Nro Factura: <? echo $idfact; ?>
 
</p>
<table width="194" border="0">
  <tr>
    <td width="121" align="right">Ventas:</td>
    <td width="63" align="right">$<? echo  number_format($row['total_fact']); ?></td>
  </tr>
  <tr>
    <td align="right">Devoluciones: </td>
    <td align="right">$<? echo  number_format($row2['TOTALDEVOL']); ?></td>
  </tr>
  <tr>
    <td align="right">Total Factura:</td>
    <td align="right">$<? echo number_format($totalfinal);?></td>
  </tr>
</table>
<br />
<br />
<table border="0" align="center" class="tabla">
  <tr class="letter"  bgcolor="#00A9EC" valign="baseline">
    <td>nomb_product</td>
    <td>peso</td>
    <td>cant</td>
    <td>precio</td>
    <td>valor_unitario</td>
    <td>valor_iva</td>
    <td></td>
  </tr>
  <?php do { ?>
  <tr bgcolor="#CCCCCC"
 onmouseover="this.style.backgroundColor='#00CCFF';"
 onmouseout="this.style.backgroundColor='#CCCCCC';">
      <td><?php echo $row_ventas['nomb_product']; ?></td>
      <td><?php echo $row_ventas['peso']; ?></td>
      <td><?php echo $row_ventas['cant']; ?></td>
      <td align="right"><?php echo number_format($row_ventas['precio']); ?></td>
      <td align="right"><?php echo number_format($row_ventas['valor_unitario']); ?></td>
<td align="right"><?php echo number_format($row_ventas['valor_iva']); ?></td>
  <td>
  <?php
  $activo=$row_ventas['activo'];
  $idventa=$row_ventas['id_venta'];
  $producto=$row_ventas['nomb_product'];
  if ($activo==2) {
	  echo  <a href="delete_devolucion.php?idventa=$idventa&idfact=$idfact" onclick=return window.confirm('¿Esta seguro de hacer la devolucion del dinero del producto ($producto)? ');>< img src='img/b_deltbl.png' border='0' /></a>;
  }
  ?>
 
  
 </td>
    </tr>
    <?php } while ($row_ventas = mysqli_fetch_assoc($ventas)); ?>
</table>
<!-- InstanceEndEditable -->
</body>
<!-- InstanceEnd --></html>
<?php
mysqli_free_result($ventas);
?>
