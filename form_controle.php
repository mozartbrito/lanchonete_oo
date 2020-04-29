<?php include './layout/header.php'; ?>
<?php include './layout/menu.php'; ?>
<?php 
	require 'classes/Controle.php'; 
	require 'classes/ControleDAO.php';
	$controle = new Controle();
	if(isset($_GET['id']) && $_GET['id'] != '') {
		$id = $_GET['id'];
		$controleDAO = new ControleDAO();
		$controle = $controleDAO->get($id);
	}

?>

<div class="row" style="margin-top:40px">
	<div class="col-6 offset-3">
		<h2>Cadastrar controle</h2>
	</div>
	<div class="col-2">
		<a href="form_controle.php" class="btn btn-success">Novo controle</a>
	</div>
</div>

<div class="row">
	<div class="col-6 offset-3">
		<p>&nbsp;</p>
		<form action="controle_controle.php?acao=<?= ( $controle->getId() != '' ? 'editar' : 'cadastrar' )?>" method="post">
			<div class="form-group">
				<label for="id">ID</label>
				<input type="text" class="form-control" name="id" id="id" value="<?=($controle->getId() != '' ? $controle->getId() : '')?>" readonly>
			</div>
			<div class="form-group">
				<label for="nome">Nome:</label>
				<input type="text" class="form-control" name="nome" id="nome" required value="<?= ($controle->getNome() != '' ? $controle->getNome() : '') ?>" >
			</div>
			<div class="form-group">
				<label for="tipo">Tipo</label>
				<select name="tipo" class="form-control">
					<option value="Administrativo" <?= ($controle->getTipo() == 'Administrativo' ? 'selected' : '') ?>>Administrativo</option>
					<option value="Front" <?= ($controle->getTipo() == 'Front' ? 'selected' : '') ?>>Front</option>
				</select>
			</div>
			<div class="form-group">
				<label for="status">Status</label>
				<select name="status" class="form-control">
					<option value="1" <?= ($controle->getStatus() == 1 ? 'selected' : '') ?>>Ativo</option>
					<option value="0" <?= ($controle->getStatus() == 0 ? 'selected' : '') ?>>Inativo</option>
				</select>
			</div>
			<div class="form-group">
				<button type="submit" class="btn btn-primary">Salvar</button>
				<button type="reset" class="btn btn-warning">Resetar</button>
			</div>
		</form>
	</div>
</div>

<?php include './layout/footer.php'; ?>