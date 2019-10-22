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

$currentPage = $_SERVER["PHP_SELF"];

$maxRows_vendidos = 30;
$pageNum_vendidos = 0;
if (isset($_GET['pageNum_vendidos'])) {
  $pageNum_vendidos = $_GET['pageNum_vendidos'];
}
$startRow_vendidos = $pageNum_vendidos * $maxRows_vendidos;

mysql_select_db($database_conn, $conn);
$fecha=$_GET['fecha'];
$cadB="-";
$cadS="/";
$fecha1=str_replace($cadB,$cadS,$fecha);
$fecha2=$_GET['fecha2'];
$cadB="-";
$cadS="/";
$fecha3=str_replace($cadB,$cadS,$fecha2);
$buscar=$_GET['buscar'];
echo $query_vendidos = "SELECT  articulos.cod_product, articulos.nomb_product,   ventas.peso, ventas.cant, ventas.precio, ventas.id_fact, ventas.activo FROM ventas INNER JOIN articulos ON (ventas.id_product = articulos.id_product) INNER JOIN facturas ON (ventas.id_fact = facturas.id_fact) WHERE   ventas.activo = 2  and facturas.fecha_fact BETWEEN '$fecha1 00:00:00' AND '$fecha3 23:59:00' and (articulos.cod_product LIKE '%$buscar%' or articulos.nomb_product LIKE '%$buscar%' )";
$query_limit_vendidos = sprintf("%s LIMIT %d, %d", $query_vendidos, $startRow_vendidos, $maxRows_vendidos);
$vendidos = mysql_query($query_limit_vendidos, $conn) or die(mysql_error());
$row_vendidos = mysql_fetch_assoc($vendidos);

if (isset($_GET['totalRows_vendidos'])) {
  $totalRows_vendidos = $_GET['totalRows_vendidos'];
} else {
  $all_vendidos = mysql_query($query_vendidos);
  $totalRows_vendidos = mysql_num_rows($all_vendidos);
}
$totalPages_vendidos = ceil($totalRows_vendidos/$maxRows_vendidos)-1;

$queryString_vendidos = "";
if (!empty($_SERVER['QUERY_STRING'])) {
  $params = explode("&", $_SERVER['QUERY_STRING']);
  $newParams = array();
  foreach ($params as $param) {
    if (stristr($param, "pageNum_vendidos") == false && 
        stristr($param, "totalRows_vendidos") == false) {
      array_push($newParams, $param);
    }
  }
  if (count($newParams) != 0) {
    $queryString_vendidos = "&" . htmlentities(implode("&", $newParams));
  }
}
$queryString_vendidos = sprintf("&totalRows_vendidos=%d%s", $totalRows_vendidos, $queryString_vendidos);
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
  </p>
<p>&nbsp;</p>
<p>&nbsp;</p>
<p>&nbsp;</p>
<p><a href="reportes1.php">Regresar</a><br />
  <br />
PRODUCTOS VENDIDOS<br /> 
DESDE <? echo $fecha; ?> HASTA <? echo $fecha2; ?> 
</p>
<form action="vendidos_peso.php" method="get">
<input type="hidden" name="fecha" value="<? echo $fecha; ?>" />
<input type="hidden" name="fecha2" value="<? echo $fecha2; ?>" />
Buscar
<label for="buscar"></label>
<input type="text" name="buscar" id="buscar" />
<input type="submit" name="button" id="button" value="Enviar" />
</form>
<table border="0" class="tabla">
  <tr class="letter"  bgcolor="#00A9EC" valign="baseline">
    <td>cod_product</td>
    <td>nomb_product</td>
    <td>peso</td>
    <td>cant</td>
    <td>precio</td>
    <td>id_fact</td>
  </tr>
  <?php do { ?>
    <tr bgcolor="#CCCCCC"
 onmouseover="this.style.backgroundColor='#00CCFF';"
 onmouseout="this.style.backgroundColor='#CCCCCC';">
      <td><?php echo $row_vendidos['cod_product']; ?></td>
      <td><?php echo $row_vendidos['nomb_product']; ?></td>
      <td align="right"><?php echo $row_vendidos['peso']; ?></td>
      <td align="right"><?php echo $row_vendidos['cant']; ?></td>
      <td align="right"><?php echo number_format($row_vendidos['precio']); ?></td>
      <td><?php echo $row_vendidos['id_fact']; ?></td>
    </tr>
    <?php } while ($row_vendidos = mysql_fetch_assoc($vendidos)); ?>
</table>
<table border="0">
  <tr>
    <td><?php if ($pageNum_vendidos > 0) { // Show if not first page ?>
        <a href="<?php printf("%s?pageNum_vendidos=%d%s", $currentPage, 0, $queryString_vendidos); ?>"><img src="First.gif" border="0" /></a>
    <?php } // Show if not first page ?></td>
    <td><?php if ($pageNum_vendidos > 0) { // Show if not first page ?>
        <a href="<?php printf("%s?pageNum_vendidos=%d%s", $currentPage, max(0, $pageNum_vendidos - 1), $queryString_vendidos); ?>"><img src="Previous.gif" border="0" /></a>
    <?php } // Show if not first page ?></td>
    <td><?php if ($pageNum_vendidos < $totalPages_vendidos) { // Show if not last page ?>
        <a href="<?php printf("%s?pageNum_vendidos=%d%s", $currentPage, min($totalPages_vendidos, $pageNum_vendidos + 1), $queryString_vendidos); ?>"><img src="Next.gif" border="0" /></a>
    <?php } // Show if not last page ?></td>
    <td><?php if ($pageNum_vendidos < $totalPages_vendidos) { // Show if not last page ?>
        <a href="<?php printf("%s?pageNum_vendidos=%d%s", $currentPage, $totalPages_vendidos, $queryString_vendidos); ?>"><img src="Last.gif" border="0" /></a>
    <?php } // Show if not last page ?></td>
  </tr>
</table>
<?
if ($buscar!=NULL) {
$sql="SELECT 
  articulos.nomb_product,
  sum(ventas.peso)as peso,
  sum(ventas.cant)as cant,
  sum(ventas.precio) as precio
FROM
  ventas
  INNER JOIN articulos ON (ventas.id_product = articulos.id_product)
  INNER JOIN facturas ON (ventas.id_fact = facturas.id_fact)
WHERE
  ventas.activo = 2 AND 
  facturas.fecha_fact BETWEEN '$fecha 00:00:00' AND '$fecha2 23:59:59' AND 
  (articulos.cod_product LIKE '%$buscar%' or articulos.nomb_product LIKE '%$buscar%' )
GROUP by `articulos`.`id_product`";
$resultado=mysql_query($sql);
$row=mysql_fetch_array($resultado);
?>
<table width="258" border="0" class="tabla">
  <tr class="letter"  bgcolor="#00A9EC" valign="baseline">
    <td>Peso(GR)</td>
    <td>Cant</td>
    <td>Precio</td>
  </tr>
  <tr bgcolor="#CCCCCC"
 onmouseover="this.style.backgroundColor='#00CCFF';"
 onmouseout="this.style.backgroundColor='#CCCCCC';">

    <td align="center">&nbsp;<? echo $row['peso']; ?>&nbsp;</td>
    <td align="center">&nbsp;<? echo $row['cant']; ?></td>
    <td align="right">&nbsp;<? echo number_format($row['precio']); ?></td>
  </tr>
</table>
<?
}
?>
<!-- InstanceEndEditable -->
</body>
<!-- InstanceEnd --></html>
<?php
mysql_free_result($vendidos);
?>
