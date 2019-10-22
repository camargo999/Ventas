<?php require_once('../Connections/consulta.php'); ?>
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

if ((isset($_POST["MM_update"])) && ($_POST["MM_update"] == "form2")) {
  $updateSQL = sprintf("UPDATE clientes SET Nombres=%s, Nit=%s, Direccion=%s, Telefono=%s WHERE Id_Cliente=%s",
                       GetSQLValueString($_POST['Nombres'], "text"),
                       GetSQLValueString($_POST['Nit'], "int"),
                       GetSQLValueString($_POST['Direccion'], "text"),
                       GetSQLValueString($_POST['Telefono'], "text"),
                       GetSQLValueString($_POST['Id_Cliente'], "int"));

  mysql_select_db($database_consulta, $consulta);
  $Result1 = mysql_query($updateSQL, $consulta) or die(mysql_error());

  $updateGoTo = "clientemsnok.html";
  if (isset($_SERVER['QUERY_STRING'])) {
    $updateGoTo .= (strpos($updateGoTo, '?')) ? "&" : "?";
    $updateGoTo .= $_SERVER['QUERY_STRING'];
  }
  header(sprintf("Location: %s", $updateGoTo));
}

if ((isset($_POST["MM_update"])) && ($_POST["MM_update"] == "form3")) {
  $updateSQL = sprintf("UPDATE clientes SET Id_Cliente=%s, Nombres=%s, Direccion=%s, Telefono=%s WHERE Nit=%s",
                       GetSQLValueString($_POST['Id_Cliente'], "int"),
                       GetSQLValueString($_POST['Nombres'], "text"),
                       GetSQLValueString($_POST['Direccion'], "text"),
                       GetSQLValueString($_POST['Telefono'], "text"),
                       GetSQLValueString($_POST['Nit'], "int"));

  mysql_select_db($database_consulta, $consulta);
  $Result1 = mysql_query($updateSQL, $consulta) or die(mysql_error());

  $updateGoTo = "clientemsnok.html";
  if (isset($_SERVER['QUERY_STRING'])) {
    $updateGoTo .= (strpos($updateGoTo, '?')) ? "&" : "?";
    $updateGoTo .= $_SERVER['QUERY_STRING'];
  }
  header(sprintf("Location: %s", $updateGoTo));
}

$colname_Recordset1 = "-1";
if (isset($_GET['Nit'])) {
  $colname_Recordset1 = (get_magic_quotes_gpc()) ? $_GET['Nit'] : addslashes($_GET['Nit']);
}
mysql_select_db($database_consulta, $consulta);
$query_Recordset1 = sprintf("SELECT * FROM clientes WHERE Nit = %s", $colname_Recordset1);
$Recordset1 = mysql_query($query_Recordset1, $consulta) or die(mysql_error());
$row_Recordset1 = mysql_fetch_assoc($Recordset1);
$totalRows_Recordset1 = mysql_num_rows($Recordset1);

$varNit_MODIFIC = "-1";
if (isset($_POST[Nit])) {
  $varNit_MODIFIC = (get_magic_quotes_gpc()) ? $_POST[Nit] : addslashes($_POST[Nit]);
}
mysql_select_db($database_consulta, $consulta);
$query_MODIFIC = sprintf("SELECT * FROM clientes WHERE Nit = %s", $varNit_MODIFIC);
$MODIFIC = mysql_query($query_MODIFIC, $consulta) or die(mysql_error());
$row_MODIFIC = mysql_fetch_assoc($MODIFIC);
$totalRows_MODIFIC = mysql_num_rows($MODIFIC);
?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<!-- TemplateBeginEditable name="doctitle" -->
<title>Documento sin t&iacute;tulo</title>
<!-- TemplateEndEditable -->
<!-- TemplateBeginEditable name="head" -->
<!-- TemplateEndEditable -->
<style type="text/css">
<!--
body {
	background-image: url(img/Fondo-color-verde-688051.jpeg);
}
.Estilo1 {
	font-size: 24px;
	color: #FFFF00;
}
-->
</style></head>

<body>
<p>&nbsp;</p>
<p><a href="menu.php" class="Estilo1">volver  </a></p>
<form id="form1" name="form1" method="post" action="">
Realice los cambios requeridos
</form>
<form id="form2" name="form2" method="post" action="">
</form>
<p>&nbsp;</p>




    <form method="post" name="form3" action="<?php echo $editFormAction; ?>">
      <table align="center">
        <tr valign="baseline">
          <td nowrap align="right">Id_Cliente:</td>
          <td><input type="text" name="Id_Cliente" value="<?php echo $row_MODIFIC['Id_Cliente']; ?>" size="32"></td>
        </tr>
        <tr valign="baseline">
          <td nowrap align="right">Nombres:</td>
          <td><input type="text" name="Nombres" value="<?php echo $row_MODIFIC['Nombres']; ?>" size="32"></td>
        </tr>
        <tr valign="baseline">
          <td nowrap align="right">Nit:</td>
          <td><?php echo $row_MODIFIC['Nit']; ?></td>
        </tr>
        <tr valign="baseline">
          <td nowrap align="right">Direccion:</td>
          <td><input type="text" name="Direccion" value="<?php echo $row_MODIFIC['Direccion']; ?>" size="32"></td>
        </tr>
        <tr valign="baseline">
          <td nowrap align="right">Telefono:</td>
          <td><input type="text" name="Telefono" value="<?php echo $row_MODIFIC['Telefono']; ?>" size="32"></td>
        </tr>
        <tr valign="baseline">
          <td nowrap align="right">&nbsp;</td>
          <td><input type="submit" value="Actualizar registro"></td>
        </tr>
      </table>
      <input type="hidden" name="MM_update" value="form3">
      <input type="hidden" name="Nit" value="<?php echo $row_MODIFIC['Nit']; ?>">
    </form>
    <p>&nbsp;</p>
    <p>&nbsp;</p>
</body>
</html>
<?php
mysql_free_result($Recordset1);

mysql_free_result($MODIFIC);

?>
