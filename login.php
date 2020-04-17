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
	$_SESSION['nome'] = $usuario->getNome();
	$_SESSION['email'] = $usuario->getEmail();
	$_SESSION['id_usuario'] = $usuario->getId();

	$msg = 'Usuário logado com sucesso!';
	header("Location: administrativa.php?msg=$msg");
}
?>