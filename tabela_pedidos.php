<?php if(!isset($_SESSION)) { session_start(); } ?>
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