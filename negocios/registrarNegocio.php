<?php
require_once('../config/config.php');

// controle de sessao
if (empty($_SESSION['matricula'])) {
    header("Location: ".constant("BASE_URL"));
    exit;
}

$array_produtos = Produto::BuscaTodos(1);
?>

<!DOCTYPE html>
<html>
<head>
	<?php include_once('../views/header.php'); ?>
	<link rel="stylesheet" type="text/css" href="../assets/css/select2/select2.css">
	<link rel="stylesheet" type="text/css" href="../assets/css/switchery/switchery.min.css">
	<style type="text/css">
	</style>
</head>
<body>
	<div class="wrapper">
		<?php include_once('../views/sidebar.php'); ?>
		<!-- fim sidebar -->
		<div id="content" class="ml-4"> 
			<?php include_once('../views/navbar.php'); ?>
			<!-- content -->
			<section class="col-md-11">
				<h2 class="titulo">Negócios <small>> registrar</small></h2>
				<div class="widget offset-lg-2 col-lg-8">
					<h5><i class="fa fa-list-alt"></i> Registrar</h5>
					<div id="resultMessage" class="alert text-center mt-5" style="display: none;">
					</div>
					<form id="formNegocios" method="post">
						<div class="form-group row mt-5">
							<label for="mci" class="col-sm-3 col-form-label">MCI</label>
							<div class="col-sm-9">
								<input maxlength="9" type="text" name="mci" class="form-control" id="mci" data-mask="000000000">
							</div>
						</div>
						<div class="form-group row">
							<label for="produto" class="col-sm-3 col-form-label">Produto</label>
							<div class="col-sm-9">
								<select class="col" id="produtos" name="produtos">
									<option>Selecione um produto</option>
									<?php foreach ( $array_produtos as $produto ) { ?>
										<option value="<?=$produto['id']?>" id_produto="<?=$produto['idProduto']?>"><?=$produto['produto']?> - <?=$produto['segmentacao']?></option>
									<?php } ?>
								</select>
							</div>
						</div>
						<div class="form-group row" id="sessaoValorCartaoAtual" style="display: none">
							<label for="valor cartao atual" class="col-sm-3 col-form-label">Limite Atual Cartão</label>
							<div class="col-sm-9">
								<input type="text" name="valorCartaoAtual" class="form-control" id="valorCartaoAtual" data-mask="#.##0,00" data-mask-reverse="true">
							</div>
						</div>
						<div class="form-group row" id="sessaoValorContratado" style="display: none">
							<label for="valor contratado" class="col-sm-3 col-form-label">Valor Contratado</label>
							<div class="col-sm-9">
								<input type="text" name="valorContratado" class="form-control" id="valorContratado" data-mask="#.##0,00" data-mask-reverse="true">
							</div>
						</div>
						<div class="form-group row" id="sessaoNumeroOperacao" style="display: none">
							<label for="numero operacao" class="col-sm-3 col-form-label">Número Operação</label>
							<div class="col-sm-9">
								<input type="text" name="numeroOperacao" class="form-control" id="numeroOperacao" data-mask="000.000.000" data-mask-reverse="true">
							</div>
						</div>
						<div class="form-group row" id="sessaoSeguroOperacao" style="display: none">
							<label for="seguro operacao" class="col-sm-3 col-form-label">Seguro Operação</label>
							<div class="col-sm-9">
								<input type="checkbox" name="seguroOperacao" class="form-control js-switch" id="seguroOperacao">
							</div>
						</div>
						<div class="form-group row" id="sessaoValorSeguroOperacao" style="display: none">
							<label for="valor seguro operacao" class="col-sm-3 col-form-label">Valor Seguro</label>
							<div class="col-sm-9">
								<input type="text" name="valorSeguroOperacao" class="form-control" id="valorSeguroOperacao" data-mask="#.##0,00" data-mask-reverse="true">
							</div>
						</div>
						<div class="form-group row">
							<label for="status" class="col-sm-3 col-form-label">Status</label>
							<div class="col-sm-9">
								<select class="col" id="status" name='status'>
									<option value="1">Oferta Realizada</option>
									<option value="2">Negócio Fechado</option>
									<option value="3">Cliente Recusou Oferta</option>
								</select>
							</div>
						</div>
						<div class="form-actions">
							<div class="offset-sm-5">
								<button id="botaoSalvar" class="btn btn-primary align-center">Salvar</button>	
							</div>
						</div>
					</form>
				</div>
			</section>
			<!-- fim content -->

			<!-- modal para ofertas pendentes -->
			<div class="modal fade " id="modalOfertasPendentes" tabindex="-1" role="dialog" aria-labelledby="tituloModal" aria-hidden="true">
				<div class="modal-dialog modal-lg" role="document">
					<div class="modal-content">
						<div class="modal-header">
							<h5 class="modal-title" id="tituloModal" style="color: black">Ofertas Pendentes</h5>
							<button type="button" class="close" data-dismiss="modal" aria-label="Close">
								<span aria-hidden="true">&times;</span>
							</button>
						</div>
						<div class="modal-body">
							<div id="resultMessageModal" class="alert text-center mt-5" style="display: none;">
							</div>
							<table class="table table-dark table-hover table-striped text-center rounded" id="tabelaOfertasPendentes">
																
							</table>
						</div>
						<div class="modal-footer">
							<button type="button" class="btn btn-secondary" data-dismiss="modal" id="fecharOfertasPendentes">Fechar</button>
							<button type="button" class="btn btn-primary" id="cadastrarOferta">Cadastrar Oferta</button>
						</div>
					</div>
				</div>
			</div>
			<!-- fim modal para ofertas pendentes -->
		</div>
	</div>
	<?php include_once('../views/footer.php'); ?>

	<script src="../assets/js/select2/select2.min.js"></script>
	<script src="../assets/js/switchery/switchery.min.js"></script>
	<script src="../assets/js/negocios/formNegocios.js"></script>
	<script src="../assets/js/negocios/ajax.js"></script>
	<script type="text/javascript">
		$(document).ready(function() {
			$('#status').select2({
				minimumResultsForSearch: -1
			});
			$('#produtos').select2();
		});

		var elem = document.querySelector('.js-switch');
		var init = new Switchery(elem, {
			color: '#378fe8'
		});
	</script>
</body>
</html>