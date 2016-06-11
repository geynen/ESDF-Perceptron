<?php
session_start();
if($_SESSION['Tipo']!=2) header("location: ../Inicio.php");
require("../datos/cado.php");
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>ESDF Logic Fuzzy</title>
<script type="text/javascript" src="../estilos/json.js"></script>
<script type="text/javascript" src="../estilos/motorAjax.js"></script>
<script type="text/javascript" src="../estilos/funcionesJSmin.js"></script>
<link rel="stylesheet" href="../estilos/hojaEstilos.css" media="all"/>
</head>
<body>
<table width="925" border="0">
  <tr>
    <td width="158">
	<img src="../Imagenes/logo.JPG" width="158" height="98" /></td>
    <td width="605">
	<div id="headerPanel">
	    <h1 class="centrarText">ESDF Logic Fuzzy</h1>
		<h2 class="centrarText">Framework de Desarrollo de Sistemas Expertos - L&oacute;gica Difusa</h2>

	<ul id="navSite">
    <li><a href="main_usuario.php">INICIO</a></li>
  	<li><a href="mant_persona_usu.php">MIS DATOS </a>	</li>
	<li><a href='../salir.php'>  SALIR</a></li>
  	</ul>	
  </td>
    <td width="148">
	
	 <?php "<b>Codigo:</b><font color='blue'> ".$_SESSION['Id']."</font> " ;?>
	<fieldset>
				<?php echo " <b>Bienvenido:</b><font color='blue'> ".$_SESSION['Nombre']."</font> ";?> 
	</fieldset>
	<fieldset>
            <?php echo " <b>Perfil:</b><font color='blue'> ".$_SESSION['Perfil']." Postulante</font> ";?> <br />
	</fieldset>
          
            </label>	
            
  </tr>
</table>	