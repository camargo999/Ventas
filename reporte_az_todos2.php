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

$maxRows_Recordset1 = 10;
$pageNum_Recordset1 = 0;
if (isset($_GET['pageNum_Recordset1'])) {
  $pageNum_Recordset1 = $_GET['pageNum_Recordset1'];
}
$startRow_Recordset1 = $pageNum_Recordset1 * $maxRows_Recordset1;

mysql_select_db($database_conn, $conn);
$query_Recordset1 = "SELECT entrada_caja.fecha_entrada, entrada_caja.valor_entrada,   cierre_caja.devoluciones, cierre_caja.fecha_cierre,  cierre_caja.total_cierre,pos.id_caja,pos.nomb_caja,usuarios.id_usuarios,usuarios.nombre FROM cierre_caja   INNER JOIN entrada_caja ON (cierre_caja.id_entracaja = entrada_caja.id_entracaja)   INNER JOIN usuarios ON (cierre_caja.id_usuarios = usuarios.id_usuarios)   INNER JOIN pos ON (cierre_caja.id_caja = pos.id_caja) WHERE     entrada_caja.fecha_entrada between '$fecha 00:00:00' and '$fecha 23:59:00' ORDER BY entrada_caja.fecha_entrada desc";
$query_limit_Recordset1 = sprintf("%s LIMIT %d, %d", $query_Recordset1, $startRow_Recordset1, $maxRows_Recordset1);
$Recordset1 = mysql_query($query_limit_Recordset1, $conn) or die(mysql_error());
$row_Recordset1 = mysql_fetch_assoc($Recordset1);

if (isset($_GET['totalRows_Recordset1'])) {
  $totalRows_Recordset1 = $_GET['totalRows_Recordset1'];
} else {
  $all_Recordset1 = mysql_query($query_Recordset1);
  $totalRows_Recordset1 = mysql_num_rows($all_Recordset1);
}
$totalPages_Recordset1 = ceil($totalRows_Recordset1/$maxRows_Recordset1)-1;

$queryString_Recordset1 = "";
if (!empty($_SERVER['QUERY_STRING'])) {
  $params = explode("&", $_SERVER['QUERY_STRING']);
  $newParams = array();
  foreach ($params as $param) {
    if (stristr($param, "pageNum_Recordset1") == false && 
        stristr($param, "totalRows_Recordset1") == false) {
      array_push($newParams, $param);
    }
  }
  if (count($newParams) != 0) {
    $queryString_Recordset1 = "&" . htmlentities(implode("&", $newParams));
  }
}
$queryString_Recordset1 = sprintf("&totalRows_Recordset1=%d%s", $totalRows_Recordset1, $queryString_Recordset1);
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
  <?
$fecha=$_GET['fecha'];
$cadB="/";
$cadS="-";

$fecha2=str_replace($cadB,$cadS,$fecha);




 
?>
</p>
<p>&nbsp;</p>
<p>&nbsp;</p>
<p>Reporte A-Z<br />
  Fecha:<? echo $fecha?><br />
</p>
<p>&nbsp;</p>
<table border="0" class="tabla">
  <tr class="letter"  bgcolor="#00A9EC" valign="baseline">
    <td>Cajero(a)</td>
    <td>Caja</td>
    <td>Fecha Entrada</td>
    <td>valor_entrada</td>
    <td>Ventas</td>
    <td>devoluciones</td>
    <td>Fecha Cierre</td>
    <td>total_cierre</td>
  </tr>
  <?php do { ?>
  <?
  $cajero=$row_Recordset1['id_usuarios'];
$sql2="SELECT 
  entrada_caja.valor_entrada,
  cierre_caja.devoluciones,
  cierre_caja.total_cierre
FROM
  cierre_caja
  INNER JOIN entrada_caja ON (cierre_caja.id_entracaja = entrada_caja.id_entracaja)
  INNER JOIN usuarios ON (cierre_caja.id_usuarios = usuarios.id_usuarios)
  INNER JOIN pos ON (cierre_caja.id_caja = pos.id_caja)
WHERE
  usuarios.id_usuarios=$cajero AND 
  entrada_caja.fecha_entrada between '$fecha2 00:00:00' and '$fecha2 23:59:00'";
  $resultado=mysql_query($sql2);
  $reg=mysql_fetch_array($resultado);
//echo $sql2;
?>
   <tr bgcolor="#CCCCCC"
 onmouseover="this.style.backgroundColor='#00CCFF';"
 onmouseout="this.style.backgroundColor='#CCCCCC';">
     <td>&nbsp;<?php echo $row_Recordset1['nombre']; ?></td>
     <td>&nbsp;<?php echo $row_Recordset1['nomb_caja']; ?></td>
      <td>&nbsp;<?php echo $row_Recordset1['fecha_entrada']; ?></td>
      <td align="right"><?php echo number_format($row_Recordset1['valor_entrada']); ?></td>
      <?
	  $cajero=$row_Recordset1['id_usuarios'];
 $fechaentrada=$row_Recordset1['fecha_entrada'];   
  $fechacierre=$row_Recordset1['fecha_cierre'];
   $idcaja=$row_Recordset1['id_caja']; 
$sql4="select SUM(facturas.total_fact) AS totalvent 
FROM facturas 
INNER JOIN usuarios ON (facturas.id_usuarios = usuarios.id_usuarios) 
INNER JOIN pos ON (facturas.id_caja = pos.id_caja)
 WHERE 
  usuarios.id_usuarios=$cajero AND 
  facturas.fecha_fact between '$fechaentrada' and '$fechacierre' and pos.id_caja=$idcaja ";
  $resultado4=mysql_query($sql4);
  $reg4=mysql_fetch_array($resultado4);
//echo $sql4;
?>
      <td align="right">&nbsp;<?php echo number_format($reg4['totalvent']); ?></td>
      <td align="right"><?php echo number_format($row_Recordset1['devoluciones']); ?></td>
      <td align="right"><?php echo $row_Recordset1['fecha_cierre']; ?></td>
      <td align="right"><?php echo number_format($row_Recordset1['total_cierre']); ?></td>
    </tr>
    <?php } while ($row_Recordset1 = mysql_fetch_assoc($Recordset1)); ?>
</table>
<p>
<table border="0">
  <tr>
    <td><?php if ($pageNum_Recordset1 > 0) { // Show if not first page ?>
        <a href="<?php printf("%s?pageNum_Recordset1=%d%s", $currentPage, 0, $queryString_Recordset1); ?>"><img src="First.gif" border="0" /></a>
    <?php } // Show if not first page ?></td>
    <td><?php if ($pageNum_Recordset1 > 0) { // Show if not first page ?>
        <a href="<?php printf("%s?pageNum_Recordset1=%d%s", $currentPage, max(0, $pageNum_Recordset1 - 1), $queryString_Recordset1); ?>"><img src="Previous.gif" border="0" /></a>
    <?php } // Show if not first page ?></td>
    <td><?php if ($pageNum_Recordset1 < $totalPages_Recordset1) { // Show if not last page ?>
        <a href="<?php printf("%s?pageNum_Recordset1=%d%s", $currentPage, min($totalPages_Recordset1, $pageNum_Recordset1 + 1), $queryString_Recordset1); ?>"><img src="Next.gif" border="0" /></a>
    <?php } // Show if not last page ?></td>
    <td><?php if ($pageNum_Recordset1 < $totalPages_Recordset1) { // Show if not last page ?>
        <a href="<?php printf("%s?pageNum_Recordset1=%d%s", $currentPage, $totalPages_Recordset1, $queryString_Recordset1); ?>"><img src="Last.gif" border="0" /></a>
    <?php } // Show if not last page ?></td>
  </tr>
</table>
</p>
<!-- InstanceEndEditable -->
</body>
<!-- InstanceEnd --></html>
<?php
mysql_free_result($Recordset1);
?>
