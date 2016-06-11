<?php
session_start();
//if($_SESSION['Tipo']!=1) header("location: ../Inicio.php");
?>
<?php
require("xajax_membresia.php");
require("../header.php"); 


$xajax->printJavascript();
?>
<script>
function inicio(){
<?php $flistarmembresias->printScript(); ?>
}
function listarmembresias(){
<?php $flistarmembresias->printScript(); ?>
}
</script>
<html>
<head>
<link href="../css/estiloadmin.css" rel="stylesheet" type="text/css">
<title>MEBRESIAS</title>
<link href="../estilos/estilos.css" rel="stylesheet" type="text/css">
</head>
<body onLoad="inicio()" class="body">
<p>
   <?php
function genera_cboTipoCriterio($seleccionado)
	{

	require("../negocio/cls_tipocriterio.php");
	$objTipoCriterio = new clsTipoCriterio();
	$rst2=$objTipoCriterio->consultar();

	echo "<select name='cboTipoCriterio' id='cboTipoCriterio'>
	<option value=0>TODOS</option>";
	while($registro=$rst2->fetch())
	{
		$seleccionar="";
		if($registro[0]==$seleccionado) $seleccionar="selected";
		echo "<option value='".$registro[0]."' ".$seleccionar.">".$registro[1]."</option>";
	}
	echo "</select>";
}
?>

<table width="770" border="0">
<tr>
<td width="764">
<form action="mant_membresia.php?accion=NUEVO" method="POST">
<fieldset>
<legend><strong>CRITERIOS DE BUSQUEDA :</strong></legend>
<table width="730" border="0">
  <tr>
    <td width="104" bgcolor="#E1ECDF">DESCRIPCION</td>
    <td width="146" bgcolor="#E1ECDF"><input name="txtDescripcion" type="text" id="txtDescripcion"></td>
    <td width="141" bgcolor="#E1ECDF">TIPO CRITERIO</td>
    <td width="185" bgcolor="#E1ECDF"><?php echo genera_cboTipoCriterio(0);?></td>
    <td width="72" bgcolor="#E1ECDF"><input type="button" name="Submit" value="BUSCAR" onClick="listarmembresias()"></td>
    <td width="56" bgcolor="#E1ECDF"><input type='submit' name = 'NUEVO' value = 'NUEVO'></td>
  </tr>
</table>
<label></label>
</fieldset>
<!--<div id="centralPanel">-->
<div id="">
	<div class="centrarText">
<table width="640" border="0">
  <tr>
    <td width="634">
	
<fieldset>
    <legend><strong>RESULTADOS :</strong></legend>
	
	<div id="divmembresias">  </div>
  	</fieldset>	
	</td>
  </tr>
</table>
	</div>
</div>
</form>


	</td>
  </tr>
</table>


<?php
require("../footer.php");
?>
</body>
</html>