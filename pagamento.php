<?php
include_once('header.php');

if(!isset($_SESSION['perfil']) && $_SESSION['perfil'] == '') {
	$msg = 'Usuário não efetuou login.';
	header("Location: login.php?msg=$msg");
} 
include_once('admin/classes/Produto.php');
include_once('admin/classes/ProdutoDAO.php');
include_once('admin/classes/Venda.php');
include_once('admin/classes/VendaDAO.php');
include_once('admin/classes/VendaProduto.php');
include_once('admin/classes/VendaProdutoDAO.php');

$vendaDAO = new VendaDAO();
$venda = new Venda();
$vendaProdutoDAO = new VendaProdutoDAO();

//alimentando o objeto de venda
$venda->setCodigo(date('YmdHms').gettimeofday()["usec"]);
$venda->setClienteId($_SESSION['id_cliente']);
$venda->setDataVenda(date('Y-m-d H:i:s'));
$venda->setDataFinalizacao(date('Y-m-d H:i:s'));
$venda->setDataPagamento(date('Y-m-d H:i:s'));
$venda->setFormaPagamento($_POST['forma_pagamento']);
$venda->setStatus($_POST['status']);

/*echo '<pre>';
print_r($venda);
exit;*/
//inserindo a venda no BD e recurando o id
$id_venda = $vendaDAO->insereVenda($venda);
//add o id da venda no objeto
$venda->setId($id_venda);
//echo $id_venda; //exit;
if(isset($_SESSION['compras']) && $_SESSION['compras'] != '') {
 foreach ($_SESSION['compras'] as $item) {
 	$vendaProduto = new VendaProduto();
 	$vendaProduto->setVendaId($venda->getId());
 	$vendaProduto->setProdutoId($item['produto_id']);
 	$vendaProduto->setValor($item['val_produto']);
 	$vendaProduto->setQtd($item['qtd_produto']);
 	$vendaProduto->setDesconto(0);
/*echo '<pre>';
print_r($vendaProduto);
exit;*/
 	$vendaProdutoDAO->insereVendaProduto($vendaProduto);

 }

}
 unset($_SESSION['compras']);
 $msg = 'Compra finalizada com sucesso';
 header("Location: index.php?msg=$msg");
 exit;

include_once('menu.php');

?>
<main class="container sobre">
	<div class="row">
		<div class="col-12">
			<h1>Dados do cliente</h1>
			<div class="card">
				<div class="card-body">
					<p>Nome: <strong><?= $_SESSION['nome'] ?></strong></p>
					<p>E-mail: <strong><?= $_SESSION['email'] ?></strong></p>
					<p>Telefone: <strong><?= $_SESSION['telefone'] ?></strong></p>
					<p>Endereço: <strong><?= $_SESSION['logradouro'].' '.$_SESSION['numero'].', '.$_SESSION['logradouro'] ?></strong></p>
					<p>Cidade/Estado/CEP: <strong><?= $_SESSION['cidade'].'/'.$_SESSION['estado'].'/'.$_SESSION['cep'] ?></strong></p>
					<p>CEP: <strong><?= $_SESSION['cep'] ?></strong></p>
				</div>
			</div>
          </div>
	</div>
	<div class="row">
		<div class="col-12">
			<h1>Dados do pedido</h1>
			<div id="tabela_pedido">
				<table class="table">
					<tr>
					  <th>#</th>
					  <th>Descrição</th>
					  <th>Valor</th>
					  <th>Qtd</th>
					  <th>Subtotal</th>
					  <th>Ação</th>
					</tr>
					<?php $total = 0;
					$n = 1;
					if(isset($_SESSION['compras'])) {
					foreach ($_SESSION['compras'] as $key => $compra) : ?>
					<tr>
					  <td>#<?= $n; ?></td>
					  <td><?= $compra['nome_produto']; ?></td>
					  <td>R$ <?= $compra['preco_produto']; ?></td>
					  <td>
					  	<?php if($compra['qtd_produto'] > 1): ?>
					    <a href="#" class="text-danger" onclick="AddRemoveItem(<?= $key; ?>, <?= $compra['qtd_produto'] - 1; ?>); return false;">
					      <i class="fas fa-minus-circle"></i>
					    </a>
						<?php else: ?>
							<a href="#" class="text-secondary" onclick="return false;">
						      <i class="fas fa-minus-circle"></i>
						    </a>
						<?php endif; ?>
					  	<span class="qtd_itens"><?= $compra['qtd_produto']; ?></span>
					  	<a href="#" class="text-success" onclick="AddRemoveItem(<?= $key; ?>, <?= $compra['qtd_produto'] + 1; ?>); return false;">
					      <i class="fas fa-plus-circle"></i>
					    </a>
					  		
					  	</td>
					  <td>R$ <?= number_format(($compra['qtd_produto'] * $compra['val_produto']),2,',','.'); ?></td>
					  <td>
					    <a href="#" class="btn btn-sm btn-danger" onclick="excluiItem(<?= $key; ?>); return false;">
					      <i class="fas fa-trash"></i>
					    </a>
					  </td>
					</tr>
					<?php
					  $n++; 
					  $total += ($compra['qtd_produto'] * $compra['val_produto']);
					endforeach;
					} ?>
					<tr>
					  <th class="text-right">Total</th>
					  <th colspan="5" class="text-left">R$ <?= number_format($total,2,',','.') ?></th>
					</tr>
				</table>
	          </div>
		</div>
	</div>
		<form action="pagamento.php" method="post">
		<h1>Pagamento finalizado</h1>
	<!-- <div class="row">
		<div class="col-md-6">
			<div class="form-group">
				<label for="status">Status do pedido:</label>
				<select name="status" class="form-control">
					<option value="">Escolha</option>
					<option value="Iniciada">Iniciada</option>
					<option value="Pendente">Pendente</option>
					<option value="Finalizada">Finalizada</option>					
				</select>
			</div>
			
		</div>
		<div class="col-md-6">
			<div class="form-group">
				<label for="forma_pagamento">Forma de Pagamento:</label>
				<select name="status" class="form-control">
					<option value="">Escolha</option>
					<option value="Dinheiro">Dinheiro</option>
					<option value="Débito">Débito</option>
					<option value="Cartão de crédito">Cartão de crédito</option>					
					<option value="Cartão">Cartão</option>					
				</select>
			</div>
			<div class="form-group">
				<button type="submit" class="btn btn-primary w-100">Finalizar pagamento</button>
			</div>
		</div>
	</div> -->
		</form>
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