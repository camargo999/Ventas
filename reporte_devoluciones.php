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

mysql_select_db($database_conn, $conn);
$query_Recordset1 = "SELECT * FROM usuarios WHERE id_tipouser = 2";
$Recordset1 = mysql_query($query_Recordset1, $conn) or die(mysql_error());
$row_Recordset1 = mysql_fetch_assoc($Recordset1);
$totalRows_Recordset1 = mysql_num_rows($Recordset1);
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
<script type="text/javascript" src="calendar.js"></script>
    <script type="text/javascript" src="calendar-setup.js"></script>
    <script type="text/javascript" src="lang/calendar-en.js"></script>
     <style type="text/css"> 
    @import url("calendar-win2k-cold-1.css"); 
     </style>
<style type="text/css">
.letra_menu {
	color: #FFF;
}
</style>
<script src="SpryAssets/SpryValidationTextField.js" type="text/javascript"></script>
<script src="SpryAssets/SpryValidationSelect.js" type="text/javascript"></script>
<link href="SpryAssets/SpryValidationTextField.css" rel="stylesheet" type="text/css" />
<style type="text/css">
body,td,th {
	font-family: Verdana, Geneva, sans-serif;
}
</style>
<link href="SpryAssets/SpryValidationSelect.css" rel="stylesheet" type="text/css" />
<!-- InstanceEndEditable -->
</head>

<body>
<!-- InstanceBeginEditable name="EditRegion3" -->
<?php include('menu.php'); ?>
<p>
  <?php
$report=$_GET['report'];
?>
  <br />
  <br />
</p>
<p>&nbsp;</p>
<p>&nbsp;</p>
<p>Reporte de Devoluciones
  <br />
  <br />
</p>
<form action="reporte_devoluciones2.php" method="get">
<table width="481" border="0" class="tabla">
  <tr>
    <td width="100">Fecha Desde</td>
    <td width="151" align="left"><span id="sprytextfield1">
    <label for="fecha"></label>
    <input type="text" name="fecha" id="cal-field-2"/>
     <script type="text/javascript">
            Calendar.setup({
              inputField    : "cal-field-2",
              button        : "cal-button-2"
            });
                  </script>
    <span class="textfieldRequiredMsg">Se necesita un valor.</span></span></td>
    <td width="55" align="right">de:</td>
    <td width="157" align="left"><span id="spryselect1">
      <label for="cajero"></label>
      <select name="cajero" id="cajero">
        <option value="">--Seleccionar--</option>
        <?php
do {  
?>
        <option value="<?php echo $row_Recordset1['id_usuarios']?>"><?php echo $row_Recordset1['nombre']?></option>
        <?php
} while ($row_Recordset1 = mysql_fetch_assoc($Recordset1));
  $rows = mysql_num_rows($Recordset1);
  if($rows > 0) {
      mysql_data_seek($Recordset1, 0);
	  $row_Recordset1 = mysql_fetch_assoc($Recordset1);
  }
?>
      </select>
      <span class="selectRequiredMsg">Seleccione un elemento.</span></span></td>
  </tr>
  <tr>
    <td colspan="4" align="center"><input type="submit" name="button" id="button" value="Generar Reporte" /></td>
  </tr>
</table>
</form>
<script type="text/javascript">
var sprytextfield1 = new Spry.Widget.ValidationTextField("sprytextfield1", "none", {validateOn:["blur"]});
var spryselect1 = new Spry.Widget.ValidationSelect("spryselect1");
</script>
<!-- InstanceEndEditable -->
</body>
<!-- InstanceEnd --></html>
<?php
mysql_free_result($Recordset1);
?>
