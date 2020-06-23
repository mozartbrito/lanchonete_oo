<?php 
header('Content-type:application/json;charset=utf-8');
include_once('../admin/classes/Produto.php');
include_once('../admin/classes/ProdutoDAO.php');
include_once('../admin/classes/Imagem.php');
include_once('../admin/classes/ImagemDAO.php');


$produtoDAO = new ProdutoDAO();
$imagemDAO = new ImagemDAO();

$tipo = $_GET['tipo'] ?? '';

if($tipo == 'list') {

	$produtos = $produtoDAO->listar();

	foreach ($produtos as $key => $produto) {
		$data[$key]['id_produto'] = $produto->getId();
		$data[$key]['nome'] = $produto->getNome();
		$data[$key]['preco'] = $produto->getPreco();
		$data[$key]['descricao'] = $produto->getDescricao();

		$imagem = $imagemDAO->listarUmaImagemPorProduto($produto->getId());
		$data[$key]['imagem'] = (!empty($imagem) ? 'admin/'.$imagem->getCaminho() : 'assets/img/produtos/default.png');
	}
	http_response_code(200);
	echo json_encode($data);

} else if($tipo == 'get') {

	$id_produto = $_GET['id_produto'];
	$produto = $produtoDAO->get($id_produto);

	if(!empty($produto)) {
		$data['nome'] = $produto->getNome();
		$data['preco'] = $produto->getPreco();
		$data['descricao'] = $produto->getDescricao();

		$imagem = $imagemDAO->listarUmaImagemPorProduto($produto->getId());

		$data['imagem'] = (!empty($imagem) ? 'admin/'.$imagem->getCaminho() : 'assets/img/produtos/default.png');
		http_response_code(200);
		echo json_encode($data);
	} else {
		http_response_code(400);
		$data['msg'] = 'Produto não encontrado';
		echo json_encode($data);
	}
} else if($tipo == 'pedidos') {

	include_once('../admin/classes/Venda.php');
	include_once('../admin/classes/VendaDAO.php');
	$vendaDAO = new VendaDAO();

	$id_cliente = $_GET['id_cliente'];

	$vendas = $vendaDAO->listaVendasCliente(" cliente_id = {$id_cliente} ");

	if(!empty($vendas)) {
		
		foreach ($vendas as $key => $venda) {
			$data[$key]['codigo'] = $venda->getCodigo();
			$data[$key]['dataVenda'] = $venda->getDataVenda();
			$data[$key]['formaPagamento'] = $venda->getFormaPagamento();
			$data[$key]['status'] = $venda->getStatus();
		}

		http_response_code(200);
		echo json_encode($data);

	} else {
		http_response_code(200);
		$data['msg'] = 'Compras não encontradas';
		echo json_encode($data);
	}



} else {
	http_response_code(400);
	echo json_encode(['msg' => 'Ação não encontrada']);
}

