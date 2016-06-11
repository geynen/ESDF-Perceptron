<?php 
if(!isset($idmembresia)){
require("../datos/cado.php");
require_once("../negocio/cls_membresia.php");
require_once("../negocio/cls_variablelinguistica.php");
$objMembresia = new clsMembresia();
$objVariable = new clsVariableLinguistica();
$idmembresia=7;
//$puntaje=84;
}
$rst=$objMembresia->buscar($idmembresia);
$dato=$rst->fetchObject();
$membresia=$dato->descripcion;
$rstvariable = $objVariable->buscarxMembresia($idmembresia);
$cantdatovariable = $rstvariable->rowCount();
while($datovariable = $rstvariable->fetchObject()){
	$variablesgraf[] = array ("nombre"=>$datovariable->nombre, "valorinicial"=>$datovariable->valorinicial, "valormedio"=>$datovariable->valormedio, "valorfinal"=>$datovariable->valorfinal ,"tipo"=>$datovariable->tipomembresia);
}
//print_r($variablesgraf);
?>
<!DOCTYPE HTML>
<html>
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
		<title>Gr&aacute;fico Difuso</title>
		
		
		<!-- 1. Add these JavaScript inclusions in the head of your page -->
        <script type="text/javascript" src="../Highcharts-2.1.9/jquery-1.7.1.js"></script>
		<script type="text/javascript" src="../Highcharts-2.1.9/js/highcharts.js"></script>
		
		<!-- 1a) Optional: add a theme file -->
		<!--
			<script type="text/javascript" src="../js/themes/gray.js"></script>
		-->
		
		<!-- 1b) Optional: the exporting module -->
		<script type="text/javascript" src="../Highcharts-2.1.9js/modules/exporting.js"></script>
		
		
		<!-- 2. Add the JavaScript to initialize the chart on document ready -->
		<script type="text/javascript">
		
			var chart;
			$(document).ready(function() {
				chart = new Highcharts.Chart({
					chart: {
						renderTo: 'container'
						//type: 'spline',
						//defaultSeriesType: 'line'
					},
					title: {
						text: '<?php echo utf8_decode('Función de Membresia: '.$membresia);?>'
					},
					subtitle: {
						text: 'Fuente: ESDF Logic Fuzzy'	
					},
					xAxis: {
						title: {
							text: 'Variables Linguisticas'
						},
						min: 0
					},
					yAxis: {
						title: {
							text: ''
						},
						min: 0
					},
					tooltip: {
						formatter: function() {
							if(this.series.name=='CENTROIDE'){
								return '<b>'+ this.series.name +'</b><br><?php echo utf8_decode('Grado de decisión:');?> ' + this.x + '<br><?php echo $pertenencia;?>';
							}else{
								return '<b>'+ this.series.name +'</b>';
							}
						}
					},
					series: [
					<?php 
					foreach($variablesgraf as $indice => $v){?>
						{
						name: '<?php echo $v['nombre'];?>',
						<?php if($v['tipo']=='RINFINITY'){?>
						data: [
							[<?php echo $v['valorinicial'];?>, 0],
							[<?php echo $v['valormedio'];?>, 1],
							[<?php echo $v['valorfinal'];?>, 1]
						]
						<?php
						}elseif($v['tipo']=='LINFINITY'){?>
						data: [
							[<?php echo $v['valorinicial'];?>, 1],
							[<?php echo $v['valormedio'];?>, 1],
							[<?php echo $v['valorfinal'];?>, 0]
						]
						<?php
						}elseif($v['tipo']=='TRIANGLE'){?>
						data: [
							[<?php echo $v['valorinicial'];?>, 0],
							[<?php echo $v['valormedio'];?>, 1],
							[<?php echo $v['valorfinal'];?>, 0]
						]
						<?php
						}elseif($v['tipo']=='TRAPEZOID'){//pendiente?>
						data: [
							[<?php echo $v['valorinicial'];?>, 0],
							[<?php echo $v['valormedio'];?>, 1],
							[<?php echo $v['valorfinal'];?>, 0]
						]
						<?php } ?>
						}
						<?php if($indice<$cantdatovariable-1) echo ',';?>
					<?php } ?>
					<?php if(isset($puntaje)){?>
						,
						{
						name: 'CENTROIDE',
						color: '#FF0000',
						data: [
							[<?php echo $puntaje;?>, 0],
							[<?php echo $puntaje;?>, 1]
						]
					}
					<?php } ?>
					]
				});
				
				
			});
				
		</script>
		
	</head>
	<body>
		
		<!-- 3. Add the container -->
		<div id="container" style="width: 800px; height: 400px; margin: 0 auto"></div>
		
				
	</body>
</html>