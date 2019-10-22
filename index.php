<?php require_once('Connections/conn.php'); ?>
<?php
// *** Validate request to login to this site.
//globals:$conn;

$hostname = "localhost"; 
  $username = "root"; 
  $password = ""; 
  $database = "skynet";
  $conn = mysqli_connect($hostname, $username, $password, $database);


$loginFormAction = $_SERVER['PHP_SELF'];
if (isset($_GET['accesscheck'])) {
  $_SESSION['PrevUrl'] = $_GET['accesscheck'];
}

if (isset($_POST['usuario'])) {
  $loginUsername=$_POST['usuario'];
  $password=$_POST['clave'];
  $MM_fldUserAuthorization = "";
  $MM_redirectLoginSuccess = "inicio.php";
  $MM_redirectLoginFailed = "index.php";
  $MM_redirecttoReferrer = false;

  //$conn;
   #mysqli_select_db($database_conn, $conn);
  
  $LoginRS__query="SELECT user, clave FROM usuarios WHERE user='$loginUsername' AND clave='$password' AND  id_tipouser=1";
  //get_magic_quotes_gpc() ? $loginUsername : addslashes($loginUsername), get_magic_quotes_gpc() ? $password : addslashes($password)); 
  $LoginRS = mysqli_query($conn,$LoginRS__query) or die(mysqli_error());
  $loginFoundUser = mysqli_num_rows($LoginRS);
  if ($loginFoundUser) {
     $loginStrGroup = "";
    
    //declare two session variables and assign them
    $_SESSION['MM_Username'] = $loginUsername;
    $_SESSION['MM_UserGroup'] = $loginStrGroup;	      

    if (isset($_SESSION['PrevUrl']) && false) {
      $MM_redirectLoginSuccess = $_SESSION['PrevUrl'];	
    }
    header("Location: " . $MM_redirectLoginSuccess );
  }
  else {
    header("Location: ". $MM_redirectLoginFailed );
  }
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<!-- DW6 -->
<head>
<link href="SpryAssets/SpryMenuBarHorizontal.css" rel="stylesheet" type="text/css" />
    <style>
    .letter {
  font-family: 'Tangerine', serif;
  font-size: 48px;
  text-shadow: 4px 4px 4px #aaa;
}
    .small {
	font-size: xx-small;
	color: #000000;
}
    .fondo {
	color: #000000;
}
    .fondo {
	color: #88BE4C;
}
    </style>
<title>SKYSOFT</title>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link href="SpryAssets/SpryValidationTextField.css" rel="stylesheet" type="text/css" />
<link href="SpryAssets/SpryValidationPassword.css" rel="stylesheet" type="text/css" />
<script src="SpryAssets/SpryValidationTextField.js" type="text/javascript"></script>
<script src="SpryAssets/SpryValidationPassword.js" type="text/javascript"></script>
<link href="estilo.css" rel="stylesheet" type="text/css" />
<style type="text/css">
<!--
body {
	
	background-repeat: no-repeat;
	background-color: #777777;
}
.Estilo6 {
	color: #01000c;
	font-family: Georgia, "Times New Roman", Times, serif;
	font-weight: bold;
	font-style: italic;
}
.Estilo8 {color: #FFFFFF; font-size: 36px; }
.Estilo9 {color: #01000c}
.Estilo10 {
  color: #01000c; 
	font-family: Georgia, "Times New Roman", Times, serif;
	font-weight: bold;
	/*font-style: italic;*/
  /*este codigo anterior pone las letras tipo CURSIVA*/
}
.Estilo11{
    text-decoration: none;
    padding: 10px;
    font-weight: 600;
    font-size: 20px;
    color: #ffffff;
    background-color: #1883ba;
    border-radius: 6px;
    border: 2px solid #0016b0;
  }
  .Estilo11:hover{
    color: #141313;
    background-color: #edf28c;
  }
  .hola{
    text-decoration: none;
    padding: 10px;
    font-weight: 100;
    font-size: 20px;
    color: #ffffff;
    background-color: #1883ba;
    border-radius: 6px;
    border: 2px solid #0016b0;
    height: 500px
    width:250;
  }
  .hola:hover{
    color: #141313;
    background-color: #edf28c;
  }
  /*PARA LAS ESQUINAS REDONDEADAS DE CAJA DE TEXTO*/
 /* .tb5 {. tb5 {
  borde: 2px sólido # 456879;borde : 2px sólido # 456879 ;
  radio del borde: 10px;radio del borde : 10px ;
  altura: 22px;altura : 22px ; 
  ancho: 230px;ancho : 230px ; 
}}*/
-->
</style></head>
<body class="fondo">
<div align="center">
<p class="letter"></p>
<p class="ses"></p>
<H2 Style="text-align:center">BIENVENIDOS</H2>
<p class="ses"><img src="img/atomo.png" width="270" height="270" /><br />
</p>
<H2 Style="text-align:center">SOFTWARE DE INVENTARIO</H2>
<div align="center">
  <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="POST">
<table width="460" height="251" border="0" align="center" cellpadding="1" cellspacing="1">
    <tr>
      <td width="84"><div align="left" class="Estilo10"><H4 Style="text-align:center ">&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbspUSUARIO:</H4></div></td>
      <td width="210" align="left" bordercolor="#7300FF"> 
        <label for="usuario"></label>
        <span class="textfieldRequiredMsg">*</span><span id="sprytextfield2">
        <label for="usuario2"></label>
        <span class="textfieldRequiredMsg">*</span><span  id="sprytextfield2">
        <input maxlength="15" type="text" name="usuario" class=".hola"  id="usuario2" />
        </span></span></td>
    </tr>
    <tr>
      <td><div align="left"><span class="Estilo10"><H4 Style="text-align:center ">&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbspCONTRASEÑA:</H4></div></td>
      <td align="left">
        <label for="clave"></label>
        <span class="passwordRequiredMsg">*</span><span id="sprypassword2">
        <label for="clave2"></label>
        <input maxlength="15" type="password" name="clave" id="clave2" />
        <span class="passwordRequiredMsg">*	</span></span></td>
    </tr>
    <tr>
      <td><div align="left"></div></td><td align="center"><div align="left">&nbsp&nbsp
        <input type="submit" name="button" class="Estilo11" id="button" value="INGRESAR" />
      </div><span/td>
    </tr>
  </table>
</form>
</div>
<p></p>
<p></p>
<p></p>
<p></p>
<p></p>
<p></p>
<p><br/><br/></p>
<span class="Estilo9"> TEG. ROBINSON SOLANO 3112945754</span>
<span class="Estilo9">
<script type="text/javascript">
var sprytextfield2 = new Spry.Widget.ValidationTextField("sprytextfield2");
var sprypassword2 = new Spry.Widget.ValidationPassword("sprypassword2");
</script>
</span>
</body>
</html>
