<?php require_once('../Connections/PEDIDOS.php'); ?>
<?php
function GetSQLValueString($theValue, $theType, $theDefinedValue = "", $theNotDefinedValue = "") 
{
  $theValue = (!get_magic_quotes_gpc()) ? addslashes($theValue) : $theValue;

  switch ($theType) {
    case "text":
      $theValue = ($theValue != "") ? "'" . $theValue . "'" : "NULL";
      break;    
    case "long":
    case "int":
      $theValue = ($theValue != "") ? intval($theValue) : "NULL";
      break;
    case "double":
      $theValue = ($theValue != "") ? "'" . doubleval($theValue) . "'" : "NULL";
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

$editFormAction = $_SERVER['PHP_SELF'];
if (isset($_SERVER['QUERY_STRING'])) {
  $editFormAction .= "?" . htmlentities($_SERVER['QUERY_STRING']);
}

if ((isset($_POST["MM_insert"])) && ($_POST["MM_insert"] == "form2")) {
  $insertSQL = sprintf("INSERT INTO pedidos (cod_product, nomb_product, precio_venta, cantidad) VALUES (%s, %s, %s, %s)",
                       GetSQLValueString($_POST['cod_product'], "text"),
                       GetSQLValueString($_POST['nomb_product'], "text"),
                       GetSQLValueString($_POST['precio_venta'], "text"),
                       GetSQLValueString($_POST['cantidad'], "text"));

  mysql_select_db($database_PEDIDOS, $PEDIDOS);
  $Result1 = mysql_query($insertSQL, $PEDIDOS) or die(mysql_error());
}

$colname_PEDIDOS = "-1";
if (isset($_GET['id_pedido'])) {
  $colname_PEDIDOS = (get_magic_quotes_gpc()) ? $_GET['id_pedido'] : addslashes($_GET['id_pedido']);
}
mysql_select_db($database_PEDIDOS, $PEDIDOS);
$query_PEDIDOS = sprintf("SELECT * FROM pedidos WHERE id_pedido = %s", $colname_PEDIDOS);
$PEDIDOS = mysql_query($query_PEDIDOS, $PEDIDOS) or die(mysql_error());
$row_PEDIDOS = mysql_fetch_assoc($PEDIDOS);
$totalRows_PEDIDOS = mysql_num_rows($PEDIDOS);
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>SKYNET</title>

<link href="estilo.css" rel="stylesheet" type="text/css">

<style type="text/css">
<!--
body {
	background-image: url(img/Fondo-color-verde-688051.jpeg);
}
-->
</style></head>

<body>
<?php include("menu.php"); ?>
<form id="form1" name="form1" method="post" action="">
  <p>&nbsp;</p>
  <p>&nbsp;</p>
  <p>&nbsp;</p>
  <p>
    <label></label>
  </p>
  <p>&nbsp;</p>
  <p>&nbsp;</p>
  <p>&nbsp;</p>
  <p>&nbsp;</p>
</form>

<form method="post" name="form2" action="<?php echo $editFormAction; ?>">
  <table align="center">
    <tr valign="baseline">
      <td nowrap align="right">Cod_product:</td>
      <td><input type="text" name="cod_product" value="" size="32"></td>
    </tr>
    <tr valign="baseline">
      <td nowrap align="right">Nomb_product:</td>
      <td><input type="text" name="nomb_product" value="" size="32"></td>
    </tr>
    <tr valign="baseline">
      <td nowrap align="right">Precio_venta:</td>
      <td><input name="precio_venta" type="text" value="" size="32"></td>
    </tr>
    <tr valign="baseline">
      <td nowrap align="right">Cantidad:</td>
      <td><input type="text" name="cantidad" value="" size="32"></td>
    </tr>
    <tr valign="baseline">
      <td nowrap align="right">&nbsp;</td>
      <td><input type="submit" value="Insertar registro"></td>
    </tr>
  </table>
  <input type="hidden" name="MM_insert" value="form2">
</form>
<p>&nbsp;</p>
</body>
</html>
<?php
mysql_free_result($PEDIDOS);
?>

