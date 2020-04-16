<?php include './layout/header.php'; ?>
<?php include './layout/menu.php'; ?>
<?php 
	require 'classes/Categoria.php';
	require 'classes/CategoriaDAO.php';

	$categoriaDAO = new CategoriaDAO();
	$categorias = $categoriaDAO->listar();

	require 'classes/Produto.php'; 
	require 'classes/ProdutoDAO.php';
	$produto = new Produto();
	if(isset($_GET['id']) && $_GET['id'] != '') {
		$id = $_GET['id'];
		$produtoDAO = new ProdutoDAO();
		$produto = $produtoDAO->get($id);
	}

?>
<div class="row" style="margin-top:40px">
	<div class="col-6 offset-3">
		<h2>Cadastrar produto</h2>
	</div>
</div>
<div class="row">
	<div class="col-6 offset-3">
		<p>&nbsp;</p>
		<form action="controle_produto.php?acao=<?= ( $produto->getId() != '' ? 'editar' : 'cadastrar' )?>" method="post">
			<div class="form-group">
				<label for="id">ID</label>
				<input type="text" class="form-control" name="id" id="id" value="<?=($produto->getId() != '' ? $produto->getId() : '')?>" readonly>
			</div>
			<div class="form-group">
				<label for="nome">Nome</label>
				<input type="text" class="form-control" name="nome" id="nome" required value="<?= ($produto->getNome() != '' ? $produto->getNome() : '') ?>">
			</div>
			<div class="form-group">
				<label for="preco">Preço</label>
				<input type="text" name="preco" id="preco" value="<?= ($produto->getPreco() != '' ? $produto->getPreco() : '0,00' ) ?>" class="form-control moeda">
			</div>
			<div class="form-group">
				<label for="categoria">Categoria</label>
				<select name="categoria" id="categoria" class="form-control" required>
					<option value="">Selecione a categoria</option>
					<?php foreach($categorias as $categoria) : ?>
						<option value="<?= $categoria->getId(); ?>"
							<?= ($produto->getCategoria() != '' && 
								$produto->getCategoria() == $categoria->getId() 
								? 'selected' : '') ?>
						><?= $categoria->getNome(); ?></option>
					<?php endforeach; ?>
				</select>
			</div>
			<div class="form-group">
				<button type="submit" class="btn btn-primary">Salvar</button>
			</div>
		</form>
	</div>
</div>

<?php include './layout/footer.php'; ?>