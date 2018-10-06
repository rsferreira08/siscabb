// no submit, chama API
$('#botaoSalvar').on('click',function(event){
	var v_mci = $('#mci').val();
	var v_idProduto = $('#produtos option:selected').attr('id_produto');
	var v_idSegmentacaoProduto = $('#produtos option:selected').val();
	var v_valorCartaoAtual = $('#valorCartaoAtual').val();
	var v_valorContratado = $('#valorContratado').val();
	var v_numeroOperacaoCDC = $('#numeroOperacao').val();
	var v_seguroOperacao = +$('#seguroOperacao').is(':checked');
	var v_valorSeguroContratado = $('#valorSeguroOperacao').val();
	var v_status = $('#status option:selected').val();

	// desabilita botão
	var o_btn = $('#botaoSalvar');
	var o_label = o_btn.html();
	o_btn.attr('disabled', 'disabled').html('Aguarde...');

	if ( v_status == 1 ) {
		$.post('../api/api.php', {
			acao: 'buscaOfertaPorMci',
			mci: v_mci,
			idProduto: v_idProduto,
			idSegmentacaoProduto: v_idSegmentacaoProduto,
			valorCartaoAtual: v_valorCartaoAtual,
			valorContratado: v_valorContratado,
			numeroOperacaoCDC: v_numeroOperacaoCDC,
			seguroOperacao: v_seguroOperacao,
			valorSeguroContratado: v_valorSeguroContratado,
			status: v_status
		}, function(data) {
			if ( data.status == "OK" ) {
				$('#tituloModal').html("Ofertas Pendentes para o MCI <b>" + mci.value + "</b>");
				$('#tabelaOfertasPendentes').append('<tr><th>Produto</th><th>Segmentação</th><th>Valor da Oferta</th><th>Matricula Oferta</th><th>Data Oferta</th><th>Ações</th></tr>');
				$.each(data.ret_data, function( key, value ) {
					$('#tabelaOfertasPendentes').append('<tr><td>' + value.produto +'</td><td>' + value.segmentacao +'</td><td>' + value.valorOferta +'</td><td>' + value.matriculaOferta +'</td><td>' + value.dataOferta +'</td><td><button id="' +value.id + '" class="botaoConfirmarOferta btn btn-primary btn-sm">Confirmar</button>&nbsp;<button id="' +value.id + '"  class="botaoRecusarOferta btn btn-sm btn-danger">Recusar</button></td></tr>');
				})
				$('#modalOfertasPendentes').modal('show');
			} else if ( data.status == "ERROR" ) {
				$('#resultMessage').show();
				$('#resultMessage').removeClass('alert-success');
				$('#resultMessage').addClass('alert-danger').html(data.mensagem);
			} else if ( data.status == "VAZIO" ) {
				$.post('../api/api.php', {
					acao: 'registraNegocio',
					mci: v_mci,
					idProduto: v_idProduto,
					idSegmentacaoProduto: v_idSegmentacaoProduto,
					valorCartaoAtual: v_valorCartaoAtual,
					valorContratado: v_valorContratado,
					numeroOperacaoCDC: v_numeroOperacaoCDC,
					seguroOperacao: v_seguroOperacao,
					valorSeguroContratado: v_valorSeguroContratado,
					status: v_status
				}, function(data) {
					if ( data.status == "OK" ) {
						// mostra mensagem  de retorno
						$('#resultMessage').show();
						$('#resultMessage').removeClass('alert-danger');
						$('#resultMessage').addClass('alert-success').html(data.mensagem);
						// limpa form
						$('#formNegocios').trigger('reset');
						$('#sessaoValorContratado, #sessaoValorCartaoAtual, #sessaoNumeroOperacao, #sessaoSeguroOperacao, #sessaoValorSeguroOperacao').hide();
						$('#produtos, #status').select2("destroy");
						$('#produtos').select2();
						$('#status').select2({
							minimumResultsForSearch: -1
						});

					} else {
						$('#resultMessage').show();
						$('#resultMessage').removeClass('alert-success');
						$('#resultMessage').addClass('alert-danger').html(data.mensagem);
					}

					// Restaura o botão
					o_btn.removeAttr('disabled').html(o_label);
				}, 'json');
			}
			// Restaura o botão
			o_btn.removeAttr('disabled').html(o_label);
		}, 'json');
	}  

	if ( v_status == 2 || v_status == 3 ) {
		$.post('../api/api.php', {
			acao: 'registraNegocio',
			mci: v_mci,
			idProduto: v_idProduto,
			idSegmentacaoProduto: v_idSegmentacaoProduto,
			valorCartaoAtual: v_valorCartaoAtual,
			valorContratado: v_valorContratado,
			numeroOperacaoCDC: v_numeroOperacaoCDC,
			seguroOperacao: v_seguroOperacao,
			valorSeguroContratado: v_valorSeguroContratado,
			status: v_status
		}, function(data) {
			if ( data.status == "OK" ) {
				// mostra mensagem  de retorno
				$('#resultMessage').show();
				$('#resultMessage').removeClass('alert-danger');
				$('#resultMessage').addClass('alert-success').html(data.mensagem);
				// limpa form
				$('#formNegocios').trigger('reset');
				$('#sessaoValorContratado, #sessaoValorCartaoAtual, #sessaoNumeroOperacao, #sessaoSeguroOperacao, #sessaoValorSeguroOperacao').hide();
				$('#produtos, #status').select2("destroy");
				$('#produtos').select2();
				$('#status').select2({
					minimumResultsForSearch: -1
				});

			} else {
				$('#resultMessage').show();
				$('#resultMessage').removeClass('alert-success');
				$('#resultMessage').addClass('alert-danger').html(data.mensagem);
			}

			// Restaura o botão
			o_btn.removeAttr('disabled').html(o_label);
		}, 'json');
	}
});

$('#cadastrarOferta').on('click', function(){
	$('#tabelaOfertasPendentes tbody').html('');
	var v_mci = $('#mci').val();
	var v_idProduto = $('#produtos option:selected').attr('id_produto');
	var v_idSegmentacaoProduto = $('#produtos option:selected').val();
	var v_valorCartaoAtual = $('#valorCartaoAtual').val();
	var v_valorContratado = $('#valorContratado').val();
	var v_numeroOperacaoCDC = $('#numeroOperacao').val();
	var v_seguroOperacao = +$('#seguroOperacao').is(':checked');
	var v_valorSeguroContratado = $('#valorSeguroOperacao').val();
	var v_status = $('#status option:selected').val();

	// desabilita botão
	var o_btn = $('#cadastrarOferta');
	var o_label = o_btn.html();
	o_btn.attr('disabled', 'disabled').html('Aguarde...');

	$.post('../api/api.php', {
		acao: 'registraNegocio',
		mci: v_mci,
		idProduto: v_idProduto,
		idSegmentacaoProduto: v_idSegmentacaoProduto,
		valorCartaoAtual: v_valorCartaoAtual,
		valorContratado: v_valorContratado,
		numeroOperacaoCDC: v_numeroOperacaoCDC,
		seguroOperacao: v_seguroOperacao,
		valorSeguroContratado: v_valorSeguroContratado,
		status: v_status
	}, function(data) {
		if ( data.status == "OK" ) {
			$('#modalOfertasPendentes').modal('hide');
			// mostra mensagem  de retorno
			$('#resultMessage').show();
			$('#resultMessage').removeClass('alert-danger');
			$('#resultMessage').addClass('alert-success').html(data.mensagem);
			// limpa form
			$('#formNegocios').trigger('reset');
			$('#sessaoValorContratado, #sessaoValorCartaoAtual, #sessaoNumeroOperacao, #sessaoSeguroOperacao, #sessaoValorSeguroOperacao').hide();
			$('#produtos, #status').select2("destroy");
			$('#produtos').select2();
			$('#status').select2({
				minimumResultsForSearch: -1
			});
		} else {
			$('#resultMessage').show();
			$('#resultMessage').removeClass('alert-success');
			$('#resultMessage').addClass('alert-danger').html(data.mensagem);
		}
		// Restaura o botão
		o_btn.removeAttr('disabled').html(o_label);
	}, 'json');
});

$('#fecharOfertasPendentes').on('click', function(){
	$('#tabelaOfertasPendentes tr').html('');
});

$(document).on('click', '.botaoConfirmarOferta',function(event){
	$('#tabelaOfertasPendentes tbody').html('');
	var v_id = $(this).attr("id");
	var v_negocioFechado = 1;

	$.post('../api/api.php', {
		acao: 'atualizaOferta',
		id: v_id,
		negocioFechado: v_negocioFechado,
	}, function(data) {
		if ( data.status == "OK" ) {
			$('#modalOfertasPendentes').modal('hide');
			// mostra mensagem  de retorno
			$('#resultMessage').show();
			$('#resultMessage').removeClass('alert-danger');
			$('#resultMessage').addClass('alert-success').html(data.mensagem);
			// limpa form
			$('#formNegocios').trigger('reset');
			$('#sessaoValorContratado, #sessaoValorCartaoAtual, #sessaoNumeroOperacao, #sessaoSeguroOperacao, #sessaoValorSeguroOperacao').hide();
			$('#produtos, #status').select2("destroy");
			$('#produtos').select2();
			$('#status').select2({
				minimumResultsForSearch: -1
			});
		} else {
			$('#resultMessageModal').show();
			$('#resultMessageModal').removeClass('alert-success');
			$('#resultMessageModal').addClass('alert-danger').html(data.mensagem);
		}
		// Restaura o botão
		o_btn.removeAttr('disabled').html(o_label);
	}, 'json');
	
});

$(document).on('click', '.botaoRecusarOferta',function(event){
	$('#tabelaOfertasPendentes tr ').html('');
	var v_id = $(this).attr("id");
	var v_negocioFechado = 0;

	$.post('../api/api.php', {
		acao: 'atualizaOferta',
		id: v_id,
		negocioFechado: v_negocioFechado,
	}, function(data) {
		if ( data.status == "OK" ) {
			$('#modalOfertasPendentes').modal('hide');
			// mostra mensagem  de retorno
			$('#resultMessage').show();
			$('#resultMessage').removeClass('alert-danger');
			$('#resultMessage').addClass('alert-success').html(data.mensagem);
			// limpa form
			$('#formNegocios').trigger('reset');
			$('#sessaoValorContratado, #sessaoValorCartaoAtual, #sessaoNumeroOperacao, #sessaoSeguroOperacao, #sessaoValorSeguroOperacao').hide();
			$('#produtos, #status').select2("destroy");
			$('#produtos').select2();
			$('#status').select2({
				minimumResultsForSearch: -1
			});
		} else {
			$('#resultMessageModal').show();
			$('#resultMessageModal').removeClass('alert-success');
			$('#resultMessageModal').addClass('alert-danger').html(data.mensagem);
		}
		// Restaura o botão
		o_btn.removeAttr('disabled').html(o_label);
	}, 'json');
});