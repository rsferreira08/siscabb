<!DOCTYPE html>
<html>
<head>
	<?php include_once('../views/header.php'); ?>
</head>
<body>
	<div class="wrapper">
		<?php include_once('../views/sidebar.php'); ?>
		<!-- fim sidebar -->
		<div id="content" class="ml-4"> 
			<?php include_once('../views/navbar.php'); ?>
			<!-- content -->
			<section class="col-md-11">
				<h2 class="titulo">Dashboard <small>resumo da operação</small></h2>
				<div class="widget" id="dashboardChart">
					<h3>Interações do dia</h3>
				</div>
			</section>
			<!-- fim content -->
		</div>
	</div>
	<script src="../assets/js/jquery.js"></script>
	<script src="../assets/js/bootstrap.js"></script>
	<script src="../assets/js/chartist.js"></script>
	<script src="../assets/js/chartist-tooltip-plugin.js"></script>
	<script src="../assets/js/chartist-legend-plugin.js"></script>
	<script>
		// sidebar
		$(document).ready(function () {
		    $('#sidebarCollapse').on('click', function () {
		        $('#sidebar').toggleClass('active');
		    });

		});
    	new Chartist.Line('#dashboardChart', {
    		labels: ["08:00", "09:00", "10:00", "11:00", "12:00", "13:00", "14:00", "15:00", "16:00", "17:00", "18:00", "19:00", "20:00", "21:00"],
    		series: [{"name" : "Interações", "data" : [30, 50, 100, 144, 143, 214, 334, 389, 256, 156, 103, 89, 43, 10]}]
    	}, {
    		fullWidth: true,
    		showArea: true,
    		height:'350px',
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