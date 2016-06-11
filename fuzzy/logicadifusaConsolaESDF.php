<?php 
/***************************************************************
*  
*      (c) 2011 Ing. Geynen Rossler Montenegro Cochas (geynen_0710@hotmail.com)
*      All rights reserved
*
*	   BSD Licence
*
***************************************************************/
?>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
</head>
<body bgcolor="#FFFFFF" style="color:inherit">
<?php
require("../datos/cado.php");
require_once ('fuzzy-logic-class.php');
require("../negocio/cls_tipocriterio.php");
require("../negocio/cls_membresia.php");
require("../negocio/cls_variablelinguistica.php");
require("../negocio/cls_regla.php");
require("../negocio/cls_respuesta.php");
//class FuzzySEPER{
	
	//function obtenerPersonaMejorPerfil($idpersona){
		
	if(isset($_GET['idpersona'])){	
		$idpersona=$_GET['idpersona'];
	}else{
		$idpersona=1;
	}
	$idmembresia=34;
	
	//echo 'PERSONA:'.$idpersona;
	echo "ESDF Logic Fuzzy: Modo Consola";
		$x = new Fuzzy_Logic();
		$x->clearMembers(); 


		$objTipoCriterio = new clsTipoCriterio();
		$objMembresia = new clsMembresia();
		$objVariable = new clsVariableLinguistica();
		
		$rstMF=$objMembresia->buscar($idmembresia);
		$datoMF=$rstMF->fetchObject();
		$membresiafinal=str_replace(' ','_',$datoMF->descripcion);
		
		//AGREGO MEMBRESIAS DE ENTRADA		
		$rstTC = $objTipoCriterio->buscar(NULL);
		$membresias='';
		$variables='';
		$indice=0;
		while($datoTC = $rstTC->fetchObject()){
			$rst = $objMembresia->buscarxcriteriodesdeFuzzy($datoTC->idtipocriterio);
			while($dato = $rst->fetchObject()){
				if($dato->tipo=='I'){
				$rstvariable = $objVariable->buscarxMembresia($dato->idmembresia);
				if($rstvariable->rowCount()>0){
					$membresias.="'".str_replace(' ','_',$dato->descripcion)."',";
					while($datovariable = $rstvariable->fetchObject()){
						$variables.="\$x->addMember(\$x->getInputName($indice),'".str_replace(' ','_',$datovariable->nombre)."',  $datovariable->valorinicial, $datovariable->valormedio, $datovariable->valorfinal ,$datovariable->tipomembresia);";
					}
					$indice++;
				}
				}
			}
		}
		echo '<BR><BR><HR><fieldset><legend>ENTRADAS</legend>';
		echo '<BR><HR>MEMBRESIAS<br><BR>';
		echo str_replace(',',',<br>',$membresias).'<br>';
		echo '<BR><HR>VARIABLES LINGUISTICAS<br><BR>';
		echo str_replace(';',';<br>',$variables).'</fieldset><br>';
		
		$membresias=substr($membresias,0,strlen($membresias)-1);
		eval("\$x->SetInputNames(array(".$membresias."));");	
		eval($variables);
		$membresias='';
		$variables='';
		$indice=0;
		//while($datoTC = $rstTC->fetchObject()){
			$rst2 = $objMembresia->buscarxcriteriodesdeFuzzy(NULL);
			while($dato = $rst2->fetchObject()){
				if($dato->tipo=='O'){
					$rstvariable = $objVariable->buscarxMembresia($dato->idmembresia);
					if($rstvariable->rowCount()>0){
						$membresias.="'".str_replace(' ','_',$dato->descripcion)."',";
						while($datovariable = $rstvariable->fetchObject()){
							$variables.="\$x->addMember(\$x->getOutputName($indice),'".str_replace(' ','_',$datovariable->nombre)."',  $datovariable->valorinicial, $datovariable->valormedio, $datovariable->valorfinal ,$datovariable->tipomembresia);";
						}
						$indice++;
					}
				}
			}
		//}

		echo '<br><BR><HR><fieldset><legend>SALIDAS</legend>';
		echo '<BR><HR>MEMBRESIAS<br><BR>';
		echo str_replace(',',',<br>',$membresias).'<br>';
		eval("\$x->SetOutputNames(array(".$membresias."));");	
		echo '<BR><HR>VARIABLES LINGUISTICAS<br><BR>';
		echo str_replace(';',';<br>',$variables).'</fieldset><br>';
		
		$membresias=substr($membresias,0,strlen($membresias)-1);
		eval("\$x->SetOutputNames(array(".$membresias."));");	
		eval($variables);
		
		echo '<br><BR><HR><fieldset><legend>REGLAS</legend>';
		$objRegla = new clsRegla();
		$rstregla=$objRegla->consultar();
		$x->clearRules();
		while ($datoregla=$rstregla->fetchObject()){
			echo '$x->addRule(\'IF '.str_replace(' ','_',$datoregla->membresia_input1).'.'.str_replace(' ','_',$datoregla->variable_input1).' '.$datoregla->operadorlogico.' '.str_replace(' ','_',$datoregla->membresia_input2).'.'.str_replace(' ','_',$datoregla->variable_input2).' THEN '.str_replace(' ','_',$datoregla->membresia_output).'.'.str_replace(' ','_',$datoregla->variable_output).'\');<br>';
			$x->addRule('IF '.str_replace(' ','_',$datoregla->membresia_input1).'.'.str_replace(' ','_',$datoregla->variable_input1).' '.$datoregla->operadorlogico.' '.str_replace(' ','_',$datoregla->membresia_input2).'.'.str_replace(' ','_',$datoregla->variable_input2).' THEN '.str_replace(' ','_',$datoregla->membresia_output).'.'.str_replace(' ','_',$datoregla->variable_output));
		}
		echo '</fieldset>';
		
		//INTERACCION 1
		$objRespuesta = new clsRespuesta();
		$rstrpta=$objRespuesta->buscarxPersona($idpersona);
		echo '<br><br><HR>INSERTO DATOS REALES (TEST)<br>';
		while ($datorpta=$rstrpta->fetchObject()){
			$xx.= "\$x->SetRealInput('".str_replace(' ','_',$datorpta->membresia)."',$datorpta->valor);";
			$x->SetRealInput(str_replace(' ','_',$datorpta->membresia),$datorpta->valor);
		}
		
		echo $xx;
		
		$fuzzy_arr = $x->calcFuzzy();
		echo '<BR><br><HR>RESULTADO INTERACCION 1<br>';
		//print_r($fuzzy_arr);
		foreach($fuzzy_arr as $membresia => $v){
			if($v!=0){
			echo $membresia.': ';
			echo $v.'<br>';
			}
		}
		
		$membresia='';
		$valormembresiafinal=0;
		$i=2;
		do{
			echo '<BR><br><HR>RESULTADO INTERACCION '.$i.'<br>';
			foreach($fuzzy_arr as $membresia => $v){
				if($v!=0){
				$x->SetRealInput($membresia,$v);
				}
			}
			$fuzzy_arr = $x->calcFuzzy();
			foreach($fuzzy_arr as $membresia => $v){
				if($v!=0){
					echo $membresia.': ';
					echo $v.'<br>';
					if($membresia==$membresiafinal) $valormembresiafinal=$v;
				}
			}
			//la condicion indica el numero maximo de interacciones permitidas antes de mostrar el resultado
			if($i==5) $valormembresiafinal=1;
			$i++;
		}while($valormembresiafinal==0);
		
		//echo '<BR><br>RESULTADO<br>';
		echo '<BR><br><HR>RESULTADO FINAL:<br>';
		$puntaje = $fuzzy_arr[$membresiafinal];
		echo $membresiafinal.': '.$puntaje;
		
		$grados = $x->getGradosPertenencia($membresiafinal,$puntaje);
		echo "<br>GRADOS DE PERTENECIA: ";
		foreach($grados as $i => $v){
			if($v!=0) {$p=$v*100; $pertenencia .= $p.'%&nbsp;'.$x->getNameMember($membresiafinal, $i).'<br>';}
		}
		echo $pertenencia;
		
		require("../presentacion/graficodifuso.php");
?>
</body>
</html>