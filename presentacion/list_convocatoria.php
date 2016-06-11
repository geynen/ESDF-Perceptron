<?php
session_start();
//if($_SESSION['Tipo']!=1) header("location: ../Inicio.php");
?>
<?php
require("xajax_convocatoria.php");
require("headerNew.php");
$_SESSION['linkactivo']='CONVOCATORIAS';
require("menu.php");
?>
<div class="art-post-inner art-article">
<h2 class="art-postheader"><span class="art-postheadericon"></span>CONVOCATORIAS</h2>
<div class="art-postcontent" align="center">
<div>
<?php
$xajax->printJavascript();
?>
<script>
function listarconvocatorias(){
<?php $flistarconvocatorias->printScript(); ?>
}
</script>
<html>
<head>
<title>CONVOCATORIAS</title>
<link href="../estilos/estilos.css" rel="stylesheet" type="text/css">
</head>
<body onLoad="listarconvocatorias()" class="body">
<p>
<table width="770" border="0">
<tr>
<td width="764">
<form action="mant_convocatoria.php?accion=NUEVO&IdPerfil=<?php echo $_GET['IdPerfil'];?>" method="POST">
<input type="hidden" id="txtIdPerfil" name="txtIdPerfil" value="<?php echo $_GET['IdPerfil'];?>">
<fieldset>
<legend><strong>CRITERIOS DE BUSQUEDA :</strong></legend>
<table width="730" border="0" class="tablaint">
  <tr>
    <td width="104">DESCRIPCI&Oacute;N</td>
    <td width="146"><input name="txtDescripcion" type="text" id="txtDescripcion"></td>
    <td width="56" align="center"><input type="button" name="Submit" value="BUSCAR" onClick="listarconvocatorias()"></td>
    <?php if(isset($_GET['IdPerfil'])) {?><td width="56" align="center"><input type='submit' name = 'NUEVO' value = 'NUEVO'></td><?php }?>
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
	
	<div id="divconvocatorias">  </div>
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