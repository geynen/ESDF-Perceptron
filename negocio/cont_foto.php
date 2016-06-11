<?php
session_start();
/*if(!isset($_SESSION['IdUsuario_SA']))
{
	header("location: ../presentacion/login.php?error=1");
}*/

require("../datos/cado.php");
include_once("cls_foto.php");

controlador($_GET['accion']);

function controlador($accion)
{
  $objfoto = new clsfoto();

  if($accion=='NUEVO'){
    $nombre_original=$_FILES['file']['name'];
	$tipo=$_FILES['file']['type'];
	$tam=$_FILES['file']['size'];
	$temporal=$_FILES['file']['tmp_name'];
	
	//echo $tipo;
	if($tipo=="image/pjpeg" or $tipo=="image/gif" or $tipo=="image/jpeg")
	//if($tipo=='image/jpeg' or $tipo=="gif" or $tipo=="JPG")
	{
		$objfoto->ActFoto($_SESSION['Cod'],$nombre_original);
		$_SESSION['fot']=$nombre_original;
		copy($temporal,"../foto/$nombre_original");	
		if($_SESSION['Tipo']==2){
			header('Location: ../presentacion/main_usuario.php'); 	      
		}else{
			header('Location: ../presentacion/main.php'); 	      
		}
	}else
	{
		echo " No es un archivo valido ";
	}
   
}
}
?>