<?php
session_start();
if($_SESSION['Tipo']!=1) header("location: ../Inicio.php");
require("headerNew.php");
$_SESSION['linkactivo']='INICIO';
require("menu.php");
?>
<div class="art-post-inner art-article">
<h2 class="art-postheader"><span class="art-postheadericon">&nbsp;</span></h2>
<div class="art-postcontent" align="center">
<p>
<table width="827" height="28" border="0" align="center">
  <tr>
    <td width="160">	
	<table width="160" border="0">
<tr>
    <td width="154" height="35" align="center" class="none">USUARIO</td>
</tr>
<tr>
   <td align="center"><img src="../foto/<?php echo $_SESSION['fot'];?>"  width="220" height="250"/>	  </td>
</tr>
<tr>
	<td align="center"><a href="mant_foto.php">Sube tu Foto </a></td>
</tr>
</table>

		</td>
    <td width="657">	</td>
  </tr>
</table>
</p>
</div>
<div class="cleared"></div>
</div>
<?php
require("footerNew.php");
?>