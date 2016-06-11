<?php
session_start();
//if($_SESSION['Tipo']!=1) header("location: ../Inicio.php");
require("xajax_perfil.php");
require("headerNew.php");
$_SESSION['linkactivo']='PERFILES';
require("menu.php");
?>
<div class="art-post-inner art-article">
<h2 class="art-postheader"><span class="art-postheadericon"></span>PERFILES</h2>
<div class="art-postcontent" align="center">
<div>
<?php
$xajax->printJavascript();
?>
<html>
<head>
<title>PERFILES</title>
<link href="../estilos/estilos.css" rel="stylesheet" type="text/css">
<script>
function inicio(){
<?php $flistarperfils->printScript(); ?>
}
function listarperfils(){
<?php $flistarperfils->printScript(); ?>
}
</script>

</head>
<body onLoad="inicio()">
<p>
<table width="770" border="0">
<tr>
<td width="764">
<form action="mant_perfil.php?accion=NUEVO" method="POST">
<fieldset>
<legend><strong>CRITERIOS DE BUSQUEDA :</strong></legend>
<table width="730" border="0" class="tablaint">
  <tr>
    <td width="104">NOMBRE</td>
    <td width="146"><input name="txtDescripcion" type="text" id="txtDescripcion"></td>
    <td width="72"><input type="button" name="Submit" value="BUSCAR" onClick="listarperfils()"></td>
    <td width="56"><input type='submit' name = 'NUEVO' value = 'NUEVO'></td>
  </tr>
</table>
<label></label>
</fieldset>
<!--<div id="centralPanel">-->
<div id="">
	<div class="centrarText">
<table width="640" border="0">
  <tr>
    <td width="634">
	
<fieldset>
    <legend><strong>RESULTADOS :</strong></legend>
	
	<div id="divperfils">  </div>
  	</fieldset>	
	</td>
  </tr>
</table>
	</div>
</div>
</form>


	</td>
  </tr>
</table>
</body>
</html>
</div>
</div>
<div class="cleared"></div>
</div>
<?php
require("footerNew.php");
?>