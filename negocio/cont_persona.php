<?php
session_start();
/*if(!isset($_SESSION['IdUsuario_SA']))
{
	header("location: ../presentacion/login.php?error=1");
}*/

require("../datos/cado.php");
require("cls_persona.php");
controlador($_GET['accion']);

function controlador($accion)
{
  $ObjPersona = new clsPersona();
  if($accion=='NUEVO'){
	try{
		global $cnx;
		$cnx->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION); 
		$cnx->beginTransaction();
		
		$ObjPersona->insertar($_POST['txtCodigo'], $_POST['txtApellidoPaterno'], 
		$_POST['txtApellidoMaterno'], $_POST['txtNombres'], $_POST['txtFechaNacimiento'], 
		$_POST['txtLugarNacimiento'], $_POST['cboSexo'], $_POST['txtNroDoc'], $_POST['txtDireccion'], 
		$_POST['cboEstadoCivil'], $_POST['txtTelefonoFijo'], $_POST['txtTelefonoMovil'], 
		$_POST['txtEmail']);
		
		$rst=$ObjPersona->obtenerLastId();
		$dato=$rst->fetchObject();
		
		require("cls_usuario.php");
		$ObjUsuario = new clsUsuario();
		$ObjUsuario->insertarUsuario($dato->IdPersona,$_POST['txtUsuario'], md5($_POST['txtClave']), $_POST['txtTipoUsuario']);
		
		$cnx->commit(); 
		header('Location: ../presentacion/list_persona.php');
		return 1;
	} catch (Exception $e) { 
		$cnx->rollBack(); 
		echo "Error de Proceso en Lotes: " . $e->getMessage();
	}   
  }
  if($accion=='ACTUALIZAR'){
	$ObjPersona->actualizar($_POST['txtIdPersona'], $_POST['txtCodigo'], $_POST['txtApellidoPaterno'], $_POST['txtApellidoMaterno'], $_POST['txtNombres'], $_POST['txtFechaNacimiento'], $_POST['txtLugarNacimiento'], $_POST['cboSexo'], $_POST['txtNroDoc'], $_POST['txtDireccion'], $_POST['cboEstadoCivil'], $_POST['txtTelefonoFijo'], $_POST['txtTelefonoMovil'], $_POST['txtEmail']);
	//echo "ok".$_POST['txtUsuarioOld'];
	if($_POST['txtUsuarioOld']==''){
		require("cls_usuario.php");
		$ObjUsuario = new clsUsuario();
		$ObjUsuario->insertarUsuario($_POST['txtIdPersona'],$_POST['txtUsuario'], md5($_POST['txtClave']), $_POST['cboTipoUsuario']);
	}else{
		if($_POST['txtClave']!=''){
			require("cls_usuario.php");
			$ObjUsuario = new clsUsuario();
			$ObjUsuario->actualizarUsuario($_POST['txtIdPersona'],$_POST['txtUsuario'], md5($_POST['txtClave']), $_POST['cboTipoUsuario']);
		}
		if($_POST['cboTipoUsuario']!= $_POST['cboTipoUsuarioOld']){
			require("cls_usuario.php");
			$ObjUsuario = new clsUsuario();
			$ObjUsuario->actualizarUsuario($_POST['txtIdPersona'],$_POST['txtUsuario'], '', $_POST['cboTipoUsuario']);
		}
	}

	header('Location: ../presentacion/list_persona.php');
	return 1;
  }
  if($accion=='ELIMINAR'){
    	$ObjPersona->eliminar($_GET['IdPersona']);
	header('Location: ../presentacion/list_persona.php');
	}
  if($accion=='ELIMINAR-POSTULANTE'){
		require("cls_postulante.php");
		$ObjPostulante= new clsPostulante();
		$ObjPostulante->eliminar($_GET['IdPostulante']);
		header('Location: ../presentacion/list_personatest.php?IdConvocatoria='.$_GET['IdConvocatoria'].'&IdPerfil='.$_GET['IdPerfil'].'');
	}
}
?>