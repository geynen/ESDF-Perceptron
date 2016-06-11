<?php 
session_start();
require("../header.php");
require("../fuzzy/logicadifusaESDF.php");
$objLogicaSeper = new FuzzySEPER();
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Documento sin título</title>
<link href="../estilos/estilos.css" rel="stylesheet" type="text/css" />
</head>

<body>
<br />
<table>
<tr><td>
  <fieldset style="height:400px">
  <legend><strong>RESULTADOS:</strong></legend>
  <table border="1" align="center">
<tr>
<th class="cabezera">CODIGO</th>
<th class="cabezera">PERSONA</th>
<th class="cabezera">GRADO DE DECISI&Oacute;N FUZZY</th>
<th class="cabezera">GRADO DE ACEPTACI&Oacute;N FUZZY</th>
<th class="cabezera" colspan="3">OPERACIONES</th>
</tr>
<?php 
require("../datos/cado.php");
require_once("../negocio/cls_respuesta.php");
$objRespuesta= new clsRespuesta();
$rst = $objRespuesta->resultadofinal();
while($dato=$rst->fetchObject()){
	$objLogicaSeper = new FuzzySEPER();
	?>
    <tr>
    <td><?php echo $dato->codigo;?></td>
    <td><?php echo $dato->persona;?></td>
    <td align="center">
	<?php 
	$puntaje=$objLogicaSeper->obtenerPuntaje($dato->idpersona);
	echo $puntaje;?></td>
    <td><?php
	echo $objLogicaSeper->obtenerGradosPertenecia($puntaje);?></td>
    <td><a href="../fuzzy/logicadifusaConsolaESDF.php?idpersona=<?php echo $dato->idpersona;?>" target="_blank">ver&nbsp;modo&nbsp;consola</a></td>
    </tr>
    <?php 
}
?>
</table>
</fieldset>
</td></tr></table>
</body>
</html>
<?php
require("../footer.php");
?>