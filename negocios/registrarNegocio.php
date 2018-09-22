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
				<h2 class="titulo">Negócios <small>> registrar</small></h2>
				<div class="widget offset-lg-2 col-lg-8">
					<h5><i class="fa fa-list-alt"></i> Registrar</h5>
					<form>
						<div class="form-group row mt-5">
							<label for="mci" class="col-sm-3 col-form-label">MCI</label>
							<div class="col-sm-9">
								<input type="text" name="mci" class="form-control" id="mci">
							</div>
						</div>
						<div class="form-group row">
							<label for="mci" class="col-sm-3 col-form-label">Produto</label>
							<div class="col-sm-9">
								<input type="text" name="mci" class="form-control" id="mci">
							</div>
						</div>
						<div class="form-group row">
							<label for="mci" class="col-sm-3 col-form-label">Status</label>
							<div class="col-sm-9">
								<select class="" id="resultado">
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
	<script src="../assets/js/jquery.js"></script>
	<script src="../assets/js/bootstrap.js"></script>
	<script src="../assets/js/select2/select2.min.js"></script>
	<script type="text/javascript">
		$(document).ready(function() {
			$('#resultado').select2();
		});
	</script>
</body>
</html>