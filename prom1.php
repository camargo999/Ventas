
	
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

$editFormAction = $_SERVER['PHP_SELF'];
if (isset($_SERVER['QUERY_STRING'])) {
  $editFormAction .= "?" . htmlentities($_SERVER['QUERY_STRING']);
}

if ((isset($_POST["MM_update"])) && ($_POST["MM_update"] == "form1")) {
  $updateSQL = sprintf("UPDATE articulos SET cod_product=%s, nomb_product=%s, id_medida=%s, precio_venta=%s, promocion=%s, cant_prom=%s, valor_prom=%s, activo=%s WHERE id_product=%s",
                       GetSQLValueString($_POST['cod_product'], "text"),
                       GetSQLValueString($_POST['nomb_product'], "text"),
                       GetSQLValueString($_POST['id_medida'], "int"),
                       GetSQLValueString($_POST['precio_venta'], "double"),
                       GetSQLValueString($_POST['promocion'], "int"),
                       GetSQLValueString($_POST['cant_prom'], "double"),
                       GetSQLValueString($_POST['valor_prom'], "int"),
                       GetSQLValueString($_POST['activo'], "int"),
                       GetSQLValueString($_POST['id_product'], "int"));

  mysqli_select_db($conn,$database);
  $Result1 = mysqli_query($conn,$updateSQL) or die(mysqli_error($conn));

  $updateGoTo = "promociones.php";
  if (isset($_SERVER['QUERY_STRING'])) {
    $updateGoTo .= (strpos($updateGoTo, '?')) ? "&" : "?";
    $updateGoTo .= $_SERVER['QUERY_STRING'];
  }
  header(sprintf("Location: %s", $updateGoTo));
}

$colname_Recordset1 = "-1";
if (isset($_GET['prom'])) {
  $colname_Recordset1 = $_GET['prom'];
}
mysqli_select_db($conn,$database);
$query_Recordset1 = sprintf("SELECT * FROM articulos WHERE id_product = %s", GetSQLValueString($colname_Recordset1, "int"));
$Recordset1 = mysqli_query($conn,$query_Recordset1) or die(mysqli_error($conn));
$row_Recordset1 = mysqli_fetch_assoc($Recordset1);
$totalRows_Recordset1 = mysqli_num_rows($Recordset1);

mysqli_select_db($conn,$database);
$query_Recordset2 = "SELECT id_medida, medida FROM medida ORDER BY medida ASC";
$Recordset2 = mysqli_query($conn,$query_Recordset2) or die(mysqli_error($conn));
$row_Recordset2 = mysqli_fetch_assoc($Recordset2);
$totalRows_Recordset2 = mysqli_num_rows($Recordset2);
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
<!-- InstanceBeginEditable name="EditRegion3" -->
<?php include('menu.php'); ?>
<p><br />
</p>
<p>&nbsp;</p>
<p><br />
</p>
<form action="<?php echo $editFormAction; ?>" method="post" name="form1" id="form1">
  <table align="left">
    <tr valign="baseline">
      <td nowrap="nowrap" align="right">Id:</td>
      <td><?php echo $row_Recordset1['id_product']; ?></td>
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
} while ($row_Recordset2 = mysqli_fetch_assoc($Recordset2));
?>
      </select></td>
    </tr>
    <tr valign="baseline">
      <td nowrap="nowrap" align="right">Precio Venta:</td>
      <td><input type="float" name="precio_venta" value="<?php echo htmlentities($row_Recordset1['precio_venta'], ENT_COMPAT, 'utf-8'); ?>" size="32" /></td>
    </tr>
    <tr valign="baseline">
      <td height="39" colspan="2" align="right" valign="middle" nowrap="nowrap">&nbsp;</td>
    </tr>
    <tr align="center" valign="baseline" bgcolor="#0099CC">
      <td colspan="2" valign="middle" nowrap="nowrap">PROMOCIONES </td>
    </tr>
    <tr valign="baseline">
      <td align="right" valign="middle" nowrap="nowrap">Promoción:</td>
      <td valign="baseline"><table>
        <tr>
          <td><input type="radio" name="promocion" value="0" <?php if (!(strcmp(htmlentities($row_Recordset1['promocion'], ENT_COMPAT, 'utf-8'),0))) {echo "checked=\"checked\"";} ?> />
            Activo</td>
        </tr>
        <tr>
          <td><input type="radio" name="promocion" value="1" <?php if (!(strcmp(htmlentities($row_Recordset1['promocion'], ENT_COMPAT, 'utf-8'),1))) {echo "checked=\"checked\"";} ?> />
            Inactivo</td>
        </tr>
      </table></td>
    </tr>
    <tr valign="baseline">
      <td nowrap="nowrap" align="right">Cantidad (gr):</td>
      <td><input type="text" name="cant_prom" value="<?php echo htmlentities($row_Recordset1['cant_prom'], ENT_COMPAT, 'utf-8'); ?>" size="32" /></td>
    </tr>
    <tr valign="baseline">
      <td nowrap="nowrap" align="right">Valor ($):</td>
      <td><input type="text" name="valor_prom" value="<?php echo htmlentities($row_Recordset1['valor_prom'], ENT_COMPAT, 'utf-8'); ?>" size="32" /></td>
    </tr>
    <tr valign="baseline">
      <td nowrap="nowrap" align="right">&nbsp;</td>
      <td><input type="hidden" name="activo" value="<?php echo htmlentities($row_Recordset1['activo'], ENT_COMPAT, 'utf-8'); ?>" size="32" /></td>
    </tr>
    <tr valign="baseline">
      <td nowrap="nowrap" align="right">&nbsp;</td>
      <td><input type="submit" value="Actualizar registro" /></td>
    </tr>
  </table>
  <p>&nbsp;</p>
</form>
<p>&nbsp;</p>
<!-- InstanceEndEditable -->
</body>
<!-- InstanceEnd --></html>
<?php
mysqli_free_result($Recordset1);

mysqli_free_result($Recordset2);
?>
