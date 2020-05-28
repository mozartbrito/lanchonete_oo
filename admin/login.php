<?php
session_start();
require 'classes/Usuario.php';
require 'classes/UsuarioDAO.php';
$usuarioDAO = new UsuarioDAO();

$email = $_POST['email'];
$senha = md5($_POST['senha']);

$usuario = $usuarioDAO->getLogin($email, $senha);

if(empty($usuario)) {
	session_destroy();
	$msg = 'Usuário não encontrado';
	header("Location: index.php?msg=$msg");
} else {
	$permissoes = $usuarioDAO->getPermissoes($usuario->getPerfilId());

	$_SESSION['nome'] = $usuario->getNome();
	$_SESSION['email'] = $usuario->getEmail();
	$_SESSION['imagem'] = $usuario->getImagem();
	$_SESSION['id_usuario'] = $usuario->getId();
	$_SESSION['id_perfil'] = $usuario->getPerfilId();
	$_SESSION['perfil'] = $usuario->perfil;
	$_SESSION['permissoes'] = $permissoes;

	$msg = 'Usuário logado com sucesso!';
	header("Location: administrativa.php?msg=$msg");
}
?>