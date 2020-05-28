<?php 
require_once './includes/validacao.php';
require_once './includes/funcoes.php'; 
require 'classes/Categoria.php';
require 'classes/CategoriaDAO.php';

$permissoes = retornaControle('categoria');
if(empty($permissoes)) {
	header("Location: administrativa.php?msg=Acesso negado!");
}

$categoria = new Categoria();
$categoriaDAO = new CategoriaDAO();

$acao = $_GET['acao'];
$id = '';
if(isset($_GET['id']) && $_GET['id'] != '') {
	$id = $_GET['id'];
}

if($acao == 'deletar' && $permissoes['delete']) {

	$categoriaDAO->deletar($id);
	$msg = 'Categoria excluída com sucesso';
	header("Location: categorias.php?msg=$msg");

} else if($acao == 'cadastrar' && $permissoes['insert']) {

	$categoria->setNome($_POST['nome']);
	$id_categoria = $categoriaDAO->insereCategoria($categoria);
	$msg = 'Categoria cadastrada com sucesso';

	header("Location: form_categoria.php?id=$id_categoria&msg=$msg");
} else if($acao == 'editar' && $permissoes['update']) {

	$id_categoria = $_POST['id'];
	$categoria->setId($_POST['id']);
	$categoria->setNome($_POST['nome']);
	$categoriaDAO->alteraCategoria($categoria);
	$msg = 'Categoria alterada com sucesso';
	
	header("Location: form_categoria.php?id=$id_categoria&msg=$msg");
	
} else {
	$msg = "Não possui permissão";
	header("Location: categorias.php?msg=$msg");

}

