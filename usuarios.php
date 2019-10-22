<?php
	
require_once('Connections/conn.php');
//$id=$_SESSION['idus'];
?>
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

mysqli_select_db($conn,$database);
$query_Recordset1 = "SELECT id_usuarios,`user`, nombre, ult_ing FROM usuarios inner join tipo_usuario on tipo_usuario.id_tipouser= usuarios.id_tipouser WHERE activo = 1";
$Recordset1 = mysqli_query( $conn,$query_Recordset1) or die(mysqli_error($conn));
$row_Recordset1 = mysqli_fetch_assoc($Recordset1);
$totalRows_Recordset1 = mysqli_num_rows($Recordset1);
?>
<title>SKYSOFT</title>
<link href="estilo.css" rel="stylesheet" type="text/css">
<style type="text/css">
<!--
body {
	background-image: url(img/frutas.jpg);
	color: #FF0;
}
-->
</style></head>

<body>
<?php include('menu.php'); ?>
<p><br>
  <br>
<a href="add_user.php">&gt;&gt;&gt; AGREGAR USUARIO &lt;&lt;&lt;</a></p>
<p><br>
</p>
<table width="635" border="0" cellpadding="1" cellspacing="1">
  <tr class="letter">
    <td width="152" align="center" bgcolor="#00A9EC">Nombre de Usuario</td>
    <td width="248" align="center" bgcolor="#00A9EC">Nombres y Apellidos</td>
    <td width="174" align="center" bgcolor="#00A9EC">Ultimo ingreso</td>
    <td width="48" align="center" bgcolor="#00A9EC">Opci&oacute;n</td>
  </tr>
  <?php do { ?>
    <tr bgcolor="#CCCCCC"
 onmouseover="this.style.backgroundColor='#00CCFF';"
 onmouseout="this.style.backgroundColor='#CCCCCC';">
      <td><?php echo $row_Recordset1['user']; ?></td>
      <td><?php echo $row_Recordset1['nombre']; ?></td>
      <td><?php echo $row_Recordset1['ult_ing']; ?></td>
      <td align="center"><a href="edit_usuario.php?id_usuarios=<?php echo $row_Recordset1['id_usuarios']; ?>"><img src="img/edit.png" width="20" height="20" border="0"></td>
    </tr>
    <?php } while ($row_Recordset1 = mysqli_fetch_assoc($Recordset1)); ?>
</table>
</body>
</html>
<?php
mysqli_free_result($Recordset1);
?>
