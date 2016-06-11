<?php
session_start();
if($_SESSION['Tipo']!=1) header("location: ../Inicio.php");

?>
<?php
require("xajax_reglas.php");
require("../header.php"); 
$xajax->printJavascript();
?>
<script>
function generaMembresia(origen,id,seleccionado){
xajax_genera_cbomembresia(origen,id,seleccionado);
}
function generaVariable(origen,idmembresia,seleccionado){
xajax_genera_cboVariable(origen,idmembresia,seleccionado);
}
</script>
<html>
<head>
<link href="../css/estiloadmin.css" rel="stylesheet" type="text/css">
<title>REGLA</title>
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

function check_form(form_name) {
  if (submitted == true) {
    alert("Ya ha enviado el formulario. Pulse Aceptar y espere a que termine el proceso.");
    return false;
  }

  error = false;
  form = formMantRegla;
  error_message = "Hay errores en su formulario!\nPor favor, haga las siguientes correciones:\n\n";

  check_input("txtNombre", 1, "El regla debe tener un nombre");
  
  if (error == true) {
    alert(error_message);
    return false;
  } else {
    submitted = true;
    return true;
  }
}
//-->
</script>
<link href="../estilos/estilos.css" rel="stylesheet" type="text/css">
</head>
<body>
<?php 
//FUNCIONES DE MEMBRESIA
require("../negocio/cls_tipocriterio.php");
function genera_cbotipocriterio($origen,$seleccionado)
{
	$obj= new clsTipoCriterio();
	$rst= $obj->consultar();

	echo "<select name='cboTipoCriterio$origen' id='cboTipoCriterio$origen' onClick='generaMembresia(&quot;$origen&quot;,this.value)'>";
	while($registro=$rst->fetch())
	{
		$seleccionar="";
		if($registro[0]==$seleccionado) 
		$seleccionar="selected";
		echo "<option  value='".$registro[0]."' ".$seleccionar.">".$registro[1]."</option>";
	}
	echo "</select>";
}
?>
<table width="200" border="0">
  <tr>
    <td>
	<fieldset> 
<legend> <strong> REGISTRA REGLAS </strong></legend>
<form action=<?php echo '../negocio/cont_regla.php?accion='.$_GET['accion']?> method='POST' onSubmit="return check_form(formMantRegla);" name="formMantRegla">
  <input type='hidden' name = 'txtIdRegla' value = '<?php if($_GET['accion']=='ACTUALIZAR')
echo $_GET['IdRegla'];?>'>
<?php
require("../datos/cado.php");
if($_GET['accion']=='ACTUALIZAR'){
//require("../negocio/cls_regla.php");
$objRegla = new clsRegla();
$rst = $objRegla->buscar($_GET['IdRegla']);
$dato = $rst->fetchObject();
}
?>

<table width="925" border="0">
  <tr>
    <td width="34" rowspan="3" class="cabezera"><h1>IF</h1></td>
    <td width="175" align="right" bgcolor="#E1ECDF">TIPO CRITERIO</td>
    <td width="219" bgcolor="#E1ECDF"><?php if($_GET['accion']=='ACTUALIZAR')
	echo genera_cbotipocriterio('Input1',$dato->tipocriterio1); else genera_cbotipocriterio('Input1',0)?></td>
    <td width="62">&nbsp;</td>
    <td width="171" align="right" bgcolor="#E1ECDF">TIPO CRITERIO </td>
    <td width="238" bgcolor="#E1ECDF"><?php if($_GET['accion']=='ACTUALIZAR')
echo genera_cbotipocriterio('Input2',$dato->tipocriterio2); else genera_cbotipocriterio('Input2',0)?></td>
  </tr>
  <tr>
    <td align="right" bgcolor="#E1ECDF">MEBRESIA ENTRADA </td>
    <td bgcolor="#E1ECDF"><div id="divmembresiaInput1">
      <select id="cboMembresiaInput1" name="cboMembresiaInput1">
        <option value="0">TODOS </option>
      </select>
    </div></td>
    <td align="center" class="cabezera"><select id="cboOperador" name="cboOperador">
      <option value="AND" <?php if($_GET['accion']=='ACTUALIZAR') {if($dato->operadorlogico=='AND') echo 'selected';}?>>AND</option>
      <option value="OR" <?php if($_GET['accion']=='ACTUALIZAR') {if($dato->operadorlogico=='OR') echo 'selected';}?>>OR</option>
    </select></td>
    <td width="171" align="right" bgcolor="#E1ECDF">MEBRESIA ENTRADA </td>
    <td width="238" bgcolor="#E1ECDF"><div id="divmembresiaInput2">
      <select id="cboMembresiaInput2" name="cboMembresiaInput2">
        <option value="0">TODOS</option>
      </select>
    </div></td>
  </tr>
  <tr>
    <td align="right" bgcolor="#E1ECDF">VARIABLE ENTRADA </td>
    <td bgcolor="#E1ECDF"><div id="divvariableInput1">
      <select name="cboVariableInput1" id="cboVariableInput1" multiple>
        <option value="0">SELECCIONE UNA MEMBRESIA</option>
      </select>
    </div></td>
    <td>&nbsp;</td>
    <td width="171" align="right" bgcolor="#E1ECDF">VARIABLE ENTRADA </td>
    <td width="238" bgcolor="#E1ECDF"><div id="divvariableInput2">
      <select id="cboVariableInput2" name="cboVariableInput2" multiple>
        <option value="0">SELECCIONE UNA MEMBRESIA</option>
      </select>
    </div></td>
  </tr>
</table>

<table width="515" border="0" align="center">
  <tr>
    <td width="78">&nbsp;</td>
    <td width="178">&nbsp;</td>
    <td width="245">&nbsp;</td>
    </tr>
  <tr>
    <td rowspan="3" class="cabezera"> <h2>  THEN </h2></td>
    <td align="right" bgcolor="#E1ECDF">TIPO CRITERIO </td>
    <td bgcolor="#E1ECDF"><?php if($_GET['accion']=='ACTUALIZAR')
echo genera_cbotipocriterio('Output',$dato->tipocriterio3); else genera_cbotipocriterio('Output',0)?></td>
    </tr>
  <tr>
    <td align="right" bgcolor="#E1ECDF">MEBRESIA SALIDA </td>
    <td bgcolor="#E1ECDF"><div id="divmembresiaOutput">
      <select id="cboMembresiaOutput" name="cboMembresiaOutput">
        <option value="0">TODOS</option>
      </select>
    </div></td>
    </tr>
  <tr>
    <td align="right" bgcolor="#E1ECDF">VARIABLE SALIDA </td>
    <td bgcolor="#E1ECDF"><div id="divvariableOutput">
      <select id="cboVariableOutput" name="cboVariableOutput" multiple>
        <option value="0">SELECCIONE UNA MEMBRESIA</option>
      </select>
    </div></td>
    </tr>
  <tr>
    <td>&nbsp;</td>
    <td colspan="2" align="center" bgcolor="#E1ECDF"><input type='submit' name = 'grabar' value='GRABAR'>      <input type='button' name = 'cancelar' value='CANCELAR' onClick="javascript:window.open('list_reglas.php','_self')"></td>
    </tr>
</table>
</form>
</fieldset>

	</td>
  </tr>
</table>

<script>
<?php if($_GET['accion']=='ACTUALIZAR'){?>
generaMembresia('Input1',<?php echo $dato->tipocriterio1;?>,<?php echo $dato->idmembresia_input1;?>);
generaMembresia('Input2',<?php echo $dato->tipocriterio2;?>,<?php echo $dato->idmembresia_input2;?>);
generaMembresia('Output',<?php echo $dato->tipocriterio3;?>,<?php echo $dato->idmembresia_output;?>);
generaVariable('Input1',<?php echo $dato->idmembresia_input1;?>, <?php echo $dato->idvariable_input1;?>);
generaVariable('Input2',<?php echo $dato->idmembresia_input2;?>, <?php echo $dato->idvariable_input2;?>);
generaVariable('Output',<?php echo $dato->idmembresia_output;?>, <?php echo $dato->idvariable_output;?>);
<?php }else{?>
generaMembresia('Input1',1);
generaMembresia('Input2',1);
generaMembresia('Output',1);
<?php }?>
</script>
</body>
</html>
<?php
require("../footer.php");
?>