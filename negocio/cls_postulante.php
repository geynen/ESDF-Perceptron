<?php
class clsPostulante
{
function insertar($idpersona,$idconvocatoria)
 {
    $sql = "INSERT INTO postulante(idpostulante, idpersona, idconvocatoria, estado) VALUES(NULL, $idpersona, $idconvocatoria, 'N')";
	
      global $cnx;
      $cnx->query($sql) or die($sql);	 	
 }

function eliminar($idpostulante)
 {
   $sql = "DELETE FROM postulante WHERE idpostulante = " . $idpostulante;
	//$sql = "UPDATE PERSONA SET estado = 'A' WHERE idpersona = " . $idpersona ;
   global $cnx;
   return $cnx->query($sql);  	
 }
 
function obtenerLastId()
 {
   $sql = "SELECT LAST_INSERT_ID() as idpostulante";
   global $cnx;
   return $cnx->query($sql);  	 	
 }
 
function obtenerIdPostulante($idpersona,$idconvocatoria)
 {
   $sql = "SELECT idpostulante FROM postulante WHERE idpersona=$idpersona AND idconvocatoria=$idconvocatoria";
   global $cnx;
   $rst = $cnx->query($sql); 
   if($rst->rowCount()>0){
   $dato = $rst->fetchObject();
   		return $dato->idpostulante;
   }else{
	   return '';
   }
 }
} 
?>