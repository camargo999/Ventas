<?php require_once('../Connections/inventarios.php'); ?>
<?php
mysql_select_db($database_inventarios, $inventarios);
$query_Recordset1 = "SELECT * FROM articulos";
$Recordset1 = mysql_query($query_Recordset1, $inventarios) or die(mysql_error());
$row_Recordset1 = mysql_fetch_assoc($Recordset1);
$totalRows_Recordset1 = mysql_num_rows($Recordset1);
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>SKYNET</title>

<link href="estilo.css" rel="stylesheet" type="text/css">

</head>

<body>
<?php include("menu.php"); ?>
<p>&nbsp;</p>
<p>&nbsp;</p>
<p>&nbsp;</p>
<p>&nbsp;</p>
<table width="353" border="1" cellspacing="2">
  <tr>
    <td width="143">CodigoProducto:</td>
    <td width="194"><form id="form2" name="form2" method="post" action="">
      <label>
        <input type="text" name="textfield" />
        </label>
    </form>
    </td>
  </tr>
</table>
<form id="form1" name="form1" method="post" action="">
  <label>
  <input type="submit" name="Submit" value="Buscar" />
  </label>
</form>
<p>&nbsp;</p>
<p>&nbsp;</p>
<p>&nbsp;</p>
<p>&nbsp;</p>
<p>&nbsp;</p>
</body>
</html>
<?php
mysql_free_result($Recordset1);
?>

