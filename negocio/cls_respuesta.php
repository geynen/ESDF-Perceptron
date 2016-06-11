<?php
class clsRespuesta
{
function insertar($idconvocatoria, $idPersona, $identrada, $valor)
 {
   $sql = "INSERT INTO respuestas(idrespuesta, idconvocatoria, idPersona, identrada, valor) VALUES(NULL, $idconvocatoria, $idPersona, $identrada, $valor)";
   global $cnx;
   return $cnx->query($sql);   	
 }

function obtenerLastId()
 {
   $sql = "SELECT LAST_INSERT_ID() as idrespuesta";
   global $cnx;
   return $cnx->query($sql);  	 	
 }
 //PENDIENTE
function actualizar($idrespuesta, $descripcion)
 {
   $sql = "UPDATE respuestas SET descripcion=UPPER('" . $descripcion . "'), estado='N' WHERE idrespuesta = " . $idrespuesta ;
   global $cnx;
   return $cnx->query($sql);   	 	
 }
function eliminar($idrespuesta,$idconvocatoria,$idpersona)
 {
     $sql = "DELETE FROM respuestas WHERE 1=1 ";
	 if(isset($idrespuesta)) $sql.=" and idrespuesta = " . $idrespuesta ;
 	 if(isset($idconvocatoria)) $sql.=" and idconvocatoria = " . $idconvocatoria ;
	 if(isset($idpersona)) $sql.=" and idpersona = " . $idpersona ;
	global $cnx;
   return $cnx->query($sql);   	 	
 }
  //PENDIENTE
function vaciar()
 {
   $sql = "DELETE FROM respuestas";
   global $cnx;
   return $cnx->query($sql);  	 	
 }
 //PENDIENTE
function consultar()
 {
   $sql = "SELECT idrespuesta, descripcion,estado FROM respuestas WHERE estado='N'";
   global $cnx;
   return $cnx->query($sql);  	 	
 }

function buscar($idrespuesta, $idpersona, $idconvocatoria=NULL, $identrada=NULL)
 {
   $sql = "SELECT * FROM respuestas WHERE 1=1";
    if(isset($idrespuesta)) $sql.=" and idrespuesta=".$idrespuesta;
	if(isset($idpersona)) $sql.=" and idpersona=".$idpersona;
	if(isset($idconvocatoria)) $sql.=" and idconvocatoria=".$idconvocatoria;
	if(isset($identrada)) $sql.=" and identrada=".$identrada;
   global $cnx;
   return $cnx->query($sql);   	 	
 }
 //PENDIENTE
function buscarxPersona($idPersona)
 {
   $sql = "SELECT idrespuesta, idPersona, r.identrada, c.descripcion as entrada, idvariable, valor FROM respuestas r inner join entrada c on r.identrada=c.identrada WHERE 1=1";
   if(isset($idPersona)) $sql.=" and idPersona=".$idPersona;
   global $cnx;
   return $cnx->query($sql);   	 	
 } 

function resultadofinal($idpostulante=NULL,$idconvocatoria=NULL)
 {
   $sql = "SELECT Po.idpostulante, codigo, CONCAT(apellidopaterno,' ',apellidomaterno,' ',nombres) as persona, sum(e.puntaje) as puntaje FROM respuestas r inner join entradas e on e.identrada=r.identrada inner join rubro ru on ru.idrubro=e.idrubro inner join postulante Po on Po.idpostulante=R.idpersona and Po.idconvocatoria=R.idconvocatoria inner join persona P on P.idpersona=Po.idpersona where r.valor=1 ";
   if(isset($idpostulante)) $sql.=" and Po.idpostulante=".$idpostulante;
   if(isset($idconvocatoria)) $sql.=" and R.idconvocatoria=".$idconvocatoria;
   $sql.=" group by Po.idpostulante order by 4 desc";
   //echo $sql;
   global $cnx;
   return $cnx->query($sql);   	 	
 }

function personas($sexo,$idconvocatoria=NULL)
 {
   $sql = "select distinct P.idpersona, Po.idpostulante, codigo, CONCAT(apellidopaterno,' ',apellidomaterno,' ',nombres) as persona, sexo from respuestas R inner join postulante Po on Po.idpostulante=R.idpersona and Po.idconvocatoria=R.idconvocatoria inner join persona P on P.idpersona=Po.idpersona WHERE 1=1 ";
   if(isset($sexo)) $sql.=" and sexo='".$sexo."'";
   if(isset($idconvocatoria)) $sql.=" and R.idconvocatoria=".$idconvocatoria;
   global $cnx;
   return $cnx->query($sql);   	 	
 }
}
?>