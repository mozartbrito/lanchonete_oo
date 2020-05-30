<?php 
session_start();

function addItem($item, $array) {
	if(is_array($array)) {
		if(!empty($array)) {
			foreach($array as $key => $arr) {
				if($arr['produto_id'] == $item['produto_id']) {
					$nova_qtd = $item['qtd_produto'] + $arr['qtd_produto'];
					$_SESSION['compras'][$key]['qtd_produto'] = $nova_qtd;
				} else {
					$_SESSION['compras'][] = $item;
				}
			}
		} else {
			$_SESSION['compras'][] = $item;
		}
	}
}
/*print_r($_POST);
print_r($_SESSION['compras']);*/
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

	addItem($item, $_SESSION['compras']); //exit;
	$msg = "Produto adicionado a sacola com sucesso!";
}
header("Location: index.php?msg=$msg");

?>