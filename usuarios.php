<?php include './layout/header.php'; ?>
<?php include './layout/menu.php'; ?>
<?php
$permissoes = retornaControle('usuario');
$permissoesImagem = retornaControle('removeImagemUsuario');
if(empty($permissoes)) {
	header("Location: administrativa.php?msg=Acesso negado.");
}


define('DS', DIRECTORY_SEPARATOR);
define('ROOT', dirname(__FILE__));
$path = $_SERVER['DOCUMENT_ROOT'];

require 'classes/Usuario.php';
require 'classes/UsuarioDAO.php';
$usuarioDAO = new UsuarioDAO();
$usuarios = $usuarioDAO->listarUsuarios();

?>

<div class="row" style="margin-top:40px">
	<div class="col-10">
		<h2>Gerenciar usuarios</h2>
	</div>
	<?php if($permissoes['insert']): ?>
	<div class="col-2">
		<a href="form_usuario.php" class="btn btn-success">Novo usuário</a>
	</div>
	<?php endif; ?>
</div>
<div class="row">
	<table class="table table-hover table-bordered table-striped table-responsive-lg">
		<thead>
			<tr>
				<th></th>
				<th>#ID</th>
				<th>Nome</th>
				<th>E-mail</th>
				<th>Perfil</th>
				<th>Ações</th>
			</tr>
		</thead>
		<tbody>
			<?php foreach($usuarios as $usuario){ ?>
			<tr>
				<td class="text-center">
					<img src="/assets/img/usuarios/<?= ($usuario->getImagem() != '' && file_exists('assets/img/usuarios/'.$usuario->getImagem()) ? $usuario->getImagem() : 'usuario.png') ?>" alt="" width="50" class="rounded-circle">
				</td>
				<th><?= $usuario->getId() ?></th>
				<td><?= $usuario->getNome() ?></td>
				<td><?= $usuario->getEmail() ?></td>
				<td><?= $usuario->perfil ?></td>
				<td>
					<?php if($permissoes['update'] || $permissoes['show']): ?>
					<a href="form_usuario.php?id=<?= $usuario->getId() ?>"  class="btn btn-warning"  data-toggle="tooltip" title="Editar usuário"><i class="fas fa-edit"></i></a>
					<?php endif; ?>
					<?php if($permissoes['delete']): ?>
						<a href="controle_usuario.php?acao=deletar&id=<?= $usuario->getId() ?>" onclick="return confirm('Deseja realmente excluir?')" class="btn btn-danger" data-toggle="tooltip" title="Remover usuário">
							<i class="fas fa-trash-alt"></i>
						</a>
					<?php endif; ?>
					<?php if(!empty($permissoesImagem)): ?>
						<a href="controle_usuario.php?acao=removeImagem&id=<?= $usuario->getId() ?>" onclick="return confirm('Deseja realmente remover a imagem?')" class="btn btn-danger" data-toggle="tooltip" title="Remover imagem">
							<i class="fas fa-folder-minus"></i>
						</a>
					<?php endif; ?>
				</td>
			</tr>
			<?php } ?>
		</tbody>
	</table>
</div>

<?php include './layout/footer.php'; ?>