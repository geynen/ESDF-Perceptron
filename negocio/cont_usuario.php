<?php
require("../datos/cado.php");
controlador($_GET['accion']);
//echo 'ok';
function controlador($accion)
{
if($accion=='NUEVO') {
	require("cls_usuario.php");
	$ObjUsuario = new clsUsuario();
	try{
		global $cnx;
		$cnx->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION); 
		$cnx->beginTransaction();
		
		$ObjUsuario->insertar($_POST['txtCodigo'], $_POST['txtApellidoPaterno'], 
		$_POST['txtApellidoMaterno'], $_POST['txtNombres'], $_POST['txtFechaNacimiento'], 
		$_POST['txtLugarNacimiento'], $_POST['cboSexo'], $_POST['txtNroDoc'], $_POST['txtDireccion'], 
		$_POST['cboEstadoCivil'], $_POST['txtTelefonoFijo'], $_POST['txtTelefonoMovil'], 
		$_POST['txtEmail']);

		$rst=$ObjUsuario->obtenerLastId();
		$dato=$rst->fetchObject();
			
		$ObjUsuario->insertarUsuario($dato->IdPersona,$_POST['txtUsuario'], md5($_POST['txtClave']), $_POST['txtTipoUsuario']);
			
		$cnx->commit(); 
		header('Location: ../Inicio.php');
		return 1;
	} catch (Exception $e) { 
		$cnx->rollBack(); 
		echo "Error de Proceso en Lotes: " . $e->getMessage();
	}   
}
if($accion=='ACTUALIZAR-USER'){
	require("cls_usuario.php");
	$ObjUsuario = new clsUsuario();
	try{
		global $cnx;
		$cnx->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION); 
		$cnx->beginTransaction();
		
		$ObjUsuario->actualizar($_POST['txtIdPersona'], $_POST['txtCodigo'], $_POST['txtApellidoPaterno'], $_POST['txtApellidoMaterno'], $_POST['txtNombres'], $_POST['txtFechaNacimiento'], $_POST['txtLugarNacimiento'], $_POST['cboSexo'], $_POST['txtNroDoc'], $_POST['txtDireccion'], $_POST['cboEstadoCivil'], $_POST['txtTelefonoFijo'], $_POST['txtTelefonoMovil'], $_POST['txtEmail']);
	
		if($_POST['txtUsuario']!=''){
			if($_POST['txtClave']!=''){
				$ObjUsuario->actualizarUsuario($_POST['txtIdPersona'],$_POST['txtUsuario'], md5($_POST['txtClave']));
			}else{
				$ObjUsuario->actualizarUsuario($_POST['txtIdPersona'],$_POST['txtUsuario'], '');
			}
		}
		
		$cnx->commit(); 
		header('Location: ../presentacion/main_usuario.php');
		return 1;
	} catch (Exception $e) { 
		$cnx->rollBack(); 
		echo "Error de Proceso en Lotes: " . $e->getMessage();
	}   
}
if($accion=='LOGEO') {
	
	if($_POST['txtusuario']!=''){
		$usuario=$_POST['txtusuario'];
		$clave=md5($_POST['txtclave']);
			
		//$sql="SELECT idusuario,idpersona,login,clave,idtipousuario,FOTO FROM usuario 
		$sql="SELECT idusuario,U.idpersona,login,clave,idtipousuario,P.foto FROM usuario U inner join 
		persona P on P.idpersona=U.idpersona
		where login='$usuario'and clave='$clave'";
		global $cnx;
		$rs=$cnx->query($sql);
		$cant=$rs->rowCount();
		
		if($cant==1){
			session_start();
			$registro=$rs->fetchObject();
			$_SESSION['Id']=$registro->idusuario;
			$_SESSION['Cod']=$registro->idpersona;
			$_SESSION['Nombre']=$usuario;
			$_SESSION['Nombre']=$registro->login;
			$_SESSION['Tipo']=$registro->idtipousuario;
			if(isset($registro->foto) and $registro->foto!=''){
				$_SESSION['fot']=$registro->foto;
			}else{
				$_SESSION['fot']="usuario.gif";
			}
				
			if($_SESSION['Tipo']==1) header ("location: ../presentacion/main.php");
			if($_SESSION['Tipo']==2) header ("location: ../presentacion/main_usuario.php");
		}else{
				header("location:../inicio.php");
		}
	}else{
		header("location:../inicio.php");
	}
}
}
?>