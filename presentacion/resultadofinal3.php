<?php
//Autor: Geynen Rossler Montenegro Cochas (geynen@gmail.com)
//Fecha: 24 03 2012
session_start();
require("headerNew.php");
$_SESSION['linkactivo']='CONVOCATORIAS';
require("menu.php");
?>
<div class="art-post-inner art-article">
<h2 class="art-postheader"><span class="art-postheadericon"></span>Resultados Perceptron</h2>
<div class="art-postcontent" align="center">
<div>
<?php
require("../datos/cado.php");
require_once("../negocio/cls_perfilbuscado.php");
require_once("../negocio/cls_respuesta.php");

//Declarates classes and instanciate it
include("../perceptron/perceptron_class.php");
$rna_class = new perceptron();

//Setup Debug Mode
$rna_class->debug = false;
	
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Resultados Perceptron</title>
<link href="../estilos/estilos.css" rel="stylesheet" type="text/css" />
</head>

<body>
<br />
<div id="divProgreso">
<center>
<label id="lblProgress">Ingresando datos del perfil buscado...</label><br />
<img src="../imagenes/progress.gif"/>
</center>
</div>
<script>
var i=0;
function progresMsg(msg){
	document.getElementById('lblProgress').innerHTML=msg;
}
function progresTime(msg){
	if(i<=2){
		switch (i){
			case 0:
				setTimeout("progresMsg('"+msg+"');progresTime('Buscando perfiles conicidientes...');",3000);
				break;
			case 1:
				setTimeout("progresMsg('"+msg+"');progresTime('Preprando para mostrar resultados...');",3000);
				break;
			case 2:
				setTimeout("progresMsg('"+msg+"');mostrarResultados();",3000);
				break;
		}	
	}
	i++;
}
//progresTime('Entrenando red neuronal...');
function mostrarResultados(){
	document.getElementById('divResultados').style.display='';
	document.getElementById('divProgreso').style.display='none';
}
</script>
<?php
	/*************** PERFIL BUSCADO ***************/
	
	//Defines a training input data
	$objPerfilBuscado= new clsPerfilBuscado();
	$rst = $objPerfilBuscado->buscar(NULL,$_GET['IdConvocatoria']);
	if($rst->rowCount()>0){
	?>
    <script>progresTime('Entrenando red neuronal...');</script>
    <?php
	$cadenaX="\$training_array = array(array(";
	while($dato=$rst->fetchObject()){
		$cadenaXX1.="'x".$dato->identrada."' => $dato->valor,";
		$cadenaXX2.="'x".$dato->identrada."' => (-1 * $dato->valor),";
	}
	$cadenaX.=substr($cadenaXX1,0,-1).", 'o' => 1),array(".substr($cadenaXX2,0,-1).", 'o' => -1));";
	//echo $cadenaX.'<br>';
	eval($cadenaX);

	//Train the RNA
	$train_result = $rna_class->train($training_array, 1, 1);
	//print_r($train_result);

	/*************** TESTS TODOS LOS POSTULANTES ***************/
	
	//Defines a set of tests
	$objRespuesta= new clsRespuesta();
	$rst = $objRespuesta->personas(NULL,$_GET['IdConvocatoria']);
	$cadenaA.="\$testing_array = array(";
	while($dato=$rst->fetchObject()){
		$nombrepersona=$dato->persona;	
		$idpostulante=$dato->idpostulante;	
		$cadenaC='';
		$cadenaB.="'$idpostulante' => array(";
		$rst2 = $objRespuesta->buscar(NULL,$idpostulante,$_GET['IdConvocatoria']);
		while($dato2=$rst2->fetchObject()){
			//if($dato2->identrada>1){
			$cadenaC.="'x".$dato2->identrada."' => $dato2->valor,";
			//}
		}
		$cadenaB.=substr($cadenaC,0,-1)."),";
	}	
	$cadenaA.=substr($cadenaB,0,-1).");";
	//echo $cadenaA.'<br>';
	eval($cadenaA);
	// Now tests the database ($testing_array data) against the trainned network
	$matchs = array();
	foreach($testing_array as $name => $subject_data) {
		//echo $name.'-'.print_r($subject_data).'<br>';
		/*if ($rna_class->test_class($subject_data, $train_result) == true) {
			$matchs[] = $name;
		}*/
		$wfinal=$rna_class->mi_test_class($subject_data, $train_result);
		if($wfinal > 0){
			$matchs[$name] = $wfinal;
		}
	}
	
	// Prints the names of people that fit the same class in wich the user input was applied to
	echo "<div id='divResultados' style='display:none'><center>El Sistema encontro " . count($matchs) . " postulante(s) que coinciden con el perfil buscado:</center><br>";
	//echo "<table  class='tablaint' border='1'><tr><th class='cabezera'>Postulante</th></tr><tr><td>".implode("</td></tr><tr><td>", $matchs)."</td></tr></table></div>";
	//print_r($matchs);
	krsort($matchs);
	//print_r($matchs);
	echo '<br><table class="tablaint" border="1"><tr><th class="cabezera">C&oacute;digo</th><th class="cabezera">Postulante</th><th class="cabezera">Peso Obtenido</th></tr>';
	foreach($matchs as $idpostulante => $w) {
		$rst = $objRespuesta->resultadofinal($idpostulante,$_GET['IdConvocatoria']);
		$dato=$rst->fetchObject();
		echo '<tr><td align="center">'.$dato->codigo.'</td>';
		echo '<td>'.$dato->persona.'</td>';
		echo '<td align="center">'.$w.'</td></tr>';
		//echo '<td>'.$dato->puntaje.'</td></tr>';
	}
	echo '</table>';	
	
	//MUESTRA RESULTADO POR PUNTAJE
	$rst = $objRespuesta->resultadofinal(NULL,$_GET['IdConvocatoria']);
	echo '<br><a href="#" onclick=\'javascript: if(resultadotradicional.style.display==""){resultadotradicional.style.display="none";}else{resultadotradicional.style.display="";}\'>ver resultados c&aacute;lculo tradicional</a><br><br><table id="resultadotradicional" class="tablaint" border="1" style="display:none"><tr><th class="cabezera">C&oacute;digo</th><th class="cabezera">Postulante</th><th class="cabezera">Puntaje</th></tr>';
	while($dato=$rst->fetchObject()){
		echo '<tr><td align="center">'.$dato->codigo.'</td>';
		echo '<td>'.$dato->persona.'</td>';
		echo '<td align="center">'.$dato->puntaje.'</td></tr>';
	}	
	echo '</table><br></div>';
	}else{
		echo 'No ha indica el perfil buscado<br><br><a href="test_perfil.php?IdConvocatoria='.$_GET['IdConvocatoria'].'&IdPerfil='.$_GET['IdPerfil'].'">Indicar Perfil Buscado</a>';
		?>
        <script>document.getElementById('divProgreso').style.display='none';</script>
        <?php
	}
?>
<div id="leyenda" style="display:none">
<br />
<br />
LEYENDA:
<br />
x -> Entradas<br />
o -> Valor deseado<br />
Yin -> Valor obtenido internamente<br />
Y -> Valor obtenido<br />
DeltaW -> Peso modificados<br />
W -> Peso<br />
Bias -> Umbral<br />
DeltaBias -> Umbral modificado<br />
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