<?php

require_once('config/config.php');

$array_prefixos = Prefixo::buscaTodos();

?>

<!DOCTYPE html>
<html>
<head>
	<title>SisCABB - BI </title>
	<!-- favicon -->
	<link rel="apple-touch-icon" sizes="57x57" href="http://www.bb.com.br/pbb/app/docs/comum/images/structure/header/icon/apple-icon-57x57.png">
	<link rel="apple-touch-icon" sizes="60x60" href="http://www.bb.com.br/pbb/app/docs/comum/images/structure/header/icon/apple-icon-60x60.png">
	<link rel="apple-touch-icon" sizes="72x72" href="http://www.bb.com.br/pbb/app/docs/comum/images/structure/header/icon/apple-icon-72x72.png">
	<link rel="apple-touch-icon" sizes="76x76" href="http://www.bb.com.br/pbb/app/docs/comum/images/structure/header/icon/apple-icon-76x76.png">
	<link rel="apple-touch-icon" sizes="114x114" href="http://www.bb.com.br/pbb/app/docs/comum/images/structure/header/icon/apple-icon-114x114.png">
	<link rel="apple-touch-icon" sizes="120x120" href="http://www.bb.com.br/pbb/app/docs/comum/images/structure/header/icon/apple-icon-120x120.png">
	<link rel="apple-touch-icon" sizes="144x144" href="http://www.bb.com.br/pbb/app/docs/comum/images/structure/header/icon/apple-icon-144x144.png">
	<link rel="apple-touch-icon" sizes="152x152" href="http://www.bb.com.br/pbb/app/docs/comum/images/structure/header/icon/apple-icon-152x152.png">
	<link rel="apple-touch-icon" sizes="180x180" href="http://www.bb.com.br/pbb/app/docs/comum/images/structure/header/icon/apple-icon-180x180.png">
	<link rel="icon" type="image/png" sizes="192x192"  href="http://www.bb.com.br/pbb/app/docs/comum/images/structure/header/icon/android-icon-192x192.png">
	<link rel="icon" type="image/png" sizes="32x32" href="http://www.bb.com.br/pbb/app/docs/comum/images/structure/header/icon/favicon-32x32.png">
	<link rel="icon" type="image/png" sizes="96x96" href="http://www.bb.com.br/pbb/app/docs/comum/images/structure/header/icon/favicon-96x96.png">
	<link rel="icon" type="image/png" sizes="16x16" href="http://www.bb.com.br/pbb/app/docs/comum/images/structure/header/icon/favicon-16x16.png">

	<link rel="stylesheet" type="text/css" href="assets/css/bootstrap.css">
	<link rel="stylesheet" type="text/css" href="assets/css/select2/select2.css">
	<link rel="stylesheet" type="text/css" href="assets/css/fontawesome-all.css">
	<link rel="stylesheet" type="text/css" href="assets/css/login.css">
</head>
<body>
	<div class="form-login col-sm-4">
		<h4 class="text-center mt-5 header">Entrar em sua conta</h4>
		<div id="resultMessage" class="alert text-center mt-5" style="display: none;">
		</div>
		<form method="get" action="negocios/dashboard.php" style="margin-bottom: -55px">
			<div class="mt-5">
		    	<label for="matricula">Matrícula</label>
		    	<div class="input-group">
		        	<div class="input-group-prepend login-prepend">
		        		<span class="input-group-text" id="inputGroupPrepend"><i class="fas fa-sm fa-user ml-3"></i></span>
		        	</div>
		        	<input type="text" class="form-control-lg col rounded" id="matricula" placeholder="FXXXXXXX" aria-describedby="inputGroupPrepend" maxlength="8" required>
		      	</div>
		    </div>
			<div class="mt-3">
		    	<label for="senha">Senha</label>
		    	<div class="input-group">
		        	<div class="input-group-prepend login-prepend">
		        		<span class="input-group-text" id="inputGroupPrepend"><i class="fas fa-sm fa-lock ml-3"></i></span>
		        	</div>
		        	<input type="password" class="form-control-lg col rounded" id="senha" aria-describedby="inputGroupPrepend" required>
		      	</div>
		    </div>
		    <div class="mt-3">
		    	<label for="senha">Dependência</label>
		    	<div class="form-group">
		        	<select class="col-lg-12" id="prefixo">
		        		<?php foreach ( $array_prefixos as $prefixo ) { ?>
		        			<option value="<?=$prefixo["id"]?>"><?=$prefixo["abreviacao"]?> - <?=$prefixo["prefixo"]?></option>
		        	<?php } ?>
		        	</select>
		      	</div>
		    </div>
			<div class="form-group mt-5 mb-5" style="background-color: rgba(51,51,51,0.3);padding: 20px 15px 40px;margin: -20px;">
				<button class="btn btn-lg btn-primary col-sm-12 mb-3" id="botaoEntrar">Entrar</button>
				<p class="text-center"><a href="#" style="color: white" class="text-center">Esqueceu sua senha?</a></p>
			</div>
		</form>
	</div>
	<script src="assets/js/jquery.js"></script>
	<script src="assets/js/bootstrap.js"></script>
	<script src="assets/js/select2/select2.min.js"></script>
	<script src="assets/js/login/ajax.js"></script>

	<script type="text/javascript">
		$(document).ready(function() {
			$('#prefixo').select2();
		});
	</script>
</body>
</html>