<?php 
require 'classes/Produto.php';
require 'classes/Categoria.php';
require 'classes/ProdutoDAO.php';
require 'classes/CategoriaDAO.php';

$produto = new Produto();
$produtoDAO = new ProdutoDAO();
$categoriaDAO = new CategoriaDAO();

$acao = $_GET['acao'];
$id = '';
if(isset($_GET['id']) && $_GET['id'] != '') {
	$id = $_GET['id'];
}

if($acao == 'deletar') {

	$produtoDAO->deletar($id);
	$msg = 'Produto excluído com sucesso';

} else if($acao == 'cadastrar') {

	$categoria = $categoriaDAO->get($_POST['categoria']);

	$produto->setNome($_POST['nome']);
	$produto->setPreco($_POST['preco']);
	$produto->setCategoria($categoria);

	$produtoDAO->insereProduto($produto);
	$msg = 'Produto cadastrado com sucesso';

} else if($acao == 'editar') {
	
	$categoria = $categoriaDAO->get($_POST['categoria']);

	$produto->setId($_POST['id']);
	$produto->setNome($_POST['nome']);
	$produto->setPreco($_POST['preco']);
	$produto->setCategoria($categoria);

	$produtoDAO->alteraProduto($produto);
	$msg = 'Produto alterado com sucesso';
	
}


header("Location: produtos.php?msg=$msg");