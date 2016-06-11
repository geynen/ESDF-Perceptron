<?php
session_start();
//if($_SESSION['Tipo']!=1) header("location: ../Inicio.php");
require("headerNew.php");
$_SESSION['linkactivo']='CONVOCATORIAS';
require("menu.php");
?>
<div class="art-post-inner art-article">
<h2 class="art-postheader"><span class="art-postheadericon"></span>RUBRO</h2>
<div class="art-postcontent" align="center">
<div>
<html>
<head>
<link href="../css/estiloadmin.css" rel="stylesheet" type="text/css">
<title>RUBRO</title>
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
  form = formMantRubro;
  error_message = "Hay errores en su formulario!\nPor favor, haga las siguientes correciones:\n\n";

  check_input("txtDescripcion", 1, "La rubro debe tener una descripción");
  
  if (error == true) {
    alert(error_message);
    return false;
  } else {
    submitted = true;
    return true;
  }
}
//--></script>
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
	<form action=<?php echo '../negocio/cont_rubro.php?accion='.$_GET['accion']?> method='POST' onSubmit="return check_form(formMantRubro);" name="formMantRubro">
  <input type='hidden' name = 'txtIdRubro' value = '<?php if($_GET['accion']=='ACTUALIZAR') echo $_GET['IdRubro'];?>'>
  <input type="hidden" id="txtIdPerfil" name="txtIdPerfil" value="<?php echo $_GET['IdPerfil'];?>">
  <?php
require("../datos/cado.php");
if($_GET['accion']=='ACTUALIZAR'){
require("../negocio/cls_rubro.php");
$objRubro = new clsRubro();
$rst = $objRubro->buscar($_GET['IdRubro']);
$dato = $rst->fetchObject();
}?>
<fieldset> 
<legend align="left"> <strong> REGISTRO DE RUBRO </strong></legend>
<table width="515" border="0" class="tablaint">
<tr>
	<td width="173"> DESCRIPCI&Oacute;N </td>
	<td width="332" align="left"><input type='text'id='txtDescripcion'name='txtDescripcion' 
	value = '<?php if($_GET['accion']=='ACTUALIZAR') echo $dato->descripcion;?>' style="text-transform:uppercase" maxlength="50" size="50"></td>
</tr>
<tr> 
	<td>PUNTAJE</td>
	<td align="left"><input type='text'id='txtPuntaje'name='txtPuntaje' 
	value = '<?php if($_GET['accion']=='ACTUALIZAR') echo $dato->puntaje;?>' maxlength="10" size="10">	
	</td>
</tr>
<tr> 
	<td>TIPO DE SELECCI&Oacute;N</td>
	<td align="left">
    <select id="cboTipo" name="cboTipo">
    <option value="U" <?php if($_GET['accion']=='ACTUALIZAR' and $dato->tipo=='U') echo 'selected';?>>&Uacute;NICA</option>
    <option value="M" <?php if($_GET['accion']=='ACTUALIZAR' and $dato->tipo=='M') echo 'selected';?>>MULTIPLE</option>
    </select>
	</td>
</tr>
<tr>
  <th colspan="2">
    <input type='submit' name = 'grabar' value='GRABAR'> 
    <input type='button' name = 'cancelar' value='CANCELAR' onClick="javascript:window.open('list_rubro.php?IdPerfil=<?php echo $_GET['IdPerfil'];?>','_self')"> </th>
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