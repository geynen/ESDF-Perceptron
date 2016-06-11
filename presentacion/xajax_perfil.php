<?php 
require('../xajax/xajax_core/xajax.inc.php');
$xajax= new xajax();
$xajax->configure('javascript URI','../xajax/');
//$xajax->configure('debug', true);//ver errores
require("../datos/cado.php");
require('../negocio/cls_perfil.php');

function listarperfil($descripcion){

$objPerfil = new clsPerfil();
$rst = $objPerfil->consultarbusqueda($descripcion);

$tabla="<table class='tablaint' align='center' border='1' >
    <tr>
      <th class='cabezera'>C&Oacute;DIGO</th>
      <th class='cabezera'>NOMBRE</th>
	  <th class='cabezera'>DESCRIPCI&Oacute;N</th>
      <th colspan='4' class='cabezera'>OPERACIONES</th>
	  </tr>";
   

while($dato = $rst->fetchObject())
{
  $tabla.="<tr>";
      $tabla.="<td align='center' ><div align='center'>".$dato->idperfil."</div></td>";
      $tabla.="<td><div align='left' >".$dato->nombre."</div></td>";
	  $tabla.="<td><div align='left' >".$dato->descripcion."</div></td>";
	  $tabla.="<td><div align='center'>&nbsp;
	  <a href='mant_perfil.php?accion=ACTUALIZAR&IdPerfil=".$dato->idperfil."'>
	  <img src='../imagenes/editar.png'width='58'height='28'border='0'></a></div></td>";
	  $tabla.="<td align='center'><a href='#' onClick=\"javascript: if(confirm('Seguro que desea eliminar el documento?')){ window.open('../negocio/cont_perfil.php?accion=ELIMINAR&IdPerfil=".$dato->idperfil."','_self')}\"><img src='../imagenes/eliminar.png' width='78' height='28' border='0'></a></td>";
	  $tabla.="<td><div align='center'><a href='list_rubro.php?IdPerfil=".$dato->idperfil."'><img src='../imagenes/rubro.png' width='100' height='28' border='0'></a></div></td>";
	  $tabla.="<td><div align='center'><a href='list_convocatoria.php?IdPerfil=".$dato->idperfil."'><img src='../imagenes/convocatoria.png' width='100' height='28' border='0'></a></div></td>";
    $tabla.="</tr>";
	
   }
	
  $tabla.="</table>";
	
	$tabla=utf8_encode($tabla);
	$obj=new xajaxResponse();
	$obj->assign("divperfils","innerHTML",$tabla);

	return $obj;
}

$flistarperfils= & $xajax->registerFunction("listarperfil");
$flistarperfils->setParameter(0,XAJAX_INPUT_VALUE,'txtDescripcion');

$xajax->processRequest();
echo "<?xml version='1.0' encoding='UTF-8'?>";
?>