<?php
include('Connections/conn.php');

$idventa=$_GET['idventa'];
$idfact=$_GET['idfact'];



$sql="update ventas set activo= 3 
where id_venta = $idventa";
mysql_query($sql);
header("location: devolucion.php?idfact=$idfact&ok=si");
//echo $sql;
?>