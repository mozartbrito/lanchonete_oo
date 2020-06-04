<?php
session_start();

if(!isset($_SESSION['perfil']) && $_SESSION['perfil'] == '') {
	$msg = 'Usuário não efetuou login.';
	$alert = 'danger';
	header("Location: login.php?msg=$msg&alert=$alert");
} 

if(isset($_GET['tipo'])) {
	$tipo = $_GET['tipo'];
} else  {
	$tipo = 'logar';
}

include_once('admin/classes/Cliente.php');
include_once('admin/classes/ClienteDAO.php');

$cliente = new Cliente();
$clienteDAO = new ClienteDAO();

//validando campos obrigatórios
if($_POST['nome'] || $_POST['email'] || $_POST['senha']) {
	$msg = 'Nome, email e senha são obrigatórios.';
	$alert = 'danger';
	header("Location: login.php?tipo=$tipo&msg=$msg&alert=$alert");
}

$cliente->setNome($_POST['nome']);
$cliente->setCpf($_POST['cpf']);
$cliente->setDtNascimento($_POST['dt_nascimento']);
$cliente->setSexo($_POST['sexo']);
$cliente->setCelular($_POST['celular']);
$cliente->setEmail($_POST['email']);
$cliente->setSenha($_POST['senha']);
$cliente->setCep($_POST['cep']);
$cliente->setLogradouro($_POST['logradouro']);
$cliente->setComplemento($_POST['complemento']);
$cliente->setNumero($_POST['numero']);
$cliente->setCidade($_POST['cidade']);
$cliente->setEstado($_POST['estado']);
$cliente->setBairro($_POST['bairro']);
$id_cliente = $clienteDAO->insereCliente($cliente);
$msg = 'Cliente cadastrado com sucesso';

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
$_SESSION['id_cliente'] = $id_cliente;
$_SESSION['perfil'] = 'Cliente';

$msg = 'Cliente salva com sucesso!';
$alert = 'success';
if($tipo != 'logar') {
	header("Location: finaliza_compra.php?msg=$msg&alert=$alert");
}else {
	header("Location: index.php?msg=$msg&alert=$alert");
}