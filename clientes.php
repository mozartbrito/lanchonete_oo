<?php include './layout/header.php'; ?>
<?php include './layout/menu.php'; ?>
<?php 

require 'classes/Cliente.php';
require 'classes/ClienteDAO.php';

$clienteDAO = new ClienteDAO();
if(isset($_GET['pesquisa']) && $_GET['pesquisa'] != '') {
	$clientes = $clienteDAO->listar($_GET['pesquisa']);
} else {
	$clientes = $clienteDAO->listar();
}

?>
<?php 
	if(isset($_GET['msg']) && $_GET['msg'] != '') {
	 echo '<div class="alert alert-info">'.$_GET['msg'].'</div>';
	}
?>
<div class="row" style="margin-top:40px">
	<div class="col-6">
		<h2>Gerenciar clientes</h2>
	</div>
	<div class="col-4">
	<form class="form-inline my-2 my-lg-0">
      <input class="form-control mr-sm-2" name="pesquisa" type="search" placeholder="Pesquisar" aria-label="Pesquisar" value="<?= (isset($_GET['pesquisa']) ? $_GET['pesquisa'] : '') ?>">
      <button class="btn btn-outline-success my-2 my-sm-0" type="submit">
      	<i class="fas fa-search"></i>	
      </button>
      <a href="./clientes.php" class="btn btn-outline-warning my-2 my-sm-0">
      	<i class="fas fa-trash-alt"></i>
      </a>
    </form>
	</div>
	<div class="col-2">
		<a href="form_cliente.php" class="btn btn-success">Novo</a>
	</div>
</div>
<div class="row">
	<table class="table table-hover table-bordered table-striped">
		<thead>
			<tr>
				<th>#ID</th>
				<th>Nome</th>
				<th>CPF</th>
				<th>E-mail</th>
				<th>Data Nascimento</th>
				<th>Sexo</th>
				<th>Ações</th>
			</tr>
		</thead>
		<tbody>
			<?php foreach($clientes as $cliente){ 
			?>
			<tr>
				<td><?= $cliente->getId() ?></td>
				<td><?= $cliente->getNome() ?></td>
				<td><?= $cliente->getCpf() ?></td>
				<td><?= $cliente->getEmail() ?></td>
				<td><?= $cliente->getDtNascimento() ?></td>
				<td><?= $cliente->getSexo() ?></td>
				<td>
					<a href="form_cliente.php?id=<?= $cliente->getId() ?>" class="btn btn-warning">
						<i class="fas fa-edit"></i>
					</a>
					<a href="controle_cliente.php?acao=deletar&id=<?= $cliente->getId() ?>" onclick="return confirm('Deseja realmente excluir?')" class="btn btn-danger">
						<i class="fas fa-trash-alt"></i>
					</a>
				</td>
			</tr>
			<?php } ?>
		</tbody>
	</table>
</div>

<?php include './layout/footer.php'; ?>