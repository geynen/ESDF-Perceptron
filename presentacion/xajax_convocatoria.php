<?php 
require('../xajax/xajax_core/xajax.inc.php');
$xajax= new xajax();
$xajax->configure('javascript URI','../xajax/');
//$xajax->configure('debug', true);//ver errores
require("../datos/cado.php");
require('../negocio/cls_convocatoria.php');

function listarconvocatorias($descripcion,$idperfil){

$objConvocatoria = new clsConvocatoria();
if($_SESSION['Tipo']==1){
	$rst = $objConvocatoria->consultarbusqueda($descripcion,$idperfil);
}else{
	$rst = $objConvocatoria->consultarConvocatoriasVigentes($descripcion,$idperfil);
}

$tabla="<table class='tablaint' align='center' border='1' >
    <tr>
      <th class='cabezera'>C&Oacute;DIGO</th>
      <th class='cabezera'>NOMBRE</th>
	  <th class='cabezera'>PERFIL</th>
	  <th class='cabezera'>FECHA INICIO</th>
	  <th class='cabezera'>FECHA FIN</th>
      <th colspan='5' class='cabezera'>OPERACIONES</th>
	  </tr>";
   

while($dato = $rst->fetchObject())
{
  $tabla.="<tr>";
      $tabla.="<td align='center' ><div align='center'>".$dato->idconvocatoria."</div></td>";
      $tabla.="<td><div align='left' >".$dato->nombre."</div></td>";
	  $tabla.="<td><div align='left' >".$dato->perfil."</div></td>";
	  $tabla.="<td><div align='left' >".$dato->fechainicio."</div></td>";
	  $tabla.="<td><div align='left' >".$dato->fechafin."</div></td>";
	  if($idperfil>0){
		  $tabla.="<td><div align='center'>&nbsp;<a href='mant_convocatoria.php?accion=ACTUALIZAR&IdConvocatoria=".$dato->idconvocatoria."&IdPerfil=".$dato->idperfil."'><img src='../imagenes/editar.png'width='58'height='28'border='0'></a></div></td>";
		  $tabla.="<td align='center'><a href='#' onClick=\"javascript: if(confirm('Seguro que desea eliminar el documento?')){ window.open('../negocio/cont_convocatoria.php?accion=ELIMINAR&IdConvocatoria=".$dato->idconvocatoria."&IdPerfil=".$dato->idperfil."','_self')}\"><img src='../imagenes/eliminar.png' width='78' height='28' border='0'></a></td>";
		  $tabla.="<td><div align='center'><a href='test_perfil.php?IdConvocatoria=".$dato->idconvocatoria."&IdPerfil=".$dato->idperfil."'><img src='../imagenes/perfil.png' width='100' height='28' border='0'></a></div></td>";
	  }
	  if($_SESSION['Tipo']==1){
		  $tabla.="<td><div align='center'><a href='resultadofinal3.php?IdConvocatoria=".$dato->idconvocatoria."&IdPerfil=".$dato->idperfil."'><img src='../imagenes/resultados.png' width='100' height='28' border='0'></a></div></td>";
		  $tabla.="<td><div align='center'><a href='list_personatest.php?IdConvocatoria=".$dato->idconvocatoria."&IdPerfil=".$dato->idperfil."'><img src='../imagenes/postulantes.png' width='100' height='28' border='0'></a></div></td>";
	  }else{
	  	  $tabla.="<td><a href='test.php?IdPersona=".$_SESSION['Cod']."&IdConvocatoria=".$dato->idconvocatoria."&IdPerfil=".$dato->idperfil."'><img src='../imagenes/postular.png' width='100' height='28' border='0'></a></td>";
	  }
	  
    $tabla.="</tr>";
	
   }
	
  $tabla.="</table>";
	
	$tabla=utf8_encode($tabla);
	$obj=new xajaxResponse();
	$obj->assign("divconvocatorias","innerHTML",$tabla);

	return $obj;
}

$flistarconvocatorias= & $xajax->registerFunction("listarconvocatorias");
$flistarconvocatorias->setParameter(0,XAJAX_INPUT_VALUE,'txtDescripcion');
$flistarconvocatorias->setParameter(2,XAJAX_INPUT_VALUE,'txtIdPerfil');

$xajax->processRequest();
echo "<?xml version='1.0' encoding='UTF-8'?>";
?>