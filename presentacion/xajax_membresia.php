<?php 
require('../xajax/xajax_core/xajax.inc.php');
$xajax= new xajax();
$xajax->configure('javascript URI','../xajax/');
//$xajax->configure('debug', true);//ver errores
require("../datos/cado.php");
require('../negocio/cls_membresia.php');

function listarmembresias($descripcion,$idtipocriterio){

$objMembresia = new clsMembresia();
$rst = $objMembresia->consultarbusqueda($descripcion,$idtipocriterio);

$tabla="<table class='tablaint' align='center' border='1' >
    <tr>
      <th class='cabezera'>C&Oacute;DIGO</th>
      <th class='cabezera'>DESCRIPCION</th>
	  <th class='cabezera'>COMENTARIO</th>
      <th class='cabezera'>TIPO CRITERIO</th>
	  <th class='cabezera'>TIPO </th>
	  <th class='cabezera'>ENTRADA</th>
      <th colspan='3' class='cabezera'>OPERACIONES</th>
	  </tr>";
   

while($dato = $rst->fetchObject())
{
  $tabla.="<tr>";
      $tabla.="<td align='center' ><div align='center'>".$dato->idmembresia."</div></td>";
      $tabla.="<td><div align='left' >".$dato->descripcion."</div></td>";
	  $tabla.="<td><div align='left' >".$dato->comentario."</div></td>";
      $tabla.="<td><div align='center'>".$dato->tipocriterio."</div></td>";
	  $tabla.="<td><div align='left' >".$dato->tipo."</div></td>";
	  $tabla.="<td><div align='left' >".$dato->tipocontrol."</div></td>";
      $tabla.="<td><div align='center'>&nbsp;
	  <a href='list_variablelinguistica.php?IdMembresia=".$dato->idmembresia."'>
	  <img src='../Imagenes/Variables.GIF'width='58'height='28'border='0'></a></div></td>";
	  $tabla.="<td><div align='center'>&nbsp;
	  <a href='mant_membresia.php?accion=ACTUALIZAR&IdMembresia=".$dato->idmembresia."'>
	  <img src='../imagenes/editar.png'width='58'height='28'border='0'></a></div></td>";
      $tabla.="<td><div align='center'>&nbsp
	  <a href='../negocio/cont_membresia.php?accion=ELIMINAR&IdMembresia=".$dato->idmembresia."'>
	  <img src='../imagenes/eliminar.png' width='78' height='28' border='0'></a></div></td>";
    $tabla.="</tr>";
	
   }
	
  $tabla.="</table>";
	
	$tabla=utf8_encode($tabla);
	$obj=new xajaxResponse();
	$obj->assign("divmembresias","innerHTML",$tabla);

	return $obj;
}

$flistarmembresias= & $xajax->registerFunction("listarmembresias");
$flistarmembresias->setParameter(0,XAJAX_INPUT_VALUE,'txtDescripcion');
$flistarmembresias->setParameter(1,XAJAX_INPUT_VALUE,'cboTipoCriterio');

$xajax->processRequest();
echo "<?xml version='1.0' encoding='UTF-8'?>";
?>