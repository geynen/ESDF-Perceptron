<?php
session_start();
/*if(!isset($_SESSION['IdUsuario_SA']))
{
	header("location: ../presentacion/login.php?error=1");
}*/

require("../datos/cado.php");
include_once("cls_rubro.php");

controlador($_GET['accion']);

function controlador($accion)
{
  $objRubro = new clsRubro();

  if($accion=='NUEVO'){
	$objRubro->insertar($_POST['txtDescripcion'],$_POST['txtPuntaje'],$_POST['cboTipo'],$_POST['txtIdPerfil']);
	header('Location: ../presentacion/list_rubro.php?IdPerfil='.$_POST['txtIdPerfil']); 	      
	 }
	 
  if($accion=='ACTUALIZAR'){
	$objRubro->actualizar($_POST['txtIdRubro'],$_POST['txtDescripcion'],$_POST['txtPuntaje'],$_POST['cboTipo'],$_POST['txtIdPerfil']);
	header('Location: ../presentacion/list_rubro.php?IdPerfil='.$_POST['txtIdPerfil']);
}

  if($accion=='ELIMINAR'){
		$objRubro->eliminar($_GET['IdRubro']);
		echo "<META HTTP-EQUIV=Refresh CONTENT='0;URL= ../presentacion/list_rubro.php?IdPerfil=".$_POST['txtIdPerfil']."'>";

	}
}
?>