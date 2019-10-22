<?php
	

?>
<?php //require_once('Connections/conn.php'); ?>
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

$editFormAction = $_SERVER['PHP_SELF'];
if (isset($_SERVER['QUERY_STRING'])) {
  $editFormAction .= "?" . htmlentities($_SERVER['QUERY_STRING']);
}

if ((isset($_POST["MM_update"])) && ($_POST["MM_update"] == "form1")) {
  $updateSQL = sprintf("UPDATE pos SET ip_caja=%s, nomb_caja=%s, desc_caja=%s, act_caja=%s WHERE id_caja=%s",
                       GetSQLValueString($_POST['ip_caja'], "text"),
                       GetSQLValueString($_POST['nomb_caja'], "text"),
                       GetSQLValueString($_POST['desc_caja'], "text"),
                       GetSQLValueString($_POST['act_caja'], "int"),
                       GetSQLValueString($_POST['id_caja'], "int"));

  mysqli_select_db($conn,$database);
  $Result1 = mysqli_query($conn,$updateSQL) or die(mysqli_error($conn));

  $updateGoTo = "cajas.php";
  if (isset($_SERVER['QUERY_STRING'])) {
    $updateGoTo .= (strpos($updateGoTo, '?')) ? "&" : "?";
    $updateGoTo .= $_SERVER['QUERY_STRING'];
  }
  header(sprintf("Location: %s", $updateGoTo));
}

$colname_Recordset1 = "-1";
if (isset($_GET['id_caj'])) {
  $colname_Recordset1 = $_GET['id_caj'];
}
mysqli_select_db($conn,$database);
$query_Recordset1 = sprintf("SELECT * FROM pos WHERE id_caja = %s", GetSQLValueString($colname_Recordset1, "int"));
$Recordset1 = mysqli_query($conn,$query_Recordset1) or die(mysqli_error($conn));
$row_Recordset1 = mysqli_fetch_assoc($Recordset1);
$totalRows_Recordset1 = mysqli_num_rows($Recordset1);
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
body {
	background-image: url(img/frutas.jpg);
}
</style>
<!-- InstanceEndEditable -->
</head>

<body>
<!-- InstanceBeginEditable name="EditRegion3" -->
<?php include('menu.php'); ?>
<p>&nbsp;</p>
<p>&nbsp;</p>
<p>&nbsp;</p>
<p><br />
</p>
<form action="<?php echo $editFormAction; ?>" method="post" name="form1" id="form1">
  <table align="left">
    <tr valign="baseline">
      <td nowrap="nowrap" align="right">Id_caja:</td>
      <td><?php echo $row_Recordset1['id_caja']; ?></td>
    </tr>
    <tr valign="baseline">
      <td nowrap="nowrap" align="right">Direccion IP:</td>
      <td><input type="text" name="ip_caja" value="<?php echo htmlentities($row_Recordset1['ip_caja'], ENT_COMPAT, 'utf-8'); ?>" size="32" /></td>
    </tr>
    <tr valign="baseline">
      <td nowrap="nowrap" align="right">Nombre:</td>
      <td><input type="text" name="nomb_caja" value="<?php echo htmlentities($row_Recordset1['nomb_caja'], ENT_COMPAT, 'utf-8'); ?>" size="32" /></td>
    </tr>
    <tr valign="baseline">
      <td nowrap="nowrap" align="right">Descripcion:</td>
      <td><input type="text" name="desc_caja" value="<?php echo htmlentities($row_Recordset1['desc_caja'], ENT_COMPAT, 'utf-8'); ?>" size="32" /></td>
    </tr>
    <tr valign="baseline">
      <td nowrap="nowrap" align="right">Act_caja:</td>
      <td valign="baseline"><table>
        <tr>
          <td><input type="radio" name="act_caja" value="1" <?php if (!(strcmp(htmlentities($row_Recordset1['act_caja'], ENT_COMPAT, 'utf-8'),1))) {echo "checked=\"checked\"";} ?> />
            Activo</td>
        </tr>
        <tr>
          <td><input type="radio" name="act_caja" value="0" <?php if (!(strcmp(htmlentities($row_Recordset1['act_caja'], ENT_COMPAT, 'utf-8'),0))) {echo "checked=\"checked\"";} ?> />
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
  <input type="hidden" name="id_caja" value="<?php echo $row_Recordset1['id_caja']; ?>" />
</form>
<p>&nbsp;</p>
<br />

<!-- InstanceEndEditable -->
</body>
<!-- InstanceEnd --></html>
<?php
mysqli_free_result($Recordset1);
?>
