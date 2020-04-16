<?php include './layout/header.php'; ?>
<?php include './layout/menu.php'; ?>
<?php 
	require 'classes/Usuario.php'; 
	require 'classes/UsuarioDAO.php';
	$usuario = new Usuario();
	if(isset($_GET['id']) && $_GET['id'] != '') {
		$id = $_GET['id'];
		$usuarioDAO = new UsuarioDAO();
		$usuario = $usuarioDAO->get($id);
	}

?>
<?php 
	if(isset($_GET['msg']) && $_GET['msg'] != '') {
	 echo '<div class="alert alert-info">'.$_GET['msg'].'</div>';
	}
?>
<div class="row" style="margin-top:40px">
	<div class="col-6 offset-3">
		<h2>Cadastrar usuario</h2>
	</div>
</div>

<div class="row">
	<div class="col-6 offset-3">
		<p>&nbsp;</p>
		<form action="controle_usuario.php?acao=<?= ( $usuario->getId() != '' ? 'editar' : 'cadastrar' )?>" method="post">
			<div class="form-group">
				<label for="id">ID</label>
				<input type="text" class="form-control" name="id" id="id" value="<?=($usuario->getId() != '' ? $usuario->getId() : '')?>" readonly>
			</div>
			<div class="form-group">
				<label for="nome">Nome</label>
				<input type="text" class="form-control" name="nome" id="nome" required value="<?= ($usuario->getNome() != '' ? $usuario->getNome() : '') ?>">
			</div>
			<div class="form-group">
				<label for="email">E-mail</label>
				<input type="email" name="email" id="email" class="form-control" required value="<?= ($usuario->getEmail() != '' ? $usuario->getEmail() : ''); ?>">
			</div>
			<div class="form-group">
				<label for="senha">Senha</label>
				<input type="password" name="senha" id="senha" class="form-control" 
				<?= ($usuario->getId() == '' ? ' required' : '' ) ?>>
			</div>
			<div class="form-group">
				<button type="submit" class="btn btn-primary">Salvar</button>
			</div>
		</form>
	</div>
</div>

<?php include './layout/footer.php'; ?>