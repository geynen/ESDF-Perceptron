<?php
session_start();
?>
<ul class="art-vmenu">
	<li><a href="main.php" <?php if($_SESSION['linkactivo']=='INICIO') echo 'class="active"';?>>INICIO</a></li>
    <li><a href="mant_persona_usu.php" <?php if($_SESSION['linkactivo']=='MISDATOS') echo 'class="active"';?>>MIS DATOS </a>	</li>
    <?php if($_SESSION['Tipo']==1){?>
   	<li><a href="list_persona.php" <?php if($_SESSION['linkactivo']=='PERSONA') echo 'class="active"';?>>PERSONA</a></li>
    <li><a href='list_perfil.php' <?php if($_SESSION['linkactivo']=='PERFILES') echo 'class="active"';?>>PERFILES</a></li>
    <?php }?>
    <li><a href='list_convocatoria.php' <?php if($_SESSION['linkactivo']=='CONVOCATORIAS') echo 'class="active"';?>>CONVOCATORIAS VIGENTES</a></li>
    <li><a href='../salir.php' <?php if($_SESSION['linkactivo']=='SALIR') echo 'class="active"';?>>SALIR</a></li>    
</ul>
<div class="cleared"></div>
                    </div>
                </div>
		<div class="cleared"></div>
    </div>
</div>

                          <div class="cleared"></div>
                        </div>
                        <div class="art-layout-cell art-content">
