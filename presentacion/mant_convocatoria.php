<?php
session_start();
//if($_SESSION['Tipo']!=1) header("location: ../Inicio.php");
require("headerNew.php");
$_SESSION['linkactivo']='CONVOCATORIAS';
require("menu.php");
?>
<div class="art-post-inner art-article">
<h2 class="art-postheader"><span class="art-postheadericon"></span>CONVOCATORIA</h2>
<div class="art-postcontent" align="center">
<div>
<html>
<head>
<link href="../css/estiloadmin.css" rel="stylesheet" type="text/css">
<title>CONVOCATORIA</title>
<script language="javascript"><!--
var form = "";
var submitted = false;
var error = false;
var error_message = "";

function check_input(field_name, field_size, message) {
  if (form.elements[field_name] && (form.elements[field_name].type != "hidden")) {
    var field_value = form.elements[field_name].value;

    if (field_value.length < field_size) {
      error_message = error_message + "* " + message + "\n";
      error = true;
    }
  }
}

function check_select(field_name, field_default, message) {
  if (form.elements[field_name] && (form.elements[field_name].type != "hidden")) {
    var field_value = form.elements[field_name].value;

    if (field_value == field_default) {
      error_message = error_message + "* " + message + "\n";
      error = true;
    }
  }
}

function check_form(form_name) {
  if (submitted == true) {
    alert("Ya ha enviado el formulario. Pulse Aceptar y espere a que termine el proceso.");
    return false;
  }

  error = false;
  form = formMantConvocatoria;
  error_message = "Hay errores en su formulario!\nPor favor, haga las siguientes correciones:\n\n";

  check_input("txtDescripcion", 1, "La convocatoria debe tener una descripción");
  
  if (error == true) {
    alert(error_message);
    return false;
  } else {
    submitted = true;
    return true;
  }
}
//--></script>
<!--calendario-->
<script src="../calendario/js/jscal2.js"></script>
    <script src="../calendario/js/lang/es.js"></script>
    <link rel="stylesheet" type="text/css" href="../calendario/css/jscal2.css" />
    <link rel="stylesheet" type="text/css" href="../calendario/css/reduce-spacing.css" />
    <link rel="stylesheet" type="text/css" href="../calendario/css/steel/steel.css" />
    <link rel="stylesheet" type="text/css" href="../calendario/css/border-radius.css" />
<!--calendario-->
<link href="../estilos/estilos.css" rel="stylesheet" type="text/css">
</head>
<body>
</p>
</p>
<div id="centralPanel">
	<div class="centrarText">
<table width="529" border="0">
  <tr>
    <td width="523">
	<form action=<?php echo '../negocio/cont_convocatoria.php?accion='.$_GET['accion']?> method='POST' onSubmit="return check_form(formMantConvocatoria);" name="formMantConvocatoria">
  <input type='hidden' name = 'txtIdConvocatoria' value = '<?php if($_GET['accion']=='ACTUALIZAR') echo $_GET['IdConvocatoria'];?>'>
  <input type="hidden" id="txtIdPerfil" name="txtIdPerfil" value="<?php echo $_GET['IdPerfil'];?>">
  <?php
require("../datos/cado.php");
if($_GET['accion']=='ACTUALIZAR'){
require("../negocio/cls_convocatoria.php");
$objConvocatoria = new clsConvocatoria();
$rst = $objConvocatoria->buscar($_GET['IdConvocatoria']);
$dato = $rst->fetchObject();
}?>
<fieldset> 
<legend align="left"> <strong> REGISTRO DE CONVOCATORIA </strong></legend>
<table width="515" border="0" class="tablaint">
<tr>
	<td width="173"> NOMBRE </td>
	<td width="332" align="left"><input type='text'id='txtNombre'name='txtNombre' 
	value = '<?php if($_GET['accion']=='ACTUALIZAR') echo $dato->nombre;?>' style="text-transform:uppercase" maxlength="50" size="50"></td>
</tr>
<tr> 
	<td>FECHA INICIO</td>
	<td align="left"><input type='text' name = 'txtFechaInicio' id = 'txtFechaInicio' value = '<?php 
	if($_GET['accion']=='ACTUALIZAR')
	echo $dato->fechainicio;?>'maxlength="10" size="10" style= "text-transform:uppercase">
    <button type="button" id="btnCalendar" name="btnCalendar">...</button>
        <script type="text/javascript">//<![CDATA[
      var cal = Calendar.setup({
          onSelect: function(cal) { cal.hide() },
          showTime: false
      });
      cal.manageFields("btnCalendar", "txtFechaInicio", "%Y-%m-%d");
    //]]></script>
	</td>
</tr>
<tr> 
	<td>FECHA FIN</td>
	<td align="left"><input type='text' name = 'txtFechaFin' id = 'txtFechaFin' value = '<?php 
	if($_GET['accion']=='ACTUALIZAR')
	echo $dato->fechainicio;?>'maxlength="10" size="10" style= "text-transform:uppercase">
    <button type="button" id="btnCalendar2" name="btnCalendar2">...</button>
        <script type="text/javascript">//<![CDATA[
      var cal = Calendar.setup({
          onSelect: function(cal) { cal.hide() },
          showTime: false
      });
      cal.manageFields("btnCalendar2", "txtFechaFin", "%Y-%m-%d");
    //]]></script>
	</td>
</tr>
<tr>
  <th colspan="2">
    <input type='submit' name = 'grabar' value='GRABAR'> 
    <input type='button' name = 'cancelar' value='CANCELAR' onClick="javascript:window.open('list_convocatoria.php?IdPerfil=<?php echo $_GET['IdPerfil'];?>','_self')"> </th>
</tr>
</table>
</fieldset>
</form>
	</td>
  </tr>
</table>
	</div>
</div>
</body>
</html>
</div>
</div>
<div class="cleared"></div>
</div>
<?php
require("footerNew.php");
?>