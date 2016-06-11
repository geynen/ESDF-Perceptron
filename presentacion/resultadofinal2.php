<?php
session_start();
require("../header.php");

require("../datos/cado.php");
require_once("../negocio/cls_respuesta.php");

//Declarates classes and instanciate it
include("../perceptron/perceptron_class.php");
$rna_class = new perceptron();

//Setup Debug Mode
$rna_class->debug = true;
	
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
<?php
	//Defines a training input data
	$training_array = array(
		array(
			"x1" => $_POST["p1"], "x2" => $_POST["p2"], "x3" => $_POST["p3"], "x4" => $_POST["p4"], "o" => 1 
		),
		array(
			"x1" => (-1 * $_POST["p1"]), "x2" => (-1 * $_POST["p2"]), "x3" => (-1 * $_POST["p3"]), "x4" => (-1 * $_POST["p4"]), "o" => -1 
		)
	);

	//Train the RNA
	$train_result = $rna_class->train($training_array, 1, 1);
	
	/*************** TESTS ***************/
	
	//Defines a set of tests
	$objRespuesta= new clsRespuesta();
	$rst = $objRespuesta->personas('M');
	$cadenaA.="\$testing_array['male'] = array(";
	while($dato=$rst->fetchObject()){
		$nombrepersona=$dato->persona;		
		$cadenaC='';
		if($dato->sexo=='M'){
			$cadenaB.="'$nombrepersona' => array(";
			$rst2 = $objRespuesta->buscar(NULL,$dato->idpersona);
			while($dato2=$rst2->fetchObject()){
				if($dato2->identrada>1){
				$cadenaC.="'x".$dato2->identrada."' => $dato2->valor,";
				}
			}
			$cadenaB.=substr($cadenaC,0,-1)."),";
		}else{
			$cadenaB.="'$nombrepersona' => array(";
			$rst2 = $objRespuesta->buscar(NULL,$dato->idpersona);
			while($dato2=$rst2->fetchObject()){
				if($dato2->identrada>1){
				$cadenaC.="'x".$dato2->identrada."' => $dato2->valor,";
				}
			}
			$cadenaB.=substr($cadenaC,0,-1)."),";
		}
	}	
	$cadenaA.=substr($cadenaB,0,-1).");";
	echo $cadenaA.'<br>';
	eval($cadenaA);
	// Now tests the database ($testing_array data) against the trainned network
	$matchs = array();
	foreach($testing_array[$_POST["sex"]] as $name => $subject_data) {
		//echo $name.'-'.print_r($subject_data).'<br>';
		if ($rna_class->test_class($subject_data, $train_result) == true) {
			$matchs[] = $name;
		}
	}
	
	// Prints the names of people that fit the same class in wich the user input was applied to
	echo "El Sistema encontro " . count($matchs) . " persona(s) que coinciden con su perfil: " . implode(", ", $matchs) . ".";
?>
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
</body>
</html>
<?php
require("../footer.php");
?>