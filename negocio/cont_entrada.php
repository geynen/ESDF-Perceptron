<?php
session_start();
/*if(!isset($_SESSION['IdUsuario_SA']))
{
	header("location: ../presentacion/login.php?error=1");
}*/

require("../datos/cado.php");
include_once("cls_entrada.php");

controlador($_GET['accion']);

function controlador($accion)
{
  $objEntrada = new clsEntrada();

  if($accion=='NUEVO'){
	$objEntrada->insertar($_POST['txtDescripcion'],$_POST['txtcomentario'],$_POST['txtRespuestaPositivo'],$_POST['txtRespuestaNegativo'],$_POST['txtPuntaje'],$_POST['txtIdRubro']);
	header('Location: ../presentacion/list_entradas.php?IdRubro='.$_POST['txtIdRubro'].'&IdPerfil='.$_POST['txtIdPerfil']); 	      
	 }
	 
  if($accion=='ACTUALIZAR'){
	$objEntrada->actualizar($_POST['txtIdEntrada'],$_POST['txtDescripcion'],$_POST['txtcomentario'],$_POST['txtRespuestaPositivo'],$_POST['txtRespuestaNegativo'],$_POST['txtPuntaje'],$_POST['txtIdRubro']);
	header('Location: ../presentacion/list_entradas.php?IdRubro='.$_POST['txtIdRubro'].'&IdPerfil='.$_POST['txtIdPerfil']);
}

  if($accion=='ELIMINAR'){
		$objEntrada->eliminar($_GET['IdEntrada']);
		echo "<META HTTP-EQUIV=Refresh CONTENT='0;URL= ../presentacion/list_entradas.php?IdRubro=".$_POST['txtIdRubro']."&IdPerfil=".$_POST['txtIdPerfil']."'>";

	}
}
?>