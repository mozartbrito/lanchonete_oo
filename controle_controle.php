<?php 
require 'classes/Controle.php';
require 'classes/ControleDAO.php';

$controle = new Controle();
$controleDAO = new ControleDAO();

$acao = $_GET['acao'];
$id = '';
if(isset($_GET['id']) && $_GET['id'] != '') {
	$id = $_GET['id'];
}

if($acao == 'deletar') {

	$controleDAO->deletar($id);
	$msg = 'Controle excluído com sucesso';

	header("Location: controles.php?msg=$msg");

} else if($acao == 'cadastrar') {


	$controle->setNome($_POST['nome']);
	$controle->setTipo($_POST['tipo']);
	$controle->setStatus($_POST['status']);
	$id_controle = $controleDAO->insereControle($controle);
	$msg = 'Controle cadastrado com sucesso';

	header("Location: form_controle.php?id=$id_controle&msg=$msg");

} else if($acao == 'editar') {
	$id_controle = $_POST['id'];
	$controle->setId($_POST['id']);
	$controle->setNome($_POST['nome']);
	$controle->setTipo($_POST['tipo']);
	$controle->setStatus($_POST['status']);
	$controleDAO->alteraControle($controle);
	$msg = 'Controle alterado com sucesso';
	
	header("Location: form_controle.php?id=$id_controle&msg=$msg");
}