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
		$('#sessaoValorContratado, #sessaoNumeroOperacao, #sessaoSeguroOperacao, #sessaoValorSeguroOperacao').hide();
		$('#sessaoValorContratado, #sessaoNumeroOperacao, #sessaoSeguroOperacao, #sessaoValorSeguroOperacao').find('input[type=text]').val('');
		sw_check.checked = false;
		//onChange(sw_check);

		// localiza tipo do produto
		var idProduto = $('option:selected', this).attr('id_produto');

		if (idProduto >= 2 && idProduto <= 5 ) {
			$('#sessaoValorContratado').show();
		} else if ( idProduto == 1 ) {
			$('#sessaoValorContratado, #sessaoNumeroOperacao, #sessaoSeguroOperacao').show();
		}



	});
});