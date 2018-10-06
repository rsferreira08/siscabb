<?php
require_once('../config/config.php');

// controle de sessao
if (empty($_SESSION['matricula'])) {
    header("Location: ".constant("BASE_URL"));
    exit;
}

$array_negocios = Negocio::buscaNegociosFechados();

?>

<!DOCTYPE html>
<html>
<head>
	<?php include_once('../views/header.php'); ?>
	<link rel="stylesheet" type="text/css" href="../assets/DataTables-1.10.18/css/dataTables.bootstrap4.min.css">
</head>
<body>
	<div class="wrapper">
		<?php include_once('../views/sidebar.php'); ?>
		<!-- fim sidebar -->
		<div id="content" class="ml-4"> 
			<?php include_once('../views/navbar.php'); ?>
			<!-- content -->
			<section class="col-md-12">
				<h2 class="titulo">Relatórios <small>> volume Negócios</small></h2>
				<div class="row">
					<div class="col-md-12">
						<div class="widget ml-6 col-md-5" id="chartCDC">
							<h5><i class="fa fa-list-alt mb-3"></i> CDC</h5>
						</div>
						<div class="widget col-md-5 mt-1" id="chartVolumeCartao">
							<h5><i class="fa fa-list-alt mb-3"></i> Limite de Cartão</h5>
						</div>
					</div>
				</div>
				<div class="row">
					<div class="col-md-12">
						<div class="widget col-md-11 mt-3">
							<h5><i class="fa fa-list-alt mb-3"></i> Lista de negócios fechados</h5>
							<table class="table table-hover table-striped text-center rounded" id="tabelaNegocios">
								<thead>
									<tr>
										<th>MCI</th>
										<th>Produto</th>
										<th>Segmentação</th>
										<th>Valor Atual</th>
										<th>Valor Ofertado</th>
										<th>Seguro</th>
										<th>Valor Seguro</th>
										<th>Matricula Oferta</th>
										<th>Data Oferta</th>
										<th>Matricula</th>
										<th>Data</th>
									</tr>
								</thead>
								<tbody>
									<?php foreach ( $array_negocios as $negocio ) { ?>
										<tr>
											<td><?=$negocio['mci']?></td>
											<td><?=$negocio['produto']?></td>
												<td><?=$negocio['segmentacao']?></td>
											<td><?=($negocio['segmentacao']=="Limite")?$negocio['valorCartaoAtual']:'-'?></td>
											<td><?=($negocio['valorContratado']!=0.00)?'R$ '.number_format($negocio['valorContratado'],2,',','.'):'-'?></td>
											<td><?=$negocio['seguro']?></td>
											<td><?=($negocio['valorSeguroContratado']!=0.00)?'R$ '.number_format($negocio['valorSeguroContratado'],2,',','.'):'-'?></td>
											<td><?=$negocio['matriculaOferta']?></td>
											<td><?=date('d/m/Y',$negocio['dataOferta'])?></td>
											<td><?=$negocio['matriculaNegocio']?></td>
											<td><?=date('d/m/Y',$negocio['dataNegocio'])?></td>
										</tr>
									<?php }?>
								</tbody>
							</table>
						</div>
					</div>
				</div>
			</section>
			<!-- fim  content -->
		</div>
	</div>
	<?php include_once('../views/footer.php'); ?>
	<script src="../assets/js/chartist.js"></script>
	<script src="../assets/js/chartist-tooltip-plugin.js"></script>
	<script src="../assets/js/chartist-legend-plugin.js"></script>

	<script src="../assets/js/dataTable.js"></script>
	<script src="../assets/DataTables-1.10.18/js/dataTables.bootstrap4.min.js"></script>
	<script type="text/javascript">
		new Chartist.Bar('#chartCDC', {
    		labels: ["Jul","Ago","Set","Out","Nov","Dez"],
    		series: [{"name" : "Volume", "data" : ['50000.00', 30000, 67000, 70000, 50000, 80000]}]
    	}, {
    		fullWidth: true,
    		showArea: true,
    		height:'200px',
    		chartPadding: {
        		right: 40,
        		top: 40
    		},
    		plugins: [
    			Chartist.plugins.tooltip(),
    			Chartist.plugins.legend({
    				position: 'bottom',
    			})
    		]
    	});

    	new Chartist.Bar('#chartVolumeCartao', {
    		labels: ["Jul","Ago","Set","Out","Nov","Dez"],
    		series: [{"name" : "Volume", "data" : ['80000.00', 40000, 300000, 71235, 20000, 90428]}]
    	}, {
    		fullWidth: true,
    		showArea: true,
    		height:'200px',
    		seriesBarDistance: 5,
    		chartPadding: {
        		right: 40,
        		top: 40
    		},
    		plugins: [
    			Chartist.plugins.tooltip(),
    			Chartist.plugins.legend({
    				position: 'bottom',
    			})
    		]
    	});
	</script>
</body>