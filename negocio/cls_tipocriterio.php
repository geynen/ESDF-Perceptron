<?php
class clsTipoCriterio
{
function insertar($descripcion)
 {
   $sql = "INSERT INTO TIPO_CRITERIO(idtipocriterio,descripcion,estado) VALUES(NULL,UPPER('" . $descripcion . "'),'N')";
   global $cnx;
   return $cnx->query($sql);   	
 }

function obtenerLastId()
 {
   $sql = "SELECT LAST_INSERT_ID() as idtipocriterio";
   global $cnx;
   return $cnx->query($sql);  	 	
 }

function actualizar($idtipocriterio, $descripcion)
 {
   $sql = "UPDATE TIPO_CRITERIO SET descripcion=UPPER('" . $descripcion . "'), estado='N' WHERE idtipocriterio = " . $idtipocriterio ;
   global $cnx;
   return $cnx->query($sql);   	 	
 }

function eliminar($idtipocriterio)
 {
/*   $sql = "DELETE FROM TIPO_CRITERIO WHERE idtipocriterio = " . $idtipocriterio;*/
     $sql = "UPDATE TIPO_CRITERIO SET estado='A' WHERE idtipocriterio = " . $idtipocriterio ;
	global $cnx;
   return $cnx->query($sql);   	 	
 }
 
function vaciar()
 {
   $sql = "DELETE FROM TIPO_CRITERIO";
   global $cnx;
   return $cnx->query($sql);  	 	
 }

function consultar()
 {
   $sql = "SELECT idtipocriterio, descripcion, comentario,estado FROM TIPO_CRITERIO WHERE estado='N'";
   global $cnx;
   return $cnx->query($sql);  	 	
 }

function buscar($idtipocriterio)
 {
   $sql = "SELECT idtipocriterio,descripcion,comentario,estado FROM TIPO_CRITERIO WHERE 1=1";
   if(isset($idtipocriterio)){ $sql.=" and idtipocriterio=".$idtipocriterio;}
   global $cnx;
   return $cnx->query($sql);   	 	
 }
 
 
}
?>