<?php
session_start();
/*if(!isset($_SESSION['IdUsuario_SA']))
{
	header("location: ../presentacion/login.php?error=1");
}*/

require("../datos/cado.php");
include_once("cls_membresia.php");

controlador($_GET['accion']);

function controlador($accion)
{
  $objMembresia = new clsMembresia();

  if($accion=='NUEVO'){
	$objMembresia->insertar($_POST['txtDescripcion'],$_POST['txtcomentario'],$_POST['cboTipoCriterio'],$_POST['cboEntrada'],$_POST['cbocontrol']);
	header('Location: ../presentacion/list_membresia.php'); 	      
	 }
	 
  if($accion=='ACTUALIZAR'){
	$objMembresia->actualizar($_POST['txtIdMembresia'],$_POST['txtDescripcion'],$_POST['txtcomentario'],$_POST['cboTipoCriterio'],$_POST['cboEntrada'],$_POST['cbocontrol']);
	header('Location: ../presentacion/list_membresia.php');
}

  if($accion=='ELIMINAR'){
		$objMembresia->eliminar($_GET['IdMembresia']);
		echo "<META HTTP-EQUIV=Refresh CONTENT='0;URL= ../presentacion/list_membresia.php'>";

	}
}
?>