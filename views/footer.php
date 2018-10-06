<script src="../assets/js/jquery.js"></script>
<script src="../assets/js/bootstrap.js"></script>
<script src="../assets/js/sidebar.js"></script>
<script>
	$('#botaoLogoff').on('click',function(){
		$.post('../api/api.php',{
			acao: 'logoff'
		},function(data){
			if ( data.status == "OK" ) {
				window.location.href = "../index.php";
			} else {
				alert("Houve um erro ao processar sua informação. Contate o administrador");
			}
		},'json')
	})
</script>