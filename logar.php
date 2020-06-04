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
	$alert = 'danger';
	header("Location: login.php?msg=$msg&alert=$alert&tipo=$tipo");
} else {
	$_SESSION['nome'] = $cliente->getNome();
	$_SESSION['email'] = $cliente->getEmail();
	$_SESSION['telefone'] = $cliente->getCelular();
	$_SESSION['imagem'] = $cliente->getImagem();
	$_SESSION['cep'] = $cliente->getCep();
	$_SESSION['logradouro'] = $cliente->getLogradouro();
	$_SESSION['bairro'] = $cliente->getBairro();
	$_SESSION['cidade'] = $cliente->getCidade();
	$_SESSION['estado'] = $cliente->getEstado();
	$_SESSION['numero'] = $cliente->getNumero();
	$_SESSION['complemento'] = $cliente->getComplemento();
	$_SESSION['id_cliente'] = $cliente->getId();
	$_SESSION['perfil'] = 'Cliente';

	$msg = 'Cliente logado com sucesso!';
	$alert = 'success';
	if($tipo != 'logar') {
		header("Location: finaliza_compra.php?msg=$msg&alert=$alert");
	}else {
		header("Location: index.php?msg=$msg&alert=$alert");
	}
}
?>