<?php 
session_start();
//unset($_SESSION['compras']);
function pesquisaRecursiva($valor, $array) {
	if(is_array($array)) {
		foreach($array as $arr) {
			$tem_produto = in_array($valor, $arr);
			if($tem_produto) {
				return $tem_produto;
			}
		}
	}
}

if(isset($_GET['acao']) && $_GET['acao'] == 'removerItem') {
	$key = $_GET['key'];
	unset($_SESSION['compras'][$key]);
	$msg = "Produto removido da sacola com sucesso!";
} else {

	if(!isset($_SESSION['compras'])) {
		$_SESSION['compras'] = [];
	}
	$item = [];
	$item['produto_id'] = $_POST['produto'];
	$item['nome_produto'] = $_POST['nome_produto'];
	$item['preco_produto'] = $_POST['preco_produto'];
	$item['qtd_produto'] = $_POST['qtd'];
	$item['val_produto'] = $_POST['val'];

	$tem_produto = pesquisaRecursiva($item['produto_id'], $_SESSION['compras']); //exit;
	if(!$tem_produto) {
		$_SESSION['compras'][] = $item;
	}
	$msg = "Produto adicionado a sacola com sucesso!";
}
header("Location: index.php?msg=$msg")

?>