<?php 
require 'classes/Usuario.php';
require 'classes/UsuarioDAO.php';

$usuario = new Usuario();
$usuarioDAO = new UsuarioDAO();

$acao = $_GET['acao'];
$id = '';
if(isset($_GET['id']) && $_GET['id'] != '') {
	$id = $_GET['id'];
}

if($acao == 'deletar') {

	$usuarioDAO->deletar($id);
	$msg = 'Usuário excluído com sucesso';

	header("Location: usuarios.php?msg=$msg");
} else if($acao == 'cadastrar') {

	$usuario->setNome($_POST['nome']);
	$usuario->setEmail($_POST['email']);
	$usuario->setSenha($_POST['senha']);
	$id_usuario = $usuarioDAO->insereUsuario($usuario);
	$msg = 'Usuário cadastrado com sucesso';

	header("Location: form_usuario.php?id=$id_usuario&msg=$msg");

} else if($acao == 'editar') {

	if($_POST['senha'] != ''){
		$usuario->setSenha($_POST['senha']);
	}

	$usuario->setId($_POST['id']);
	$usuario->setEmail($_POST['email']);
	$usuario->setNome($_POST['nome']);
	$usuarioDAO->alteraUsuario($usuario);
	$msg = 'Usuário alterado com sucesso';
	$id_usuario = $_POST['id'];
	header("Location: form_usuario.php?id=$id_usuario&msg=$msg");
}


