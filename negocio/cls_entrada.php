<?php
class clsEntrada
{
function insertar($descripcion,$comentario, $respuestap, $respuestan, $puntaje, $idrubro)
 {
   $sql = "INSERT INTO entradas (identrada, descripcion, comentario, respuesta_positivo, respuesta_negativo, puntaje, idrubro, estado) 
   VALUES(NULL, '".$descripcion."', '".$comentario."', '".$respuestap."', '".$respuestan."', ".$puntaje.", ".$idrubro.",'N')";
   global $cnx;
   return $cnx->query($sql);   	
 }

function obtenerLastId()
 {
   $sql = "SELECT LAST_INSERT_ID() as identrada";
   global $cnx;
   return $cnx->query($sql);  	 	
 }

function actualizar($identrada, $descripcion,$comentario, $respuestap, $respuestan, $puntaje, $idrubro)
 {
   $sql = "UPDATE entradas SET descripcion='" . $descripcion . "',comentario='".$comentario."',respuesta_positivo='".$respuestap."',respuesta_negativo='".$respuestan."',puntaje=".$puntaje.",idrubro=".$idrubro.",estado='N' WHERE identrada = " . $identrada ;
   global $cnx;
   return $cnx->query($sql);   	 	
   //echo $sql;
 }

function eliminar($identrada)
 {
/*   $sql = "DELETE FROM entradas WHERE identrada = " . $identrada;*/
     $sql = "UPDATE entradas SET estado='A' WHERE identrada = " . $identrada ;
	global $cnx;
   return $cnx->query($sql);   	 	
 }
 
function vaciar() 
 {
   $sql = "DELETE FROM entradas";
   global $cnx;
   return $cnx->query($sql);  	 	
 }

function consultar()
 {
   $sql = "SELECT * FROM entradas  WHERE estado='N'";
   global $cnx;
   return $cnx->query($sql);  	 	
 }

function consultarbusqueda($descripcion,$idrubro=0)
{
  $sql = "SELECT * FROM entradas WHERE estado='N'";
  if($descripcion!=""){ 
	$sql = $sql." AND descripcion LIKE '%". $descripcion ."%'";
  }
  if($idrubro>0){ 
	$sql = $sql." AND idrubro = ".$idrubro;
  }
  
   global $cnx;
   return $cnx->query($sql); 

}

function buscar($identrada,$idtipocriterio=0, $tipo='')
 {
   $sql = "SELECT * FROM entradas WHERE 1=1 ";
   if($identrada>0) $sql.=" AND identrada=".$identrada;
  /* if($idtipocriterio>0) $sql.=" AND idtipocriterio=".$idtipocriterio;
   if($tipo<>'') $sql.=" AND tipo='".$tipo."'";*/
   global $cnx;
   return $cnx->query($sql);   	 	
 }

function buscarxTipoCriterioTest($idtipocriterio=0)
 {
   $sql = "SELECT identrada,descripcion,comentario,tipocontrol,estado,tipo FROM entradas WHERE tipo='I'";
   if($idtipocriterio>0) $sql.=" AND idtipocriterio=".$idtipocriterio;
   global $cnx;
   return $cnx->query($sql);   	 	
 }

function buscarxcriteriodesdeFuzzy($idtipocriterio=0)
 {
   $sql = "SELECT distinct identrada,descripcion,comentario,tipocontrol,estado,tipo FROM entradas WHERE 1=1";
   if($idtipocriterio>0) $sql.=" AND idtipocriterio=".$idtipocriterio;
   global $cnx;
   return $cnx->query($sql);   	 	
 }

 
function obtenerEntradasAsignadosAReglas($idcargo)
 {
   $sql = "SELECT identrada,descripcion,estado FROM entradas WHERE identrada in (select identrada from CARGO_REGLA CR INNER JOIN REGLAS R ON CR.idregla=R.idregla where CR.idcargo=".$idcargo.")";
   global $cnx;
   return $cnx->query($sql);   	 	
 }
}
?>