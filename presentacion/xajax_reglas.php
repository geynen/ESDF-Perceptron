<?php 
require('../xajax/xajax_core/xajax.inc.php');
$xajax= new xajax();
$xajax->configure('javascript URI','../xajax/');
//$xajax->configure('debug', true);//ver errores
require("../datos/cado.php");
require('../negocio/cls_regla.php');
require('../negocio/cls_membresia.php');
require('../negocio/cls_variablelinguistica.php');

function listarreglas($regla,$criterio1,$criterio2,$criterio3){
$objRegla = new clsRegla();
$rst = $objRegla->consultarbusquedareglas($regla,$criterio1,$criterio2,$criterio3);
$CANT=$rst->rowCount();
$tabla="<table class='tablaint' border='1'>
<tr>
	<th width='10' class='cabezera' >ID</th>
	<th class='cabezera'>MEMBRESIA 1</th>
	<th class='cabezera'>VARIABLE 1</th>
	<th class='cabezera'>OPERADOR</th>
	<th class='cabezera'>MEMBRESIA 2</th>
	<th class='cabezera'>VARIABLE 2</th>
	<th class='cabezera'>MEMBRESIA SALIDA</th>
	<th class='cabezera'>VARIABLE SALIDA</th>
	<th colspan='2' class='cabezera'>OPERACIONES</th>
</tr>";

while($dato = $rst->fetchObject())
{

$tabla.="<tr>";
$tabla.="<td><div align='center'>".$dato->idregla."</div></td>";
$tabla.="<td><div align='left'>".$dato->membresia_input1."</div></td>";
$tabla.="<td><div align='center'>".$dato->variable_input1."</div></td>";
$tabla.="<td><div align='center'>".$dato->operadorlogico."</div></td>";
$tabla.="<td><div align='center'>".$dato->membresia_input2."</div></td>";
$tabla.="<td><div align='center'>".$dato->variable_input2."</div></td>";
$tabla.="<td><div align='center'>".$dato->membresia_output."</div></td>";
$tabla.="<td ><div align='center'>".$dato->variable_output."</div></td>";
$tabla.="<td width='65'><div align='center'><a href='mant_reglas.php?accion=ACTUALIZAR&IdRegla=". $dato->idregla."'><img src='../imagenes/editar.png' width='58'height='28'border='0'></a></div></td>";
$tabla.="<td width='61'><div align='center'><a href='../negocio/cont_regla.php?accion=ELIMINAR&IdRegla=".$dato->idregla."'><img src='../imagenes/eliminar.png' width='78' height='28' border='0'></a></div></td>";
$tabla.="</tr>";
}


$tabla.="</table><center>Registros encontrados: ".$CANT."</center>";
	
	$tabla=utf8_encode($tabla);
	$obj=new xajaxResponse();
	$obj->assign("divreglas","innerHTML",$tabla);

	return $obj;
}

function genera_cbomembresia($origen,$idtipo,$seleccionado,$todos=''){

$objMembresia = new clsMembresia();
if($origen=='Output'){$tipo='O';}else{$tipo='';}
$rst = $objMembresia->buscar(0,$idtipo,$tipo);

$tabla='<select id="cboMembresia'.$origen.'" name="cboMembresia'.$origen.'" onClick="generaVariable(\''.$origen.'\',this.value)">';
if($todos!=''){$tabla.='<option  value="0" selected>TODOS</option>';}
   
if($rst->rowCount()<>0){
while($dato = $rst->fetchObject())
{
		$seleccionar="";
		if($dato->idmembresia==$seleccionado){$seleccionar="selected";}
      $tabla.="<option value=".$dato->idmembresia." ".$seleccionar.">".$dato->descripcion."</option>";
}
}else{
      $tabla.="<option value='0'>NO EXISTEN MEMBRESIAS REGISTRADOS</option>";
}
	
$tabla.="</select>";
	
	$tabla=utf8_encode($tabla);
	$obj=new xajaxResponse();
	$obj->assign("divmembresia".$origen,"innerHTML",$tabla);

	return $obj;
}

function genera_cboVariable($origen,$idmembresia,$seleccionado,$todos=''){

$objVariableLinguistica = new clsVariableLinguistica();
$rst = $objVariableLinguistica->buscarxMembresia($idmembresia);

$tabla='<select id="cboVariable'.$origen.'" name="cboVariable'.$origen.'" multiple>';
if($todos!=''){$tabla.='<option  value="0" selected>TODOS</option>';}
   
if($rst->rowCount()<>0){
while($dato = $rst->fetchObject())
{
		$seleccionar="";
		if($dato->idvariable==$seleccionado){$seleccionar="selected";}
      $tabla.="<option value=".$dato->idvariable." ".$seleccionar.">".$dato->nombre."</option>";
}
}else{
      $tabla.="<option value='0'>NO EXISTEN VARIABLES REGISTRADOS</option>";
}
	
$tabla.="</select>";
	
	$tabla=utf8_encode($tabla);
	$obj=new xajaxResponse();
	$obj->assign("divvariable".$origen,"innerHTML",$tabla);

	return $obj;
}

$flistarreglas= & $xajax->registerFunction("listarreglas");
$flistarreglas->setParameter(0,XAJAX_INPUT_VALUE,'txtRegla');
$flistarreglas->setParameter(1,XAJAX_INPUT_VALUE,'cboMembresiaInput');
$flistarreglas->setParameter(2,XAJAX_INPUT_VALUE,'cboMembresiaInput2');
$flistarreglas->setParameter(3,XAJAX_INPUT_VALUE,'cboMembresiaOutput');

$xajax->registerFunction("genera_cbomembresia");
$xajax->registerFunction("genera_cboVariable");


$xajax->processRequest();
echo "<?xml version='1.0' encoding='UTF-8'?>";
?>