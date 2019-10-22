<?php
	session_start();
	if (!isset($_SESSION['idus'])) 
	{ 
header("location: index.php");
    } 
require_once('Connections/conn.php');
$id=$_SESSION['idus'];

?>
<?php require_once('Connections/conn.php'); ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<!-- TemplateBeginEditable name="doctitle" -->
<title>SKYNET</title>
<!-- TemplateEndEditable -->
<link href="../estilo.css" rel="stylesheet" type="text/css">
<!-- TemplateBeginEditable name="head" -->
<style type="text/css">
.letra_menu {
	color: #FFF;
}

</style>
<!-- TemplateEndEditable -->
</head>

<body>
<!-- TemplateBeginEditable name="EditRegion3" -->
<?php include('menu.php'); ?>

<!-- TemplateEndEditable -->
</body>
</html>

