<?php
session_start();
//if($_SESSION['Tipo']!=1) header("location: ../Inicio.php");
?>
<?php
require("xajax_entrada.php");
require("headerNew.php");
$_SESSION['linkactivo']='CONVOCATORIAS';
require("menu.php");
?>
<div class="art-post-inner art-article">
<h2 class="art-postheader"><span class="art-postheadericon"></span>ENTRADAS</h2>
<div class="art-postcontent" align="center">
<div>
<?php
$xajax->printJavascript();
?>
<script>
function inicio(){
<?php $flistarentradas->printScript(); ?>
}
function listarentradas(){
<?php $flistarentradas->printScript(); ?>
}
</script>
<html>
<head>
<link href="../css/estiloadmin.css" rel="stylesheet" type="text/css">
<title>ENTRADAS</title>
<link href="../estilos/estilos.css" rel="stylesheet" type="text/css">
</head>
<body onLoad="inicio()" class="body">
<p>
<table width="770" border="0">
<tr>
<td width="764">
<form action="mant_entrada.php?accion=NUEVO&IdPerfil=<?php echo $_GET['IdPerfil'];?>&IdRubro=<?php echo $_GET['IdRubro'];?>" method="POST">
<input type="hidden" id="txtIdPerfil" name="txtIdPerfil" value="<?php echo $_GET['IdPerfil'];?>">
<input type="hidden" id="txtIdRubro" name="txtIdRubro" value="<?php echo $_GET['IdRubro'];?>">
<fieldset>
<legend><strong>CRITERIOS DE BUSQUEDA :</strong></legend>
<table width="730" border="0" class="tablaint">
  <tr>
    <td width="104">DESCRIPCI&Oacute;N</td>
    <td width="146"><input name="txtDescripcion" type="text" id="txtDescripcion"></td>
    <td width="72"><input type="button" name="Submit" value="BUSCAR" onClick="listarentradas()"></td>
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
	
	<div id="diventradas">  </div>
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