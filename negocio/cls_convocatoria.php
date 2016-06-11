<?php
class clsConvocatoria
{
function insertar($nombre,$idperfil, $fechainicio, $fechafin)
 {
   $sql = "INSERT INTO convocatoria (idconvocatoria, nombre, idperfil, fechainicio, fechafin, estado) 
   VALUES(NULL, UPPER('".$nombre."'),".$idperfil.", '".$fechainicio."', '".$fechafin."','N')";
   global $cnx;
   return $cnx->query($sql);   	
 }

function obtenerLastId()
 {
   $sql = "SELECT LAST_INSERT_ID() as idconvocatoria";
   global $cnx;
   return $cnx->query($sql);  	 	
 }

function actualizar($idconvocatoria,$nombre,$idperfil, $fechainicio, $fechafin)
 {
   $sql = "UPDATE convocatoria SET nombre=UPPER('" . $nombre . "'),idperfil=UPPER('".$idperfil."'),fechainicio='".$fechainicio."',fechafin='".$fechafin."',estado='N' WHERE idconvocatoria = " . $idconvocatoria ;
   global $cnx;
   return $cnx->query($sql);   	 	
   //echo $sql;
 }

function eliminar($idconvocatoria)
 {
/*   $sql = "DELETE FROM convocatoria WHERE idconvocatoria = " . $idconvocatoria;*/
     $sql = "UPDATE convocatoria SET estado='A' WHERE idconvocatoria = " . $idconvocatoria ;
	global $cnx;
   return $cnx->query($sql);   	 	
 }
 
function vaciar() 
 {
   $sql = "DELETE FROM convocatoria";
   global $cnx;
   return $cnx->query($sql);  	 	
 }

function consultar()
 {
   $sql = "SELECT * FROM convocatoria  WHERE estado='N'";
   global $cnx;
   return $cnx->query($sql);  	 	
 }

function consultarbusqueda($nombre,$idperfil=0)
{
  $sql = "SELECT idconvocatoria, c.nombre, p.idperfil, fechainicio, fechafin, c.estado, p.nombre as perfil FROM convocatoria c INNER JOIN perfil p ON c.idperfil=p.idperfil WHERE c.estado='N'";
  if($nombre!=""){
  	$sql = $sql." AND c.nombre LIKE '%". $nombre ."%'";
  }
  if($idperfil>0){
  	$sql = $sql." AND p.idperfil=". $idperfil ."";
  }
  
   global $cnx;
   return $cnx->query($sql); 

}

function consultarConvocatoriasVigentes($nombre,$idperfil=0)
{
  $sql = "SELECT idconvocatoria, c.nombre, p.idperfil, fechainicio, fechafin, c.estado, p.nombre as perfil FROM convocatoria c INNER JOIN perfil p ON c.idperfil=p.idperfil WHERE c.estado='N'";
  if($nombre!=""){
  	$sql = $sql." AND c.nombre LIKE '%". $nombre ."%'";
  }
  if($idperfil>0){
  	$sql = $sql." AND p.idperfil=". $idperfil ."";
  }
  $sql = $sql." AND fechainicio<='".date('Y/m/d')."' AND fechafin>='". date('Y/m/d')."'";
  
   global $cnx;
   return $cnx->query($sql); 

}

function buscar($idconvocatoria,$idfechainiciocriterio=0, $fechainicio='')
 {
   $sql = "SELECT * FROM convocatoria WHERE 1=1 ";
   if($idconvocatoria>0) $sql.=" AND idconvocatoria=".$idconvocatoria;
  /* if($idfechainiciocriterio>0) $sql.=" AND idfechainiciocriterio=".$idfechainiciocriterio;
   if($fechainicio<>'') $sql.=" AND fechainicio='".$fechainicio."'";*/
   global $cnx;
   return $cnx->query($sql);   	 	
 }
}
?>