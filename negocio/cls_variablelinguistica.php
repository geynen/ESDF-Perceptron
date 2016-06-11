<?php
class clsVariableLinguistica
{
function insertar($nombre, $valorinicial, $valormedio, $valorfinal, $idmembresia, $idtipomembresia)
 {
   $sql = "INSERT INTO Variable_Linguistica(idvariable, nombre, valorinicial, valormedio, valorfinal, idmembresia, idtipomembresia) VALUES(NULL,UPPER('".$nombre."'), $valorinicial, $valormedio, $valorfinal, $idmembresia, $idtipomembresia)";
   global $cnx;
   return $cnx->query($sql);   	
   //echo $sql;
 }

function obtenerLastId()
 {
   $sql = "SELECT LAST_INSERT_ID() as idvariable";
   global $cnx;
   return $cnx->query($sql);  	 	
 }

function actualizar($idvariablelinguistica, $nombre, $valorinicial, $valormedio, $valorfinal, $idmembresia, $idtipomembresia)
 {
   $sql = "UPDATE Variable_Linguistica SET nombre=UPPER('".$nombre."'), valorinicial=$valorinicial, valormedio=$valormedio, valorfinal=$valorfinal, idmembresia=$idmembresia, idtipomembresia=$idtipomembresia WHERE idvariable = " . $idvariablelinguistica ;
   global $cnx;
   return $cnx->query($sql);   	 	
 }

function eliminar($idvariablelinguistica)
 {
   $sql = "DELETE FROM Variable_Linguistica WHERE idvariable = " . $idvariablelinguistica;
//     $sql = "UPDATE REGLA SET valorinicial='A' WHERE idvariablelinguistica = " . $idvariablelinguistica ;
	global $cnx;
   return $cnx->query($sql);   	 	
 }
 
function vaciar()
 {
   $sql = "DELETE FROM Variable_Linguistica";
   global $cnx;
   return $cnx->query($sql);  	 	
 }

function consultar()
 {
   $sql = "SELECT idvariable, nombre, valorinicial, valorfinal,C.descripcion as criterio FROM Variable_Linguistica R INNER JOIN CRITERIO C ON C.idtipomembresia=R.idtipomembresia";
   global $cnx;
   return $cnx->query($sql);  	 	
 }
 
 function consultarbusqueda($variablelinguistica,$membresia)
 {
  $sql = "SELECT idvariable, VL.nombre, valorinicial, valormedio, valorfinal, VL.idmembresia, M.descripcion as membresia,TM.nombre as tipomembresia FROM Variable_Linguistica VL INNER JOIN TIPO_MEMBRESIA TM ON TM.idtipomembresia=VL.idtipomembresia INNER JOIN MEMBRESIA M ON M.idmembresia=VL.idmembresia  WHERE 1=1  ";
   
   if($variablelinguistica!="")
   {
   $sql=$sql." and nombre like '%".$variablelinguistica."%'";
   }
   if($membresia!=0)
   {
   $sql=$sql." and VL.idmembresia=".$membresia."";
   }
   
   global $cnx;
   return $cnx->query($sql);  	 	
 
 }

function buscar($idvariablelinguistica)
 {
   $sql = "SELECT idvariable, nombre, valorinicial, valormedio, valorfinal, VL.idmembresia, idtipomembresia, idtipocriterio FROM Variable_Linguistica VL inner join Membresia M on M.idmembresia=VL.idmembresia WHERE idvariable=".$idvariablelinguistica;
   global $cnx;
   return $cnx->query($sql);   	 	
 }
 
function buscarxMembresia($idmembresia)
 {
   $sql = "SELECT idvariable, VL.nombre, valorinicial, valormedio, valorfinal, idmembresia, TM.idtipomembresia, TM.nombre as tipomembresia FROM Variable_Linguistica VL INNER JOIN Tipo_Membresia TM on TM.idtipomembresia=VL.idtipomembresia WHERE idmembresia=".$idmembresia."";
   global $cnx;
   return $cnx->query($sql);   	 	
   //echo $sql;
 } 
}
?>