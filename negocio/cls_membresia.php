<?php
class clsMembresia
{
function insertar($descripcion,$comentario,$idtipocriterio,$tipo,$tipocontrol)
 {
   $sql = "INSERT INTO MEMBRESIA (idmembresia,descripcion,comentario,idtipocriterio,tipo,estado,tipocontrol) 
   VALUES(NULL,UPPER('".$descripcion."'),UPPER('".$comentario."'),$idtipocriterio,'".$tipo."','N','".$tipocontrol."')";
   global $cnx;
   return $cnx->query($sql);   	
 }

function obtenerLastId()
 {
   $sql = "SELECT LAST_INSERT_ID() as idmembresia";
   global $cnx;
   return $cnx->query($sql);  	 	
 }

function actualizar($idmembresia, $descripcion,$comentario,$idtipocriterio,$tipo,$tipocontrol)
 {
   $sql = "UPDATE MEMBRESIA SET descripcion=UPPER('" . $descripcion . "'),comentario=UPPER('".$comentario."'),idtipocriterio=$idtipocriterio,estado='N',tipo='".$tipo."', tipocontrol='".$tipocontrol."' WHERE idmembresia = " . $idmembresia ;
   global $cnx;
   return $cnx->query($sql);   	 	
   //echo $sql;
 }

function eliminar($idmembresia)
 {
/*   $sql = "DELETE FROM MEMBRESIA WHERE idmembresia = " . $idmembresia;*/
     $sql = "UPDATE MEMBRESIA SET estado='A' WHERE idmembresia = " . $idmembresia ;
	global $cnx;
   return $cnx->query($sql);   	 	
 }
 
function vaciar() 
 {
   $sql = "DELETE FROM MEMBRESIA";
   global $cnx;
   return $cnx->query($sql);  	 	
 }

function consultar()
 {
   $sql = "SELECT idmembresia,C.descripcion,C.idtipocriterio, TC.descripcion as tipocriterio,C.estado FROM MEMBRESIA C INNER JOIN TIPO_CRITERIO TC ON C.idtipocriterio=TC.idtipocriterio WHERE C.estado='N'";
   global $cnx;
   return $cnx->query($sql);  	 	
 }

function consultarbusqueda($descripcion,$criterio)
{
  $sql = "SELECT idmembresia,C.descripcion,C.comentario,C.idtipocriterio, TC.descripcion as tipocriterio,C.tipo,C.tipocontrol,C.estado FROM MEMBRESIA C INNER JOIN TIPO_CRITERIO TC ON C.idtipocriterio=TC.idtipocriterio WHERE C.estado='N'";
  if($descripcion!="")
  { 
  $sql = $sql." AND C.descripcion LIKE '%". $descripcion ."%'";
  }
   if($criterio!=0)
  { 
  $sql = $sql." AND C.idtipocriterio=".$criterio."";
  }
   global $cnx;
   return $cnx->query($sql); 

}

function buscar($idmembresia,$idtipocriterio=0, $tipo='')
 {
   $sql = "SELECT idmembresia,descripcion,comentario,idtipocriterio,tipo,estado,tipocontrol FROM MEMBRESIA WHERE 1=1 ";
   if($idmembresia>0) $sql.=" AND idmembresia=".$idmembresia;
   if($idtipocriterio>0) $sql.=" AND idtipocriterio=".$idtipocriterio;
   if($tipo<>'') $sql.=" AND tipo='".$tipo."'";
   global $cnx;
   return $cnx->query($sql);   	 	
 }

function buscarxTipoCriterioTest($idtipocriterio=0)
 {
   $sql = "SELECT idmembresia,descripcion,comentario,tipocontrol,estado,tipo FROM MEMBRESIA WHERE tipo='I'";
   if($idtipocriterio>0) $sql.=" AND idtipocriterio=".$idtipocriterio;
   global $cnx;
   return $cnx->query($sql);   	 	
 }

function buscarxcriteriodesdeFuzzy($idtipocriterio=0)
 {
   $sql = "SELECT distinct idmembresia,descripcion,comentario,tipocontrol,estado,tipo FROM MEMBRESIA WHERE 1=1";
   if($idtipocriterio>0) $sql.=" AND idtipocriterio=".$idtipocriterio;
   global $cnx;
   return $cnx->query($sql);   	 	
 }

 
function obtenerMembresiasAsignadosAReglas($idcargo)
 {
   $sql = "SELECT idmembresia,descripcion,estado FROM MEMBRESIA WHERE idmembresia in (select idmembresia from CARGO_REGLA CR INNER JOIN REGLAS R ON CR.idregla=R.idregla where CR.idcargo=".$idcargo.")";
   global $cnx;
   return $cnx->query($sql);   	 	
 }
}
?>