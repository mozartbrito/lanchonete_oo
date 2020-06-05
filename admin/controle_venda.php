<?php
require_once './includes/validacao.php';
require_once './includes/funcoes.php'; 
require 'classes/Venda.php';
require 'classes/VendaDAO.php';
require 'classes/VendaProdutoDAO.php';

$permissoes = retornaControle('venda');

if(empty($permissoes)) {
	header("Location: adminstrativa.php?msg=Acesso negado.");
}

$venda = new Venda();
$vendaDAO = new VendaDAO();
$vendaProdutoDAO = new VendaProdutoDAO();

$acao = $_GET['acao'];
$id = '';

if(isset($_GET['id']) && $_GET['id'] != '') {
	$id = $_GET['id'];
}

if($acao == 'deletar' && $permissoes['delete']) {

	$vendaProdutoDAO->deletarProdutosVendas($id);
	$vendaDAO->deletar($id);
	$msg = 'Venda excluída com sucesso';
	header("Location: vendas.php?msg=$msg");

}  else if($acao == 'editar' && $permissoes['update']) {
	$status = $_GET['status'];
	$venda->setStatus($status);
	$venda->setId($id);
	
	$vendaDAO->alteraVenda($venda);
	$msg = 'Venda alterada com sucesso';

	header("Location: vendas.php?msg=$msg");
	
} else {
	$meg = 'Não possui permissão';
	header("Location: produtos.php?msg=$msg");
}

