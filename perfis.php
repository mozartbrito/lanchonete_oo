<?php include './layout/header.php'; ?>
<?php include './layout/menu.php'; ?>
<?php 

require 'classes/Perfil.php';
require 'classes/PerfilDAO.php';
$perfiDAO = new PerfilDAO();
$perfis = $perfiDAO->listar();

?>
<?php 
	if(isset($_GET['msg']) && $_GET['msg'] != '') {
	 echo '<div class="alert alert-info">'.$_GET['msg'].'</div>';
	}
?>
<div class="row" style="margin-top:40px">
	<div class="col-10">
		<h2>Gerenciar perfis</h2>
	</div>
	<div class="col-2">
		<a href="form_perfil.php" class="btn btn-success">Novo perfil</a>
	</div>
</div>
<div class="row">
	<table class="table table-hover table-bordered table-striped table-responsive-lg">
		<thead>
			<tr>
				<th>#ID</th>
				<th>Nome</th>
				<th>Status</th>
				<th>Ações</th>
			</tr>
		</thead>
		<tbody>
			<?php foreach($perfis as $perfi){ ?>
			<tr>
				<td><?= $perfi->getId() ?></td>
				<td><?= $perfi->getDescricao() ?></td>
				<td><?= ($perfi->getStatus() == 1 ? 'Ativo' : 'Inativo') ?></td>
				<td>
					<a href="form_perfil.php?id=<?= $perfi->getId() ?>"  class="btn btn-warning">
						<i class="fas fa-edit"></i>
					</a>
					<a href="controle_perfil.php?acao=deletar&id=<?= $perfi->getId() ?>" onclick="return confirm('Deseja realmente excluir?')" class="btn btn-danger">
						<i class="fas fa-trash-alt"></i>
					</a>
				</td>
			</tr>
			<?php } ?>
		</tbody>
	</table>
</div>

<?php include './layout/footer.php'; ?>