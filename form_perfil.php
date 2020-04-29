<?php include './layout/header.php'; ?>
<?php include './layout/menu.php'; ?>
<?php 
	require 'classes/Perfil.php'; 
	require 'classes/PerfilDAO.php';
	$perfil = new Perfil();
	if(isset($_GET['id']) && $_GET['id'] != '') {
		$id = $_GET['id'];
		$perfilDAO = new PerfilDAO();
		$perfil = $perfilDAO->get($id);
	}

?>

<div class="row" style="margin-top:40px">
	<div class="offset-3">
		<h2>Cadastrar perfil</h2>
	</div>
	<div class="col-2">
		<a href="form_perfil.php" class="btn btn-success">Novo perfil</a>
	</div>
</div>

<div class="row">
	<div class="col-6 <?= ( $perfil->getId() != '' ? '' : 'offset-3' )?>">
		<p>&nbsp;</p>
		<form action="controle_perfil.php?acao=<?= ( $perfil->getId() != '' ? 'editar' : 'cadastrar' )?>" method="post">
			<div class="form-group">
				<label for="id">ID</label>
				<input type="text" class="form-control" name="id" id="id" value="<?=($perfil->getId() != '' ? $perfil->getId() : '')?>" readonly>
			</div>
			<div class="form-group">
				<label for="nome">Descrição:</label>
				<input type="text" class="form-control" name="descricao" id="descricao" required value="<?= ($perfil->getDescricao() != '' ? $perfil->getDescricao() : '') ?>">
			</div>
			<div class="form-group">
				<label for="status">Status</label>
				<select name="status" class="form-control">
					<option value="1" <?= ($perfil->getStatus() == 1 ? 'selected' : '') ?>>Ativo</option>
					<option value="0" <?= ($perfil->getStatus() == 1 ? 'selected' : '') ?>>Inativo</option>
				</select>
			</div>
			<div class="form-group">
				<button type="submit" class="btn btn-primary">Salvar</button>
				<button type="reset" class="btn btn-warning">Resetar</button>
			</div>
		</form>
	</div>
<?php if($perfil->getId() != ''): 
	require 'classes/Controle.php'; 
	require 'classes/ControleDAO.php';
	require 'classes/Permissao.php'; 
	require 'classes/PermissaoDAO.php';

	$controleDAO = new ControleDAO();
	$controles = $controleDAO->listar();
	$permissaoDAO = new PermissaoDAO();
	$permissoes = $permissaoDAO->listarControles("perfil_id = {$perfil->getId()}");
?>
	<div class="col-6">
		<p>&nbsp;</p>
		<p>&nbsp;</p>
		<div class="card">
			<div class="card-header">
				Cadastro de permissões
			</div>
			<div class="card-body">
				<form action="controle_perfil.php?acao=cadastraPermissao" method="post">
				<div class="form-group">
					<input type="hidden" name="perfil_id" value="<?= $perfil->getId(); ?>">
				    <select name="controle_id" class="form-control" required >
					    <option value="">Escolha o controle</option>
						<?php foreach($controles as $controle) : ?>
					    	<option value="<?= $controle->getId(); ?>"><?= $controle->getNome(); ?></option>
					    <?php endforeach; ?>
				    </select>
				</div>

				<div class="form-check form-check-inline">
				  <input class="form-check-input" checked type="checkbox" id="inlineCheckbox1" value="1" name="select">
				  <label class="form-check-label" for="inlineCheckbox1">select</label>
				</div>
				<div class="form-check form-check-inline">
				  <input class="form-check-input" checked type="checkbox" id="inlineCheckbox2" value="1" name="insert">
				  <label class="form-check-label" for="inlineCheckbox2">insert</label>
				</div>
				<div class="form-check form-check-inline">
				  <input class="form-check-input" checked type="checkbox" id="inlineCheckbox2" value="1" name="update">
				  <label class="form-check-label" for="inlineCheckbox2">update</label>
				</div>
				<div class="form-check form-check-inline">
				  <input class="form-check-input" checked type="checkbox" id="inlineCheckbox2" value="1" name="delete">
				  <label class="form-check-label" for="inlineCheckbox2">delete</label>
				</div>
				<div class="form-check form-check-inline">
				  <input class="form-check-input" checked type="checkbox" id="inlineCheckbox2" value="1" name="show">
				  <label class="form-check-label" for="inlineCheckbox2">show</label>
				</div>
				<button type="submit" class="btn btn-primary w-100">Adicionar permissão</button>
				</form>
			</div>
		</div>

		<div class="card">
				<div class="card-header">
					Permissões cadastradas
				</div>
				<div class="card-body">
					<table class="table">
						<tr>
							<th>Controle</th>
							<th>Permissões</th>
							<th>Ações</th>
						</tr>
						<?php foreach($permissoes as $permissao): ?>
						<tr>
							<td><?= $permissao->controle; ?></td>
							<td>
								<?= ($permissao->getSelect() == 1 ? '->select' : ''); ?>
								<?= ($permissao->getInsert() == 1 ? '->insert': '') ?>
								<?= ($permissao->getDelete() == 1 ? '->delete': '') ?> 
								<?= ($permissao->getUpdate() == 1 ? '->update': '') ?>
								<?= ($permissao->getShow() == 1 ? '->show': ''
) ?>					</td>
							<td>
								<i class="fas fa-trash"></i>
							</td>
						</tr>
						<?php endforeach; ?>
					</table>
				</div>
			</div>
	</div>
<?php endif; ?>
</div>

<?php include './layout/footer.php'; ?>