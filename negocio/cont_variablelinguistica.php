<?php
session_start();
/*if(!isset($_SESSION['IdUsuario_SA']))
{
	header("location: ../presentacion/login.php?error=1");
}*/

require("../datos/cado.php");
include_once("cls_variablelinguistica.php");

controlador($_GET['accion']);

function controlador($accion)
{
  $objVariableLinguistica = new clsVariableLinguistica();

  if($accion=='NUEVO'){
	$objVariableLinguistica->insertar($_POST['txtNombre'], $_POST['txtValorInicial'], $_POST['txtValorMedio'], $_POST['txtValorFinal'], $_POST['cboMembresia'],$_POST['cboTipoMembresia']);
	if(isset($_GET['IdMembresia'])){
		header('Location: ../presentacion/list_variablelinguistica.php?IdMembresia='.$_GET['IdMembresia']); 	      
	}else{
		header('Location: ../presentacion/list_variablelinguistica.php'); 	      
	}
 }
  if($accion=='ACTUALIZAR'){
	$objVariableLinguistica->actualizar($_POST['txtIdVariable'], $_POST['txtNombre'], $_POST['txtValorInicial'], $_POST['txtValorMedio'], $_POST['txtValorFinal'], $_POST['cboMembresia'], $_POST['cboTipoMembresia']);
	if(isset($_GET['IdMembresia'])){
		header('Location: ../presentacion/list_variablelinguistica.php?IdMembresia='.$_GET['IdMembresia']); 	      
	}else{
		header('Location: ../presentacion/list_variablelinguistica.php'); 	      
	}
}

  if($accion=='ELIMINAR'){
		$objVariableLinguistica->eliminar($_GET['IdVariableLinguistica']);
	if(isset($_GET['IdMembresia'])){
		header('Location: ../presentacion/list_variablelinguistica.php?IdMembresia='.$_GET['IdMembresia']); 	      
	}else{
		header('Location: ../presentacion/list_variablelinguistica.php'); 	      
	}
	}
}
?>