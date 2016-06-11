<?php
session_start();
/*if(!isset($_SESSION['IdUsuario_SA']))
{
	header("location: ../presentacion/login.php?error=1");
}*/

require("../datos/cado.php");
include_once("cls_perfil.php");

controlador($_GET['accion']);

function controlador($accion)
{
  $objPerfil = new clsPerfil();

  if($accion=='NUEVO'){
	$objPerfil->insertar($_POST['txtNombre'],$_POST['txtDescripcion']);
	header('Location: ../presentacion/list_perfil.php'); 	      
	 }
	 
  if($accion=='ACTUALIZAR'){
	$objPerfil->actualizar($_POST['txtIdPerfil'],$_POST['txtNombre'],$_POST['txtDescripcion']);
	header('Location: ../presentacion/list_perfil.php');
}

  if($accion=='ELIMINAR'){
		$objPerfil->eliminar($_GET['IdPerfil']);
		echo "<META HTTP-EQUIV=Refresh CONTENT='0;URL= ../presentacion/list_perfil.php'>";

	}
}
?>