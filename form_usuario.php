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

<form action="controle_usuario.php?acao=<?= ( $usuario->getId() != '' ? 'editar' : 'cadastrar' )?>" method="post" enctype="multipart/form-data">
	<div class="row">
		<div class="col-3 text-center">
			<img src="/assets/img/usuarios/<?= ($usuario->getImagem() != '' && file_exists('assets/img/usuarios/'.$usuario->getImagem()) ? $usuario->getImagem() : 'usuario.png') ?>" alt="" width="150" class="rounded-circle img-thumbnail" id="fotopreview">
			<br>
			<br>
			<div class="custom-file">
			  <input type="file" class="custom-file-input" name="imagem" id="imagem">
			  <label class="custom-file-label" for="imagem">Escolher...</label>
			</div>
			<!-- <div class="form-group">
				<input type="file" name="imagem" id="imagem" class="form-control-file">
			</div> -->
		</div>
		<div class="col-6">
			<p>&nbsp;</p>

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
		</div>
	</div>
</form>

<?php include './layout/footer.php'; ?>

<script type="text/javascript">
var uploadfoto = document.getElementById('imagem');
var fotopreview = document.getElementById('fotopreview');

uploadfoto.addEventListener('change', function(e) {
	fotopreview.src = '/assets/img/loading.gif';
    showThumbnail(this.files);
});

function showThumbnail(files) {
    if (files && files[0]) {
    var reader = new FileReader();

    reader.onload = function (e) {
       fotopreview.src = e.target.result;
    }

        reader.readAsDataURL(files[0]);
    }
}
</script>