<?php
class clsRubro
{
function insertar($descripcion,$puntaje, $tipo, $idperfil)
 {
   $sql = "INSERT INTO rubro (idrubro, descripcion, puntaje, tipo, idperfil, estado) 
   VALUES(NULL, UPPER('".$descripcion."'),".$puntaje.", '".$tipo."', ".$idperfil.",'N')";
   global $cnx;
   return $cnx->query($sql);   	
 }

function obtenerLastId()
 {
   $sql = "SELECT LAST_INSERT_ID() as idrubro";
   global $cnx;
   return $cnx->query($sql);  	 	
 }

function actualizar($idrubro,$descripcion,$puntaje, $tipo, $idperfil)
 {
   $sql = "UPDATE rubro SET descripcion=UPPER('" . $descripcion . "'),puntaje=UPPER('".$puntaje."'),tipo='".$tipo."',idperfil=".$idperfil.",estado='N' WHERE idrubro = " . $idrubro ;
   global $cnx;
   return $cnx->query($sql);   	 	
   //echo $sql;
 }

function eliminar($idrubro)
 {
/*   $sql = "DELETE FROM rubro WHERE idrubro = " . $idrubro;*/
     $sql = "UPDATE rubro SET estado='A' WHERE idrubro = " . $idrubro ;
	global $cnx;
   return $cnx->query($sql);   	 	
 }
 
function vaciar() 
 {
   $sql = "DELETE FROM rubro";
   global $cnx;
   return $cnx->query($sql);  	 	
 }

function consultar()
 {
   $sql = "SELECT * FROM rubro  WHERE estado='N'";
   global $cnx;
   return $cnx->query($sql);  	 	
 }

function consultarbusqueda($descripcion,$idperfil=0)
{
  $sql = "SELECT * FROM rubro WHERE estado='N'";
  if($descripcion!=""){
  	$sql = $sql." AND descripcion LIKE '%". $descripcion ."%'";
  }
  if($idperfil>0){
  	$sql = $sql." AND idperfil=". $idperfil ."";
  }
  
   global $cnx;
   return $cnx->query($sql); 

}

function buscar($idrubro,$idtipocriterio=0, $tipo='')
 {
   $sql = "SELECT * FROM rubro WHERE 1=1 ";
   if($idrubro>0) $sql.=" AND idrubro=".$idrubro;
  /* if($idtipocriterio>0) $sql.=" AND idtipocriterio=".$idtipocriterio;
   if($tipo<>'') $sql.=" AND tipo='".$tipo."'";*/
   global $cnx;
   return $cnx->query($sql);   	 	
 }
}
?>