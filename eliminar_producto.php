
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

$currentPage = $_SERVER["PHP_SELF"];

$maxRows_facturas = 20;
$pageNum_facturas = 0;
if (isset($_GET['pageNum_facturas'])) {
  $pageNum_facturas = $_GET['pageNum_facturas'];
}
$startRow_facturas = $pageNum_facturas * $maxRows_facturas;

mysqli_select_db($conn,$database);
$query_facturas = "SELECT    facturas.id_fact,   pos.nomb_caja,   usuarios.nombre FROM   facturas   INNER JOIN pos ON (facturas.id_caja = pos.id_caja)   INNER JOIN usuarios ON (facturas.id_usuarios = usuarios.id_usuarios) WHERE   facturas.activo = 1";
$query_limit_facturas = sprintf("%s LIMIT %d, %d", $query_facturas, $startRow_facturas, $maxRows_facturas);
$facturas = mysqli_query($conn,$query_limit_facturas) or die(mysqli_error($conn));
$row_facturas = mysqli_fetch_assoc($facturas);

if (isset($_GET['totalRows_facturas'])) {
  $totalRows_facturas = $_GET['totalRows_facturas'];
} else {
  $all_facturas = mysqli_query($conn,$query_facturas);
  $totalRows_facturas = mysqli_num_rows($all_facturas);
}
$totalPages_facturas = ceil($totalRows_facturas/$maxRows_facturas)-1;

$queryString_facturas = "";
if (!empty($_SERVER['QUERY_STRING'])) {
  $params = explode("&", $_SERVER['QUERY_STRING']);
  $newParams = array();
  foreach ($params as $param) {
    if (stristr($param, "pageNum_facturas") == false && 
        stristr($param, "totalRows_facturas") == false) {
      array_push($newParams, $param);
    }
  }
  if (count($newParams) != 0) {
    $queryString_facturas = "&" . htmlentities(implode("&", $newParams));
  }
}
$queryString_facturas = sprintf("&totalRows_facturas=%d%s", $totalRows_facturas, $queryString_facturas);
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
body {
	background-image: url();
}
.Estilo2 {font-size: 18px; color: #FFFF00; }
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
<p><br />
  <span class="Estilo2"><strong>Borrar Producto </strong></span>
  
</p>
<table width="491"  border="0" cellpadding="1" cellspacing="1" class="tabla">
  <tr class="letter"  bgcolor="#00A9EC">
    <td>Fact N°</td>
    <td>Caja</td>
    <td>Cajero</td>
    <td></td>
  </tr>
  <?php do { ?>
    <tr bg bgcolor="#CCCCCC">
      <td><?php echo $row_facturas['id_fact']; ?></td>
      <td><?php echo $row_facturas['nomb_caja']; ?></td>
      <td><?php echo $row_facturas['nombre']; ?></td>
       <td align="center"><a href="articulos_fact.php?idfact=<?php echo $row_facturas['id_fact']; ?>"><img src="img/bd_select.png" width="16" height="16" border="0" /></a></td>
    </tr>
    <?php } while ($row_facturas = mysqli_fetch_assoc($facturas)); ?>
</table>
<table border="0">
  <tr>
    <td><?php if ($pageNum_facturas > 0) { // Show if not first page ?>
        <a href="<?php printf("%s?pageNum_facturas=%d%s", $currentPage, 0, $queryString_facturas); ?>"><img src="First.gif" border="0" /></a>
    <?php } // Show if not first page ?></td>
    <td><?php if ($pageNum_facturas > 0) { // Show if not first page ?>
        <a href="<?php printf("%s?pageNum_facturas=%d%s", $currentPage, max(0, $pageNum_facturas - 1), $queryString_facturas); ?>"><img src="Previous.gif" border="0" /></a>
    <?php } // Show if not first page ?></td>
    <td><?php if ($pageNum_facturas < $totalPages_facturas) { // Show if not last page ?>
        <a href="<?php printf("%s?pageNum_facturas=%d%s", $currentPage, min($totalPages_facturas, $pageNum_facturas + 1), $queryString_facturas); ?>"><img src="Next.gif" border="0" /></a>
    <?php } // Show if not last page ?></td>
    <td><?php if ($pageNum_facturas < $totalPages_facturas) { // Show if not last page ?>
        <a href="<?php printf("%s?pageNum_facturas=%d%s", $currentPage, $totalPages_facturas, $queryString_facturas); ?>"><img src="Last.gif" border="0" /></a>
    <?php } // Show if not last page ?></td>
  </tr>
</table>
<!-- InstanceEndEditable -->
</body>
<!-- InstanceEnd --></html>
<?php
mysqli_free_result($facturas);
?>
