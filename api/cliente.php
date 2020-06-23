<?php
header('Content-type:application/json;charset=utf-8');

require '../admin/classes/Cliente.php';
require '../admin/classes/ClienteDAO.php';

$clienteDAO = new ClienteDAO();

$email = $_POST['email'];
$senha = md5($_POST['senha']);

$cliente = $clienteDAO->getLogin($email, $senha);

if(empty($cliente)) {
	$data = [
		'error' => 'Cliente não encontrado.'
	];
	http_response_code(401);
	echo json_encode($data);
} else {
	$data = [
		'cliente' => [
			'nome' => $cliente->getNome(),
			'email' => $cliente->getEmail(),
			'id_cliente' => $cliente->getId()
		],
		'msg' => 'Cliente encontrado com sucesso'
	];

	http_response_code(200);
	echo json_encode($data);
}