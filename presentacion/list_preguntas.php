<?php
session_start();
require("../datos/cado.php");

//if($_SESSION['Tipo']!=1) header("location: ../Inicio.php");

require("xajax_preguntas.php");
require("../header.php");

$xajax->printJavascript();
?>
<head>
<style type="text/css">
<!--
.Estilo2 {font-size: 14px; font-weight: bold; }
.Estilo3 {font-size: 12px}
.Estilo4 {
	font-size: 24px;
	font-weight: bold;
}
-->
</style>
<link href="../estilos/estilos.css" rel="stylesheet" type="text/css">
</head>
<script>
function inicio()
{
divMantPregunta.style.display="none";
divMantAlternativas.style.display="none";
<?php $flistarpreguntasyalter->printScript(); ?>
}
function listarpreguntas()
{
<?php $flistarpreguntasyalter->printScript(); ?>
}
function cancelar()
{
divMantPregunta.style.display="none";
frmPreguntas.txtDescripcion.value="";

}
function cancelaralt()
{
divMantAlternativas.style.display="none";
frmPreguntas.txtIdPreguntaAlt.value="";
}
function nuevo()
{
divMantPregunta.style.display="";
frmPreguntas.txtDescripcion.value="";
frmPreguntas.txtaccion.value="NUEVO";

}
function guardarpregunta()
{
<?php $fguardarpregunta->printScript(); ?>
}
function guardaralternativa()
{
<?php $fguardaralternativa->printScript(); ?>
}
function modificarpregunta(num){
 xajax_modificarpregunta(num);
}
function modificaralternativa(num){
 xajax_modificaralternativa(num);
}
function nuevaalternativa(num){
 xajax_nuevaalternativa(num);
}
function eliminarpregunta(num){
 xajax_eliminarpregunta(num);
}
function eliminaralternativa(num){
 xajax_eliminaralternativa(num);
}
</script>

<body onLoad="inicio()">
<?php
require("../negocio/cls_exaconocimiento.php");
require("../negocio/cls_cargo.php");

$objex= new clsExaconocimiento();
$objcargo= new clsCargo();

$rst1= $objex->buscar($_GET['id']);
$fila= $rst1->fetchObject();

$rst2= $objcargo->buscar($fila->idcargo);
$fila2= $rst2->fetchObject();
?>
<!--<div id="centralPanel">
	<div class="centrarText">-->
<table width="200" border="0">
  <tr>
    <td>
<form name="frmPreguntas" method="post" action="">
  <fieldset> 
  <legend> <strong> REGISTTO DE EXAMEN DE CONOCIMIENTO</strong></legend>
  <table width="962" height="139">
    <tr>
      <td width="174" height="25" bgcolor="#E1ECDF"> TITULO :</td>
      <td width="319" class="Estilo2" bgcolor="#E1ECDF"><span class="Estilo3"><?php echo $fila->titulo;?></span></td>
      <td width="453" colspan="3" rowspan="5">
      <div id="divMantPregunta" style="height:120px; overflow:auto;" ><fieldset>
      <legend><strong>MANT. PREGUNTA:</strong></legend>
      <table width="429">
        <tr>
          <td width="160" bgcolor="#E1ECDF">DESCRIPCION:</td>
          <td width="257" bgcolor="#E1ECDF">
            <textarea name="txtDescripcion" cols="40" id="txtDescripcion" style="text-transform:uppercase"></textarea>
            <input name="txtaccion" type="hidden" id="txtaccion">
            <input name="txtIdPregunta" type="hidden" id="txtIdPregunta"></td>
        </tr>
        <tr>
          <td colspan="2" bgcolor="#E1ECDF">
            <div align="center">
              <input type="button" name="Submit2" value="GUARDAR" onClick="guardarpregunta()">
              <input type="button" name="Submit3" value="CANCELAR" onClick="cancelar()">
              </div>          </td>
          </tr>
      </table>
      </fieldset></div>      </td>
    </tr>
    <tr>
      <td height="26" bgcolor="#E1ECDF">APLICADO AL CARGO:</td>
      <td class="Estilo2" bgcolor="#E1ECDF"><span class="Estilo3"><?php echo $fila2->descripcion;?></span></td>
    </tr>
    <tr>
      <td height="23" bgcolor="#E1ECDF">TOTAL DE PREGUNTAS: </div></td>
      <td class="Estilo2" bgcolor="#E1ECDF"><div id="divTotalPreguntas"></div></td>
    </tr>
    <tr>
      <td height="21" bgcolor="#E1ECDF">PUNTAJE OPTIMO : </div></td>
      <td class="Estilo2" bgcolor="#E1ECDF"><div id="divPuntajeOptimo"></div></td>
    </tr>
    <tr>
      <td height="26"><div align="center">
        <input name="txtIdExamen" type="hidden" id="txtIdExamen"  value="<?php echo $fila->id_exaconocimiento;?>">
      </div></td>
      <td class="Estilo2"><div align="center">
        <input name="btnNueva" type="button" id="btnNueva" value="NUEVA PREGUNTA" onClick="nuevo()">
        <input type="button" name="Submit" value="REGRESAR"  onClick="javascript:window.open('list_exaconocimiento.php','_self')">
      </div></td>
    </tr>
  </table>
  </fieldset>
  
      <table width="960" border="0">
        <tr>
          <td width="633" height="108">
		  <fieldset>
      <legend><strong>PREGUNTAS :</strong></legend>
		  <div id="divpreguntas" style="height:320px;overflow:auto;">
		  
	      </div>	</fieldset>	  </td>
          <td width="317"><div id="divMantAlternativas" style="height:320px;overflow:auto;">
		 <fieldset>
      <legend><strong>MANT. ALTERNATIVAS :</strong></legend>
	  <table width="267">
        <tr>
          <td width="95" bgcolor="#E1ECDF">ALTERNATIVA: </td>
          <td width="154" bgcolor="#E1ECDF"><input name="txtAlternativa" type="text" id="txtAlternativa" size="20" 
		  style="text-transform:uppercase"></td>
        </tr>
        <tr>
          <td bgcolor="#E1ECDF">CORRECTA:</td>
          <td bgcolor="#E1ECDF"><label>
            <select name="cboCorrecta" size="1" id="cboCorrecta">
              <option value="S">SI</option>
              <option value="N">NO</option>
            </select>
          </label>
            <label></label></td>
        </tr>
        <tr>
          <td bgcolor="#E1ECDF">PUNTAJE:</td>
          <td bgcolor="#E1ECDF"><label>
            <input name="txtPuntaje" type="text" id="txtPuntaje" size="10" onKeyPress="if (event.keyCode < 46 || event.keyCode > 57) event.returnValue = false;">
            <input name="txtIdPreguntaAlt" type="hidden" id="txtIdPreguntaAlt">
            <input name="txtaccionalt" type="hidden" id="txtaccionalt">
            <input name="txtidalternativa" type="hidden" id="txtidalternativa">
          </label></td>
        </tr>
        <tr>
          <td colspan="2" bgcolor="#E1ECDF">
          <div align="center">
            <input type="button" name="Submit4" value="GUARDAR" onClick="guardaralternativa()">
            <input type="button" name="Submit5" value="CANCELAR" onClick="cancelaralt()">
          </div>         </td>
          </tr>
      </table>
	     </fieldset>
		  </div></td>
        </tr>
      </table>
  </form>
	</td>
  </tr>
</table>
<!--	</div>
</div>
-->
</body>
<?php
require("../footer.php");
?>
