<?php
require_once('../config/config.php');

// controle de sessao
if (empty($_SESSION['matricula'])) {
    header("Location: ".constant("BASE_URL"));
    exit;
}

// busca ofertas pendentes para a matricula
$array_ofertasPendentes = Negocio::buscaOfertaPorMatricula($_SESSION['matricula']);
$qtdOfertasPendetes = count($array_ofertasPendentes);

// calculo da taxa de conversao individual com arredondamento para nenhuma casa decimmal
$array_taxaConversao = Negocio::taxaConversaoIndividual($_SESSION['matricula']);
$taxaConversaoIndividual = ($array_taxaConversao['qtdNegociosFechados']/$array_taxaConversao['qtdOfertas'])*100;
$taxaConversaoIndividual = round($taxaConversaoIndividual,0)

?>

<!DOCTYPE html>
<html>
<head>
	<?php include_once('../views/header.php'); ?>
	<style type="text/css">
		.box {
			border-radius: 5px;
		    padding: 5px;
		    text-align: center;
		    margin-bottom: 30px;
		    background: rgba(51,51,51,0.425);
		    color: #f8f8f8;
		}

		.bigText {
			margin-top: 15px;
		    font-size: 36px;
		    line-height: 36px;
		    height: 36px;
		    font-weight: bold;
		}

		.descricao {
			font-weight: normal;
		    text-align: center;
		    margin: 10px -5px;
		}

		.box2 {
			border-radius: 5px;
		    padding: 20px;
		    margin-bottom: 30px;
		    background: rgba(51,51,51,0.425);
		    color: #f8f8f8;
		}

		.progresso {
			overflow: hidden;
		    height: 18px;
		    margin-bottom: 18px;
		    background-color: #f5f5f5;
		    border-radius: 5px;
		    -webkit-box-shadow: inset 0 1px 2px rgba(0,0,0,0.1);
		    box-shadow: inset 0 1px 2px rgba(0,0,0,0.1);
		}
		.barra-progresso {
			float: left;
		    width: 0%;
		    height: 100%;
		    font-size: 12px;
		    line-height: 18px;
		    color: #fff;
		    text-align: center;
		    background-color: #4e85bd;
		    -webkit-box-shadow: inset 0 -1px 0 rgba(0,0,0,0.15);
		    box-shadow: inset 0 -1px 0 rgba(0,0,0,0.15);
		    -webkit-transition: width 0.6s ease;
		    -o-transition: width 0.6s ease;
		    transition: width 0.6s ease;
		}
	</style>
	<link rel="stylesheet" type="text/css" href="../assets/DataTables-1.10.18/css/dataTables.bootstrap4.min.css">
</head>
<body>
	<div class="wrapper">
		<?php include_once('../views/sidebar.php'); ?>
		<!-- fim sidebar -->
		<div id="content" class="ml-4"> 
			<?php include_once('../views/navbar.php'); ?>
			<!-- content -->
			<section>
				<h2 class="titulo">Dashboard <small>resumo da operação</small></h2>
				<div class="row">
					<div class="col-md-3">
						<div class="box">
							<div class="bigText">
								<?=$qtdOfertasPendetes?>
							</div>
							<div class="descricao">
								<strong><i class="fa fa-user"></i></strong>  Ofertas Pendentes
							</div>
						</div>
					</div>
					<div class="col-md-3">
						<div class="box">
							<div class="bigText">
								<?=$taxaConversaoIndividual?>%
							</div>
							<div class="descricao">
								<strong><i class="fa fa-user"></i></strong>  Taxa Conversão
							</div>
						</div>
					</div>
					<div class="col-md-3">
						<div class="box">
							<div class="bigText">
								87
							</div>
							<div class="descricao">
								<strong><i class="fa fa-user"></i></strong>  Qualquer Coisa
							</div>
						</div>
					</div>
					<div class="col-md-3">
						<div class="box">
							<div class="bigText">
								100%
							</div>
							<div class="descricao">
								<strong><i class="fa fa-user"></i></strong>  Alguma outra estatistica
							</div>
						</div>
					</div>
				</div>
			</section>
			<section>
				<div class="row">
					<div class="col-md-6">
						<div class="box2">
							<h4>Metas Outubro</h4>
							<div style="border-top: 1px solid rgb(51,51,51);">
								<h5 class="mt-3">CDC - R$ 80.000,00 / R$ 100.000,00</h5>
								<div class="progresso">
									<div class="barra-progresso" style="width: 80%;">80%</div>
								</div>
								<h5 class="mt-3">Ourocap - 5 / 10</h5>
								<div class="progresso">
									<div class="barra-progresso" style="width: 50%;">50%</div>
								</div>
								<h5 class="mt-3">Pacote - R$ 54 / R$ 120</h5>
								<div class="progresso">
									<div class="barra-progresso" style="width: 45%;">45%</div>
								</div>
								<h5 class="mt-3">Seguro - R$ 1.300,00 / R$ 5.000,00</h5>
								<div class="progresso">
									<div class="barra-progresso" style="width: 26%;">26%</div>
								</div>
							</div>
						</div>
					</div>
					<div class="col-md-6">
						<div>
							<div class="widget" style="display: block !important;" id="dashboardChart">
								<h3>Interações do dia</h3>
							</div>
						</div>
					</div>
				</div>
			</section>
			<section>
				<div class="row">
					<div class="col-md-12">
						<div class="widget" style="display: block !important;">
							<h4 class="mb-3">Meus Negócios Pendentes</h4>
							<table class="table table-hover table-striped text-center rounded" id="tabelaOfertasPendentes">
								<thead>
									<tr>
										<th>MCI</th>
										<th>Produto</th>
										<th>Segmentação</th>
										<th>Valor Atual</th>
										<th>Valor Ofertado</th>
										<th>Seguro</th>
										<th>Valor Seguro</th>
										<th>Data Oferta</th>
									</tr>
								</thead>
								<tbody>
									<?php foreach ( $array_ofertasPendentes as $ofertas ) { ?>
										<tr>
											<td><?=$ofertas['mci']?></td>
											<td><?=$ofertas['produto']?></td>
											<td><?=$ofertas['segmentacao']?></td>
											<td><?=($ofertas['segmentacao']=="Limite")?$ofertas['valorCartaoAtual']:'-'?></td>
											<td><?=($ofertas['valorContratado']!=0.00)?'R$ '.number_format($ofertas['valorContratado'],2,',','.'):'-'?></td>
											<td><?=$ofertas['seguro']?></td>
											<td><?=($ofertas['valorSeguroContratado']!=0.00)?'R$ '.number_format($ofertas['valorSeguroContratado'],2,',','.'):'-'?></td>
											<td><?=date('d/m/Y',$ofertas['dataOferta'])?></td>
										</tr>
									<?php }?>
								</tbody>
							</table>
						</div>
					</div>
				</div>
			</section>
			<!-- fim content -->
		</div>
	</div>
	<?php include_once('../views/footer.php'); ?>

	<script src="../assets/js/chartist.js"></script>
	<script src="../assets/js/chartist-tooltip-plugin.js"></script>
	<script src="../assets/js/chartist-legend-plugin.js"></script>
	<script src="../assets/js/dataTable.js"></script>
	<script src="../assets/DataTables-1.10.18/js/dataTables.bootstrap4.min.js"></script>
	<script type="text/javascript">
		$(document).ready(function(){
			$('#tabelaOfertasPendentes').DataTable();
		});
    	new Chartist.Line('#dashboardChart', {
    		labels: ["08:00", "09:00", "10:00", "11:00", "12:00", "13:00", "14:00", "15:00", "16:00", "17:00", "18:00", "19:00", "20:00", "21:00"],
    		series: [{"name" : "Interações", "data" : [30, 50, 100, 144, 143, 214, 334, 389, 256, 156, 103, 89, 43, 10]}]
    	}, {
    		fullWidth: true,
    		showArea: true,
    		height:'195px',
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
</html>