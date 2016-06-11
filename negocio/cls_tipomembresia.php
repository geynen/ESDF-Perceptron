<?php
class clsTipoMembresia
{

function consultar()
 {
   $sql = "SELECT * FROM TIPO_MEMBRESIA";
   global $cnx;
   return $cnx->query($sql);  	 	
 }
 
}
?>