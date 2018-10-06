// no submit, chama API
$('#botaoSalvar').on('click',function(event){
	event.preventDefault();
	var v_mci = $('#mci').val();
	var v_idDemanda = $('#demanda option:selected').attr('id_demanda');
	var v_idSegmentacaoDemanda = $('#demanda option:selected').val();

	// desabilita botão
	var o_btn = $('#botaoSalvar');
	var o_label = o_btn.html();
	o_btn.attr('disabled', 'disabled').html('Aguarde...');

	$.post('../api/api.php', {
		acao: 'registraContato',
		mci: v_mci,
		idDemanda: v_idDemanda,
		idSegmentacaoDemanda: v_idSegmentacaoDemanda,
	}, function(data) {
		if ( data.status == "OK" ) {
			// mostra mensagem  de retorno
			$('#resultMessage').show();
			$('#resultMessage').removeClass('alert-danger');
			$('#resultMessage').addClass('alert-success').html(data.mensagem);
			// limpa form
			$('#formContatos').trigger('reset');
			$('#demanda').select2("destroy");
			$('#demanda').select2();
		} else {
			$('#resultMessage').show();
			$('#resultMessage').removeClass('alert-success');
			$('#resultMessage').addClass('alert-danger').html(data.mensagem);
		}

		// Restaura o botão
		o_btn.removeAttr('disabled').html(o_label);
	}, 'json');
});