<?php
session_start();
//if($_SESSION['Tipo']!=2) header("location: ../Inicio.php");
require("../datos/cado.php");
require("headerNew.php"); 	
require("menu.php");
?> 
<html>
<head>
<link href="../css/estiloadmin.css" rel="stylesheet" type="text/css">
<title>CARGO</title>
<script type="text/JavaScript">
<!--
function MM_jumpMenu(targ,selObj,restore){ //v3.0
  eval(targ+".location='"+selObj.options[selObj.selectedIndex].value+"'");
  if (restore) selObj.selectedIndex=0;
}
//-->
</script>
      
<link href="../estilos/estilos.css" rel="stylesheet" type="text/css">
</head>
<body>
</p>

<div id="centralPanel">
<div class="centrarText">
<table width="633" align="center">
  <tr>
    <td width="625">

<form action='../negocio/cont_foto.php?accion=NUEVO' method='POST' enctype="multipart/form-data" name="" 
onSubmit="return check_form();">
<fieldset> 
<legend align="left"> <strong> FOTO </strong></legend>
<table class="tablaint" border="0" align="center">
<tr>
	<td width="159"> PERSONA : </td>
	<td width="377" align="left"><?php echo $_SESSION['Nombre'];?> <label>
	  <?php  $_SESSION['Cod'];?>
	  </label></td>
</tr>
<tr> 
	<td> FOTO :</td>
	<td><label>
	  <input type="file" name="file" border="1">
	</label></td>
</tr>
<tr height="45">
<th colspan="2"><input type='submit' name = 'grabar' value='GRABAR'> <input type='button' name = 'cancelar' value='CANCELAR' onClick="javascript: history.back()"></th>
</tr>
</table>
</fieldset>
</form>
	</td>
  </tr>
  
</table>
</div></div>
 <div id="div">
   <div class="centrarText"></div>
 </div>
</body>
</html>
<?php
require("footerNew.php");
?>
