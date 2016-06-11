<?php
session_start();
/*if(!isset($_SESSION['IdUsuario_SA']))
{
	header("location: ../presentacion/login.php?error=1");
}*/

require("../datos/cado.php");
include_once("cls_regla.php");

controlador($_GET['accion']);

function controlador($accion)
{
  $objRegla = new clsRegla();

  if($accion=='NUEVO'){
	$objRegla->insertar($_POST['cboMembresiaInput1'], $_POST['cboVariableInput1'], $_POST['cboOperador'], $_POST['cboMembresiaInput2'], $_POST['cboVariableInput2'],$_POST['cboMembresiaOutput'], $_POST['cboVariableOutput']);
	header('Location: ../presentacion/list_reglas.php'); 	      
 }
  if($accion=='ACTUALIZAR'){
	$objRegla->actualizar($_POST['txtIdRegla'], $_POST['cboMembresiaInput1'], $_POST['cboVariableInput1'], $_POST['cboOperador'], $_POST['cboMembresiaInput2'], $_POST['cboVariableInput2'],$_POST['cboMembresiaOutput'], $_POST['cboVariableOutput']);
	header('Location: ../presentacion/list_reglas.php');
}
  if($accion=='ELIMINAR'){
		$objRegla->eliminar($_GET['IdRegla']);
	header('Location: ../presentacion/list_reglas.php');
	}
}
?>