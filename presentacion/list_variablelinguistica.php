<?php
session_start();
//if($_SESSION['Tipo']!=1) header("location: ../Inicio.php");

?>
<?php
require("xajax_variablelinguistica.php");
require("../header.php"); 
$xajax->printJavascript();
?>
<script>
function inicio(){
<?php $flistarvariablelinguistica->printScript(); ?>
}
function listarvariablelinguistica(){
<?php $flistarvariablelinguistica->printScript(); ?>
}
function generaMembresia(id,seleccionado){
xajax_genera_cbomembresia(id,seleccionado,'TODOS');
}
</script>
<html>
<head>
<link href="../css/estiloadmin.css" rel="stylesheet" type="text/css">
<title>REGLA</title>
<link href="../estilos/estilos.css" rel="stylesheet" type="text/css">
</head>
<body onLoad="inicio()">
<br>
<?php
function genera_cbotipocriterio($seleccionado)
{
	
	require("../negocio/cls_tipocriterio.php");
	$obj= new clsTipoCriterio();
	$rst= $obj->consultar();

	echo "<select name='cbotipoCriterio' id='cbotipoCriterio' onChange='generaMembresia(this.value)'>
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
<table width="951" border="0">
  <tr>
    <td width="945">
<form action="mant_variablelinguistica.php?accion=NUEVO&IdMembresia=<?php if(isset($_GET['IdMembresia']) and $_GET['IdMembresia']>0) echo $_GET['IdMembresia'];?>" method="POST">

<table width="938" border="0">
  <tr>
    <td width="932">
<?php 
if(isset($_GET['IdMembresia'])){
$objMembresiaNombre = new clsMembresia();
$rst=$objMembresiaNombre->buscar($_GET['IdMembresia']);
$dato=$rst->fetchObject();
$membresia=$dato->descripcion;
}
?>
<fieldset>
<legend><strong><?php if(isset($_GET['IdMembresia']) and $_GET['IdMembresia']>0) echo 'MEMBRESIA: '.$membresia; else echo 'CRITERIOS DE BUSQUEDA :';?></strong></legend>
<table>
<tr>
<td <?php if(isset($_GET['IdMembresia']) and $_GET['IdMembresia']>0) echo 'style="display:none"';?>>
<table width="928">
    <tr>
      <td width="63" class="etiqueta"bgcolor="#E1ECDF">VARIABLE:</td>
      <td width="164"bgcolor="#E1ECDF"><input name="txtRegla" type="text" id="txtRegla"></td>
      <td width="111" class="etiqueta" bgcolor="#E1ECDF">TIPO CRITERIO</td>
      <td width="143"bgcolor="#E1ECDF"> <?php echo genera_cbotipocriterio(0);?></td>
      <td width="83" class="etiqueta"bgcolor="#E1ECDF">MEMBRESIA:</td>
      <td width="205"bgcolor="#E1ECDF"><div id="divmembresia"><select id="cboMembresia" name="cboMembresia"><option value="<?php if(isset($_GET['IdMembresia']) and $_GET['IdMembresia']>0) echo $_GET['IdMembresia']; else echo '0';?>">TODOS</option></select></div></td>
      <td width="63" align="left" bgcolor="#E1ECDF"><div align="center">
        <input type="button"  name="Submit" value="BUSCAR" onClick="listarvariablelinguistica()"> 
      </div></td>
	<!--  <td width="93" bgcolor="#E1ECDF">
	  <input type='button' name = 'cancelar' value='VARIABLES' onClick="javascript:window.open('mant_variablelinguistica2.php','_self')">
	  <a href="mant_variablelinguistica2.php"></a> </td>
	 </tr>-->
    </tr>
  </table>
</td>
<td width="60" bgcolor="#E1ECDF"><div align="center">
        <input type='submit' name = 'NUEVO' value = 'NUEVO'>
      </div>
	  </td>
</tr>
</table>
</fieldset>

	</td>
  </tr>
</table>
<!--<div id="centralPanel">-->
<div id="">
	<div class="rigthText">

<fieldset>
      <legend><strong>RESULTADO :</strong></legend>
  <div id="divvariablelinguistica"></div>
  <?php 
  if(isset($_GET['IdMembresia']) and $_GET['IdMembresia']>0){
	  $objMembresia = new clsMembresia();
	  $objVariable = new clsVariableLinguistica();
	  $idmembresia=$_GET['IdMembresia'];
	  require("../presentacion/graficodifuso.php");
  }?>
</fieldset>
		</div>
</div>
</form>
	</td>
  </tr>
</table>
</body>
</html>
<?php
require("../footer.php");
?>