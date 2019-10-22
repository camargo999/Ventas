<?php
include('Connections/conn.php');

$idventa=$_GET['idventa'];
$idfact=$_GET['idfact'];



$sql="update ventas set activo= 0 
where id_venta = $idventa";
mysqli_query($sql);
header("location: articulos_fact.php?idfact=$idfact&ok=si");
echo $sql;
?>