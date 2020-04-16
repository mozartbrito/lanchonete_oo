<?php include './layout/header.php'; ?>
<?php include './layout/menu.php'; ?>
<?php 

require 'classes/Usuario.php';
require 'classes/UsuarioDAO.php';
$usuarioDAO = new UsuarioDAO();
$usuarios = $usuarioDAO->listar();

?>
<?php 
	if(isset($_GET['msg']) && $_GET['msg'] != '') {
	 echo '<div class="alert alert-info">'.$_GET['msg'].'</div>';
	}
?>
<div class="row" style="margin-top:40px">
	<div class="col-10">
		<h2>Gerenciar usuarios</h2>
	</div>
	<div class="col-2">
		<a href="form_usuario.php" class="btn btn-success">Nova</a>
	</div>
</div>
<div class="row">
	<table class="table table-hover table-bordered table-striped">
		<thead>
			<tr>
				<th>#ID</th>
				<th>Nome</th>
				<th>E-mail</th>
				<th>Ações</th>
			</tr>
		</thead>
		<tbody>
			<?php foreach($usuarios as $usuario){ ?>
			<tr>
				<td><?= $usuario->getId() ?></td>
				<td><?= $usuario->getNome() ?></td>
				<td><?= $usuario->getEmail() ?></td>
				<td>
					<a href="form_usuario.php?id=<?= $usuario->getId() ?>">Editar</a> | 
					<a href="controle_usuario.php?acao=deletar&id=<?= $usuario->getId() ?>" onclick="return confirm('Deseja realmente excluir?')">Excluir</a>
				</td>
			</tr>
			<?php } ?>
		</tbody>
	</table>
</div>

<?php include './layout/footer.php'; ?>