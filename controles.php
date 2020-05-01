<?php include './layout/header.php'; ?>
<?php include './layout/menu.php'; ?>
<?php 

require 'classes/Controle.php';
require 'classes/ControleDAO.php';
$controleDAO = new ControleDAO();
$controles = $controleDAO->listar();

?>
<div class="row" style="margin-top:40px">
	<div class="col-10">
		<h2>Gerenciar controles</h2>
	</div>
	<div class="col-2">
		<a href="form_controle.php" class="btn btn-success">Novo controle</a>
	</div>
</div>
<div class="row">
	<table class="table table-hover table-bordered table-striped table-responsive-lg">
		<thead>
			<tr>
				<th>#ID</th>
				<th>Nome</th>
				<th>Tipo</th>
				<th>Status</th>
				<th>Ações</th>
			</tr>
		</thead>
		<tbody>
			<?php foreach($controles as $controle){ ?>
			<tr>
				<td><?= $controle->getId() ?></td>
				<td><?= $controle->getNome() ?></td>
				<td><?= $controle->getTipo() ?></td>
				<td><?= ($controle->getStatus() == 1 ? 'Ativo' : 'Inativo') ?></td>
				<td>
					<a href="form_controle.php?id=<?= $controle->getId() ?>"  class="btn btn-warning">
						<i class="fas fa-edit"></i>
					</a>
					<a href="controle_controle.php?acao=deletar&id=<?= $controle->getId() ?>" onclick="return confirm('Deseja realmente excluir?')" class="btn btn-danger">
						<i class="fas fa-trash-alt"></i>
					</a>
				</td>
			</tr>
			<?php } ?>
		</tbody>
	</table>
</div>

<?php include './layout/footer.php'; ?>