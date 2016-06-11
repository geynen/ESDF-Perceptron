<?php
session_start();
/*if(!isset($_SESSION['IdUsuario_SA']))
{
	header("location: ../presentacion/login.php?error=1");
}*/

require("../datos/cado.php");
include_once("cls_convocatoria.php");

controlador($_GET['accion']);

function controlador($accion)
{
  $objConvocatoria = new clsConvocatoria();

  if($accion=='NUEVO'){
	$objConvocatoria->insertar($_POST['txtNombre'],$_POST['txtIdPerfil'],$_POST['txtFechaInicio'],$_POST['txtFechaFin']);
	header('Location: ../presentacion/list_convocatoria.php?IdPerfil='.$_POST['txtIdPerfil']); 	      
	 }
	 
  if($accion=='ACTUALIZAR'){
	$objConvocatoria->actualizar($_POST['txtIdConvocatoria'],$_POST['txtNombre'],$_POST['txtIdPerfil'],$_POST['txtFechaInicio'],$_POST['txtFechaFin']);
	header('Location: ../presentacion/list_convocatoria.php?IdPerfil='.$_POST['txtIdPerfil']);
}

  if($accion=='ELIMINAR'){
		$objConvocatoria->eliminar($_GET['IdConvocatoria']);
		echo "<META HTTP-EQUIV=Refresh CONTENT='0;URL= ../presentacion/list_convocatoria.php?IdPerfil=".$_POST['txtIdPerfil']."'>";

	}
}
?>