<?php 
require 'classes/Categoria.php';
require 'classes/CategoriaDAO.php';

$categoria = new Categoria();
$categoriaDAO = new CategoriaDAO();

$acao = $_GET['acao'];
$id = '';
if(isset($_GET['id']) && $_GET['id'] != '') {
	$id = $_GET['id'];
}

if($acao == 'deletar') {

	$categoriaDAO->deletar($id);
	$msg = 'Categoria excluída com sucesso';

} else if($acao == 'cadastrar') {

	$categoria->setNome($_POST['nome']);
	$categoriaDAO->insereCategoria($categoria);
	$msg = 'Categoria cadastrada com sucesso';

} else if($acao == 'editar') {

	$categoria->setId($_POST['id']);
	$categoria->setNome($_POST['nome']);
	$categoriaDAO->alteraCategoria($categoria);
	$msg = 'Categoria alterada com sucesso';
	
}


header("Location: categorias.php?msg=$msg");