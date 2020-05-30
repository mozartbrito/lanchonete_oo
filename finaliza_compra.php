<?php
include_once('header.php');
include_once('menu.php');
if(isset($_GET['tipo'])) {
	$tipo = $_GET['tipo'];
} else  {
	$tipo = 'logar';
}
?>
<main class="container sobre">
	<div class="row">
		<div class="col-12">
			<h1>Finalizar pedido</h1>
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
                  <td><?= $compra['qtd_produto']; ?></td>
                  <td>R$ <?= number_format(($compra['qtd_produto'] * $compra['val_produto']),2,',','.'); ?></td>
                  <td>
                    <a href="adiciona_produto.php?acao=removerItem&key=<?= $key; ?>" class="btn btn-sm btn-danger" onclick="return confirm('Deseja remover o item da sacola?')">
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
                  <th colspan="3" class="text-right">Total</th>
                  <th colspan="3" class="text-left">R$ <?= number_format($total,2,',','.') ?></th>
                </tr>
              </table>

			<form action="logar.php?tipo=<?php echo $tipo; ?>" method="post">
				<div class="form-group">
					<label for="email">E-mail:</label>
					<input type="text" name="email" id="email" value="" class="form-control">
				</div>
				<div class="form-group">
					<label for="senha">Senha:</label>
					<input type="password" name="senha" id="senha" value="" class="form-control">
				</div>
				<div class="form-group">
					<button type="submit" class="btn btn-primary w-100">Efetuar login</button>
				</div>
			</form>
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