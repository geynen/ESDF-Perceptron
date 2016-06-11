<?php
session_start();
//if($_SESSION['Tipo']!=1) header("location: ../Inicio.php");

?>
<?php
require("../datos/cado.php");
//require_once("../negocio/cls_persona.php");
require("xajax_persona.php");
require("headerNew.php");
$_SESSION['linkactivo']='CONVOCATORIAS';
require("menu.php");
?>
<div class="art-post-inner art-article">
<h2 class="art-postheader"><span class="art-postheadericon"></span>LISTADO DE POSTULANTES</h2>
<div class="art-postcontent" align="center">
<div>
<?php
$xajax->printJavascript();
?>
<script>
function listadopersonas(){
divParametros.style.display="";
divlistapersona.style.display="";
<?php $flistadopersonatest->printScript(); ?>
}
</script>
<html>
<head>
<title>LISTADO DE POSTULANTES</title>
<link href="../estilos/estilos.css" rel="stylesheet" type="text/css">
<script type="text/javascript" src="../js/autocompletar.js"></script> 
<!--AUTOCOMPLETAR: LOS ESTILOS SIGUIENTES SON PARA CAMBIAR EL EFECTO AL MOMENTO DE NAVEGAR POR LA LISTA DEL AUTOCOMPLETAR-->
<style type="text/css">    
		.autocompletar tr:hover, .autocompletar .tr_hover {cursor:default; text-decoration:none; background-color:#999;}
		.autocompletar tr span {text-decoration:none; color:#99CCFF; font-weight:bold; }
		.autocompletar {border:1px solid rgb(0, 0, 0); background-color:rgb(255, 255, 255); position:absolute; overflow:hidden; }
    </style>  
<!--AUTOCOMPLETAR--> 
<script language="javascript">
<!--LAS SIGUIENTES FUNCIONES LAS USO PARA LLAMAR AL XAJAX Y A LAS FUNCIONES DEL AUTOCOMPLETAR-->
function buscarPersona(e){
  if(!e) e = window.event; 
    var keyc = e.keyCode || e.which;     
    if(keyc == 38 || keyc == 40 || keyc == 13) {
        autocompletar_teclado('divregistrosPersona', 'tablaPersona', keyc);        
	}else{
		//si presiona retroceso o suprimir
		if(keyc == 8 || keyc == 46) {
			form1.txtIdPersona.value="";
		}
		<?php $flistadopersonaautocomplete->printScript() ?>;
		divregistrosPersona.style.display="";
		window.setTimeout('divregistrosPersona.style.display="";', 300);
  }
}
function mostrarPersona(id){
   xajax_mostrarPersona(id);
   divregistrosPersona.style.display="none";
}
<!--LAS SIGUIENTES FUNCIONES LAS USO PARA LLAMAR AL XAJAX Y A LAS FUNCIONES DEL AUTOCOMPLETAR-->
function agregarPostulante(id){
	if(confirm("Seguro que desea agregar un nuevo postulante?")){
		<?php $fagregarPostulante->printScript() ?>;
		fielpostulante.style.display="none";
	}
}
</script>
</head>
<body onLoad="listadopersonas()">
<table width="200" border="0">
  <tr>
    <td>
		<div id='divParametros'>
<fieldset>
<legend align="left"><strong>CRITERIOS DE BUSQUEDA :</strong></legend>
  <input type='hidden' name = 'txtIdConvocatoria' id="txtIdConvocatoria" value = '<?php echo $_GET['IdConvocatoria']?>'>
  <input type='hidden' name = 'txtIdPerfil' value = '<?php echo $_GET['IdPerfil']?>'>
<table width="670" border="0">
  <tr>
    <td width="335" align="left">APELLIDOS Y NOMBRES :</td>
    <td width="159"> <input name="txtApellidosyNombres" type="text" id="txtApellidosyNombres" style="text-transform:uppercase">
	</td>
	<td width="64"><input name = 'BUSCAR' type='button' id="BUSCAR" value = 'BUSCAR' onClick="listadopersonas()"> </td>
    <td width="64"><input name = 'NUEVO' type='button' id="NUEVO" value = 'NUEVO' onClick="javascript: fielpostulante.style.display='';frasePersona.value='';txtIdPersona.value='';frasePersona.focus();"> </td>
  </tr>
</table>

</fieldset>
</div>
	
	</td>
  </tr>
<tr><td>
<fieldset id="fielpostulante" style="display:none"> 
<legend> <strong>REGISTRAR POSTULANTE :</strong></legend>

<table width="425" class="tablaint">
<td>
<b>Persona:</b></td><td>
<div id='divBuscarPersona' style="overflow:auto;">
<!--CAMPOS OCULTOS PARA EL MANEJO DE LA PAGINACION-->
<input type="hidden" name="pagPersona" id="pagPersona" value="1">
<input type="hidden" name="TotalRegPersona" id="TotalRegPersona">
<table>
<tr><td><!--Por:--></td> 
<td>
  <select name="campoPersona" id="campoPersona" onChange="javascript:pagPersona.value=1;buscarPersona(event)" style="display:none">
    <option value="concat(apellidopaterno,' ',apellidomaterno,' ',nombres)">Apellidos y Nombres</option>
	<option value="nrodoc">Nro Doc.</option>
  </select>
</td></tr>
<tr><td><input type="text" id="txtIdPersona" name="txtIdPersona" readonly="readonly" size="3" value=""  style="background-color:#CCCCCC"/>
</td>
<td>
  <input name="frasePersona" id="frasePersona" onBlur="autocompletar_blur('divregistrosPersona')" onKeyUp="javascript:pagPersona.value=1;buscarPersona(event)" value="" style="width:230px"><br>
<div id="divregistrosPersona" class="autocompletar"  style="display:none"></div>
</td></tr></table>
</div>
</td></tr>
<tr>
<th colspan="2"><input type="button" name = 'grabar' value='GRABAR' onClick="agregarPostulante()"> <input type='button' name = 'cancelar' value='CANCELAR' onClick="javascript: fielpostulante.style.display='none';"></th>
</tr>
</table></fieldset>
</td></tr>
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

</body>
</html>
</div>
</div>
<div class="cleared"></div>
</div>
<?php
require("footerNew.php");
?>