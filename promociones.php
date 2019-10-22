<?php require_once('Connections/conn.php'); ?>
<?php

 $hostname = "localhost"; 
  $username = "root"; 
  $password = ""; 
  $database = "skynet";
    $conn = mysqli_connect($hostname, $username, $password, $database);

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

$colname_Recordset1 = "-1";
if (isset($_POST['product'])) {
  $colname_Recordset1 = $_POST['product'];
}
mysqli_select_db($conn,$database);
$query_Recordset1 = sprintf("SELECT * FROM articulos inner join medida on medida.id_medida=articulos.id_medida WHERE nomb_product LIKE %s or cod_product='$colname_Recordset1' ORDER BY nomb_product ASC", GetSQLValueString("%" . $colname_Recordset1 . "%", "text"));
$Recordset1 = mysqli_query($conn,$query_Recordset1) or die(mysql_error($conn));
$row_Recordset1 = mysqli_fetch_assoc($Recordset1);
$totalRows_Recordset1 = mysqli_num_rows($Recordset1);


?>
<?php require_once('Connections/conn.php'); ?>
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
<!--
body {
	background-image: url();
}
.Estilo1 {color: #CC0000}
.Estilo2 {color: #000000}
-->
</style><!-- InstanceEndEditable -->
</head>

<body>
<!-- InstanceBeginEditable name="EditRegion3" -->
<?php include('menu.php'); ?>
<br />
<p>Promociones:</p>
<form id="form1" name="form1" method="post" action="promociones.php">
  <label for="product"></label>
  <input type="text" name="product" id="product" />
  <input type="submit" name="button" id="button" value="Buscar" />
</form>
<p>Si la promocion <span class="Estilo1"><span class="Estilo2">esta </span>activada</span> se mostrara un<span class="Estilo1"> 0</span> en la columna Activa </p>
<p>si la promocion esta <span class="Estilo1">desactivada</span> se mostrara un <span class="Estilo1">1</span>  en la columna Activa </p>
<table width="600" border="0" cellpadding="1" cellspacing="1">
  <tr class="letter">
    <td align="center" bgcolor="#00A9EC">Codigo</td>
    <td align="center" bgcolor="#00A9EC">Producto</td>
    <td align="center" bgcolor="#00A9EC">Precio Venta</td>
    <td align="center" bgcolor="#00A9EC">Activa</td>
    <td align="center" bgcolor="#00A9EC">Cantidad/unidades</td>
    <td align="center" bgcolor="#00A9EC">Precio Oferta </td>
    <td align="center" bgcolor="#00A9EC">Medida</td>
    <td align="center" bgcolor="#00A9EC">Opci&oacute;n</td>
  </tr>
  <?php do { ?>
    <tr bgcolor="#CCCCCC"
 onmouseover="this.style.backgroundColor='#00CCFF';"
 onmouseout="this.style.backgroundColor='#CCCCCC';">
      <td align="left"><?php echo $row_Recordset1['cod_product']; ?></td>
      <td><?php echo $row_Recordset1['nomb_product']; ?></td>
      <td align="right"><?php echo $row_Recordset1['precio_venta']; ?></td>
      <td align="center"><?php echo $row_Recordset1['promocion']; ?></td>
      <td align="center"><?php echo $row_Recordset1['cant_prom']; ?></td>
      <td align="center"><?php echo $row_Recordset1['valor_prom']; ?></td>
      <td align="center"><?php echo $row_Recordset1['medida']; ?></td>
           <td align="center"><a href="prom.php?prom=<?php echo $row_Recordset1['id_product']; ?>"><img src="img/índice.jpg" width="54" height="58" border="0" /></a></td>
    </tr>
    <?php } while ($row_Recordset1 = mysqli_fetch_assoc($Recordset1)); ?>
</table>
<!-- InstanceEndEditable -->
</body>
<!-- InstanceEnd --></html>
<?php
mysqli_free_result($Recordset1);
?>
