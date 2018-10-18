<!-- modal para ofertas pendentes -->
<div class="modal fade " id="modalCadastroClientesEspera" tabindex="-1" role="dialog" aria-labelledby="tituloModal" aria-hidden="true">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="tituloModal" style="color: black">Cadastro de clientes em espera</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<div class="modal-body">
				<div id="resultMessageModal" class="alert text-center" style="display: none; color:black !important;">
				</div>
				<div class="row">
					<form class="form-inline" id="formClientesEspera" method="post">
						<div class="form-group">
							<label for="clientes em espera" class="col-sm-8 col-form-label" style="color: black !important;">Quantidade Clientes em Espera</label>
							<div class="col-sm-4">
								<input type="text" maxlength="5" name="clientesEspera" class="form-control" id="clientesEspera" data-mask="00000" autofocus>
							</div>
						</div>
					</form>
				</div>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-secondary" data-dismiss="modal">Fechar</button>
				<button type="button" class="btn btn-primary" id="salvarClientesEspera">Salvar</button>
			</div>
		</div>
	</div>
</div>
			<!-- fim modal para ofertas pendentes -->

<script src="../assets/js/jquery.js"></script>
<script src="../assets/js/bootstrap.js"></script>
<script src="../assets/js/jquery.mask.js"></script>
<script src="../assets/js/sidebar.js"></script>
<script src="../assets/js/mousetrap/mousetrap.min.js"></script>
<script>
	Mousetrap.bind('?', function(e){
		$('#modalCadastroClientesEspera').modal('show');
		$('#formClientesEspera').trigger('reset');
		$('#resultMessageModal').hide();
		$('#resultMessageModal').removeClass('alert-danger alert-success');
		return false;
	});
	// forçar autofocus no input do modal
	$('.modal').on('shown.bs.modal', function() {
  		$(this).find('[autofocus]').focus();
	});
	$('#salvarClientesEspera').on('click',function(event){
		event.preventDefault();
		var v_quantidadeEmEspera = $('#clientesEspera').val();

		// desabilita botão
		var o_btn = $('#salvarClientesEspera');
		var o_label = o_btn.html();
		o_btn.attr('disabled', 'disabled').html('Aguarde...');

		$.post('../api/api.php',{
			acao: 'clientesEmEspera',
			quantidadeEmEspera: v_quantidadeEmEspera
		}, function(data){
			if ( data.status == "OK" ) {
				// mostra mensagem  de retorno
				$('#resultMessageModal').show();
				$('#resultMessageModal').removeClass('alert-danger');
				$('#resultMessageModal').addClass('alert-success').html(data.mensagem);
				$('#modalCadastroClientesEspera').modal('hide');
			} else {
				$('#resultMessageModal').show();
				$('#resultMessageModal').removeClass('alert-success');
				$('#resultMessageModal').addClass('alert-danger').html(data.mensagem);
			}

			// Restaura o botão
			o_btn.removeAttr('disabled').html(o_label);
		},'json');
	});
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