<?php 
session_start();
/*if(!isset($_SESSION['Usuario_SA']))
{
  header("location: ../presentacion/login.php?error=1");
}*/
require('../xajax/xajax_core/xajax.inc.php');
$xajax= new xajax();
$xajax->configure('javascript URI','../xajax/');
//$xajax->configure('debug', true);//ver errores

require_once("../negocio/cls_persona.php");

function listadopersona($apellidosynombres){
require("../datos/cado.php");
	$registro.="<table class='tablaint' border='1'>";
	$registro.="<tr>
	  <th class='cabezera'>COD</th>
	  <th class='cabezera'>APELLIDOS Y NOMBRES </font></a> </th>		         
	  <th class='cabezera'>DNI</th>
      <th class='cabezera'>SEXO</th>
      <th class='cabezera'>ESTADO</th>
      <th class='cabezera'>DIRECCION</th>
	  <th class='cabezera'>TEL FIJO</th>
  	  <th class='cabezera'>CELULAR</th>
	  <th class='cabezera'>EMAIL</th>
	  <th class='cabezera' colspan='4'>OPERACIONES</th>
 
    </tr>";
	
	date_default_timezone_set('America/Lima');
	
    $objPersona= new clsPersona();
	$rst = $objPersona->buscar(NULL,$apellidosynombres);
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
	$registro.="<td><a href='seleccionarcargo.php?IdPersona=$dato->idpersona'>&nbsp;Aplicar Test</a></td>";}
	else{ $registro.="<td></td>";}	*/
    $registro.="<td><a href='mant_persona.php?accion=ACTUALIZAR&IdPersona=$dato->idpersona'>
	<img src='../imagenes/editar.png' width='58'height='28'border='0'></a></td>";
    $registro.="<td><a href='../negocio/cont_persona.php?accion=ELIMINAR&IdPersona=$dato->idpersona'>
	<img src='../imagenes/eliminar.png' width='78' height='28' border='0'></a></td>";

  $registro.="</tr>";
	}
	$registro.="</table>";
	$registro=utf8_encode($registro);
	$obj=new xajaxResponse();
	$obj->assign("divReporte","innerHTML",$registro);
	return $obj;
}

$flistadopersona= & $xajax->registerFunction("listadopersona");
$flistadopersona->setParameter(0,XAJAX_INPUT_VALUE,'txtApellidosyNombres');

function listadopersonatest($apellidosynombres,$idconvocatoria,$idperfil){
require("../datos/cado.php");
	$registro.="<table class='tablaint' border='1'>";
	$registro.="<tr>
	  <th class='cabezera'>COD</th>
	  <th class='cabezera'>APELLIDOS Y NOMBRES </font></a> </th>		         
	  <th class='cabezera'>DNI</th>
      <th class='cabezera'>SEXO</th>
      <th class='cabezera'>ESTADO</th>
      <th class='cabezera'>DIRECCION</th>
	  <th class='cabezera'>TEL FIJO</th>
  	  <th class='cabezera'>CELULAR</th>
	  <th class='cabezera'>EMAIL</th>
	  <th class='cabezera' colspan='4'>OPERACIONES</th>
 
    </tr>";
	
	date_default_timezone_set('America/Lima');
	
    $objPersona= new clsPersona();
	$rst = $objPersona->buscarpostulante(NULL,$idconvocatoria,$apellidosynombres);
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
	$registro.="<td align='center'><a href='#' onClick=\"javascript: if(confirm('Seguro que desea quitar al persona de esta convocatoria?')){ window.open('../negocio/cont_persona.php?accion=ELIMINAR-POSTULANTE&IdPostulante=$dato->idpostulante&IdConvocatoria=".$idconvocatoria."&IdPerfil=".$idperfil."','_self')}\" title='Eliminar postulante de esta convocatorias'><img src='../imagenes/eliminar.png' width='78' height='28' border='0'></a></td>";
    $registro.="<td><a href='test.php?IdPersona=".$dato->idpersona."&IdConvocatoria=".$idconvocatoria."&IdPerfil=".$idperfil."&IdPostulante=$dato->idpostulante'><img src='../imagenes/aplicartest.png' width='100' height='28' border='0'></a></td>";

  $registro.="</tr>";
	}
	$registro.="</table>";
	$registro=utf8_encode($registro);
	$obj=new xajaxResponse();
	$obj->assign("divReporte","innerHTML",$registro);
	return $obj;
}

$flistadopersonatest= & $xajax->registerFunction("listadopersonatest");
$flistadopersonatest->setParameter(0,XAJAX_INPUT_VALUE,'txtApellidosyNombres');
$flistadopersonatest->setParameter(1,XAJAX_INPUT_VALUE,'txtIdConvocatoria');
$flistadopersonatest->setParameter(2,XAJAX_INPUT_VALUE,'txtIdPerfil');

function listadopersonaautocomplete($campo,$frase,$pag,$TotalReg){
	require("../datos/cado.php");
	$ObjPersona= new clsPersona();
	$EncabezadoTabla=array("Apellidos y Nombres","RUC/DNI");
	$regxpag=10;
	$nr1=$TotalReg;
	$inicio=$regxpag*($pag - 1);
	$limite="";
	$frase=utf8_decode($frase);	
	if($inicio==0){		
		$rs = $ObjPersona->consultarpersona($campo,$frase,$limite);	
    	$nr1=$rs->rowCount();
	}
	$nunPag=ceil($nr1/$regxpag);
	$limite=" limit $inicio,$regxpag";
	$rs = $ObjPersona->consultarpersona($campo,$frase,$limite);
    $nr=$rs->rowCount()*($pag);	
	$CantCampos=$rs->columnCount();
    $cadena="Encontrados: $nr de $nr1";
    $registros="
	<table id='tablaPersona' class=registros>
    <tr>";
	for($i=0;$i<count($EncabezadoTabla);$i++){
	$registros.="<th>".$EncabezadoTabla[$i]."</th>";
	}
	$cont=0;
    while($reg=$rs->fetch()){
	   $cont++;
	   if($cont%2) $estilo="par";
	   else $estilo="impar";
	   $registros.= "<tr id='".$reg[0]."' class='$estilo' onClick='mostrarPersona(".$reg[0].")'>";
	   for($i=0;$i<$CantCampos;$i++){
		   if($i<>0){
			   //LO SGTE PARA OBTENER LA PORSION DE TEXTO QUE COINCIDE Y CAMBIARLE DE ESTILO, $cadena2 -> está variable contiene el valor q coincide, al cual lo ubico en una etiqueta span para cambiarle de estilo.
				$posicion  = stripos($reg[$i], $frase);
				if($posicion>-1){
					$cadena1 = substr($reg[$i], 0, $posicion);
					$cadena2 = substr($reg[$i], $posicion, strlen($frase));
					$cadena3 = substr($reg[$i], ($posicion + strlen($frase)));
					
					$dato = $cadena1.'<span>'.$cadena2.'</span>'.$cadena3;
					$registros.= "<td>".$dato."</td>";
				}else{
					$registros.= "<td>".$reg[$i]."</td>";
					}
		   }
	   }
	   $registros.=$RegistroSeleccion;
	   $registros.= "</tr>";
    }
//+ 1 indican las operaciones
	$cantcolum=count($EncabezadoTabla)+1;
    $registros.="<tr><td colspan='".$cantcolum."' align='center'>";
	//INICIO PAGINACION
	$registros.='<table class="tablaPaginacion"><tr>';
	$nro_hojas=$nunPag;
	$nro_hoja=$pag;
	$ini = "<td><a href=\"#\" onClick=\"javascript:document.getElementById('pagPersona').value=";
	$medio=";buscarPersona(event);\">";
	if($nro_hojas>11){
	for($i=1;$i<=3;$i++){
		if($nro_hoja!=$i){$registros.= $ini.$i.$medio.$i."</a></td>";}else{ $registros.= "<td>".$i."</td>";}
	}
	if($nro_hojas % 2 == 0){
		$mitad = (int)($nro_hojas/2);
	}else{
		$mitad = (int)($nro_hojas/2) + 1;
	}
	if($nro_hoja>3 && $nro_hoja <= $nro_hojas-3){
		if($nro_hoja > 6 && $nro_hoja < $nro_hojas - 5){
			if($nro_hoja!=4){$registros.= $ini.'4'.$medio."-></a></td>";}else{ $registros.= "<td>-></td>";}
			for($i=$nro_hoja-2;$i<$nro_hoja;$i++){
				if($nro_hoja!=$i){$registros.= $ini.$i.$medio.$i."</a></td>";}else{ $registros.= "<td>".$i."</td>";}
			}	
			for($i=$nro_hoja;$i<=$nro_hoja+2;$i++){
				if($nro_hoja!=$i){$registros.= $ini.$i.$medio.$i."</a></td>";}else{ $registros.= "<td>".$i."</td>";}
			}	
			if($nro_hoja!=($nro_hojas-3)){$registros.= $ini.($nro_hojas-3).$medio."<-</a></td>";}else{ $registros.= "<td><-</td>";}
		}else{
			if($nro_hoja>=4 && $nro_hoja<=6){
				for($i=4;$i<=8;$i++){
					if($nro_hoja!=$i){$registros.= $ini.$i.$medio.$i."</a></td>";}else{ $registros.= "<td>".$i."</td>";}
				}
				if($nro_hoja!=($nro_hojas-3)){$registros.= $ini.($nro_hojas-3).$medio."<-</a></td>";}else{ $registros.= "<td><-</td>";}
			}else{
				if($nro_hoja!=4){$registros.= $ini.'4'.$medio."-></a></td>";}else{ $registros.= "<td>-></td>";}
				for($i=$nro_hojas-7;$i<=$nro_hojas-3;$i++){
					if($nro_hoja!=$i){$registros.= $ini.$i.$medio.$i."</a></td>";}else{ $registros.= "<td>".$i."</td>";}
				}
			}
		}
	}else{
		if($nro_hoja!=4){$registros.= $ini.'4'.$medio."-></a></td>";}else{ $registros.= "<td>-></td>";}
		for($i=(int)$mitad-2;$i<=(int)$mitad+2;$i++){
			if($nro_hoja!=$i){$registros.= $ini.$i.$medio.$i."</a></td>";}else{ $registros.= "<td>".$i."</td>";}
		}
		if($nro_hoja!=($nro_hojas-3)){$registros.= $ini.($nro_hojas-3).$medio."<-</a></td>";}else{ $registros.= "<td><-</td>";}
	}
	for($i=(int)$nro_hojas-2;$i<=(int)$nro_hojas;$i++){
		if($nro_hoja!=$i){$registros.= $ini.$i.$medio.$i."</a></td>";}else{ $registros.= "<td>".$i."</td>";}
	}
	}else{
	for($i=1;$i<=$nro_hojas;$i++){
		if($nro_hoja!=$i){$registros.= $ini.$i.$medio.$i.""."</a></td>";}else{ $registros.= "<td>".$i."</td>";}
	}
	}
	$registros.= "</tr></table>";
	//FIN PAGINACION
    $registros.="</td></tr></table>";

	$registros=utf8_encode($registros);
	$objResp=new xajaxResponse();
	$objResp->assign('divregistrosPersona','innerHTML',$registros);
	$objResp->assign('TotalRegPersona','value',$nr1);
	return $objResp;
}

function mostrarPersona($id){
  require("../datos/cado.php");
  $ObjPersona= new clsPersona();
  $rs = $ObjPersona->buscar($id,'');	
  $reg= $rs->fetchObject();
  $objResp=new xajaxResponse();
  $objResp->assign('txtIdPersona','value',$reg->idpersona);
  $objResp->assign('frasePersona','value',utf8_encode($reg->apellidosynombres));
  return $objResp;
}

$xajax->registerFunction('mostrarPersona');
$flistadopersonaautocomplete = & $xajax-> registerFunction('listadopersonaautocomplete');
$flistadopersonaautocomplete->setParameter(0,XAJAX_INPUT_VALUE,'campoPersona');
$flistadopersonaautocomplete->setParameter(1,XAJAX_INPUT_VALUE,'frasePersona');
$flistadopersonaautocomplete->setParameter(2,XAJAX_INPUT_VALUE,'pagPersona');
$flistadopersonaautocomplete->setParameter(3,XAJAX_INPUT_VALUE,'TotalRegPersona');

function agregarPostulante($idpersona,$idconvocatoria){
  require("../datos/cado.php");
  require_once("../negocio/cls_postulante.php");
  $ObjPostulante= new clsPostulante();
  $ObjPostulante->insertar($idpersona,$idconvocatoria);	
  $objResp=new xajaxResponse();
  $objResp->alert("Guardado correctamente!");
  $objResp->script("listadopersonas();");
  return $objResp;
}

$fagregarPostulante = & $xajax->registerFunction('agregarPostulante');
$fagregarPostulante->setParameter(0,XAJAX_INPUT_VALUE,'txtIdPersona');
$fagregarPostulante->setParameter(1,XAJAX_INPUT_VALUE,'txtIdConvocatoria');


$xajax->processRequest();
echo"<?xml version='1.0' encoding='UTF-8'?>";
?>