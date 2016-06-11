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
<h2 class="art-postheader"><span class="art-postheadericon"></span>PERFIL BUSCADO</h2>
<div class="art-postcontent" align="center">
<div>

<html>
<head>
<link href="../css/estiloadmin.css" rel="stylesheet" type="text/css">
<title>PERFIL BUSCADO</title>
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
<form action=<?php echo '../negocio/cont_test.php?accion=NUEVO-PERFILBUSCADO'?> method='POST' onSubmit="return check_form(formMantTest);" name="formMantTest">
  <input type='hidden' name = 'txtIdPersona' value = '<?php echo $_GET['IdPersona']?>'>
  <input type='hidden' name = 'txtIdPerfil' value = '<?php echo $_GET['IdPerfil']?>'>
  <input type='hidden' name = 'txtIdConvocatoria' value = '<?php echo $_GET['IdConvocatoria']?>'>
<?php
require_once("../negocio/cls_perfilbuscado.php");
$objPerfilBuscado= new clsPerfilBuscado();
require("../negocio/cls_rubro.php");
$objRubro = new clsRubro();
require("../negocio/cls_entrada.php");
$objEntrada = new clsEntrada();

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
					$rstperfilbuscado = $objPerfilBuscado->buscar(NULL,$_GET['IdConvocatoria'],$dato->identrada);
					$datoperfilbuscado=$rstperfilbuscado->fetchObject();
					$valorbuscado=$datoperfilbuscado->valor;
					?>
                	<tr class="<?php echo $stilo;?>">
                    <td><?php echo utf8_encode($dato->descripcion);?></td>
                    <td align="center" width="5%">
                    <?php if($datoRubro->tipo=='M'){?>
                    <input type="checkbox" id="opt<?php echo $dato->identrada;?>" name="opt<?php echo $dato->identrada;?>" value="<?php echo $dato->identrada;?>" <?php if($valorbuscado==1) echo "checked";?>>
                    <?php }else{?>
                    <input type="radio" id="opt<?php echo $dato->identrada;?>" name="optg<?php echo $datoRubro->idrubro;?>" value="<?php echo $dato->identrada;?>" <?php if($valorbuscado==1) echo "checked";?>>
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
<center> <input type='submit' name = 'grabar' value='GRABAR'> <input type='button' name = 'cancelar' value='CANCELAR' onClick="javascript:window.open('main.php','_self')"></center>
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