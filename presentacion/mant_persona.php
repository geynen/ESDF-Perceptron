<?php
session_start();
//if($_SESSION['Tipo']!=1) header("location: ../Inicio.php");
require("../datos/cado.php");

require('../xajax/xajax_core/xajax.inc.php');

$xajax= new xajax();
$xajax->configure('javascript URI','../xajax/');
//$xajax->configure('debug', true);//ver errores

//require("../datos/cado.php");

function verificaNroDoc($nro){
	require("../negocio/cls_persona.php");
	$opersona = new clsPersona();
	$consulta = $opersona->verificaNroDoc($nro);

	$Cadena="";
	if($consulta->rowCount()!=0){$Cadena=$Cadena."El N&uacute;mero de Documento ya existe";}
	$Cadena=utf8_encode($Cadena);
	$obj=new xajaxResponse();
    $obj->assign("LabelVerificaNroDoc","innerHTML",$Cadena);
	return $obj;
}

$xajax->registerFunction("verificaNroDoc");

function verificaUsuario($nombreusuario){
	require("../negocio/cls_usuario.php");
	$oUsuario = new clsUsuario();
	$consulta = $oUsuario->verificaExisteUsuario($nombreusuario);

	$Cadena="";
	if($consulta->rowCount()!=0){$Cadena=$Cadena."El nombre de Usuario ya existe";}
	$Cadena=utf8_encode($Cadena);
	$obj=new xajaxResponse();
    $obj->assign("LabelVerificaUsuario","innerHTML",$Cadena);
	return $obj;
}

$xajax->registerFunction("verificaUsuario");
$xajax->processRequest();
echo '<?xml version="1.0" encoding="UTF-8"?>';
require("headerNew.php");
$_SESSION['linkactivo']='PERSONA';
require("menu.php");
?>
<div class="art-post-inner art-article">
<h2 class="art-postheader"><span class="art-postheadericon"></span>MANTENIMIENTO DE PERSONAS</h2>
<div class="art-postcontent" align="center">
<div>
<html>
<head>
<link href="../css/estiloadmin.css" rel="stylesheet" type="text/css">
<title>MANTENIMIENTO DE PERSONA</title>
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

  check_input("txtCodigo", 1, "La Persona debe tener un codigo");
  check_input("txtNombres", 1, "La Persona debe tener un nombre");
  check_input("txtApellidoPaterno", 1, "La Persona debe tener un apellido paterno");
  check_input("txtApellidoMaterno", 1, "La Persona debe tener un apellido materno");
  check_input("txtNroDoc", 1, "La Persona debe tener un numero documento");
  check_input("txtFechaNacimiento", 1, "La Persona debe tener una fecha de nacimiento");
/*  check_input("txtDireccion", 1, "La Persona debe tener direccion");
  check_input("txtCelular", 1, "La Persona debe tener celular");
  check_input("txtEmail", 1, "La Persona debe tener email");*/
  check_select ("cboSexo", 0, "Debe seleccionar un Sexo");
  
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
				alert("El Numero de Documento ya existe");
				return false;
			} else{
				return true;
			}
		}
	}
}
function verificaUsuario(nombreusuario,Accion)
{
	if(nombreusuario==""){
		return true;
	}else
	{
		xajax_verificaUsuario(nombreusuario);
		if(LabelVerificaUsuario.innerHTML==""){ 
			return true;
		}else{
			if(Accion=='NUEVO'){
				alert("El nombre de usuario ya existe");
				return false;
			} else{
				return true;
			}
		}
	}
}
</script>
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
<!--<body onLoad="verDpto(14);VerProv(125);VerDist(409);">-->
<body>
<div id="centralPanel">
<div class="centrarText">
<form action=<?php echo '../negocio/cont_persona.php?accion='.$_GET['accion']?> 
method='POST' onSubmit="if(verificaNroDoc(txtNroDoc.value,'<?php echo $_GET['accion'];?>')==false || verificaUsuario(txtUsuario.value,'<?php echo $_GET['accion'];?>')==false){return false;}else{ return check_form(formMantPersona);}" name="formMantPersona">
  <p>
  <input type='hidden' name = 'txtIdPersona' value = '<?php echo $_GET['IdPersona'];?>'>
  <?php
require("../datos/cado.php");
require("../negocio/cls_persona.php");
$objPersona = new clsPersona();

if($_GET['accion']=='ACTUALIZAR'){

$rst = $objPersona->buscar($_GET['IdPersona'],'');
$dato = $rst->fetchObject();
}
?>
<table width="686" border="0">
  <tr>
    <td width="759">
	<fieldset> 
<legend align="left"> <strong> DATOS PERSONALES</strong></legend>
<table width="644" align="center" class="tablaint">
<tr>
  <td align="left"> CODIGO :</td>
  <td colspan="3" align="left"><input type='text' name = 'txtCodigo' value = '<?php if($_GET['accion']=='ACTUALIZAR') echo $dato->codigo; else echo $objPersona->generaCodigo();?>' maxlength="10" size="10" style= "text-transform:uppercase"></td>
  </tr>
<tr>
	<td width="172" align="left"> NOMBRES :</td>
	<td colspan="3" align="left"><input type='text' name = 'txtNombres' 
	value = '<?php 	if($_GET['accion']=='ACTUALIZAR')
	echo $dato->nombres;?>' maxlength="50" size="20" style= "text-transform:uppercase"></td>
	</tr>
<tr>
	<td align="left">APELLIDO PATERNO :</td>
	<td width="139" align="left"><input type='text' name = 'txtApellidoPaterno' value = '<?php 
	if($_GET['accion']=='ACTUALIZAR')
	echo $dato->apellidopaterno;?>' maxlength="60" size="20" style= "text-transform:uppercase"></td>
	<td width="177" align="left"> APELLIDO MATERNO :</td>
	<td width="136" align="left"><input type='text' name = 'txtApellidoMaterno' value = '<?php 
	if($_GET['accion']=='ACTUALIZAR')
	echo $dato->apellidomaterno;?>' maxlength="50" size="20" style= "text-transform:uppercase"></td>
</tr>
<tr>
	<td align="left"> N&ordm; DOCUMENTO : </td>
	<td align="left"><input type='text' name = 'txtNroDoc' value = '<?php
	if($_GET['accion']=='ACTUALIZAR') {
	echo $dato->nrodoc;} else { echo '11111111111';}?>' onKeyPress="if (event.keyCode < 45 || event.keyCode > 57) event.returnValue
	 = false;" onBlur="verificaNroDoc(this.value);" size='11' maxlength='11'><label id="LabelVerificaNroDoc" style="color: #003399"></label></td>
	<td align="left"><div id="DivSexo1">SEXO : </div></td>
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
	<td align="left"> FECHA NACIMIENTO :</td>
	<td align="left"><input type='text' name = 'txtFechaNacimiento' id = 'txtFechaNacimiento' value = '<?php 
	if($_GET['accion']=='ACTUALIZAR')
	echo $dato->fechanacimiento;?>'maxlength="10" size="10" style= "text-transform:uppercase">
    <button type="button" id="btnCalendar" name="btnCalendar">...</button>
        <script type="text/javascript">//<![CDATA[
      var cal = Calendar.setup({
          onSelect: function(cal) { cal.hide() },
          showTime: false
      });
      cal.manageFields("btnCalendar", "txtFechaNacimiento", "%Y-%m-%d");
    //]]></script></td>
	<td align="left"> LUGAR NACIMIENTO :</td>
	<td align="left"><input type='text' name = 'txtLugarNacimiento' id="txtLugarNacimiento" value = '<?php
	if($_GET['accion']=='ACTUALIZAR')
	echo $dato->lugarnacimiento;?>' maxlength="50" size="20" style= "text-transform:uppercase"></td>
</tr>
<tr>
	<td align="left"> DIRECCI&Oacute;N : </td>
	<td colspan="3" align="left"><input type='text' name = 'txtDireccion' 
	value = '<?php if($_GET['accion']=='ACTUALIZAR')
	echo $dato->direccion;?>' maxlength="50" size="30" style= "text-transform:uppercase"></td>
	</tr>
<tr>
	<td align="left">ESTADO CIVIL : </td>
	<td colspan="3" align="left"><select id="cboEstadoCivil" name="cboEstadoCivil">
	<option value="S" <?php if($_GET['accion']=='ACTUALIZAR'){ if($dato->estadocivil=='S') echo 'selected';}?>>Soltero</option>
	<option value="C" <?php if($_GET['accion']=='ACTUALIZAR'){ if($dato->estadocivil=='C') echo 'selected';}?>>Casado</option>
	<option value="D" <?php if($_GET['accion']=='ACTUALIZAR'){ if($dato->estadocivil=='D') echo 'selected';}?>>Divorciado</option>
	<option value="V" <?php if($_GET['accion']=='ACTUALIZAR'){ if($dato->estadocivil=='V') echo 'selected';}?>>Viudo</option>
	</select></td>
	</tr>
<tr>
	<td align="left"> TEL&Eacute;FONO FIJO : </td>
	<td align="left"><input type='text' name = 'txtTelefonoFijo' value = '<?php 
	if($_GET['accion']=='ACTUALIZAR')
	echo $dato->telefonofijo;?>' maxlength="10" size="10" onKeyPress="if (event.keyCode < 45 || event.keyCode > 57) 
	event.returnValue = false;"></td>
	<td align="left"> TEL&Eacute;FONO MOVIL : </td>
	<td align="left"><input type='text' name = 'txtTelefonoMovil' value = '<?php 
	if($_GET['accion']=='ACTUALIZAR')
	echo $dato->celular;?>' maxlength="10" size="10" onKeyPress="if (event.keyCode < 45 || event.keyCode > 57) event.returnValue = 	
	false;">	</td>
</tr>
<tr>
	<td align="left"> EMAIL : </td>
	<td colspan="3" align="left"><input type='text' name = 'txtEmail' maxlength="50" size="45" value = '<?php if($_GET['accion']=='ACTUALIZAR') echo $dato->email;?>'></td>
	</tr>
</table>
</fieldset>

<fieldset> 
<legend align="left"> <strong> REGISTRO DE DATOS DE CUENTA </strong></legend>

<table width="648" border="0" align="center" class="tablaint">
<tr>
	<td align="left">TIPO USUARIO </td>
	<td align="left">
    <input type="hidden" name="cboTipoUsuarioOld" value="<?php if($_GET['accion']=='ACTUALIZAR')echo $dato->idtipousuario;?>">
    <select id="cboTipoUsuario" name="cboTipoUsuario">
    <option value="2" <?php if($_GET['accion']=='ACTUALIZAR'){ if($dato->idtipousuario=='2') echo 'selected';}?>>Postulante</option>
    <option value="1" <?php if($_GET['accion']=='ACTUALIZAR'){ if($dato->idtipousuario=='1') echo 'selected';}?>>Administrador</option>
    </select></td>
</tr>
<tr>
	<td align="left">USUARIO </td>
	<td align="left"><input type="hidden" name="txtUsuarioOld" value="<?php if($_GET['accion']=='ACTUALIZAR')echo $dato->login;?>">
    <input type="text" name="txtUsuario" id="txtUsuario" value="<?php if($_GET['accion']=='ACTUALIZAR')echo $dato->login;?>" onBlur="xajax_verificaUsuario(this.value)">
    <label id="LabelVerificaUsuario" style="color: #003399"></label>
    </td>
</tr>
<tr>
	<td width="159" align="left"> CONTRASE&Ntilde;A </td>
	<td width="547" align="left"> <input type="password" name="txtClave"><?php if($_GET['accion']=='ACTUALIZAR'){?><br>
	Dejar en blanco si no desea cambiar<?php }?></tr>
<tr>
<tr>
  <th colspan="4">
    <input type='submit' name = 'grabar' value='GRABAR'>
	<input type='button' name = 'cancelar' value='CANCELAR' onClick="javascript:window.open('list_persona.php','_self')">
    </th>
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