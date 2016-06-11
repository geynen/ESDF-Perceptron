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
function inicio(){
<?php $flistarreglas->printScript(); ?>
}
function listarreglas(){
<?php $flistarreglas->printScript(); ?>
}
function generaMembresia(id,idtipo,seleccionado){
xajax_genera_cbomembresia(id,idtipo,seleccionado,'TODOS');
}
</script>
<html>
<head>
<link href="../css/estiloadmin.css" rel="stylesheet" type="text/css">
<title>REGLA</title>
<link href="../estilos/estilos.css" rel="stylesheet" type="text/css">
</head>
<body onLoad="inicio()">
<?php
//FUNCIONES DE MEMBRESIA
function genera_cbotipocriterio($origen,$seleccionado)
{
	
	require("../negocio/cls_tipocriterio.php");
	$obj= new clsTipoCriterio();
	$rst= $obj->consultar();

	echo "<select name='cbotipoCriterio' id='cbotipoCriterio' onChange='generaMembresia(&quot;Input&quot;,this.value);generaMembresia(&quot;Input2&quot;,this.value);generaMembresia(&quot;Output&quot;,this.value);'>
	 <option  value='0' selected>TODOS</option>";
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



<form action="mant_reglas.php?accion=NUEVO" method="POST">
<table width="930" border="0">
  <tr>
    <td width="924">
<fieldset>
<legend><strong>CRITERIOS DE BUSQUEDA :</strong></legend>
<table width="749">
    <tr>
      <td width="208" bgcolor="#E1ECDF">REGLAS:</td>
      <td width="149" bgcolor="#E1ECDF"><input name="txtRegla" type="text" id="txtRegla"></td>
      <td width="208" bgcolor="#E1ECDF">TIPO CRITERIO:</td>
      <td width="156" bgcolor="#E1ECDF"><?php echo genera_cbotipocriterio('Input',0);?></td>      
	  </tr><tr>
      <td width="208" align="left" bgcolor="#E1ECDF">MEMBERSIA ENTRADA 1 </td>
      <td width="149" bgcolor="#E1ECDF"><div id="divmembresiaInput"><select id="cboMembresiaInput" name="cboMembresiaInput">
	  <option value="0">TODOS</option></select></div></td>
      <td width="208" align="left" bgcolor="#E1ECDF">MEMBERSIA ENTRADA 2 </td>
      <td width="156" bgcolor="#E1ECDF"><div id="divmembresiaInput2"><select id="cboMembresiaInput2" name="cboMembresiaInput2">
	  <option value="0">TODOS</option></select></div></td>

      </tr>
    <tr>
      <td bgcolor="#E1ECDF">MEMBERSIA SALIDA:</td>
      <td bgcolor="#E1ECDF"><div id="divmembresiaOutput"><select id="cboMembresiaOutput" name="cboMembresiaOutput">
	  <option value="0">TODOS</option></select></div></td>
      <td colspan="2" bgcolor="#E1ECDF"><div align="center">
      <input type="button"  name="Submit" value="BUSCAR" onClick="listarreglas()"> 
      <input type='submit' name = 'NUEVO' value = 'NUEVO'>
          </div></td>
      </tr> 
</table>
</fieldset>
	</td>
  </tr>
</table>
<!--<div id="centralPanel">-->
<div id="">
<div class="rigthText">
<table width="857" border="0">
  <tr>
    <td width="851">

<fieldset>
      <legend><strong>RESULTADO :</strong></legend>
  <div id="divreglas"></div>
</fieldset>
	</td>
  </tr>
</table>
</div>
</div>
</form>
</body>
</html>
<?php
require("../footer.php");
?>