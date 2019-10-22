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

$colname_Recordset1 = "-1";
if (isset($_POST['product'])) {
  $colname_Recordset1 = $_POST['product'];
}
mysql_select_db($database_conn, $conn);
$query_Recordset1 = sprintf("SELECT * FROM articulos inner join medida on medida.id_medida=articulos.id_medida WHERE nomb_product LIKE %s or cod_product='$colname_Recordset1' ORDER BY nomb_product ASC", GetSQLValueString("%" . $colname_Recordset1 . "%", "text"));
$Recordset1 = mysql_query($query_Recordset1, $conn) or die(mysql_error());
$row_Recordset1 = mysql_fetch_assoc($Recordset1);
$totalRows_Recordset1 = mysql_num_rows($Recordset1);


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
	background-image: url(img/frutas.jpg);
}
-->
</style><!-- InstanceEndEditable -->
</head>

<body>
<!-- InstanceBeginEditable name="EditRegion3" -->
<?php include('menu.php'); ?>
<p><br />
</p>
<p>&nbsp;</p>
<p>&nbsp;</p>
<p>articulos:</p>
<p><a href="add_producto.php">Agregar articulos</a></p>
<form id="form1" name="form1" method="post" action="prom.php">
  <label for="product"></label>
  <input type="text" name="product" id="product" />
  <input type="submit" name="button" id="button" value="Buscar" />
</form>
<p>&nbsp;</p>
<p>&nbsp;</p>
<table width="931" border="0" align="center" cellpadding="1" cellspacing="1">
  <tr class="letter">
    <td width="216" align="center" bgcolor="#00A9EC">Codigo</td>
    <td width="233" align="center" bgcolor="#00A9EC">Producto</td>
    <td width="222" align="center" bgcolor="#00A9EC">Precio Venta</td>
    <td width="7" align="center" bgcolor="#00A9EC">Cantidad</td>
    <td width="177" align="center" bgcolor="#00A9EC">Medida</td>
    <td width="57" align="center" bgcolor="#00A9EC">Opci&oacute;n</td>
  </tr>
  <?php do { ?>
    <tr bgcolor="#CCCCCC"
 onmouseover="this.style.backgroundColor='#00CCFF';"
 onmouseout="this.style.backgroundColor='#CCCCCC';">
      <td align="left"><?php echo $row_Recordset1['cod_product']; ?></td>
      <td><?php echo $row_Recordset1['nomb_product']; ?></td>
      <td align="right"><?php echo $row_Recordset1['precio_venta']; ?></td>
      <td align="center"><?php echo $row_Recordset1['cantidad']; ?></td>
      <td align="center"><?php echo $row_Recordset1['medida']; ?></td>
           <td align="center"><a href="prom.php?prom=<?php echo $row_Recordset1['id_product']; ?>"><img src="img/edit.png" width="20" height="20" border="0"/></a></td>
    </tr>
    <?php } while ($row_Recordset1 = mysql_fetch_assoc($Recordset1)); ?>
</table>
<!-- InstanceEndEditable -->
</body>
<!-- InstanceEnd --></html>
<?php
mysql_free_result($Recordset1);
?>
