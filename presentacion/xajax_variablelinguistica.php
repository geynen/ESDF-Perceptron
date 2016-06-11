<?php 
require('../xajax/xajax_core/xajax.inc.php');
$xajax= new xajax();
$xajax->configure('javascript URI','../xajax/');
//$xajax->configure('debug', true);//ver errores
require("../datos/cado.php");
require('../negocio/cls_variablelinguistica.php');
require('../negocio/cls_membresia.php');

function listarvariablelinguistica($variablelinguistica,$membresia){
$objVariable = new clsVariableLinguistica();
$rst = $objVariable->consultarbusqueda($variablelinguistica,$membresia);

$tabla="<table class='tablaint' border='1'>
<tr>
	<th width='10' class='cabezera'>ID</th>
	<th width='150' class='cabezera'>VARIABLE</th>
	<th width='30' class='cabezera'>V.INICIAL</th>
	<th width='30' class='cabezera'>V.MEDIO</th>
	<th width='20' class='cabezera'>V.FINAL</th>
	<th width='30' class='cabezera'>MEMBRESIA</th>
	<th width='170' class='cabezera'>TIPO MEMBRESIA</th>
	<th colspan='2' class='cabezera'>OPERACIONES</th>
</tr>";

while($dato = $rst->fetchObject())
{

$tabla.="<tr>";
$tabla.="<td><div align='center'>".$dato->idvariable."</div></td>";
$tabla.="<td><div align='left'>".$dato->nombre."</div></td>";
$tabla.="<td><div align='center'>".$dato->valorinicial."</div></td>";
$tabla.="<td><div align='center'>".$dato->valormedio."</div></td>";
$tabla.="<td><div align='center'>".$dato->valorfinal."</div></td>";
$tabla.="<td><div align='center'>".$dato->membresia."</div></td>";
$tabla.="<td><div align='center'>".$dato->tipomembresia."</div></td>";
$tabla.="<td width='40'><div align='center'><a href='mant_variablelinguistica.php?accion=ACTUALIZAR&IdVariable=". $dato->idvariable."&IdMembresia=".$membresia."'><img src='../imagenes/editar.png' width='58'height='28'border='0'></a></div></td>";
$tabla.="<td width='40'><div align='center'><a href='../negocio/cont_variablelinguistica.php?accion=ELIMINAR&IdVariable=".$dato->idvariable."&IdMembresia=".$membresia."'><img src='../imagenes/eliminar.png' width='78' height='28' border='0'></a></div></td>";
$tabla.="</tr>";
}


$tabla.="</table>";
	
	$tabla=utf8_encode($tabla);
	$obj=new xajaxResponse();
	$obj->assign("divvariablelinguistica","innerHTML",$tabla);

	return $obj;
}

function genera_cbomembresia($idtipo,$seleccionado,$todos=''){

$objMembresia = new clsMembresia();
$rst = $objMembresia->buscar(0,$idtipo);

$tabla='<select id="cboMembresia" name="cboMembresia">';
if($todos!=''){$tabla.='<option  value="0" selected>TODOS</option>';}
   
if($rst->rowCount()<>0){
while($dato = $rst->fetchObject())
{
		$seleccionar="";
		if($dato->idmembresia==$seleccionado){$seleccionar="selected";}
      $tabla.="<option value=".$dato->idmembresia." ".$seleccionar.">".$dato->descripcion."</option>";
}
}else{
      $tabla.="<option value='0'>NO EXISTEN MEMBRESIAS REGISTRADAS</option>";
}
	
$tabla.="</select>";
	
	$tabla=utf8_encode($tabla);
	$obj=new xajaxResponse();
	$obj->assign("divmembresia","innerHTML",$tabla);

	return $obj;
}

$flistarvariablelinguistica= & $xajax->registerFunction("listarvariablelinguistica");
$flistarvariablelinguistica->setParameter(0,XAJAX_INPUT_VALUE,'txtRegla');
$flistarvariablelinguistica->setParameter(1,XAJAX_INPUT_VALUE,'cboMembresia');

$xajax->registerFunction("genera_cbomembresia");

$xajax->processRequest();
echo "<?xml version='1.0' encoding='UTF-8'?>";
?>