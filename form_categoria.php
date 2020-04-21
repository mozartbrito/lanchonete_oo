<?php include './layout/header.php'; ?>
<?php include './layout/menu.php'; ?>
<?php 
	require 'classes/Categoria.php'; 
	require 'classes/CategoriaDAO.php';
	$categoria = new Categoria();
	if(isset($_GET['id']) && $_GET['id'] != '') {
		$id = $_GET['id'];
		$categoriaDAO = new CategoriaDAO();
		$categoria = $categoriaDAO->get($id);
	}

?>

<div class="row" style="margin-top:40px">
	<div class="col-6 offset-3">
		<h2>Cadastrar categoria</h2>
	</div>
</div>

<div class="row">
	<div class="col-6 offset-3">
		<p>&nbsp;</p>
		<form action="controle_categoria.php?acao=<?= ( $categoria->getId() != '' ? 'editar' : 'cadastrar' )?>" method="post">
			<div class="form-group">
				<label for="id">ID</label>
				<input type="text" class="form-control" name="id" id="id" value="<?=($categoria->getId() != '' ? $categoria->getId() : '')?>" readonly>
			</div>
			<div class="form-group">
				<label for="nome">Nome</label>
				<input type="text" class="form-control" name="nome" id="nome" required value="<?= ($categoria->getNome() != '' ? $categoria->getNome() : '') ?>">
			</div>
			<div class="form-group">
				<button type="submit" class="btn btn-primary">Salvar</button>
				<button type="reset" class="btn btn-warning">Resetar</button>
			</div>
		</form>
	</div>
</div>

<?php include './layout/footer.php'; ?>