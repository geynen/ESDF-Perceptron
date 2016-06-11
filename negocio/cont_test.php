<?php
//Autor: Geynen Rossler Montenegro Cochas (geynen@gmail.com)
//Fecha: 24 03 2012
session_start();
/*if(!isset($_SESSION['IdUsuario_SA']))
{
	header("location: ../presentacion/login.php?error=1");
}*/

require("../datos/cado.php");
include_once("cls_respuesta.php");
include_once("cls_perfilbuscado.php");
include_once("cls_rubro.php");
include_once("cls_entrada.php");
require("../negocio/cls_tipocriterio.php");

controlador($_GET['accion']);

function controlador($accion)
{
  

  if($accion=='NUEVO'){
	  $objRespuesta = new clsRespuesta();
	  $objTipoCriterio = new clsTipoCriterio();
	  $objRubro = new clsRubro();
	  $objEntrada = new clsEntrada();
	  	try{
			global $cnx;
			$cnx->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION); 
			$cnx->beginTransaction();
			
			if($_SESSION['Tipo']==2){
				require_once("../negocio/cls_postulante.php");
				$ObjPostulante= new clsPostulante();
				$ObjPostulante->insertar($_POST['txtIdPersona'],$_POST['txtIdConvocatoria']);	
				$rst=$ObjPostulante->obtenerLastId();
				$dato=$rst->fetchObject();
				$idpostulante=$dato->idpostulante;
			}else{
				$idpostulante=$_POST['txtIdPostulante'];
			}
  
			$objRespuesta->eliminar(NULL,$_POST['txtIdConvocatoria'],$idpostulante);
			$rst1 = $objRubro->consultarbusqueda(NULL,$_POST['txtIdPerfil']);
			while($datoRubro = $rst1->fetchObject()){
				$rst=$objEntrada->consultarbusqueda(NULL,$datoRubro->idrubro);
				$idrubro=$datoRubro->idrubro;
				while($datoentrada=$rst->fetchObject()){
					$identrada=$datoentrada->identrada;
					/*echo '<br>grupo1<br>';
					echo $_POST['opt1'];
					echo '<br>grupo<br>';
					echo $_POST['optg2'];*/
					if($datoRubro->tipo=='M'){
						eval("if(\$_POST['opt".$identrada."']){\$objRespuesta->insertar(".$_POST['txtIdConvocatoria'].",".$idpostulante.", ".$identrada.",1);}else{\$objRespuesta->insertar(".$_POST['txtIdConvocatoria'].",".$idpostulante.", ".$identrada.",-1);}");
						//echo "if(\$_POST['opt".$identrada."']){\$objRespuesta->insertar(".$idpostulante.", ".$identrada.",1)}else{\$objRespuesta->insertar(".$idpostulante.", ".$identrada.",-1)};<br>";
					}else{
						eval("if(\$_POST['optg".$idrubro."']==".$identrada."){\$objRespuesta->insertar(".$_POST['txtIdConvocatoria'].",".$idpostulante.", ".$identrada.",1);}else{\$objRespuesta->insertar(".$_POST['txtIdConvocatoria'].",".$idpostulante.", ".$identrada.",-1);}");
						//echo "if(\$_POST['optg".$idrubro."']==".$identrada."){\$objRespuesta->insertar(".$idpostulante.", ".$identrada.",1)}else{\$objRespuesta->insertar(".$idpostulante.", ".$identrada.",-1)};<br>";
					}
				}
			}

			$cnx->commit(); 
			echo "<script>alert('Guardado correctamente!!');</script>";
			echo "<META HTTP-EQUIV=Refresh CONTENT='0;URL= ../presentacion/list_personatest.php?IdPerfil=".$_POST['txtIdPerfil']."&IdConvocatoria=".$_POST['txtIdConvocatoria']."'>";
			//header('Location: ../presentacion/resultadofinal.php');
			return 1;
		} catch (Exception $e) { 
			$cnx->rollBack(); 
			echo "Error de Proceso en Lotes: " . $e->getMessage();
		}   
	 }
	if($accion=='NUEVO-PERFILBUSCADO'){
	  $objRespuesta = new clsPerfilBuscado();
	  $objTipoCriterio = new clsTipoCriterio();
	  $objRubro = new clsRubro();
	  $objEntrada = new clsEntrada();
	  	try{
			global $cnx;
			$cnx->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION); 
			$cnx->beginTransaction();
			
			$objRespuesta->eliminar(NULL,$_POST['txtIdConvocatoria']);
			$rst1 = $objRubro->consultarbusqueda(NULL,$_POST['txtIdPerfil']);
			while($datoRubro = $rst1->fetchObject()){
				$rst=$objEntrada->consultarbusqueda(NULL,$datoRubro->idrubro);
				$idrubro=$datoRubro->idrubro;
				while($datoentrada=$rst->fetchObject()){
					$identrada=$datoentrada->identrada;
					/*echo '<br>grupo1<br>';
					echo $_POST['opt1'];
					echo '<br>grupo<br>';
					echo $_POST['optg2'];*/
					if($datoRubro->tipo=='M'){
						eval("if(\$_POST['opt".$identrada."']){\$objRespuesta->insertar(".$_POST['txtIdConvocatoria'].", ".$identrada.",1);}else{\$objRespuesta->insertar(".$_POST['txtIdConvocatoria'].", ".$identrada.",-1);}");
						//echo "if(\$_POST['opt".$identrada."']){\$objRespuesta->insertar(".$_POST['txtIdPersona'].", ".$identrada.",1)}else{\$objRespuesta->insertar(".$_POST['txtIdPersona'].", ".$identrada.",-1)};<br>";
					}else{
						eval("if(\$_POST['optg".$idrubro."']==".$identrada."){\$objRespuesta->insertar(".$_POST['txtIdConvocatoria'].", ".$identrada.",1);}else{\$objRespuesta->insertar(".$_POST['txtIdConvocatoria'].", ".$identrada.",-1);}");
						//echo "if(\$_POST['optg".$idrubro."']==".$identrada."){\$objRespuesta->insertar(".$_POST['txtIdPersona'].", ".$identrada.",1)}else{\$objRespuesta->insertar(".$_POST['txtIdPersona'].", ".$identrada.",-1)};<br>";
					}
				}
			}

			$cnx->commit(); 
			echo "<script>alert('Guardado correctamente!!');</script>";
			echo "<META HTTP-EQUIV=Refresh CONTENT='0;URL= ../presentacion/list_convocatoria.php?IdPerfil=".$_POST['txtIdPerfil']."'>";
			//header('Location: ../presentacion/resultadofinal.php');
			return 1;
		} catch (Exception $e) { 
			$cnx->rollBack(); 
			echo "Error de Proceso en Lotes: " . $e->getMessage();
		}   
	 }
}
?>