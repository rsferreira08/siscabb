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
	<link rel="stylesheet" type="text/css" href="assets/css/fontawesome-all.css">
	<link rel="stylesheet" type="text/css" href="assets/css/login.css">
	<link href="https://fonts.googleapis.com/css?family=Open+Sans" rel="stylesheet">
</head>
<body>
	<div class="form-login col-sm-4">
		<h4 class="text-center mt-5 header">Entrar em sua conta</h4>
		<form method="get" action="dashboard.php">
			<div class="mt-5">
		    	<label for="matricula">Matrícula</label>
		    	<div class="input-group">
		        	<div class="input-group-prepend login-prepend">
		        		<span class="input-group-text" id="inputGroupPrepend"><i class="fas fa-sm fa-user ml-3"></i></span>
		        	</div>
		        	<input type="text" class="form-control-lg col rounded" id="matricula" placeholder="FXXXXXXX" aria-describedby="inputGroupPrepend" required>
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
			<div class="form-group mt-5 mb-5">
				<button class="btn btn-lg btn-primary col-sm-12 mb-3">Entrar</button>
				<p class="text-center"><a href="#" style="color: white" class="text-center">Esqueceu sua senha?</a></p>
			</div>
		</form>
	</div>
	<script src="assets/js/bootstrap.js"></script>
</body>
</html>