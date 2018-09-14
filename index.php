<!DOCTYPE html>
<html>
<head>
	<title>SisCABB - BI </title>
	<link rel="stylesheet" type="text/css" href="assets/css/bootstrap.css">
	<link rel="stylesheet" type="text/css" href="assets/css/fontawesome-all.css">
	<link rel="stylesheet" type="text/css" href="assets/css/login.css">
	<link href="https://fonts.googleapis.com/css?family=Open+Sans" rel="stylesheet">
</head>
<body>
	<div class="form-login col-sm-3">
		<h4 class="text-center mt-5 header">Entrar em sua conta</h4>
		<form method="get">
			<div class="mt-5">
		    	<label for="matricula">Matrícula</label>
		    	<div class="input-group">
		        	<div class="input-group-prepend">
		        		<span class="input-group-text" id="inputGroupPrepend"><i class="fas fa-sm fa-user"></i></span>
		        	</div>
		        	<input type="text" class="form-control-lg col rounded" id="matricula" placeholder="FXXXXXXX" aria-describedby="inputGroupPrepend" required>
		      	</div>
		    </div>
			<div class="mt-3">
		    	<label for="senha">Senha</label>
		    	<div class="input-group">
		        	<div class="input-group-prepend login-prepend">
		        		<span class="input-group-text" id="inputGroupPrepend"><i class="fas fa-sm fa-lock"></i></span>
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