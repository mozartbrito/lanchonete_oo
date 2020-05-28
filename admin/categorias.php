<?php include './layout/header.php'; ?>
<?php include './layout/menu.php'; ?>
<?php 
$permissoes = retornaControle('categoria');
if(empty($permissoes)) {
	header("Location: administrativa.php?msg=Sem permissão de acesso");
}

require 'classes/Categoria.php';
require 'classes/CategoriaDAO.php';
$categoriaDAO = new CategoriaDAO();
$categorias = $categoriaDAO->listar();

?>
<div class="row" style="margin-top:40px">
	<div class="col-10">
		<h2>Gerencias categorias</h2>
	</div>
	<?php if($permissoes['insert']) : ?>
		<div class="col-2">
			<a href="form_categoria.php" class="btn btn-success">Nova</a>
		</div>
	<?php endif; ?>
</div>
<div class="row">
	<table class="table table-hover table-bordered table-striped table-responsive-lg">
		<thead>
			<tr>
				<th>#ID</th>
				<th>Nome</th>
				<th>Ações</th>
			</tr>
		</thead>
		<tbody>
			<?php foreach($categorias as $categoria){ ?>
			<tr>
				<td><?= $categoria->getId() ?></td>
				<td><?= $categoria->getNome() ?></td>
				<td>
					<?php if($permissoes['update'] || $permissoes['show']): ?>
					<a href="form_categoria.php?id=<?= $categoria->getId() ?>"  class="btn btn-warning">
						<i class="fas fa-edit"></i>
					</a>
					<?php endif; ?>

					<?php if($permissoes['delete']): ?>
					<a href="controle_categoria.php?acao=deletar&id=<?= $categoria->getId() ?>" onclick="return confirm('Deseja realmente excluir?')" class="btn btn-danger">
						<i class="fas fa-trash-alt"></i>
					</a>
					<?php endif; ?>
				</td>
			</tr>
			<?php } ?>
		</tbody>
	</table>
</div>

<?php include './layout/footer.php'; ?>