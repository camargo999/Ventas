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

$editFormAction = $_SERVER['PHP_SELF'];
if (isset($_SERVER['QUERY_STRING'])) {
  $editFormAction .= "?" . htmlentities($_SERVER['QUERY_STRING']);
}

if ((isset($_POST["MM_update"])) && ($_POST["MM_update"] == "form1")) {
  $updateSQL = sprintf("UPDATE articulos SET id_categoria=%s, iva=%s, familia=%s, lote=%s, cod_product=%s, nomb_product=%s, id_medida=%s, inventario=%s, precio_compra=%s, precio_venta=%s, activo=%s WHERE id_product=%s",
                       GetSQLValueString($_POST['id_categoria'], "int"),
                       GetSQLValueString($_POST['iva'], "int"),
					   GetSQLValueString($_POST['familia'], "text"),
					   GetSQLValueString($_POST['lote'], "text"),
                       GetSQLValueString($_POST['cod_product'], "text"),
                       GetSQLValueString($_POST['nomb_product'], "text"),
                       GetSQLValueString($_POST['id_medida'], "int"),
					   GetSQLValueString($_POST['inventario'], "int"),
					   GetSQLValueString($_POST['precio_compra'], "int"),
                       GetSQLValueString($_POST['precio_venta'], "double"),
                       GetSQLValueString($_POST['activo'], "int"),
                       GetSQLValueString($_POST['id_product'], "int"));

  mysql_select_db($database_conn, $conn);
  $Result1 = mysql_query($updateSQL, $conn) or die(mysql_error());

  $updateGoTo = "articulos.php";
  if (isset($_SERVER['QUERY_STRING'])) {
    $updateGoTo .= (strpos($updateGoTo, '?')) ? "&" : "?";
    $updateGoTo .= $_SERVER['QUERY_STRING'];
  }
  header(sprintf("Location: %s", $updateGoTo));
}

$colname_Recordset1 = "-1";
if (isset($_GET['id_pro'])) {
  $colname_Recordset1 = $_GET['id_pro'];
}
mysql_select_db($database_conn, $conn);
$query_Recordset1 = sprintf("SELECT * FROM articulos WHERE id_product = %s", GetSQLValueString($colname_Recordset1, "int"));
$Recordset1 = mysql_query($query_Recordset1, $conn) or die(mysql_error());
$row_Recordset1 = mysql_fetch_assoc($Recordset1);
$totalRows_Recordset1 = mysql_num_rows($Recordset1);

mysql_select_db($database_conn, $conn);
$query_Recordset2 = "SELECT id_medida, medida FROM medida";
$Recordset2 = mysql_query($query_Recordset2, $conn) or die(mysql_error());
$row_Recordset2 = mysql_fetch_assoc($Recordset2);
$totalRows_Recordset2 = mysql_num_rows($Recordset2);

mysql_select_db($database_conn, $conn);
$query_cat = "SELECT id_categoria, categoria FROM categorias";
$cat = mysql_query($query_cat, $conn) or die(mysql_error());
$row_cat = mysql_fetch_assoc($cat);
$totalRows_cat = mysql_num_rows($cat);
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
<!--
body {
	background-image: url();
}
-->
</style><!-- InstanceEndEditable -->
</head>

<body>
<!-- InstanceBeginEditable name="EditRegion3" --><?php include('menu.php'); ?><br />
<form action="<?php echo $editFormAction; ?>" method="post" name="form1" id="form1">
<p>&nbsp;</p>
  <p>&nbsp;</p>
  <table align="left">
    <tr valign="baseline">
      <td nowrap="nowrap" align="right">Id_product:</td>
      <td><?php echo $row_Recordset1['id_product']; ?></td>
    </tr>
    <tr valign="baseline">
      <td nowrap="nowrap" align="right">Categoria:</td>
      <td><select name="id_categoria">
        <?php 
do {  
?>
        <option value="<?php echo $row_cat['id_categoria']?>" <?php if (!(strcmp($row_cat['id_categoria'], htmlentities($row_Recordset1['id_categoria'], ENT_COMPAT, 'utf-8')))) {echo "SELECTED";} ?>><?php echo $row_cat['categoria']?></option>
        <?php
} while ($row_cat = mysql_fetch_assoc($cat));
?>
      </select></td>
    </tr>
    <tr> </tr>
    <tr valign="baseline">
      <td nowrap="nowrap" align="right">Iva:</td>
      <td><input name="iva" type="text" value="<?php echo htmlentities($row_Recordset1['iva'], ENT_COMPAT, 'utf-8'); ?>" size="5" maxlength="5" /></td>
    </tr>
    <tr valign="baseline">
      <td nowrap="nowrap" align="right">Familia</td>
      <td><input type="text" name="familia" value="<?php echo htmlentities($row_Recordset1['familia'], ENT_COMPAT, 'utf-8'); ?>" size="32" /></td>
    </tr>
    <tr valign="baseline">
      <td nowrap="nowrap" align="right">Lote:</td>
      <td><input type="text" name="lote" value="<?php echo htmlentities($row_Recordset1['lote'], ENT_COMPAT, 'utf-8'); ?>" size="32" /></td>
    </tr>
    <tr valign="baseline">
      <td nowrap="nowrap" align="right">Codigo:</td>
      <td><input type="text" name="cod_product" value="<?php echo htmlentities($row_Recordset1['cod_product'], ENT_COMPAT, 'utf-8'); ?>" size="32" /></td>
    </tr>
    <tr valign="baseline">
      <td nowrap="nowrap" align="right">Producto:</td>
      <td><input type="text" name="nomb_product" value="<?php echo htmlentities($row_Recordset1['nomb_product'], ENT_COMPAT, 'utf-8'); ?>" size="32" /></td>
    </tr>
    <tr valign="baseline">
      <td nowrap="nowrap" align="right">Medida:</td>
      <td><select name="id_medida">
        <?php 
do {  
?>
        <option value="<?php echo $row_Recordset2['id_medida']?>" <?php if (!(strcmp($row_Recordset2['id_medida'], htmlentities($row_Recordset1['id_medida'], ENT_COMPAT, 'utf-8')))) {echo "SELECTED";} ?>><?php echo $row_Recordset2['medida']?></option>
        <?php
} while ($row_Recordset2 = mysql_fetch_assoc($Recordset2));
?>
      </select></td>
    </tr>
    <tr> </tr>
    <tr valign="baseline">
      <td nowrap="nowrap" align="right">cantidad:</td>
      <td><input type="text" name="inventario" value="<?php echo htmlentities($row_Recordset1['inventario'], ENT_COMPAT, 'utf-8'); ?>" size="32" /></td>
    </tr>
    <tr valign="baseline">
      <td nowrap="nowrap" align="right">Precio compra:</td>
      <td><input type="text" name="precio_compra" value="<?php echo htmlentities($row_Recordset1['precio_compra'], ENT_COMPAT, 'utf-8'); ?>" size="32" /></td>
    </tr>
    <tr valign="baseline">
      <td nowrap="nowrap" align="right">Precio Venta:</td>
      <td><input type="text" name="precio_venta" value="<?php echo htmlentities($row_Recordset1['precio_venta'], ENT_COMPAT, 'utf-8'); ?>" size="32" /></td>
    </tr>
    <tr valign="baseline">
      <td align="right" valign="middle" nowrap="nowrap">Activo:</td>
      <td valign="baseline"><table>
        <tr>
          <td><input type="radio" name="activo" value="1" <?php if (!(strcmp(htmlentities($row_Recordset1['activo'], ENT_COMPAT, 'utf-8'),1))) {echo "checked=\"checked\"";} ?> />
            Activo</td>
        </tr>
        <tr>
          <td><input type="radio" name="activo" value="0" <?php if (!(strcmp(htmlentities($row_Recordset1['activo'], ENT_COMPAT, 'utf-8'),0))) {echo "checked=\"checked\"";} ?> />
            Inactivo</td>
        </tr>
      </table></td>
    </tr>
    <tr valign="baseline">
      <td nowrap="nowrap" align="right">&nbsp;</td>
      <td><input type="submit" value="Actualizar registro" /></td>
    </tr>
  </table>
  <input type="hidden" name="MM_update" value="form1" />
  <input type="hidden" name="id_product" value="<?php echo $row_Recordset1['id_product']; ?>" />
</form>
<p>&nbsp;</p>
<br />

<!-- InstanceEndEditable -->
</body>
<!-- InstanceEnd --></html>
<?php
mysql_free_result($Recordset1);

mysql_free_result($Recordset2);

mysql_free_result($cat);
?>
