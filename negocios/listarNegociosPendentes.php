<?php
require_once('../config/config.php');

// controle de sessao
if (empty($_SESSION['matricula'])) {
    header("Location: ".constant("BASE_URL"));
    exit;
}

$array_ofertasPendentes = Negocio::buscaOfertasPendentes();

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
				<h2 class="titulo">Relatórios <small>> negócios pendentes</small></h2>
				<div class="widget col-lg-12">
					<h5><i class="fa fa-list-alt mb-3"></i> Negócios Pendentes</h5>
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
								<th>Matricula Oferta</th>
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
									<td><?=$ofertas['matriculaOferta']?></td>
									<td><?=date('d/m/Y',$ofertas['dataOferta'])?></td>
								</tr>
							<?php }?>
						</tbody>
					</table>
				</div>
			</section>
			<!-- fim  content -->
		</div>
	</div>
	<?php include_once('../views/footer.php'); ?>
	<script src="../assets/js/dataTable.js"></script>
	<script src="../assets/DataTables-1.10.18/js/dataTables.bootstrap4.min.js"></script>
	<script type="text/javascript">
		$(document).ready(function(){
			$('#tabelaOfertasPendentes').DataTable();
		});
	</script>
</body>