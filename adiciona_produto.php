<?php 
session_start();

//criando função para adicionar item
function addItem($item, $array) {
	//verificando se é um array a sessao de produtos
	if(is_array($array)) {
		//verificando se tem produtos
		if(!empty($array)) {
			$tem = 0; //variavel que armazena a validação se tem item ou não
			//varrendo a variável de sessão
			foreach($array as $key => $arr) {

				//verificando se o produto já está no conjunto de itens
				if($arr['produto_id'] == $item['produto_id']) {
					$nova_qtd = $item['qtd_produto'] + $arr['qtd_produto'];
					$_SESSION['compras'][$key]['qtd_produto'] = $nova_qtd;
					$tem = 1;//informamos que tem o produto
					break;
				} else {
					$tem = 0; //informamos que o produto não está na lista
				}

			}
			//se não estiver na lista, é adicionado
			if($tem == 0) {
				$_SESSION['compras'][] = $item;
			}
 		} else { //se não tiver produtos é adicionado
			$_SESSION['compras'][] = $item;
		}
	}
}
/*echo '<pre>';
print_r($_POST);
print_r($_SESSION['compras']); exit;*/
/*if(isset($_GET['acao']) && $_GET['acao'] == 'removerItem') {
	$key = $_GET['key'];
	unset($_SESSION['compras'][$key]);
	$msg = "Produto removido da sacola com sucesso!";
} else */
if(isset($_GET['acao']) && $_GET['acao'] == 'removerItemAjax') {
	$key = $_GET['key'];
	unset($_SESSION['compras'][$key]);
	echo isset($_SESSION['compras']) ? count($_SESSION['compras']) : 0;
	exit;
}else if(isset($_GET['acao']) && $_GET['acao'] == 'AlteraItemAjax') {
	$key = $_GET['key'];
	$qtd = $_GET['qtd'];

	$_SESSION['compras'][$key]['qtd_produto'] = $qtd;

	echo 1;
	exit;
} else if(isset($_GET['acao']) && $_GET['acao'] == 'AddItemAjax') {

	if(!isset($_SESSION['compras'])) {
		$_SESSION['compras'] = [];
	}

	$item = [];
	$item['produto_id'] = $_POST['produto'];
	$item['nome_produto'] = $_POST['nome_produto'];
	$item['preco_produto'] = $_POST['preco_produto'];
	$item['qtd_produto'] = $_POST['qtd'];
	$item['val_produto'] = $_POST['val'];

	addItem($item, $_SESSION['compras']); 
	echo isset($_SESSION['compras']) ? count($_SESSION['compras']) : 0;
}
?>