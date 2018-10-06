$(document).ready(function(){

	var sw_check = document.querySelector('#seguroOperacao');

	// Toggle para input de valor do seguro
	sw_check.onchange = function() {
	  	if ( sw_check.checked ) 
	   		$('#sessaoValorSeguroOperacao').show();
	    else 
	       	$('#sessaoValorSeguroOperacao').hide();
	};


	$('#produtos').change(function(){

		// valores padrões
		$('#sessaoValorContratado, #sessaoValorCartaoAtual, #sessaoNumeroOperacao, #sessaoSeguroOperacao, #sessaoValorSeguroOperacao').hide();
		$('#sessaoValorContratado, #sessaoValorCartaoAtual, #sessaoNumeroOperacao, #sessaoSeguroOperacao, #sessaoValorSeguroOperacao').find('input[type=text]').val('');
		$('#sessaoValorContratado').find('label').html('Valor Contratado');
		sw_check.checked = false;
		//onChange(sw_check);

		// localiza tipo do produto
		var idProduto = $('option:selected', this).attr('id_produto');
		var idSegmentacao = $('option:selected', this).val();

		if ( idProduto >= 2 && idProduto <= 5 ) {
			if ( idProduto == 2 ) {
				$('#sessaoValorContratado').find('label').html('Valor Total do Prêmio');	
			}
			if ( idProduto == 3 ) {
				$('#sessaoValorContratado').find('label').html('Valor Investido');		
			}
			$('#sessaoValorContratado').show();
		} else if ( idProduto == 1 ) {
			$('#sessaoValorContratado, #sessaoNumeroOperacao, #sessaoSeguroOperacao').show();
		} else if ( idProduto == 7 && idSegmentacao == 39 ) {
			$('#sessaoValorContratado').find('label').html('Novo Limite Cartão');
			$('#sessaoValorContratado, #sessaoValorCartaoAtual').show();
		}
	});
});