<?php 
require('../xajax/xajax_core/xajax.inc.php');
$xajax= new xajax();
$xajax->configure('javascript URI','../xajax/');
//$xajax->configure('debug', true);//ver errores
require("../datos/cado.php");
require('../negocio/cls_entrada.php');

function listarentradas($descripcion,$idrubro,$idperfil){

$objEntrada = new clsEntrada();
$rst = $objEntrada->consultarbusqueda($descripcion,$idrubro);

$tabla="<table class='tablaint' align='center' border='1' >
    <tr>
      <th class='cabezera'>C&Oacute;DIGO</th>
      <th class='cabezera'>DESCRIPCION</th>
	  <th class='cabezera'>COMENTARIO</th>
	  <th class='cabezera'>RESPUESTA POSITIVA</th>
	  <th class='cabezera'>RESPUESTA NEGATIVA</th>
	  <th class='cabezera'>PUNTAJE</th>
      <th colspan='2' class='cabezera'>OPERACIONES</th>
	  </tr>";
   

while($dato = $rst->fetchObject())
{
  $tabla.="<tr>";
      $tabla.="<td align='center' ><div align='center'>".$dato->identrada."</div></td>";
      $tabla.="<td><div align='left' >".$dato->descripcion."</div></td>";
	  $tabla.="<td><div align='left' >".$dato->comentario."</div></td>";
	  $tabla.="<td><div align='left' >".$dato->respuesta_positivo."</div></td>";
	  $tabla.="<td><div align='left' >".$dato->respuesta_negativo."</div></td>";
	  $tabla.="<td><div align='left' >".$dato->puntaje."</div></td>";
	  $tabla.="<td><div align='center'>&nbsp;
	  <a href='mant_entrada.php?accion=ACTUALIZAR&IdEntrada=".$dato->identrada."&IdRubro=".$idrubro."&IdPerfil=".$idperfil."'>
	  <img src='../imagenes/editar.png'width='58'height='28'border='0'></a></div></td>";
	  $tabla.="<td align='center'><a href='#' onClick=\"javascript: if(confirm('Seguro que desea eliminar el documento?')){ window.open('../negocio/cont_entrada.php?accion=ELIMINAR&IdEntrada=".$dato->identrada."&IdRubro=".$idrubro."&IdPerfil=".$idperfil."','_self')}\"><img src='../imagenes/eliminar.png' width='78' height='28' border='0'></a></td>";
    $tabla.="</tr>";
	
   }
	
  $tabla.="</table>";
	
	$tabla=utf8_encode($tabla);
	$obj=new xajaxResponse();
	$obj->assign("diventradas","innerHTML",$tabla);

	return $obj;
}

$flistarentradas= & $xajax->registerFunction("listarentradas");
$flistarentradas->setParameter(0,XAJAX_INPUT_VALUE,'txtDescripcion');
$flistarentradas->setParameter(1,XAJAX_INPUT_VALUE,'txtIdRubro');
$flistarentradas->setParameter(2,XAJAX_INPUT_VALUE,'txtIdPerfil');

$xajax->processRequest();
echo "<?xml version='1.0' encoding='UTF-8'?>";
?>