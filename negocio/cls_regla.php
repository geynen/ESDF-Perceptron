<?php
// CLASE REGLA: permite establecer las reglas
class clsRegla
{
function insertar($membresiainput1,$variableinput1,$operador,$membresiainput2,$variableinput2,$membresiaoutput,$variableoutput)
 {
   $sql = "INSERT INTO REGLAS(idregla, membresia_input1, variable_input1, operadorlogico, membresia_input2, variable_input2, membresia_output, variable_output) VALUES(NULL,$membresiainput1,$variableinput1,'$operador',$membresiainput2,$variableinput2,$membresiaoutput,$variableoutput)";
   global $cnx;
   return $cnx->query($sql);   	
   //echo $sql;
 }
//PENDIENTE
function obtenerLastId()
 {
   $sql = "SELECT LAST_INSERT_ID() as idregla";
   global $cnx;
   return $cnx->query($sql);  	 	
 }

function actualizar($idregla, $membresiainput1,$variableinput1,$operador,$membresiainput2,$variableinput2,$membresiaoutput,$variableoutput)
 {
   $sql = "UPDATE REGLAS SET membresia_input1=$membresiainput1, variable_input1=$variableinput1, operadorlogico='$operador', membresia_input2=$membresiainput2, variable_input2=$variableinput2, membresia_output=$membresiaoutput, variable_output=$variableoutput WHERE idregla = " . $idregla ;
   global $cnx;
   return $cnx->query($sql);   	 	
   //echo $sql;
 }
function eliminar($idregla)
 {
   $sql = "DELETE FROM REGLAS WHERE idregla = " . $idregla;
	global $cnx;
   return $cnx->query($sql);   	 	
 }
 //PENDIENTE
function vaciar()
 {
   $sql = "DELETE FROM REGLAS";
   global $cnx;
   return $cnx->query($sql);  	 	
 }

function consultar()
 {
   $sql = "SELECT R.idregla, C1.descripcion as membresia_input1, V1.nombre as variable_input1, operadorlogico, C2.descripcion as membresia_input2, V2.nombre as variable_input2, C3.descripcion as membresia_output, V3.nombre as variable_output FROM REGLAS R INNER JOIN MEMBRESIA C1 ON R.membresia_input1=C1.idmembresia INNER JOIN MEMBRESIA C2 ON R.membresia_input2=C2.idmembresia INNER JOIN MEMBRESIA C3 ON R.membresia_output=C3.idmembresia INNER JOIN VARIABLE_LINGUISTICA V1 ON V1.idvariable=R.variable_input1 INNER JOIN VARIABLE_LINGUISTICA V2 ON V2.idvariable=R.variable_input2 INNER JOIN VARIABLE_LINGUISTICA V3 ON V3.idvariable=R.variable_output WHERE 1=1";
   global $cnx;
   return $cnx->query($sql);  	 	
 }

 function consultarbusqueda($regla,$idmembresia)
 {
  $sql = "SELECT R.idregla, C1.descripcion as membresia_input1, V1.nombre as variable_input1, operadorlogico, C2.descripcion as membresia_input2, V2.nombre as variable_input2, C3.descripcion as membresia_output, V3.nombre as variable_output FROM REGLAS R INNER JOIN MEMBRESIA C1 ON R.membresia_input1=C1.idmembresia INNER JOIN MEMBRESIA C2 ON R.membresia_input2=C2.idmembresia INNER JOIN MEMBRESIA C3 ON R.membresia_output=C3.idmembresia INNER JOIN VARIABLE_LINGUISTICA V1 ON V1.idvariable=R.variable_input1 INNER JOIN VARIABLE_LINGUISTICA V2 ON V2.idvariable=R.variable_input2 INNER JOIN VARIABLE_LINGUISTICA V3 ON V3.idvariable=R.variable_output WHERE 1=1  ";
   
   if($regla!="")
   {
   $sql=$sql." and C1.descripcion like '%".$regla."%'";
   }
   if($idmembresia!=0)
   {
   $sql=$sql." and (C1.idmembresia=".$idmembresia." or C2.idmembresia=".$idmembresia." or C3.idmembresia=".$idmembresia.")";
   }
   
   global $cnx;
   return $cnx->query($sql);  	 	
 
 }
 
  function consultarbusquedareglas($regla,$idmembresia1,$idmembresia2,$idmembresia3)
 {
  $sql = "SELECT R.idregla, C1.descripcion as membresia_input1, V1.nombre as variable_input1, operadorlogico, C2.descripcion as membresia_input2, V2.nombre as variable_input2, C3.descripcion as membresia_output, V3.nombre as variable_output FROM REGLAS R INNER JOIN MEMBRESIA C1 ON R.membresia_input1=C1.idmembresia INNER JOIN MEMBRESIA C2 ON R.membresia_input2=C2.idmembresia INNER JOIN MEMBRESIA C3 ON R.membresia_output=C3.idmembresia INNER JOIN VARIABLE_LINGUISTICA V1 ON V1.idvariable=R.variable_input1 INNER JOIN VARIABLE_LINGUISTICA V2 ON V2.idvariable=R.variable_input2 INNER JOIN VARIABLE_LINGUISTICA V3 ON V3.idvariable=R.variable_output WHERE 1=1  ";
   
   if($regla!="")
   {
   $sql=$sql." and C1.descripcion like '%".$regla."%'";
   }
   if($idmembresia1!=0)
   {
   $sql=$sql." and C1.idmembresia=".$idmembresia1." ";
   }
   if($idmembresia2!=0)
   {
   $sql=$sql." and C2.idmembresia=".$idmembresia2." ";
   }
   if($idmembresia3!=0)
   {
   $sql=$sql." and C3.idmembresia=".$idmembresia3." ";
   }
   
   global $cnx;
   return $cnx->query($sql);  	 	
 
 }

function buscar($idregla)
 {
   $sql = "SELECT R.idregla, C1.idtipocriterio as tipocriterio1, membresia_input1 as idmembresia_input1, C1.descripcion as membresia_input1, V1.nombre as variable_input1, variable_input1 as idvariable_input1, operadorlogico, C2.idtipocriterio as tipocriterio2, membresia_input2 as idmembresia_input2, C2.descripcion as membresia_input2, V2.nombre as variable_input2, variable_input2 as idvariable_input2, C3.idtipocriterio as tipocriterio3, membresia_output as idmembresia_output, C3.descripcion as membresia_output, V3.nombre as variable_output, variable_output as idvariable_output FROM REGLAS R INNER JOIN MEMBRESIA C1 ON R.membresia_input1=C1.idmembresia INNER JOIN MEMBRESIA C2 ON R.membresia_input2=C2.idmembresia INNER JOIN MEMBRESIA C3 ON R.membresia_output=C3.idmembresia INNER JOIN VARIABLE_LINGUISTICA V1 ON V1.idvariable=R.variable_input1 INNER JOIN VARIABLE_LINGUISTICA V2 ON V2.idvariable=R.variable_input2 INNER JOIN VARIABLE_LINGUISTICA V3 ON V3.idvariable=R.variable_output WHERE R.idregla=".$idregla;
   global $cnx;
   return $cnx->query($sql);   	 	
 }


}
?>