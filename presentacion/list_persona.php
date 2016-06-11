<?php
session_start();
if($_SESSION['Tipo']!=1) header("location: ../Inicio.php");

?>
<?php
require("../datos/cado.php");
//require_once("../negocio/cls_persona.php");
require("xajax_persona.php");
require("headerNew.php");
$_SESSION['linkactivo']='PERSONA';
require("menu.php");
?>
<div class="art-post-inner art-article">
<h2 class="art-postheader"><span class="art-postheadericon"></span>LISTADO DE PERSONAS</h2>
<div class="art-postcontent" align="center">
<div>
<?php
$xajax->printJavascript();
?>
<html>
<head>
<title>LISTADO DE PERSONAS</title>
<link href="../estilos/estilos.css" rel="stylesheet" type="text/css">
<script>
function listadopersonas(){
divParametros.style.display="";
divlistapersona.style.display="";
<?php $flistadopersona->printScript(); ?>
}
</script>
</head>
<body onLoad="listadopersonas()">

<form id="form1" name="form1" method="post" action="mant_persona.php?accion=NUEVO">
<table width="200" border="0">
  <tr>
    <td>
		<div id='divParametros'>
<fieldset>
<legend align="left"><strong>CRITERIOS DE BUSQUEDA :</strong></legend>
<table width="670" border="0" class="tablaint">
  <tr>
    <td width="335" align="left">APELLIDOS Y NOMBRES :</td>
    <td width="159"> <input name="txtApellidosyNombres" type="text" id="txtApellidosyNombres" style="text-transform:uppercase">
	</td>
	<td width="64"><input name = 'BUSCAR' type='button' id="BUSCAR" value = 'BUSCAR' onClick="listadopersonas()"> </td>
	<td width="94"> <input type='submit' name = 'NUEVO2' value = 'NUEVO'></td>
  </tr>
</table>

</fieldset>
</div>
	
	</td>
  </tr>
</table>

<table width="848" border="0">
  <tr>
    <td width="842">
	<div class="centrarText">
	<div id="divlistapersona">
<div id="centralPanel">
<fieldset>
<legend align="left"><strong>LISTA :</strong></legend>
<div id="divReporte"> </div>
</fieldset>
	</div>
</div>
 </div>



	</td>
  </tr>
</table>

</form>
</body>
</html>
</div>
</div>
<div class="cleared"></div>
</div>
<?php
require("footerNew.php");
?>