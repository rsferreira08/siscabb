$('#botaoEntrar').on('click',function(event){
	event.preventDefault();

	var v_matricula = $('#matricula').val();
	var v_senha = $('#senha').val();
	var v_prefixo = $('#prefixo option:selected').val();

	$.post('api/api.php', {
		acao: 'login',
		matricula: v_matricula,
		senha: v_senha,
		prefixo: v_prefixo
	}, function(data) {
		if ( data.status == "OK" ) {
			window.location.replace('negocios/dashboard.php');
		} else {
			$('#resultMessage').show();
			$('#resultMessage').removeClass('alert-success');
			$('#resultMessage').addClass('alert-danger').html(data.mensagem);
		}
	}, 'json');
});