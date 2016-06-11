<?php
session_start();

/*if(!isset($_SESSION['Usuario_SA']))
{
	header("location: ../presentacion/login.php?error=1");
}*/
if(!isset($_GET['IdPersona'])){
	$_GET['IdPersona']=1;	
}
require("headerNew.php");
$_SESSION['linkactivo']='CONVOCATORIAS';
require("menu.php");
?>
<div class="art-post-inner art-article">
<h2 class="art-postheader"><span class="art-postheadericon"></span>TEST</h2>
<div class="art-postcontent" align="center">
<div>

<html>
<head>
<link href="../css/estiloadmin.css" rel="stylesheet" type="text/css">
<title>TEST</title>
<script type="text/JavaScript">
<!--
function MM_jumpMenu(targ,selObj,restore){ //v3.0
  eval(targ+".location='"+selObj.options[selObj.selectedIndex].value+"'");
  if (restore) selObj.selectedIndex=0;
}
//-->
</script>
<script language="javascript"><!--
var form = "";
var submitted = false;
var error = false;
var error_message = "";

function check_input(field_name, field_size, message) {
  if (form.elements[field_name] && (form.elements[field_name].type != "hidden")) {
    var field_value = form.elements[field_name].value;

    if (field_value.length < field_size) {
      error_message = error_message + "* " + message + "\n";
      error = true;
    }
  }
}

function check_select(field_name, field_default, message) {
  if (form.elements[field_name] && (form.elements[field_name].type != "hidden")) {
    var field_value = form.elements[field_name].value;

    if (field_value == field_default) {
      error_message = error_message + "* " + message + "\n";
      error = true;
    }
  }
}

function check_form(form_name) {
  if (submitted == true) {
    alert("Ya ha enviado el formulario. Pulse Aceptar y espere a que termine el proceso.");
    return false;
  }

  error = false;
  form = formMantTest;
  error_message = "Hay errores en su formulario!\nPor favor, haga las siguientes correciones:\n\n";

  check_input("txtDescripcion", 1, "El test debe tener un nombre");
  
  if (error == true) {
    alert(error_message);
    return false;
  } else {
    submitted = true;
    return true;
  }
}
//--></script>
<link href="../estilos/estilos.css" rel="stylesheet" type="text/css">
</head>
<body>
<br>
<div id="centralPanel">
	<div class="rigthText">
<table width="654" height="123" border="0" align="center">
  <tr>
    <td>
	<?php 
require("../datos/cado.php");
if($_GET['IdPostulante']=='' or !isset($_GET['IdPostulante'])){
require_once("../negocio/cls_postulante.php");
$objPostulante= new clsPostulante();
$_GET['IdPostulante']=$objPostulante->obtenerIdPostulante($_GET['IdPersona'],$_GET['IdConvocatoria']);
}
require_once("../negocio/cls_respuesta.php");
$objRespuesta= new clsRespuesta();
require_once("../negocio/cls_persona.php");
$objPersona= new clsPersona();
$rstP = $objPersona->buscar($_GET['IdPersona'],'');
$datoP=$rstP->fetchObject();
echo '<b>PERSONA :</b> '.$datoP->apellidosynombres.'<br />';
?>
<form action=<?php echo '../negocio/cont_test.php?accion=NUEVO'?> method='POST' onSubmit="return check_form(formMantTest);" name="formMantTest">
  <input type='hidden' name = 'txtIdPostulante' value = '<?php echo $_GET['IdPostulante'];?>'>
  <input type='hidden' name = 'txtIdPersona' value = '<?php echo $_GET['IdPersona'];?>'>
  <input type='hidden' name = 'txtIdPerfil' value = '<?php echo $_GET['IdPerfil'];?>'>
  <input type='hidden' name = 'txtIdConvocatoria' value = '<?php echo $_GET['IdConvocatoria'];?>'>
  <?php
require("../negocio/cls_rubro.php");
$objRubro = new clsRubro();
require("../negocio/cls_entrada.php");
$objEntrada = new clsEntrada();

$tienerespuestas=false;
$rst1 = $objRubro->consultarbusqueda(NULL,$_GET['IdPerfil']);
$cantRubros=$rst1->rowCount();
if($cantRubros>0){?>
    <br>
    <?php
		while($datoRubro = $rst1->fetchObject()){?>
            <fieldset><legend><?php echo $datoRubro->descripcion;?>: </legend>
            <?php
            $rst = $objEntrada->consultarbusqueda(NULL,$datoRubro->idrubro);
            $cantEntradas=$rst->rowCount();
            if($cantEntradas>0){?>
                <br>
                <table width="100%">
                <?php
				$i=0;
                while($dato = $rst->fetchObject()){
					if($i%2==0) $stilo="par"; else $stilo="";
					$i++;
					if(isset($_GET['IdPostulante']) and $_GET['IdPostulante']!=''){
						$rstR = $objRespuesta->buscar(NULL,$_GET['IdPostulante'],$_GET['IdConvocatoria'],$dato->identrada);
						if($tienerespuestas==false){
							if($rstR->rowCount()>0) $tienerespuestas=true;
						}
						$datoR=$rstR->fetchObject();
						$valorR=$datoR->valor;	
					}
					?>
                	<tr class="<?php echo $stilo;?>">
                    <td><?php echo utf8_encode($dato->descripcion);?></td>
                    <td align="center" width="5%">
                    <?php if($datoRubro->tipo=='M'){?>
                    <input type="checkbox" id="opt<?php echo $dato->identrada;?>" name="opt<?php echo $dato->identrada;?>" value="<?php echo $dato->identrada;?>" <?php if($valorR==1) echo "checked";?>>
                    <?php }else{?>
                    <input type="radio" id="opt<?php echo $dato->identrada;?>" name="optg<?php echo $datoRubro->idrubro;?>" value="<?php echo $dato->identrada;?>" <?php if($valorR==1) echo "checked";?>>
                    <?php }?>
                    </td>
                    </tr>
                <?php }?>
                </table>
            <?php
            }
            ?> 
            <br>
            </fieldset>
            <br>
        <?php }?>
<?php 
}
?> 
<center><?php if($tienerespuestas==true and $_SESSION['Tipo']==2){echo "Usted ya postulo a est&aacute; convocatoria.<br>";}else{ ?><input type='submit' name = 'grabar' value='GRABAR'><?php }?> <input type='button' name = 'cancelar' value='CANCELAR' onClick="javascript:history.back()"></center>
</form>
	</td>
  </tr>
</table>
	</div>
</div>
</body>
</html>
</div>
</div>
<div class="cleared"></div>
</div>
<?php
require("footerNew.php");
?>