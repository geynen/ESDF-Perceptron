<?php
session_start();
if($_SESSION['Tipo']!=1) header("location: ../Inicio.php");
require("../header.php");
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>ESDF Logic Fuzzy</title>
<link href="../estilos/estilos.css" rel="stylesheet" type="text/css" />
</head>
<body class="body">
<div id="centralPanel">
	 <div class="centrarText">  
<table width="827" height="28" border="0" align="center">
  <tr>
    <td width="160">	
	<table width="160" border="0">
<tr>
    <td width="154" height="35" align="center">USUARIO</td>
</tr>
<tr>
   <td align="center"><img src="../foto/<?php echo $_SESSION['fot'];?>"  width="220" height="250"/>	  </td>
</tr>
<tr>
	<td align="center"><a href="mant_foto.php">Sube tu Foto </a></td>
</tr>
</table>

		</td>
    <td width="657">	</td>
  </tr>
</table>
    </div>
</div>
</body>
</html>
<?php
require("../footer.php");
?>