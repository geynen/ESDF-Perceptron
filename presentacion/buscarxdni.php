<?php 
require('../xajax/xajax_core/xajax.inc.php');
$xajax= new xajax();
$xajax->configure('javascript URI','../xajax/');
//$xajax->configure('debug', true);//ver errores

require("../datos/cado.php");

function verificaNroDoc($nro){
	require("../negocio/cls_persona.php");
	$oPersona = new clsPersona();
	$consulta = $oPersona->verificaNroDoc($nro);

	$Cadena="El Persona no est&aacute; registrado. <a href='mant_registrousuario.php'>Registrar&nbsp;Persona</a>";
	$nombre="";
	if($consulta->rowCount()!=0){
		$Cadena="El N&uacute;mero de Documento ya existe";
		$dato=$consulta->fetchObject();
		$nombre="Nombre: ".$dato->nombres;
	}
	$Cadena=utf8_encode($Cadena);
	$obj=new xajaxResponse();
    $obj->assign("LabelVerificaNroDoc","innerHTML",$Cadena);
    $obj->assign("LabelNombre","innerHTML",$nombre);
	return $obj;
}

$xajax->registerFunction("verificaNroDoc");
$xajax->processRequest();
echo '<?xml version="1.0" encoding="UTF-8"?>';
require("headerNew2.php");
?>
<html>
<head>
<?php $xajax->printJavascript();?>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<link href="../css/estiloadmin.css" rel="stylesheet" type="text/css">
<title>REGISTRO DE PERSONA</title>
<script>
function verificaNroDoc(nro,Accion)
{
	if(nro=="1111111111"){
		return true;
	}else
	{
		xajax_verificaNroDoc(nro);
		if(LabelVerificaNroDoc.innerHTML==""){ 
			return true;
		}else{
			if(Accion=='NUEVO'){
				alert("El Número de Documento ya existe");
				return false;
			} else{
				return true;
			}
		}
	}
}
</script>
<link href="../estilos/estilos.css" rel="stylesheet" type="text/css">
</head>
<script type="text/javascript" src="../estilos/json.js"></script>
<script type="text/javascript" src="../estilos/motorAjax.js"></script>
<script type="text/javascript" src="../estilos/funcionesJSmin.js"></script>
<link rel="stylesheet" href="../estilos/hojaEstilos.css" media="all"/>
</head>
<body>
<div id='divParametros' style="height:100px;overflow:auto;">
<BR>
    <fieldset >
       <table border="0" align="left">
        <tr>
          <td width="135" align="left"><b>Ingrese su DNI: </b></td>
          <td width="312"><label>
            <input name="txtdni" type="text" id="txtdni" size="8" maxlength="8">
          </label><input name = 'BUSCAR' type='button' id="BUSCAR" value = 'BUSCAR' onClick="verificaNroDoc(txtdni.value);">
		  <input type='button' name = 'cancelar' value='CANCELAR' onClick="javascript:window.open('../index.php','_self')">
		  </td>
    
        </tr>
        <tr><td colspan="2"><label id="LabelVerificaNroDoc" style="color: #003399"	></label></td></tr>
        <tr><td colspan="2"><label id="LabelNombre"></label></td></tr>
      </table>
    </fieldset>
</div>
  
&nbsp;

<br>
<br>
<br>
<br>
<br>
<br>
<br>
<br>
<br>
<br>
<br>
<br>
<br>
<br>
</body>
<?php
require("footerNew.php");
?>