<?php
/*session_start();
if(!isset($_SESSION['Usuario_SA']))
{
	header("location: ../presentacion/login.php?error=1");
}*/
require('../xajax/xajax_core/xajax.inc.php');
$xajax= new xajax();
$xajax->configure('javascript URI','../xajax/');
//$xajax->configure('debug', true);//ver errores
$xajax->configure( 'defaultMode', 'synchronous' );

require("../datos/cado.php");

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
require("headerNew2.php");
?>
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

  check_input("txtCodigo", 1, "La Persona debe tener un codigo");
  check_input("txtNombres", 1, "La Persona debe tener un nombre");
  check_input("txtApellidoPaterno", 1, "La Persona debe tener un apellido paterno");
  check_input("txtApellidoMaterno", 1, "La Persona debe tener un apellido materno");
  check_input("txtNroDoc", 1, "La Persona debe tener un numero de documento");
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
		xajax_verificaNroDoc(nro);
		if(LabelVerificaNroDoc.innerHTML==""){ 
			return true;
		}else{
			if(Accion=='NUEVO'){
				alert("El Número de Documento ya existe");
				return false;
			} else{
				return true;
			}
		}
}
function verificaUsuario(nombreusuario,Accion)
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
</script>
<link href="../estilos/estilos.css" rel="stylesheet" type="text/css">
<script type="text/javascript" src="../estilos/json.js"></script>
<script type="text/javascript" src="../estilos/motorAjax.js"></script>
<script type="text/javascript" src="../estilos/funcionesJSmin.js"></script>
<link rel="stylesheet" href="../estilos/hojaEstilos.css" media="all"/>
</head>
<body>
<h2 class="art-postheader"><span class="art-postheadericon"></span>REGISTRO DE POSTULANTES</h2>
<br>
<table width="565" border="0" align="center">
<tr>
  <td width="559"> 
<!--Inicio-->

<form action="../negocio/cont_usuario.php?accion=NUEVO" method='POST' onSubmit="if(verificaNroDoc(txtNroDoc.value,'NUEVO')==false || verificaUsuario(txtUsuario.value,'NUEVO')==false){return false;}else{ return check_form(formMantPersona);}" 
name="formMantPersona">
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
<fieldset>
  <legend><strong>DATOS PERSONALES</strong></legend>
  <table width="420" border="0" align="center" class="tablaint">
<tr>
	<td width="238"> CODIGO :</td>
	<td width="172"><input type='text' name = 'txtCodigo' value = '<?php 
	if($_GET['accion']=='ACTUALIZAR') echo $dato->codigo; else echo $objPersona->generaCodigo();?>' maxlength="10" size="10" style= "text-transform:uppercase">
	</td>
</tr>
<tr>
	<td> APELLIDO PATERNO :</td>
	<td><input type='text' name = 'txtApellidoPaterno' value = '<?php 
	if($_GET['accion']=='ACTUALIZAR')
	echo $dato->apellidopaterno;?>' maxlength="50" size="25" style= "text-transform:uppercase">
	</td>
</tr>
<tr>
	<td> APELLIDO MATERNO :</td>
	<td><input type='text' name = 'txtApellidoMaterno' value = '<?php 
	if($_GET['accion']=='ACTUALIZAR')
	echo $dato->apellidomaterno;?>' maxlength="50" size="25" style= "text-transform:uppercase">
	</td>
</tr>
<tr>
	<td> NOMBRES :</td>
	<td><input type='text' name = 'txtNombres' value = '<?php 
	if($_GET['accion']=='ACTUALIZAR')
	echo $dato->nombres;?>' maxlength="50" size="25" style= "text-transform:uppercase">
	</td>
</tr>
<tr>
	<td> N&Uacute;MERO DOCUMENTO : </td>
	<td><input type='text' name = 'txtNroDoc' value = '<?php 
	if($_GET['accion']=='ACTUALIZAR') {
	echo $dato->nrodoc;} else { echo '';}?>' onKeyPress="if (event.keyCode < 45 || 		
	event.keyCode > 57) event.returnValue = false;"
	onBlur="verificaNroDoc(this.value);" size='11' maxlength='11'> <label id="LabelVerificaNroDoc" 
	style="color: #003399"></label>
	</td>
</tr>
<tr>
	<td> <div id="DivSexo1">SEXO : </div></td>
	<td><div id="DivSexo2">
	<select name="cboSexo"><?php
	if($_GET['accion']=="ACTUALIZAR" & $dato->Sexo=="F"){
		echo "<option selected='selected' value='F'>Femenino</option>
		<option value='M'>Masculino</option>";
        }
		else{
	    echo "<option selected='selected' value='M'>Masculino</option>
		<option id='F' value='F'>Femenino</option>";  
		  }
	?>
	</select></div>
	</td>
</tr>
<tr>	
	<td> FECHA NACIMIENTO :</td>
	<td><input type='text' name = 'txtFechaNacimiento' id="txtFechaNacimiento" value = '<?php 
	if($_GET['accion']=='ACTUALIZAR')
	echo $dato->fechanacimiento;?>'maxlength="10" size="10" style= "text-transform:uppercase">
    <button type="button" id="btnCalendar">...</button>
    <script type="text/javascript">//<![CDATA[
     var cal = Calendar.setup({
      onSelect: function(cal) { cal.hide() },
         showTime: false
      });
      cal.manageFields("btnCalendar", "txtFechaNacimiento", "%Y-%m-%d");
    //]]></script>	
	</td>
</tr>
<tr>
	<td>LUGAR NACIMIENTO :</td>
	<td><input type='text' name = 'txtLugarNacimiento' value = '<?php 
	if($_GET['accion']=='ACTUALIZAR')
	echo $dato->lugarnacimiento;?>' maxlength="50" size="25" style= "text-transform:uppercase">
	</td>
</tr>
<tr>
	<td> DIRECCI&Oacute;N : </td>
	<td><input type='text' name = 'txtDireccion' value = '<?php 
	if($_GET['accion']=='ACTUALIZAR')
	echo $dato->direccion;?>' maxlength="50" size="25" style= "text-transform:uppercase">
	</td>
</tr>
<tr>
	<td> ESTADO CIVIL : </td>
	<td> <select id="cboEstadoCivil" name="cboEstadoCivil">
	<option value="S" <?php 
	if($_GET['accion']=='ACTUALIZAR')
	{ 
	if($dato->estadocivil=='S') 
	echo 'selected';}?>>Soltero</option>
	<option value="C" <?php 
	if($_GET['accion']=='ACTUALIZAR')
	{
	if($dato->estadocivil=='C') 
	echo 'selected';}?>>Casado</option>
	<option value="D" <?php 
	if($_GET['accion']=='ACTUALIZAR')
	{ 
	if($dato->estadocivil=='D') echo 'selected';}?>>Divorciado</option>
	<option value="V" <?php 
	if($_GET['accion']=='ACTUALIZAR')
	{
	 if($dato->estadocivil=='V') echo 'selected';}?>>Viudo</option>
	</select>
	</td>
</tr>
<tr>
	<td>TEL&Eacute;FONO FIJO : </td>
	<td><input type='text' name = 'txtTelefonoFijo' value = '<?php 
	if($_GET['accion']=='ACTUALIZAR')
	echo $dato->telefonofijo;?>' maxlength="10" size="10" onKeyPress="if (event.keyCode < 45 || 
	event.keyCode > 57) event.returnValue = false;">
	</td>
</tr>
<tr>
	<td> TEL&Eacute;FONO MOVIL : </td>
	<td><input type='text' name = 'txtTelefonoMovil' value = '<?php
	if($_GET['accion']=='ACTUALIZAR')
	echo $dato->celular;?>' maxlength="10" size="10" onKeyPress="if (event.keyCode < 45 || 	
	event.keyCode > 57) event.returnValue = false;">
	</td>
</tr>
<tr>
	<td> EMAIL : </td>
	<td> <input type='text' name = 'txtEmail' maxlength="50" size="25" value = '<?php 
	if($_GET['accion']=='ACTUALIZAR')
	echo $dato->email;?>'>
	</td>
</tr>
</table>
</fieldset>
</p>
<fieldset>
  <legend><strong>DATOS DE CUENTA </strong></legend>
  <table width="425"  border="0" align="center" class="tablaint">
<tr>
	<td width="237"> LOGIN : </td>
	<td width="178"><input name = 'txtUsuario' id="txtUsuario" type='text' id="txtUsuario" value = '<?php 
	if($_GET['accion']=='ACTUALIZAR')
	echo $dato->usuario;?>' size="25" maxlength="50"><label id="LabelVerificaUsuario" style="color: #003399"></label>	</td>
</tr>
<tr>
	<td> CLAVE : </td>
	<td><input name = 'txtClave' type='password' id="txtClave" value = '<?php 
	if($_GET['accion']=='ACTUALIZAR')
	echo $dato->usuario;?>' size="25" maxlength="50">	</td>
</tr>
<tr>
  <td colspan="2" align="center"><input name="btnenviar" type="submit" value="REGISTRAR" id="btnenviar">
    <input type='button' name = 'cancelar' value='CANCELAR' onClick="javascript:window.open('../Inicio.php','_self')">
    <input name = 'txtTipoUsuario' type='hidden' id="txtTipoUsuario" value = '<?php if($_GET['accion']=='ACTUALIZAR'){echo $dato->tipousuario;} else { echo '2';}?>' size="25" maxlength="50"></td>
  </tr>
</table>
</fieldset>

</form>	




<!--Final-->	</td>
  </tr>
</table>

	</div>
</div>
	
<br>
<br>
</body>
</html>
<?php
require("footerNew.php");
?>