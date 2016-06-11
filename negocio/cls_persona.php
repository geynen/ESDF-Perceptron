<?php
class clsPersona
{
function insertar($codigo, $apellidopaterno, $apellidomaterno, $nombres, $fechanacimiento, $lugarnacimiento, $sexo, $nrodoc, $direccion, $estadocivil, $telefonofijo, $celular, $email)
 {
    $sql = "INSERT INTO PERSONA(idpersona, codigo, apellidopaterno, apellidomaterno, nombres, fechanacimiento, lugarnacimiento, sexo, nrodoc, direccion, estadocivil, telefonofijo, celular, email, estado) VALUES(NULL,'$codigo', upper(trim('$apellidopaterno')), upper(trim('$apellidomaterno')), upper(trim('$nombres')), '$fechanacimiento', '$lugarnacimiento', '$sexo', '$nrodoc', '$direccion', '$estadocivil', '$telefonofijo', '$celular', '$email', 'N')";
	
      global $cnx;
      $cnx->query($sql) or die($sql);	 	
 }

function registro($codigo, $apellidopaterno, $apellidomaterno, $nombres, $fechanacimiento, $lugarnacimiento, $sexo, $nrodoc, $direccion, $estadocivil, $telefonofijo, $celular, $email,$idpersona,$login,$clave,$tipousu)
 {
	$sql = "INSERT INTO PERSONA(idpersona, codigo, apellidopaterno, apellidomaterno, nombres, 	
	fechanacimiento, lugarnacimiento, sexo, nrodoc, direccion, estadocivil, telefonofijo, celular, 
	email, estado) VALUES(NULL,'$codigo', upper(trim('$apellidopaterno')), 
	upper(trim('$apellidomaterno')), upper(trim('$nombres')), '$fechanacimiento', '$lugarnacimiento', 
	'$sexo', '$nrodoc', '$direccion', '$estadocivil', '$telefonofijo', '$celular', '$email', 'N')
	INSERT INTO usuario(idusuario, idpersona, login, clave,tipo)VALUES (null, LAST_INSERT_ID(), 
	'$login', '$clave','$tipousuario')";
	
      global $cnx;
      $cnx->query($sql) or die($sql);	 	
 }


function actualizar($idpersona, $codigo, $apellidopaterno, $apellidomaterno, $nombres, $fechanacimiento, $lugarnacimiento, $sexo, $nrodoc, $direccion, $estadocivil, $telefonofijo, $celular, $email)
 {
   $sql = "UPDATE PERSONA SET codigo='".$codigo."' ,apellidopaterno = UPPER(TRIM('".$apellidopaterno."')),apellidomaterno = UPPER(TRIM('".$apellidomaterno."')),nombres = UPPER(TRIM('".$nombres."')), fechanacimiento = '".$fechanacimiento."', lugarnacimiento=UPPER('".$lugarnacimiento."'), sexo=UPPER('".$sexo."'), nrodoc='".$nrodoc."', direccion=UPPER(TRIM('".$direccion."')), estadocivil='".$estadocivil."', telefonofijo='".$telefonofijo."', celular='".$celular."',email='".$email."', estado = 'N' WHERE idpersona = ".$idpersona ;
      global $cnx;
      $cnx->query($sql);
 }

function eliminar($idpersona)
 {
   $sql = "DELETE FROM PERSONA WHERE idpersona = " . $idpersona;
	//$sql = "UPDATE PERSONA SET estado = 'A' WHERE idpersona = " . $idpersona ;
   global $cnx;
   return $cnx->query($sql);  	
 }
 
function verificaNroDoc($NroDoc)
 {
   $sql = "SELECT * FROM PERSONA WHERE NroDoc='".$NroDoc."'";	  
   global $cnx;
   return $cnx->query($sql);
 }  

function obtenerLastId()
 {
   //$sql = "SELECT IdPersona FROM PERSONA WHERE NroDoc='".$NroDoc."'";	
   $sql = "SELECT LAST_INSERT_ID() as IdPersona";
   global $cnx;
   return $cnx->query($sql);  	 	
 }
 
function consultar()
 {
   $sql = "SELECT P.idpersona, codigo, apellidopaterno, apellidomaterno, nombres, fechanacimiento, lugarnacimiento, sexo, nrodoc, direccion, estadocivil, telefonofijo, celular, email, estado, count(*) AS cant FROM PERSONA P LEFT JOIN RESPUESTAS R ON P.idpersona=R.idpersona WHERE P.Estado='N'
GROUP BY P.idpersona, codigo, apellidopaterno, apellidomaterno, nombres, fechanacimiento, lugarnacimiento, sexo, nrodoc, direccion, estadocivil, telefonofijo, celular, email, estado";
   global $cnx;
   return $cnx->query($sql);  	 	
 }

function buscar($idpersona, $apellidosynombres)
 {
   $sql = "SELECT P.idpersona, codigo, apellidopaterno, apellidomaterno, nombres, 
CONCAT( apellidopaterno, ' ', apellidomaterno, ' ', nombres ) AS apellidosynombres, fechanacimiento, lugarnacimiento, sexo, nrodoc, direccion, estadocivil, telefonofijo, celular, email, P.estado, U.login, U.idtipousuario
FROM persona P left join Usuario U on U.idpersona=P.idpersona ";

	$sql.=" WHERE 1=1 ";
   if(isset($idpersona))
	$sql = $sql . " AND P.idpersona = " . $idpersona;
   if(isset($apellidosynombres))
	$sql = $sql . " AND CONCAT(apellidopaterno,' ',apellidomaterno,' ',nombres) LIKE '%".$apellidosynombres."%'";
	
   global $cnx;
   return $cnx->query($sql);  		 	
   //echo $sql;
 }

function buscarpostulante($idpersona,$idconvocatoria,$apellidosynombres)
 {
   $sql = "SELECT pos.idpostulante, P.idpersona, codigo, apellidopaterno, apellidomaterno, nombres, 
CONCAT( apellidopaterno, ' ', apellidomaterno, ' ', nombres ) AS apellidosynombres, fechanacimiento, lugarnacimiento, sexo, nrodoc, direccion, estadocivil, telefonofijo, celular, email, P.estado
FROM postulante pos inner join persona P on pos.idpersona=P.idpersona";

	$sql.=" WHERE 1=1 ";
   if(isset($idpersona))
	$sql = $sql . " AND P.idpersona = " . $idpersona;
	if(isset($idconvocatoria))
	$sql = $sql . " AND pos.idconvocatoria=".$idconvocatoria."";
   if(isset($apellidosynombres))
	$sql = $sql . " AND CONCAT(apellidopaterno,' ',apellidomaterno,' ',nombres) LIKE '%".$apellidosynombres."%'";
	
   global $cnx;
   return $cnx->query($sql);  		 	
   //echo $sql;
 }
 
function buscador($buscar)
{
	$sql="SELECT * FROM persona WHERE nrodoc like '%$buscar%'"; 
	global $cnx;
	return $cnx->query($sql);  		 	

}

function generaCodigo(){
		$sql="select codigo from persona ORDER BY idpersona DESC LIMIT 1";
		global $cnx;
		$registro=$cnx->query($sql);  		 	
		if($registro->rowCount()>0){
			$dato=$registro->fetchObject();
			$num= $dato->codigo;
			if($num=='999999'){$num=0;}
			$num=$num+1;
			$num=str_pad($num,6,"0",STR_PAD_LEFT);
		}else{
			$num="000001";
		}
		return $num;
	}

function consultarpersona($campo,$frase,$limite)
 {
 $sql="SELECT Distinct persona.idpersona, concat(apellidopaterno,' ',apellidomaterno,' ',nombres) as Nombres, nrodoc FROM persona WHERE persona.estado = 'N'"; 

 $sql = $sql . " AND ".$campo." LIKE '%" . $frase . "%'";

 $sql = $sql . " $limite";
 //echo $sql;
 global $cnx;
 return $cnx->query($sql);
 } 

} 
?>