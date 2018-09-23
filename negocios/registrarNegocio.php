<?php
require_once('../config/config.php');
$array_produtos = Produtos::BuscaTodos(1);
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
					<form>
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
									<option>Oferta Realizada</option>
									<option>Negócio Fechado</option>
									<option>Negócio Não Realizado</option>
								</select>
							</div>
						</div>
						<div class="form-actions">
							<div class="offset-sm-5">
								<button class="btn btn-primary align-center">Salvar</button>	
							</div>
						</div>
					</form>
				</div>
			</section>
			<!-- fim content -->
		</div>
	</div>
	<?php include_once('../views/footer.php'); ?>

	<script src="../assets/js/select2/select2.min.js"></script>
	<script src="../assets/js/switchery/switchery.min.js"></script>
	<script src="../assets/js/jquery.mask.js"></script>
	<script src="../assets/js/negocios.js"></script>
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