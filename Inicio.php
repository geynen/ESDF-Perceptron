<?php
session_start();
require("headerNew.php");
?> 
<form id="Login" action='negocio/cont_usuario.php?accion=LOGEO' method='POST' name="Login">
      <p>&nbsp;</p>
      <table align="center" width="470" border="0">
        <tr>
          <td> <div align="center" class="subtitulo" ><em>Si eres mienbro ingresa al sitio, sino <a href="presentacion/buscarxdni.php">Registrate </a> </em></div></td>
        </tr>
      </table><br>
      <table width="348" height="188" border="0" align="center">
        <tr height="50">
          <td colspan="2" class="Estilo6 "><div align="center" class="subtitulo">ACCESO AL SISTEMA
          </div></td>
        </tr>
        <tr>
          <td width="106" class="etiquetalogeo"><div align="right">Usuario : </div></td>
          <td width="232"><label><input type="text" name="txtusuario" id="txtusuario"/></label></td>
        </tr>
        <tr>
          <td class="etiquetalogeo"><div align="right">Password :</div></td>
		  <td><label><input type="password" name="txtclave" id="txtclave"/></label></td>
        </tr>
        <tr>
          <td height="44" colspan="2" align="center"><input type="submit" name="Submit" value="Ingresar"/>            </td>
        </tr>
	  </table>
	  </form>
<br><br>
<script>document.getElementById('txtusuario').focus();</script>
<?php
require("footerNew.php");
?>