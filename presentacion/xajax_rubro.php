<?php 
require('../xajax/xajax_core/xajax.inc.php');
$xajax= new xajax();
$xajax->configure('javascript URI','../xajax/');
//$xajax->configure('debug', true);//ver errores
require("../datos/cado.php");
require('../negocio/cls_rubro.php');

function listarrubros($descripcion,$idperfil){

$objRubro = new clsRubro();
$rst = $objRubro->consultarbusqueda($descripcion,$idperfil);

$tabla="<table class='tablaint' align='center' border='1' >
    <tr>
      <th class='cabezera'>C&Oacute;DIGO</th>
      <th class='cabezera'>DESCRIPCI&Oacute;N</th>
	  <th class='cabezera'>PUNTAJE</th>
	  <th class='cabezera'>TIPO</th>
      <th colspan='3' class='cabezera'>OPERACIONES</th>
	  </tr>";
   

while($dato = $rst->fetchObject())
{
  $tabla.="<tr>";
      $tabla.="<td align='center' ><div align='center'>".$dato->idrubro."</div></td>";
      $tabla.="<td><div align='left' >".$dato->descripcion."</div></td>";
	  $tabla.="<td><div align='left' >".$dato->puntaje."</div></td>";
	  $tabla.="<td><div align='left' >".$dato->tipo."</div></td>";
	  $tabla.="<td><div align='center'>&nbsp;
	  <a href='mant_rubro.php?accion=ACTUALIZAR&IdRubro=".$dato->idrubro."&IdPerfil=".$dato->idperfil."'>
	  <img src='../imagenes/editar.png'width='58'height='28'border='0'></a></div></td>";
	  $tabla.="<td align='center'><a href='#' onClick=\"javascript: if(confirm('Seguro que desea eliminar el documento?')){ window.open('../negocio/cont_rubro.php?accion=ELIMINAR&IdRubro=".$dato->idrubro."&IdPerfil=".$dato->idperfil."','_self')}\"><img src='../imagenes/eliminar.png' width='78' height='28' border='0'></a></td>";
	  $tabla.="<td><div align='center'>&nbsp;<a href='list_entradas.php?IdRubro=".$dato->idrubro."&IdPerfil=".$dato->idperfil."'><img src='../imagenes/entradas.png' width='78' height='28' border='0'></a></div></td>";
    $tabla.="</tr>";
	
   }
	
  $tabla.="</table>";
	
	$tabla=utf8_encode($tabla);
	$obj=new xajaxResponse();
	$obj->assign("divrubros","innerHTML",$tabla);

	return $obj;
}

$flistarrubros= & $xajax->registerFunction("listarrubros");
$flistarrubros->setParameter(0,XAJAX_INPUT_VALUE,'txtDescripcion');
$flistarrubros->setParameter(2,XAJAX_INPUT_VALUE,'txtIdPerfil');

$xajax->processRequest();
echo "<?xml version='1.0' encoding='UTF-8'?>";
?>