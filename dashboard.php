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
	<link rel="stylesheet" type="text/css" href="assets/css/base.css">
	<link href="https://fonts.googleapis.com/css?family=Open+Sans" rel="stylesheet">

</head>
<body>
	<!-- navbar para funções -->
	<nav class="navbar navbar-expand-lg navbar-light bg-light nav-transparente">
		<a class="navbar-brand ml-5" style="color:white" href="#">SisCABB <strong>RPO</strong></a>
		<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
    		<span class="navbar-toggler-icon"></span>
  		</button>
		<div class="collapse navbar-collapse" id="navbarNavDropdown">
			<ul class="navbar-nav nav ml-auto mr-5">
				<li class="nav-link comandos"><a href="#"><i class="fas fa-2x fa-user mr-3"></i></a></li>
				<li class="nav-link comandos"><a href="index.php"><i class="fas fa-2x fa-power-off"></i></a></li>
			</ul>
		</div>
	</nav>
	<!-- fim navbar -->

	
	<div class="container-fluid">
		
		<div class="row"> 
			<!-- sidebar -->
			<nav class="col-md-2 d-none d-md-block bg-light sidebar">
				<div class="sidebar-sticky">
					<ul class="nav flex-column ml-5">
						<li class="nav-item">
							<a class="nav-link" href="#"><i class="fas fa-home mr-4"></i><span class="active">Dashboard</span></a>
						</li>
						<li class="nav-item">
							<a class="nav-link" href="#"><i class="fas fa-hand-holding-usd mr-4"></i><span>Negócios</span></a>
						</li>
						<li class="nav-item">
							<a class="nav-link" href="#"><i class="fas fa-phone mr-4"></i><span>Contatos</span></a>
						</li>
						<li class="nav-item">
							<a class="nav-link" href="#"><i class="fas fa-chart-area mr-4"></i><span>Relatórios</span></a>
						</li>
					</ul>
				</div>
			</nav>
			<!-- fim sidebar -->

			<!-- content -->
			<section class="col-md-10">
				<h2 class="titulo">Dashboard <small>resumo da operação</small></h2>
				<canvas class="col-md-11" id="dashboardChart"></canvas>
			</section>
			<!-- fim content -->
		</div>
	</div>
	<script src="assets/js/jquery.js"></script>
	<script src="assets/js/bootstrap.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.7.1/Chart.min.js"></script>
	<script>
    	var ctx = document.getElementById("dashboardChart");
    	var myChart = new Chart(ctx, {
        	type: 'line',
        	data: {
        		labels: ["08:00", "09:00", "10:00", "11:00", "12:00", "13:00", "14:00", "15:00", "16:00", "17:00", "18:00", "19:00", "20:00", "21:00"],
        		datasets: [{
	        		data: [30, 50, 100, 144, 143, 214, 334, 389, 256, 156, 103, 89, 43, 10,],
	            	lineTension: 0,
	            	backgroundColor: 'transparent',
	            	borderColor: '#fff',
	            	borderWidth: 1,
	            	pointBackgroundColor: '#fff'
	          	}]
        	},
        	options: {
        		responsive: true,
        		title: {
        			display: true,
        			text: "Interações x Hora",
        			fontColor: "#fff",
        			fontSize: "20",
        			fontStyle: "lighter",
        			fontFamily: "Open Sans"
        		},
        		scales: {
            		yAxes: [{
                		ticks: {
               			beginAtZero: false,
               			fontColor: "#fff"
              		},
              	}],
              		xAxes: [{
                		ticks: {
               			beginAtZero: false,
               			fontColor: "#fff"
              		}
            	}]
        	},
        	legend: {
         		display: false,
        	}
        }
    });
    </script>
</body>
</html>