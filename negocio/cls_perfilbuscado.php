<?php
class clsPerfilBuscado
{
function insertar($idconvocatoria, $identrada, $valor)
 {
   $sql = "INSERT INTO perfilbuscado(idperfilbuscado, idconvocatoria, identrada, valor) VALUES(NULL, $idconvocatoria, $identrada, $valor)";
   global $cnx;
   return $cnx->query($sql);   	
 }

function obtenerLastId()
 {
   $sql = "SELECT LAST_INSERT_ID() as idperfilbuscado";
   global $cnx;
   return $cnx->query($sql);  	 	
 }

function actualizar($idperfilbuscado, $idconvocatoria, $identrada, $valor)
 {
   $sql = "UPDATE perfilbuscado SET idconvocatoria=".$idconvocatoria.", identrada=".$identrada.", valor=".$valor.", estado='N' WHERE idperfilbuscado = " . $idperfilbuscado ;
   global $cnx;
   return $cnx->query($sql);   	 	
 }

function eliminar($idperfilbuscado,$idconvocatoria)
 {
     $sql = "DELETE FROM perfilbuscado WHERE 1=1 ";
	 if(isset($idperfilbuscado)) $sql.=" and idperfilbuscado = " . $idperfilbuscado ;
 	 if(isset($idconvocatoria)) $sql.=" and idconvocatoria = " . $idconvocatoria ;
	 
	global $cnx;
   return $cnx->query($sql);   	 	
 }
  //PENDIENTE
function vaciar()
 {
   $sql = "DELETE FROM perfilbuscado";
   global $cnx;
   return $cnx->query($sql);  	 	
 }
 //PENDIENTE
function consultar()
 {
   $sql = "SELECT idperfilbuscado, descripcion,estado FROM perfilbuscado WHERE estado='N'";
   global $cnx;
   return $cnx->query($sql);  	 	
 }

function buscar($idperfilbuscado, $idconvocatoria, $identrada=NULL)
 {
   $sql = "SELECT * FROM perfilbuscado WHERE 1=1";
    if(isset($idperfilbuscado)) $sql.=" and idperfilbuscado=".$idperfilbuscado;
	if(isset($idconvocatoria)) $sql.=" and idconvocatoria=".$idconvocatoria;
	if(isset($identrada)) $sql.=" and identrada = " . $identrada ;
   global $cnx;
   return $cnx->query($sql);   	 	
 }
 //PENDIENTE
function buscarxPersona($idPersona)
 {
   $sql = "SELECT idperfilbuscado, idPersona, r.identrada, c.descripcion as entrada, idvariable, valor FROM perfilbuscado r inner join entrada c on r.identrada=c.identrada WHERE 1=1";
   if(isset($idPersona)) $sql.=" and idPersona=".$idPersona;
   global $cnx;
   return $cnx->query($sql);   	 	
 } 
 //PENDIENTE 
function resultadofinal()
 {
   $sql = "select distinct P.idpersona, codigo, CONCAT(apellidopaterno,' ',apellidomaterno,' ',nombres) as persona from perfilbuscado R inner join persona P on P.idpersona=R.idpersona";
   global $cnx;
   return $cnx->query($sql);   	 	
 }
 //PENDIENTE 
function personas($sexo)
 {
   $sql = "select distinct P.idpersona, codigo, CONCAT(apellidopaterno,' ',apellidomaterno,' ',nombres) as persona, sexo from perfilbuscado R inner join persona P on P.idpersona=R.idpersona WHERE 1=1 ";
   if(isset($sexo)) $sql.=" and sexo='".$sexo."'";
   global $cnx;
   return $cnx->query($sql);   	 	
 }
}
?>