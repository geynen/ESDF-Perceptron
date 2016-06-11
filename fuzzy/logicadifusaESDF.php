<?php
/***************************************************************
*  
*      (c) 2011 Ing. Geynen Rossler Montenegro Cochas (geynen_0710@hotmail.com)
*      All rights reserved
*
*	   BSD Licence
*
***************************************************************/
require("../datos/cado.php");
require_once ('fuzzy-logic-class.php');
require("../negocio/cls_tipocriterio.php");
require("../negocio/cls_membresia.php");
require("../negocio/cls_variablelinguistica.php");
require("../negocio/cls_regla.php");
require("../negocio/cls_respuesta.php");
class FuzzySEPER{
	
	public $gradoPertenencia;
	
	function obtenerPuntaje($idpersona){
/*	$idconvocatoria=2;
	$idpersona=5;
	$idcargo=1;
*/		
		//$membresiafinal='PIE_DIABETICO';
		$idmembresia=34;
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

		$membresias=substr($membresias,0,strlen($membresias)-1);
		eval("\$x->SetOutputNames(array(".$membresias."));");	
		eval($variables);
		
		$objRegla = new clsRegla();
		$rstregla=$objRegla->consultar();
		$x->clearRules();
		while ($datoregla=$rstregla->fetchObject()){
			$x->addRule('IF '.str_replace(' ','_',$datoregla->membresia_input1).'.'.str_replace(' ','_',$datoregla->variable_input1).' '.$datoregla->operadorlogico.' '.str_replace(' ','_',$datoregla->membresia_input2).'.'.str_replace(' ','_',$datoregla->variable_input2).' THEN '.str_replace(' ','_',$datoregla->membresia_output).'.'.str_replace(' ','_',$datoregla->variable_output));
		}
		
		//INTERACCION 1
		$objRespuesta = new clsRespuesta();
		$rstrpta=$objRespuesta->buscarxPersona($idpersona);
		while ($datorpta=$rstrpta->fetchObject()){
			$xx.= "\$x->SetRealInput('".str_replace(' ','_',$datorpta->membresia)."',$datorpta->valor);";
			$x->SetRealInput(str_replace(' ','_',$datorpta->membresia),$datorpta->valor);
		}
		//echo '<BR><br>RESULTADO<br>';
		$fuzzy_arr = $x->calcFuzzy();
		
		$membresia='';
		$valormembresiafinal=0;
		$i=2;
		do{
			//echo '<BR><br><HR>RESULTADO INTERACCION '.$i.'<br>';
			foreach($fuzzy_arr as $membresia => $v){
				if($v!=0){
				$x->SetRealInput($membresia,$v);
				}
			}
			$fuzzy_arr = $x->calcFuzzy();
			foreach($fuzzy_arr as $membresia => $v){
				if($v!=0){
					//echo $membresia.': ';
					//echo $v.'<br>';
					if($membresia==$membresiafinal) $valormembresiafinal=$v;
				}
			}
			//la condicion indica el numero maximo de interacciones permitidas antes de mostrar el resultado
			if($i==5) $valormembresiafinal=1;
			$i++;
		}while($valormembresiafinal==0);
		
		//echo '<BR><br>RESULTADO<br>';
		//echo '<BR><br><HR>RESULTADO FINAL:<br>';
		$puntaje = $fuzzy_arr[$membresiafinal];
		
		$grados = $x->getGradosPertenencia($membresiafinal,$puntaje);
		///echo "<br>grados de pertenencia<br>";
		///print_r($grados);
		foreach($grados as $i => $v){
			if($v!=0) {$p=$v*100; $this->gradoPertenencia = $p.'%&nbsp;'.$x->getNameMember($membresiafinal, $i).'<br>';}
		}
		
		return $puntaje;
	}
	
	function obtenerGradosPertenecia($puntaje){
		return $this->gradoPertenencia;
	}
	
	function obtenerGradosPerteneciaPersonaMejorPerfil($puntaje){
		$x = new Fuzzy_Logic();
		$x->clearMembers(); 
		$x->SetInputNames(array('POSTULANTE_CON_MEJOR_PERFIL'));	
		$x->addMember($x->getInputName(0),'NO_RECOMENDADO', 0.00, 10.00, 30.00 ,LINFINITY);
		$x->addMember($x->getInputName(0),'POCO_RECOMENDADO', 20.00, 35.00, 50.00 ,TRIANGLE);
		$x->addMember($x->getInputName(0),'RECOMENDADO', 40.00, 55.00, 70.00 ,TRIANGLE);
		$x->addMember($x->getInputName(0),'MUY_RECOMENDADO', 60.00, 80.00, 90.00 ,RINFINITY);

		$grados = $x->getGradosPertenencia('POSTULANTE_CON_MEJOR_PERFIL',$puntaje);
		///echo "<br>grados de pertenencia<br>";
		///print_r($grados);
		foreach($grados as $i => $v){
			if($v!=0) {$p=$v*100; echo $p.'%&nbsp;'.$x->getNameMember('POSTULANTE_CON_MEJOR_PERFIL', $i).'<br>';}
		}
	}
	
	function obtenerGradosPerteneciaExamenConocimiento($puntaje){
		$x = new Fuzzy_Logic();
		$x->clearMembers(); 
		$x->SetInputNames(array('CALIFICACION_EXAMEN_CONOCIMIENTO'));	
		$x->addMember($x->getInputName(0),'BAJO', 0.00, 2.00, 10.00 ,LINFINITY);
		$x->addMember($x->getInputName(0),'MEDIO', 5.00, 10.00, 15.00 ,TRIANGLE);
		$x->addMember($x->getInputName(0),'ALTO', 10.00, 18.00, 20.00 ,RINFINITY);

		$grados = $x->getGradosPertenencia('CALIFICACION_EXAMEN_CONOCIMIENTO',$puntaje);
		///echo "<br>grados de pertenencia<br>";
		///print_r($grados);
		foreach($grados as $i => $v){
			if($v!=0) {$p=$v*100; echo $p.'%&nbsp;'.$x->getNameMember('CALIFICACION_EXAMEN_CONOCIMIENTO', $i).'<br>';}
		}
	}
	
	function obtenerPersonaaElegir($idconvocatoria,$idpersona,$idcargo,$puntaje){
		
		$gdPersonaMejorPerfil=$this->obtenerPersonaMejorPerfil($idconvocatoria,$idpersona,$idcargo);
		$x = new Fuzzy_Logic();
		$x->clearMembers(); 
		$x->SetInputNames(array('POSTULANTE_CON_MEJOR_PERFIL','CALIFICACION_EXAMEN_CONOCIMIENTO'));	
		$x->addMember($x->getInputName(0),'NO_RECOMENDADO', 0.00, 10.00, 30.00 ,LINFINITY);
		$x->addMember($x->getInputName(0),'POCO_RECOMENDADO', 20.00, 35.00, 50.00 ,TRIANGLE);
		$x->addMember($x->getInputName(0),'RECOMENDADO', 40.00, 55.00, 70.00 ,TRIANGLE);
		$x->addMember($x->getInputName(0),'MUY_RECOMENDADO', 60.00, 80.00, 90.00 ,RINFINITY);
		$x->addMember($x->getInputName(1),'BAJO', 0.00, 2.00, 10.00 ,LINFINITY);
		$x->addMember($x->getInputName(1),'MEDIO', 5.00, 10.00, 15.00 ,TRIANGLE);
		$x->addMember($x->getInputName(1),'ALTO', 10.00, 18.00, 20.00 ,RINFINITY);
		
		$x->SetOutputNames(array('POSTULANTE_A_ELEGIR'));	
		$x->addMember($x->getOutputName(0),'NO_RECOMENDADO', 0.00, 10.00, 30.00 ,LINFINITY);
		$x->addMember($x->getOutputName(0),'POCO_RECOMENDADO', 20.00, 35.00, 50.00 ,TRIANGLE);
		$x->addMember($x->getOutputName(0),'RECOMENDADO', 40.00, 55.00, 70.00 ,TRIANGLE);
		$x->addMember($x->getOutputName(0),'MUY_RECOMENDADO', 60.00, 80.00, 90.00 ,RINFINITY);

		$x->addRule('IF POSTULANTE_CON_MEJOR_PERFIL.NO_RECOMENDADO AND CALIFICACION_EXAMEN_CONOCIMIENTO.BAJO THEN POSTULANTE_A_ELEGIR.NO_RECOMENDADO');
		$x->addRule('IF POSTULANTE_CON_MEJOR_PERFIL.NO_RECOMENDADO AND CALIFICACION_EXAMEN_CONOCIMIENTO.MEDIO THEN POSTULANTE_A_ELEGIR.NO_RECOMENDADO');
		$x->addRule('IF POSTULANTE_CON_MEJOR_PERFIL.NO_RECOMENDADO AND CALIFICACION_EXAMEN_CONOCIMIENTO.ALTO THEN POSTULANTE_A_ELEGIR.NO_RECOMENDADO');
		$x->addRule('IF POSTULANTE_CON_MEJOR_PERFIL.POCO_RECOMENDADO AND CALIFICACION_EXAMEN_CONOCIMIENTO.BAJO THEN POSTULANTE_A_ELEGIR.NO_RECOMENDADO');
		$x->addRule('IF POSTULANTE_CON_MEJOR_PERFIL.POCO_RECOMENDADO AND CALIFICACION_EXAMEN_CONOCIMIENTO.MEDIO THEN POSTULANTE_A_ELEGIR.NO_RECOMENDADO');
		$x->addRule('IF POSTULANTE_CON_MEJOR_PERFIL.POCO_RECOMENDADO AND CALIFICACION_EXAMEN_CONOCIMIENTO.ALTO THEN POSTULANTE_A_ELEGIR.NO_RECOMENDADO');
		$x->addRule('IF POSTULANTE_CON_MEJOR_PERFIL.RECOMENDADO AND CALIFICACION_EXAMEN_CONOCIMIENTO.BAJO THEN POSTULANTE_A_ELEGIR.POCO_RECOMENDADO');
		$x->addRule('IF POSTULANTE_CON_MEJOR_PERFIL.RECOMENDADO AND CALIFICACION_EXAMEN_CONOCIMIENTO.MEDIO THEN POSTULANTE_A_ELEGIR.POCO_RECOMENDADO');
		$x->addRule('IF POSTULANTE_CON_MEJOR_PERFIL.RECOMENDADO AND CALIFICACION_EXAMEN_CONOCIMIENTO.ALTO THEN POSTULANTE_A_ELEGIR.RECOMENDADO');
		$x->addRule('IF POSTULANTE_CON_MEJOR_PERFIL.MUY_RECOMENDADO AND CALIFICACION_EXAMEN_CONOCIMIENTO.BAJO THEN POSTULANTE_A_ELEGIR.RECOMENDADO');
		$x->addRule('IF POSTULANTE_CON_MEJOR_PERFIL.MUY_RECOMENDADO AND CALIFICACION_EXAMEN_CONOCIMIENTO.MEDIO THEN POSTULANTE_A_ELEGIR.MUY_RECOMENDADO');
		$x->addRule('IF POSTULANTE_CON_MEJOR_PERFIL.MUY_RECOMENDADO AND CALIFICACION_EXAMEN_CONOCIMIENTO.ALTO THEN POSTULANTE_A_ELEGIR.MUY_RECOMENDADO');

		$x->SetRealInput('POSTULANTE_CON_MEJOR_PERFIL',$gdPersonaMejorPerfil);
		$x->SetRealInput('CALIFICACION_EXAMEN_CONOCIMIENTO',$puntaje);
		//echo $gdPersonaMejorPerfil.'<br>';
		//echo $puntaje;
		$fuzzy_arr = $x->calcFuzzy();
		//print_r($fuzzy_arr);
		$rpta = $fuzzy_arr['POSTULANTE_A_ELEGIR'];
		
		return $rpta;
	}
	
	function obtenerGradosPerteneciaPersonaaElegir($puntaje){
		$x = new Fuzzy_Logic();
		$x->clearMembers(); 
		$x->SetInputNames(array('POSTULANTE_A_ELEGIR'));	
		$x->addMember($x->getInputName(0),'NO_RECOMENDADO', 0.00, 15.00, 30.00 ,LINFINITY);
		$x->addMember($x->getInputName(0),'POCO_RECOMENDADO', 20.00, 35.00, 50.00 ,TRIANGLE);
		$x->addMember($x->getInputName(0),'RECOMENDADO', 40.00, 55.00, 70.00 ,TRIANGLE);
		$x->addMember($x->getInputName(0),'MUY_RECOMENDADO', 60.00, 75.00, 90.00 ,RINFINITY);

		
		$grados = $x->getGradosPertenencia('POSTULANTE_A_ELEGIR',$puntaje);
		///echo "<br>grados de pertenencia<br>";
		///print_r($grados);
		foreach($grados as $i => $v){
			if($v!=0) {$p=$v*100; echo $p.'%&nbsp;'.$x->getNameMember('POSTULANTE_A_ELEGIR', $i).'<br>';}
		}
	}
}
?>