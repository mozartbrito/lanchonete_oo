<?php
include_once('header.php');

if(!isset($_SESSION['perfil']) && $_SESSION['perfil'] == '') {
	$msg = 'Usuário não efetuou login.';
	header("Location: login.php?msg=$msg");
} 
include_once('menu.php');

/*include_once('admin/classes/Produto.php');
include_once('admin/classes/ProdutoDAO.php');*/
include_once('admin/classes/Venda.php');
include_once('admin/classes/VendaDAO.php');
include_once('admin/classes/VendaProduto.php');
include_once('admin/classes/VendaProdutoDAO.php');

$vendaDAO = new VendaDAO();
$venda = new Venda();
$vendaProdutoDAO = new VendaProdutoDAO();
$cliente_id = $_SESSION['id_cliente'];

$vendasPendentes = $vendaDAO->listaVendasCliente(" cliente_id = {$cliente_id} and status in ('Pendente', 'Iniciada')");
$vendasFinalizadas = $vendaDAO->listaVendasCliente(" cliente_id = {$cliente_id} and status in ('Finalizada')");

?>
<main class="container sobre">
	<div class="row">
		<div class="col-12">
			<div class="card">
				<div class="card-body">
					<p>Nome: <strong><?= $_SESSION['nome'] ?></strong></p>
					<p>E-mail: <strong><?= $_SESSION['email'] ?></strong></p>
				</div>
			</div>
          </div>
	</div>
	<div class="row">
		<div class="col-md-12">
			<h1>Compras realizadas</h1>
			<ul class="nav nav-tabs" id="myTab" role="tablist">
			  <li class="nav-item">
			    <a class="nav-link active" id="pendentes" data-toggle="tab" href="#home" role="tab" aria-controls="home" aria-selected="true"><strong>Pendentes</strong></a>
			  </li>
			  <li class="nav-item">
			    <a class="nav-link" id="finalizadas" data-toggle="tab" href="#perfil" role="tab" aria-controls="profile" aria-selected="false"><strong>Encerrados</strong></a>
			  </li>
			</ul>
			<div class="tab-content" id="myTabContent">
			  <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="pendentes">
			  	<table class="table">
					<tr>
					  <th>#</th>
					  <th>Código</th>
					  <th>Data</th>
					  <th>Forma pagamento</th>
					  <th>Status</th>
					  <th>Produtos</th>
					</tr>
					<?php 
					foreach ($vendasPendentes as $pend): 
						$produtos = $vendaProdutoDAO->listaProdutoCliente($pend->getId());
					?>
						<tr>
						  <td>#<?= $pend->getId(); ?></td>
						  <td><?= $pend->getCodigo(); ?></td>
						  <td><?= $pend->getDataVenda(); ?></td>
						  <td>
						  	<?= $pend->getFormaPagamento(); ?>
						  </td>
						  <td><?= $pend->getStatus(); ?></td>
						  <td>
							  <a class="nav-link" href="#" id="pedidos" data-toggle="modal" data-target="#listaprodutos<?= $pend->getId(); ?>">Ver produtos</a>

						    <div class="modal fade" id="listaprodutos<?= $pend->getId(); ?>" tabindex="-1" role="dialog" aria-labelledby="labelCompra" aria-hidden="true">
					        <div class="modal-dialog modal-lg" role="document">
					          <div class="modal-content">
					            <div class="modal-header">
					              <h5 class="modal-title" id="labelCompra">Lista de produtos</h5>
					              <button type="button" class="close" data-dismiss="modal" aria-label="Fechar">
					                <span aria-hidden="true">&times;</span>
					              </button>
					            </div>
					            <div class="modal-body" id="tabela_pedidos_modal">
					              <table class="table">
									<tr>
									  <th>#</th>
									  <th>Descrição</th>
									  <th>Valor</th>
									  <th>Qtd</th>
									  <th>Subtotal</th>
									</tr>
									<?php $total = 0;
									$n = 1;
									
									foreach ($produtos as $key => $prod) : ?>
									<tr>
									  <td>#<?= $n; ?></td>
									  <td><?= $prod->nome; ?></td>
									  <td>R$ <?= $prod->getValor(); ?></td>
									  <td><?= $prod->getQtd(); ?></td>
									  <td>R$ <?= number_format(($prod->getQtd() * $prod->getValor()),2,',','.'); ?></td>
									</tr>
									<?php
									  $n++; 
									  $total += ($prod->getQtd() * $prod->getValor());
									endforeach;
									 ?>
									<tr>
									  <th class="text-right">Total</th>
									  <th colspan="4" class="text-left">R$ <?= number_format($total,2,',','.') ?></th>
									</tr>
								</table>
					            </div>
					            <div class="modal-footer">
					              <button type="button" class="btn btn-danger" data-dismiss="modal">Fechar janela</button>
					            </div>
					          </div>
					        </div>
					      </div>
						  </td>
						</tr>
						

					<?php endforeach; ?>
				</table>
				<?php if(empty($vendasPendentes)): ?>
			  		<div class="alert alert-info">
			  			Nenhuma compra pendente.
			  		</div>
			  	<?php endif; ?>
			  </div>
			  <div class="tab-pane fade" id="perfil" role="tabpanel" aria-labelledby="finalizadas">
			  	
			  	<table class="table">
					<tr>
					  <th>#</th>
					  <th>Código</th>
					  <th>Data</th>
					  <th>Forma pagamento</th>
					  <th>Status</th>
					  <th>Produtos</th>
					</tr>
					<?php 
					foreach ($vendasFinalizadas as $pend): 
						$produtos = $vendaProdutoDAO->listaProdutoCliente($pend->getId());
					?>
						<tr>
						  <td>#<?= $pend->getId(); ?></td>
						  <td><?= $pend->getCodigo(); ?></td>
						  <td><?= $pend->getDataVenda(); ?></td>
						  <td>
						  	<?= $pend->getFormaPagamento(); ?>
						  </td>
						  <td><?= $pend->getStatus(); ?></td>
						  <td>
							  <a class="nav-link" href="#" id="pedidos" data-toggle="modal" data-target="#listaprodutos<?= $pend->getId(); ?>">Ver produtos</a>
						    <div class="modal fade" id="listaprodutos<?= $pend->getId(); ?>" tabindex="-1" role="dialog" aria-labelledby="labelCompra" aria-hidden="true">
					        <div class="modal-dialog modal-lg" role="document">
					          <div class="modal-content">
					            <div class="modal-header">
					              <h5 class="modal-title" id="labelCompra">Lista de produtos</h5>
					              <button type="button" class="close" data-dismiss="modal" aria-label="Fechar">
					                <span aria-hidden="true">&times;</span>
					              </button>
					            </div>
					            <div class="modal-body" id="tabela_pedidos_modal">
					              <table class="table">
									<tr>
									  <th>#</th>
									  <th>Descrição</th>
									  <th>Valor</th>
									  <th>Qtd</th>
									  <th>Subtotal</th>
									</tr>
									<?php $total = 0;
									$n = 1;
									
									foreach ($produtos as $key => $prod) : ?>
									<tr>
									  <td>#<?= $n; ?></td>
									  <td><?= $prod->nome; ?></td>
									  <td>R$ <?= $prod->getValor(); ?></td>
									  <td><?= $prod->getQtd(); ?></td>
									  <td>R$ <?= number_format(($prod->getQtd() * $prod->getValor()),2,',','.'); ?></td>
									</tr>
									<?php
									  $n++; 
									  $total += ($prod->getQtd() * $prod->getValor());
									endforeach;
									 ?>
									<tr>
									  <th class="text-right">Total</th>
									  <th colspan="4" class="text-left">R$ <?= number_format($total,2,',','.') ?></th>
									</tr>
								</table>
					            </div>
					            <div class="modal-footer">
					              <button type="button" class="btn btn-danger" data-dismiss="modal">Fechar janela</button>
					            </div>
					          </div>
					        </div>
					      </div>
						  </td>
						</tr>
						

					<?php endforeach; ?>
				</table>
				<?php if(empty($vendasFinalizadas)): ?>
			  		<div class="alert alert-info">
			  			Nenhuma compra finalizada.
			  		</div>
			  	<?php endif; ?>
			  </div>
			</div>
		</div>
	</div>

		
	<p>&nbsp;</p>
	<p>&nbsp;</p>
	<p>&nbsp;</p>
	<p>&nbsp;</p>
</main>
<?php
include_once('footer.php');
?>

<script>
	$('.cep').on('change', function() {
	var cep = $(this).val().replace('-', '');
	
	$.ajax({
		url: 'https://viacep.com.br/ws/' + cep + '/json/',
		type: 'GET',
		dataType: 'json',
		beforeSend:function() {
			$('#logradouro').val('...');
			$('#bairro').val('...');
			$('#cidade').val('...');
			$('#estado').val('...');
		},
		success: function(resultado) {
			if(typeof resultado.logradouro === "undefined") {
				$('#msg-cep').show();
				$('#cep').val('');
				$('#logradouro').val('');
				$('#bairro').val('');
				$('#cidade').val('');
				$('#estado').val('');
				$('#cep').focus();
			} else {
				$('#msg-cep').hide();
				$('#logradouro').val(resultado.logradouro);
				$('#bairro').val(resultado.bairro);
				$('#cidade').val(resultado.localidade);
				$('#estado').val(resultado.uf);
				$('#numero').focus();

			}
	    }, 
	})
	
})
</script>
?>