<?php
class clsPerfil
{
function insertar($nombre,$descripcion)
 {
   $sql = "INSERT INTO perfil (idperfil, nombre, descripcion, estado) 
   VALUES(NULL, UPPER('".$nombre."'), UPPER('".$descripcion."'),'N')";
   global $cnx;
   return $cnx->query($sql);   	
 }

function obtenerLastId()
 {
   $sql = "SELECT LAST_INSERT_ID() as idperfil";
   global $cnx;
   return $cnx->query($sql);  	 	
 }

function actualizar($idperfil, $nombre,$descripcion)
 {
   $sql = "UPDATE perfil SET nombre=UPPER('" . $nombre . "'),descripcion=UPPER('".$descripcion."'),estado='N' WHERE idperfil = " . $idperfil ;
   global $cnx;
   return $cnx->query($sql);   	 	
   //echo $sql;
 }

function eliminar($idperfil)
 {
/*   $sql = "DELETE FROM perfil WHERE idperfil = " . $idperfil;*/
     $sql = "UPDATE perfil SET estado='A' WHERE idperfil = " . $idperfil ;
	global $cnx;
   return $cnx->query($sql);   	 	
 }
 
function vaciar() 
 {
   $sql = "DELETE FROM perfil";
   global $cnx;
   return $cnx->query($sql);  	 	
 }

function consultar()
 {
   $sql = "SELECT * FROM perfil  WHERE estado='N'";
   global $cnx;
   return $cnx->query($sql);  	 	
 }

function consultarbusqueda($descripcion)
{
  $sql = "SELECT * FROM perfil WHERE estado='N'";
  if($descripcion!="")
  { 
  $sql = $sql." AND descripcion LIKE '%". $descripcion ."%'";
  }
  
   global $cnx;
   return $cnx->query($sql); 

}

function buscar($idperfil,$idtipocriterio=0, $tipo='')
 {
   $sql = "SELECT * FROM perfil WHERE 1=1 ";
   if($idperfil>0) $sql.=" AND idperfil=".$idperfil;
  /* if($idtipocriterio>0) $sql.=" AND idtipocriterio=".$idtipocriterio;
   if($tipo<>'') $sql.=" AND tipo='".$tipo."'";*/
   global $cnx;
   return $cnx->query($sql);   	 	
 }
}
?>