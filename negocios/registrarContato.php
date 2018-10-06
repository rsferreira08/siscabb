<?php
require_once('../config/config.php');

// controle de sessao
if (empty($_SESSION['matricula'])) {
    header("Location: ".constant("BASE_URL"));
    exit;
}

// aux para varrer variavel para montar combobox
$aux = 1;
$array_demandas2 = Demanda::BuscaTodos(1);
?>

<!DOCTYPE html>
<html>
<head>
	<?php include_once('../views/header.php'); ?>
	<link rel="stylesheet" type="text/css" href="../assets/css/select2/select2.css">
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
				<h2 class="titulo">Contatos <small>> registrar</small></h2>
				<div class="widget offset-lg-2 col-lg-8">
					<h5><i class="fa fa-list-alt"></i> Registrar</h5>
					<div id="resultMessage" class="alert text-center mt-5" style="display: none;">
					</div>
					<form id="formContatos" method="post">
						<div class="form-group row  mt-5">
							<label for="carteira" class="col-sm-3 col-form-label">Carteira</label>
							<div class="col-sm-9">
								<select class="col" id="carteira" name="carteira">
									<option value="1" selected disabled>1 - Fale Com UNV</option>
								</select>
							</div>
						</div>
						<div class="form-group row">
							<label for="mci" class="col-sm-3 col-form-label">MCI</label>
							<div class="col-sm-9">
								<input maxlength="9" type="text" name="mci" class="form-control" id="mci" data-mask="000000000" autofocus>
							</div>
						</div>
						<div class="form-group row">
							<label for="demanda" class="col-sm-3 col-form-label">Demanda</label>
							<div class="col-sm-9">
								<select class="col" id="demanda" name="demanda">
									<option>Selecione uma demanda</option>
									<optgroup label="<?=$array_demandas2[0]['demanda']?>">
									<?php 
										foreach ($array_demandas2 as $demanda) { 
											if ( $aux != $demanda['idDemanda'] ) { 
												echo "</optgroup>";
												echo "<optgroup label='" . $demanda['demanda'] . "'>";
												$aux++;
											}
									?>
										<option value="<?=$demanda['id']?>" id_demanda="<?=$demanda['idDemanda']?>"><?=$demanda['segmentacao']?></option>
									<?php } ?>
									</optgroup>
								</select>
							</div>
						</div>
						<!--<div class="form-group row">
							<label for="resolveu" class="col-sm-3 col-form-label">Resolveu?</label>
							<div class="col-sm-9">
								<select class="col" id="resolveu" name="resolveu">
									<option value='1'>Sim</option>
									<option value='2'>Não</option>
								</select>
							</div>
						</div>-->
						<div class="form-actions">
							<div class="offset-sm-5">
								<button id="botaoSalvar" class="btn btn-primary align-center">Salvar</button>	
							</div>
						</div>
					</form>
				</div>
			</section>
			<!-- fim  content -->
		</div>
	</div>
	<?php include_once('../views/footer.php'); ?>

	<script src="../assets/js/select2/select2.min.js"></script>
	<script src="../assets/js/jquery.mask.js"></script>
	<script src="../assets/js/contatos/formContatos.js"></script>
	<script src="../assets/js/contatos/ajax.js"></script>
	<script type="text/javascript">
		$(document).ready(function(){
			/*$('#resolveu').select2({
				minimumResultsForSearch: -1
			});*/
			$('#carteira').select2({
				disabled: true
			});
			$('#demanda').select2();

		});
	</script>
</body>