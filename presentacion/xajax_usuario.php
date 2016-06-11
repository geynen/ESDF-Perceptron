<?php 
session_start();
/*if(!isset($_SESSION['Usuario_SA']))
{
  header("location: ../presentacion/login.php?error=1");
}*/
if(isset($_SESSION['IdSucursal'])){
$idsucursal=$_SESSION['IdSucursal'];}else {$idsucursal=1;}
require('../xajax/xajax_core/xajax.inc.php');
$xajax= new xajax();
$xajax->configure('javascript URI','../xajax/');
//$xajax->configure('debug', true);//ver errores

require_once("../negocio/cls_persona.php");

function listadopostulante($apellidosynombres){
require("../datos/cado.php");
	$registro.="<table class='tablaint'>";
	$registro.="<tr>
	  <th class='cabezera'><font size=3> COD </font> </th>
	  <th class='cabezera'><font size=3>  POSTULANTE </font></a> </th>		         
	  <th class='cabezera'><font size=3> DNI </FONT> </th>
      <th class='cabezera'><font size=3> SEXO </FONT> </th>
      <th class='cabezera'><font size=3> ESTADO </FONT> </th>
      <th class='cabezera'><font size=3> DIRECCION </FONT> </th>
	  <th class='cabezera'><font size=3> TEL FIJO </FONT> </th>
  	  <th class='cabezera'><font size=3> CELULAR </FONT> </th>
	  <th class='cabezera'><font size=3> EMAIL </FONT> </th>
	  <th class='cabezera' colspan='4'><font size=3> OPERACIONES </FONT> </th>
 
    </tr>";
	
	date_default_timezone_set('America/Bogota');
	
    $objPostulante= new clsPostulante();
	$rst = $objPostulante->buscar(NULL,$apellidosynombres);
	$cont=0;
	while($dato = $rst->fetchObject()){
	   $cont++;
	   $rojo="";
	   if($cont%2) $estilo="par";
	   else $estilo="impar";
	$registro.="<tr class='$estilo'>";
	$registro.="<td align='center'>".$dato->codigo."</td>";
	$registro.="<td align='center'>".$dato->apellidosynombres."</td>";
	$registro.="<td align='center'>".$dato->nrodoc."</td>"; 
	$registro.="<td align='center'>".$dato->sexo."</td>";
	$registro.="<td align='center'>".$dato->estadocivil."</td>";
	$registro.="<td align='center'>".$dato->direccion."&nbsp;</td>";
	$registro.="<td align='center'>".$dato->telefonofijo."&nbsp;</td>";
	$registro.="<td align='center'>".$dato->celular."&nbsp;</td>";
	$registro.="<td align='center'>".$dato->email."&nbsp;</td>";
	/*if($dato->cant==1) {
	$registro.="<td><a href='seleccionarcargo.php?IdPostulante=$dato->idpostulante'>&nbsp;Aplicar Test</a></td>";}
	else{ $registro.="<td></td>";}	*/
    $registro.="<td><a href='mant_postulante.php?accion=ACTUALIZAR&IdPostulante=$dato->idpostulante'>
	<img src='../imagenes/editar.png' width='58'height='28'border='0'></a></td>";
    $registro.="<td><a href='../negocio/cont_postulante.php?accion=ELIMINAR&IdPostulante=$dato->idpostulante'>
	<img src='../imagenes/eliminar.png' width='78' height='28' border='0'></a></td>";

  $registro.="</tr>";
	}
	$registro.="</table>";
	$registro=utf8_encode($registro);
	$obj=new xajaxResponse();
	$obj->assign("divReporte","innerHTML",$registro);
	return $obj;
}

$flistadopostulante= & $xajax->registerFunction("listadopostulante");
$flistadopostulante->setParameter(0,XAJAX_INPUT_VALUE,'txtApellidosyNombres');

$xajax->processRequest();
echo"<?xml version='1.0' encoding='UTF-8'?>";
?>