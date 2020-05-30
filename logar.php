<?php
session_start();
require 'admin/classes/Cliente.php';
require 'admin/classes/ClienteDAO.php';
$clienteDAO = new ClienteDAO();

$email = $_POST['email'];
$senha = md5($_POST['senha']);

$cliente = $clienteDAO->getLogin($email, $senha);

if(isset($_GET['tipo'])) {
	$tipo = $_GET['tipo'];
} else  {
	$tipo = 'logar';
}

if(empty($cliente)) {
	$msg = 'Cliente não encontrado';
	header("Location: index.php?msg=$msg");
} else {
	$_SESSION['nome'] = $cliente->getNome();
	$_SESSION['email'] = $cliente->getEmail();
	$_SESSION['imagem'] = $cliente->getImagem();
	$_SESSION['id_cliente'] = $cliente->getId();
	$_SESSION['perfil'] = 'Cliente';

	$msg = 'Cliente logado com sucesso!';
	if($tipo != 'logar') {
		header("Location: finaliza_compra.php?msg=$msg");
	}else {
		header("Location: index.php?msg=$msg");
	}
}
?>