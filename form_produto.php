<?php include './layout/header.php'; ?>
<?php include './layout/menu.php'; ?>
<?php
	$permissoes = retornaControle('produto');
	if(empty($permissoes)) {
		header("Location: adminstrativa.php?msg=Acesso negado.");
	}
	require 'classes/Categoria.php';
	require 'classes/CategoriaDAO.php';
	require 'classes/Imagem.php';
	require 'classes/ImagemDAO.php';

	$categoriaDAO = new CategoriaDAO();
	$categorias = $categoriaDAO->listar();

	require 'classes/Produto.php'; 
	require 'classes/ProdutoDAO.php';
	$produto = new Produto();
	if(isset($_GET['id']) && $_GET['id'] != '') {
		$id = $_GET['id'];
		$produtoDAO = new ProdutoDAO();
		$produto = $produtoDAO->get($id);
		$imagemDAO = new ImagemDAO();
		$imagens = $imagemDAO->listarPorProduto($id);
	}

?>
<div class="row" style="margin-top:40px">
	<div class="col-6 offset-3">
		<h2>Cadastrar produto</h2>
	</div>
</div>
<div class="row">
	<div class="col-6 <?= ( $produto->getId() != '' ? '' : 'offset-3' )?>">
		<p>&nbsp;</p>
		<form action="controle_produto.php?acao=<?= ( $produto->getId() != '' ? 'editar' : 'cadastrar' )?>" method="post">
			<div class="row">
				<div class="col-3">
					<div class="form-group">
						<label for="id">ID</label>
						<input type="text" class="form-control" name="id" id="id" value="<?=($produto->getId() != '' ? $produto->getId() : '')?>" readonly>
					</div>
				</div>
				<div class="col-9">
					<div class="form-group">
						<label for="nome">Nome</label>
						<input type="text" class="form-control" name="nome" id="nome" required value="<?= ($produto->getNome() != '' ? $produto->getNome() : '') ?>">
					</div>
				</div>
			</div>
			<div class="row">
				<div class="col-3">	
					<div class="form-group">
						<label for="preco">Quantidade</label>
						<input type="text" name="qtd" id="qtd" value="<?= ($produto->getQtd() != '' ? $produto->getQtd() : '0' ) ?>" class="form-control">
					</div>
				</div>
				<div class="col-3">	
					<div class="form-group">
						<label for="preco">Preço</label>
						<input type="text" name="preco" id="preco" value="<?= ($produto->getPreco() != '' ? $produto->getPreco() : '0,00' ) ?>" class="form-control moeda">
					</div>
				</div>
				<div class="col-6">
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
					
				</div>
			</div>
			<div class="row">
				<div class="col">
					<div class="form-group">
						<label for="descricao">Descrição do produto:</label>
						<textarea name="descricao" id="descricao" class="form-control" rows="5"><?= ($produto->getDescricao() != '' ? $produto->getDescricao() : '') ?></textarea>
					</div>
				</div>
			</div>
			<?php if(($permissoes['insert'] && $produto->getId() == '') || ($permissoes['update'] && $produto->getId() != '')): ?>
			<div class="form-group">
				<button type="submit" class="btn btn-primary w-100">Salvar</button>
			</div>
			<?php endif; ?>
		</form>
	</div>

	<?php if($produto->getId() != ''): ?>
		<div class="col-6">
			<p>&nbsp;</p>
			<p>&nbsp;</p>
		<?php 
			$permissoesImagens = retornaControle('imagensProduto');

			if(!empty($permissoesImagens)): 
		?>
			
			<div class="card">
				<div class="card-header">
					Imagens
				</div>
				<div class="card-body">
					<form action="controle_produto.php?acao=cadastraImagens" method="post" enctype="multipart/form-data">
						<input type="hidden" name="produto_id" value="<?= $produto->getId();  ?>">
						<div class="custom-file">
						  <input type="file" class="custom-file-input" name="imagens[]" id="imagens" multiple>
						  <label class="custom-file-label" for="imagens">Escolha as imagens</label>
						</div>
						<br>
						<br>
						<button type="submit" class="btn btn-info w-100">Cadastrar imagens</button>
					</form>
				</div>
			</div>
			<?php endif; ?>
			<div class="card">
				<div class="card-header">
					Imagens cadastradas
				</div>
				<div class="card-body">
					<?php foreach($imagens as $imagem): ?>
						<img src="<?= $imagem->getCaminho(); ?>" class="img-thumbnail" width="150px">
					<?php endforeach; ?>
				</div>
			</div>
		</div>
	<?php endif; ?>
</div>

<?php include './layout/footer.php'; ?>