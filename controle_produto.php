<?php
require_once './includes/validacao.php';
require_once './includes/funcoes.php'; 
require 'classes/Produto.php';
require 'classes/Categoria.php';
require 'classes/Imagem.php';
require 'classes/ProdutoDAO.php';
require 'classes/ImagemDAO.php';
require 'classes/CategoriaDAO.php';

$permissoes = retornaControle('produto');
$permissoesImagem = retornaControle('removeImagemProduto');

if(empty($permissoes)) {
	header("Location: adminstrativa.php?msg=Acesso negado.");
}

$produto = new Produto();
$produtoDAO = new ProdutoDAO();
$categoriaDAO = new CategoriaDAO();

$acao = $_GET['acao'];
$id = '';
if(isset($_GET['id']) && $_GET['id'] != '') {
	$id = $_GET['id'];
}

if($acao == 'deletar' && $permissoes['delete']) {

	$produtoDAO->deletar($id);
	$msg = 'Produto excluído com sucesso';
	header("Location: produtos.php?msg=$msg");

} else if($acao == 'cadastrar' && $permissoes['insert']) {

	$categoria = $categoriaDAO->get($_POST['categoria']);

	$produto->setNome($_POST['nome']);
	$produto->setPreco($_POST['preco']);
	$produto->setQtd($_POST['qtd']);
	$produto->setDescricao($_POST['descricao']);
	$produto->setCategoria($categoria);

	$id = $produtoDAO->insereProduto($produto);
	$msg = 'Produto cadastrado com sucesso';
	header("Location: form_produto.php?id=$id&msg=$msg");

} else if($acao == 'editar' && $permissoes['update']) {
	$id = $_POST['id'];
	$categoria = $categoriaDAO->get($_POST['categoria']);

	$produto->setId($_POST['id']);
	$produto->setNome($_POST['nome']);
	$produto->setPreco($_POST['preco']);
	$produto->setQtd($_POST['qtd']);
	$produto->setDescricao($_POST['descricao']);
	$produto->setCategoria($categoria);
	//print_r($produto); exit;

	$produtoDAO->alteraProduto($produto);
	$msg = 'Produto alterado com sucesso';

	header("Location: form_produto.php?id=$id&msg=$msg");
	
} else if($acao == 'cadastraImagens' && !empty($permissoesImagem)) {

	$produto_id = $_POST['produto_id'];
	/**
	Configurações de upload de imagens
	*/
	$upload['pasta_imagens'] = 'assets/img/produtos/';
	$pasta = $upload['pasta_imagens'] . $produto_id . '/';

	if(!is_dir($pasta)) {
		mkdir($upload['pasta_imagens'] . $produto_id . '/', 0775, true);
	}

	$upload['extensoes'] = ['jpg', 'png', 'gif'];

	$upload['erros'][0] = 'Não houve erro';
	$upload['erros'][1] = 'O arquivo no upload é maior do que o limite do PHP';
	$upload['erros'][2] = 'O arquivo ultrapassa o limite de tamanho especifiado no HTML';
	$upload['erros'][3] = 'O upload do arquivo foi feito parcialmente';
	$upload['erros'][4] = 'Não foi feito o upload do arquivo';


	$imagem = new Imagem();
	$imagemDAO = new ImagemDAO();

	$imagem->setProdutoId($produto_id);

	$qtd_imagens = count($_FILES['imagens']['name']);

	for($i = 0; $i < $qtd_imagens; $i++)
	{

		$descricao = explode('.', $_FILES['imagens']['name'][$i]);

		$extensao = strtolower(end($descricao));
		if(array_search($extensao, $upload['extensoes']) === false) {
		  $msg = "Por favor, envie arquivos com as seguintes extensões: jpg, png ou gif";
		  header("Location: form_produto.php?id=$produto_id&msg=$msg");
		  exit;
		}
		$nome_final = $descricao[0] . '-' . date('YmdHmi') . '.' . $extensao;
		$imagem->setDescricao($descricao[0]);
		
		// Depois verifica se é possível mover o arquivo para a pasta escolhida
		if (move_uploaded_file($_FILES['imagens']['tmp_name'][$i], $pasta . $nome_final)) {
			$caminho = $pasta . $nome_final;

			$imagem->setCaminho($caminho);
			$imagemDAO->insereImagem($imagem);

		} else {
		  // Não foi possível fazer o upload, provavelmente a pasta está incorreta
		  $msg = "Não foi possível enviar o(s) arquivo, tente novamente";
		  header("Location: form_produto.php?id=$produto_id&msg=$msg");
		  exit;
		}

	}
	$msg = "Imagens cadastradas com sucesso.";
	header("Location: form_produto.php?id=$produto_id&msg=$msg");

} else {
	$meg = 'Não possui permissão';
	header("Location: produtos.php?msg=$msg");
}

