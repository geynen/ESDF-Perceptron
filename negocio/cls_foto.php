<?php
class clsFoto
{

function ActFoto($Cod, $foto)
 {
   $sql = "UPDATE PERSONA SET foto='".$foto."' WHERE idpersona = " . $Cod ;
   global $cnx;
  // echo $sql;
   return $cnx->query($sql);   	 	
 }
 



}
?>