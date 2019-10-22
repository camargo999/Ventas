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
  $updateSQL = sprintf("UPDATE usuarios SET `user`=%s, clave=%s, nombre=%s, id_tipouser=%s, activo=%s WHERE id_usuarios=%s",
                       GetSQLValueString($_POST['user'], "text"),
                       GetSQLValueString($_POST['clave'], "text"),
                       GetSQLValueString($_POST['nombre'], "text"),
                       GetSQLValueString($_POST['id_tipouser'], "int"),
                       GetSQLValueString($_POST['activo'], "int"),
                       GetSQLValueString($_POST['id_usuarios'], "int"));

  mysqli_select_db($conn,$database);
  $Result1 = mysqli_query($conn,$updateSQL) or die(mysqli_error($conn));
}

if ((isset($_POST["MM_update"])) && ($_POST["MM_update"] == "form1")) {
  $updateSQL = sprintf("UPDATE usuarios SET `user`=%s, clave=%s, nombre=%s, id_tipouser=%s, activo=%s WHERE id_usuarios=%s",
                       GetSQLValueString($_POST['user'], "text"),
                       GetSQLValueString($_POST['clave'], "text"),
                       GetSQLValueString($_POST['nombre'], "text"),
                       GetSQLValueString($_POST['id_tipouser'], "int"),
                       GetSQLValueString($_POST['activo'], "int"),
                       GetSQLValueString($_POST['id_usuarios'], "int"));

  mysqli_select_db($conn,$database);
  $Result1 = mysqli_query($conn,$updateSQL) or die(mysqli_error($conn));

  $updateGoTo = "usuarios.php";
  if (isset($_SERVER['QUERY_STRING'])) {
    $updateGoTo .= (strpos($updateGoTo, '?')) ? "&" : "?";
    $updateGoTo .= $_SERVER['QUERY_STRING'];
  }
  header(sprintf("Location: %s", $updateGoTo));
}

$colname_Recordset1 = "-1";
if (isset($_GET['id_usuarios'])) {
  $colname_Recordset1 = $_GET['id_usuarios'];
    }
mysqli_select_db($conn,$database);
$query_Recordset1 = sprintf("SELECT * FROM usuarios WHERE id_usuarios = %s", GetSQLValueString($colname_Recordset1, "int"));
$Recordset1 = mysqli_query($conn,$query_Recordset1) or die(mysql_error($conn));
$row_Recordset1 = mysqli_fetch_assoc($Recordset1);
$totalRows_Recordset1 = mysqli_num_rows($Recordset1);

mysqli_select_db($conn,$database);
$query_Recordset2 = "SELECT * FROM tipo_usuario";
$Recordset2 = mysqli_query($conn,$query_Recordset2) or die(mysql_error($conn));
$row_Recordset2 = mysqli_fetch_assoc($Recordset2);
$totalRows_Recordset2 = mysqli_num_rows($Recordset2);

?>


<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml"><!-- InstanceBegin template="/Templates/inicio.dwt.php" codeOutsideHTMLIsLocked="false" -->
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<!-- InstanceBeginEditable name="doctitle" -->
<title>SKYSOFT</title>
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
<p><br />
</p>
<form action="<?php echo $editFormAction; ?>" method="post" name="form1" id="form1">
  <table align="left">
    <tr valign="baseline">
      <td nowrap="nowrap" align="right"><div align="left">Id:</div></td>
      <td><div align="left"><?php echo $row_Recordset1['id_usuarios']; ?></div></td>
    </tr>
    <tr valign="baseline">
      <td nowrap="nowrap" align="right"><div align="left">Usuario:</div></td>
      <td><div align="left">
        <input type="text" name="user" value="<?php echo htmlentities($row_Recordset1['user'], ENT_COMPAT, 'utf-8'); ?>" size="32" />
      </div></td>
    </tr>
    <tr valign="baseline">
      <td nowrap="nowrap" align="right"><div align="left">Clave:</div></td>
      <td><div align="left">
        <input type="password" name="clave" value="<?php echo htmlentities($row_Recordset1['clave'], ENT_COMPAT, 'utf-8'); ?>" size="32" />
      </div></td>
    </tr>
    <tr valign="baseline">
      <td nowrap="nowrap" align="right"><div align="left">Nombres:</div></td>
      <td><div align="left">
        <input type="text" name="nombre" value="<?php echo htmlentities($row_Recordset1['nombre'], ENT_COMPAT, 'utf-8'); ?>" size="32" />
      </div></td>
    </tr>
    <tr valign="baseline">
      <td nowrap="nowrap" align="right"><div align="left">Tipo Usuario:</div></td>
      <td><div align="left">
        <select name="id_tipouser">
          <?php 
do {  
?>
          <option value="<?php echo $row_Recordset2['id_tipouser']?>" <?php if (!(strcmp($row_Recordset2['id_tipouser'], htmlentities($row_Recordset1['id_tipouser'], ENT_COMPAT, 'utf-8')))) {echo "SELECTED";} ?>><?php echo $row_Recordset2['tipo_usuario']?></option>
          <?php
} while ($row_Recordset2 = mysqli_fetch_assoc($Recordset2));
?>
        </select>
      </div></td>
    </tr>
    <tr> </tr>
    <tr valign="baseline">
      <td align="right" valign="middle" nowrap="nowrap"><div align="left">Activo:</div></td>
      <td valign="baseline"><div align="left">
        <table>
          <tr>
            <td><input type="radio" name="activo" value="1" <?php if (!(strcmp(htmlentities($row_Recordset1['activo'], ENT_COMPAT, 'utf-8'),1))) {echo "checked=\"checked\"";} ?> />
              Activo</td>
            </tr>
          <tr>
            <td><input type="radio" name="activo" value="0" <?php if (!(strcmp(htmlentities($row_Recordset1['activo'], ENT_COMPAT, 'utf-8'),0))) {echo "checked=\"checked\"";} ?> />
              Inactivo</td>
            </tr>
        </table>
      </div></td>
    </tr>
    <tr valign="baseline">
      <td nowrap="nowrap" align="right"><div align="left"></div></td>
      <td><div align="left">
        <input type="submit" value="Actualizar registro" />
      </div></td>
    </tr>
  </table>
  <input type="hidden" name="MM_update" value="form1" />
  <input type="hidden" name="id_usuarios" value="<?php echo $row_Recordset1['id_usuarios']; ?>" />
</form>
<p>&nbsp;</p>
<!-- InstanceEndEditable -->
</body>
<!-- InstanceEnd -->
</html>
<?php
mysqli_free_result($Recordset1);
mysqli_free_result($Recordset2);
?>