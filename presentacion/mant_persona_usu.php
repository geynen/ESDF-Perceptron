<?php
session_start();
$_GET['accion']='ACTUALIZAR';
//if($_SESSION['Tipo']!=1) header("location: ../Inicio.php");
require("../datos/cado.php");

require('../xajax/xajax_core/xajax.inc.php');


$xajax= new xajax();
$xajax->configure('javascript URI','../xajax/');
//$xajax->configure('debug', true);//ver errores

//require("../datos/cado.php");

function verificaNroDoc($nro){
	require("../negocio/cls_persona.php");
	$oPersona = new clsPersona();
	$consulta = $oPersona->verificaNroDoc($nro);

	$Cadena="";
	if($consulta->rowCount()!=0){$Cadena=$Cadena."El N&uacute;mero de Documento ya existe";}
	$Cadena=utf8_encode($Cadena);
	$obj=new xajaxResponse();
    $obj->assign("LabelVerificaNroDoc","innerHTML",$Cadena);
	return $obj;
}

$xajax->registerFunction("verificaNroDoc");
$xajax->processRequest();
echo '<?xml version="1.0" encoding="UTF-8"?>';
require("headerNew.php");
$_SESSION['linkactivo']='MISDATOS';
require("menu.php");
?>
<div class="art-post-inner art-article">
<h2 class="art-postheader"><span class="art-postheadericon"></span>MANTENIMIENTO DE PERSONA</h2>
<div class="art-postcontent" align="center">
<div>
<html>
<head>
<link href="../css/estiloadmin.css" rel="stylesheet" type="text/css">
<title>MANTENIMIENTO DE PERSONA</title>

<!--calendario-->
<script src="../calendario/js/jscal2.js"></script>
    <script src="../calendario/js/lang/es.js"></script>
    <link rel="stylesheet" type="text/css" href="../calendario/css/jscal2.css" />
    <link rel="stylesheet" type="text/css" href="../calendario/css/reduce-spacing.css" />
    <link rel="stylesheet" type="text/css" href="../calendario/css/steel/steel.css" />
<!--calendario-->

<?php $xajax->printJavascript();?>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<script type="text/JavaScript">
<!--
function MM_jumpMenu(targ,selObj,restore){ //v3.0
  eval(targ+".location='"+selObj.options[selObj.selectedIndex].value+"'");
  if (restore) selObj.selectedIndex=0;
}
//-->
</script>
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



function check_form(formMantPersona) {
  if (submitted == true) {
    alert("Ya ha enviado el formulario. Pulse Aceptar y espere a que termine el proceso.");
    return false;
  }

  error = false;
  form = formMantPersona;
  error_message = "Hay errores en su formulario!\nPor favor, haga las siguientes correciones:\n\n";

  check_input("txtApellidosyNombres", 1, "La Persona debe tener un nombre");
  check_input("txtNroDoc", 1, "La Persona debe tener un documento");
/*  check_input("txtDireccion", 1, "La Persona debe tener direccion");
  check_input("txtCelular", 1, "La Persona debe tener celular");
  check_input("txtEmail", 1, "La Persona debe tener email");*/
  check_select ("cboArea", 0, "Debe seleccionar un Area");
  check_select ("cboSector", 0, "Debe seleccionar un Sector");
  check_select ("cboSexo", 0, "Debe seleccionar un Sexo");
  check_select ("cboZona", 0, "Debe seleccionar una Zona");
  check_select ("cboRol", 0, "Debe seleccionar un Rol");
  
  if (error == true) {
    alert(error_message);
    return false;
  } else {
    submitted = true;
    return true;
  }
}
//--></script>
<script>
function verificaNroDoc(nro,Accion)
{
	if(nro=="1111111111"){
		return true;
	}else
	{
		xajax_verificaNroDoc(nro);
		if(LabelVerificaNroDoc.innerHTML==""){ 
			return true;
		}else{
			if(Accion=='NUEVO'){
				alert("El N�mero de Documento ya existe");
				return false;
			} else{
				return true;
			}
		}
	}
}
</script>
<link href="../estilos/estilos.css" rel="stylesheet" type="text/css">
</head>
<!--<body onLoad="verDpto(14);VerProv(125);VerDist(409);">-->
<body>
<div id="centralPanel">
<div class="centrarText">
<form action=<?php echo '../negocio/cont_usuario.php?accion='.$_GET['accion'].'-USER'?> 
method='POST' onSubmit="if(verificaNroDoc(txtNroDoc.value,'<?php 
echo $_GET['accion'];?>')==false){return false;}else{ return check_form(formMantPersona);}" name="formMantPersona">
  <p>
  <input type='hidden' name = 'txtIdPersona' value = '<?php echo $_SESSION['Cod'];?>'>
  <?php
	require("../datos/cado.php");
	if($_GET['accion']=='ACTUALIZAR'){
	require("../negocio/cls_persona.php");
	
$objPersona = new clsPersona();
$rst = $objPersona->buscar($_SESSION['Cod'],'');
$dato = $rst->fetchObject();
}
?>
<table width="765" border="0">
  <tr>
    <td width="759">
	<fieldset> 
<legend> <strong> ACTUALIZAR DATOS PERSONALES</strong></legend>
<table width="732" align="center" class="tablaint">
<tr>
  <td align="right"> CODIGO :</td>
  <td colspan="3" align="left"><input type='text' name = 'txtCodigo' value = '<?php if($_GET['accion']=='ACTUALIZAR')
	echo $dato->codigo;?>' maxlength="10" size="10" style= "text-transform:uppercase"></td>
  </tr>
<tr>
	<td width="164" align="right"> NOMBRES :</td>
	<td colspan="3" align="left"><input type='text' name = 'txtNombres' value = '<?php 
	if($_GET['accion']=='ACTUALIZAR')
	echo $dato->nombres;?>' maxlength="50" size="25" style= "text-transform:uppercase"></td>
	</tr>
<tr>
	<td align="right">APELLIDO PATERNO :</td>
	<td width="186" align="left"><input type='text' name = 'txtApellidoPaterno' value = '<?php 
	if($_GET['accion']=='ACTUALIZAR')
	echo $dato->apellidopaterno;?>' maxlength="60" size="30s" style= "text-transform:uppercase"></td>
	<td width="172" align="right"> APELLIDO MATERNO :</td>
	<td width="190" align="left"><input type='text' name = 'txtApellidoMaterno' value = '<?php 
	if($_GET['accion']=='ACTUALIZAR')
	echo $dato->apellidomaterno;?>' maxlength="50" size="25" style= "text-transform:uppercase"></td>
</tr>
<tr>
	<td align="right"> N&ordm; DOCUMENTO : </td>
	<td align="left"><input type='text' name = 'txtNroDoc' value = '<?php
	if($_GET['accion']=='ACTUALIZAR') {
	echo $dato->nrodoc;} else { echo '11111111111';}?>' onKeyPress="if (event.keyCode < 45 || event.keyCode > 57) event.returnValue
	 = false;"onblur="verificaNroDoc(this.value);" size='11' maxlength='11' /></td>
	<td align="right"><div id="DivSexo1">SEXO : </div></td>
	<td align="left"><div id="DivSexo2"><select name="cboSexo">
	<?php
		if($_GET['accion']=="ACTUALIZAR" & $dato->Sexo=="F"){
			echo "<option selected='selected' value='F'>Femenino</option>
			<option value='M'>Masculino</option>";
        }
		else{
	        echo "<option selected='selected' value='M'>Masculino</option>
	  		<option id='F' value='F'>Femenino</option>";  
		  }
	?>
	 </select></div></td>
</tr>
<tr>
	<td align="right"> FECHA NACIMIENTO :</td>
	<td align="left"><input type='text' name = 'txtFechaNacimiento' value = '<?php 
	if($_GET['accion']=='ACTUALIZAR')
	echo $dato->fechanacimiento;?>'maxlength="10" size="10" style= "text-transform:uppercase">
    <button type="button" id="btnCalendar">...</button>
        <script type="text/javascript">//<![CDATA[
      var cal = Calendar.setup({
          onSelect: function(cal) { cal.hide() },
          showTime: false
      });
      cal.manageFields("btnCalendar", "txtFechaNacimiento", "%Y-%m-%d");
    //]]></script></td>
	<td align="right"> LUGAR NACIMIENTO :</td>
	<td align="left"><input type='text' name = 'txtLugarNacimiento' value = '<?php
	if($_GET['accion']=='ACTUALIZAR')
	echo $dato->lugarnacimiento;?>' maxlength="50" size="25" style= "text-transform:uppercase"></td>
</tr>
<tr>
	<td align="right"> DIRECCI&Oacute;N : </td>
	<td colspan="3" align="left"><input type='text' name = 'txtDireccion' value = '<?php if($_GET['accion']=='ACTUALIZAR')
	echo $dato->direccion;?>' maxlength="50" size="45" style= "text-transform:uppercase">	  <label id="LabelVerificaNroDoc" style="color: #003399"	
	 ></label></td>
	</tr>
<tr>
	<td align="right">ESTADO CIVIL : </td>
	<td colspan="3" align="left"><select id="cboEstadoCivil" name="cboEstadoCivil">
	<option value="S" <?php if($_GET['accion']=='ACTUALIZAR'){ if($dato->estadocivil=='S') echo 'selected';}?>>Soltero</option>
	<option value="C" <?php if($_GET['accion']=='ACTUALIZAR'){ if($dato->estadocivil=='C') echo 'selected';}?>>Casado</option>
	<option value="D" <?php if($_GET['accion']=='ACTUALIZAR'){ if($dato->estadocivil=='D') echo 'selected';}?>>Divorciado</option>
	<option value="V" <?php if($_GET['accion']=='ACTUALIZAR'){ if($dato->estadocivil=='V') echo 'selected';}?>>Viudo</option>
	</select></td>
	</tr>
<tr>
	<td align="right"> TEL&Eacute;FONO FIJO : </td>
	<td align="left"><input type='text' name = 'txtTelefonoFijo' value = '<?php 
	if($_GET['accion']=='ACTUALIZAR')
	echo $dato->telefonofijo;?>' maxlength="10" size="10" onKeyPress="if (event.keyCode < 45 || event.keyCode > 57) 
	event.returnValue = false;"></td>
	<td align="right"> TEL&Eacute;FONO MOVIL : </td>
	<td align="left"><input type='text' name = 'txtTelefonoMovil' value = '<?php 
	if($_GET['accion']=='ACTUALIZAR')
	echo $dato->celular;?>' maxlength="10" size="10" onKeyPress="if (event.keyCode < 45 || event.keyCode > 57) event.returnValue = 	
	false;">	</td>
</tr>
<tr>
	<td align="right"> EMAIL : </td>
	<td colspan="3" align="left"><input type='text' name = 'txtEmail' maxlength="50" size="45" value = '<?php 
	if($_GET['accion']=='ACTUALIZAR')
	echo $dato->email;?>'></td>
	</tr>
</table>
</fieldset>

	<fieldset> 
<legend align="left"> <strong> ACTUALIZAR DATOS DE CUENTA DE USUARIO</strong></legend>

<table width="716" border="0" align="center" class="tablaint">
<tr>
	<td align="left">USUARIO </td>
	<td align="left"><input type="text" name="txtUsuario" value="<?php if($_GET['accion']=='ACTUALIZAR')echo $dato->login;?>"></td>
</tr>
<tr>
	<td width="159" align="left"> CONTRASE&Ntilde;A </td>
	<td width="547" align="left"> <input type="password" name="txtClave"><br>Dejar en blanco sino desea cambiar</tr>
<tr>
  <th colspan="4"><input type='submit' name = 'grabar' value='GRABAR' />
    <input type='button' name = 'cancelar' value='CANCELAR' onClick="javascript:window.open('main.php','_self')" /></th>
</tr>
</table>
</fieldset>
	
	</td>
  </tr>
</table>




</form>
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