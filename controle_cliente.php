<?php 
session_start();
require 'classes/Cliente.php';
require 'classes/ClienteDAO.php';

$cliente = new Cliente();
$clienteDAO = new ClienteDAO();

$acao = $_GET['acao'];
$id = '';
if(isset($_GET['id']) && $_GET['id'] != '') {
	$id = $_GET['id'];
}

/**
Configurações de upload de imagens
*/
$upload['pasta_clientes'] = 'assets/img/clientes/';
$upload['extensoes'] = ['jpg', 'png', 'gif'];

$upload['erros'][0] = 'Não houve erro';
$upload['erros'][1] = 'O arquivo no upload é maior do que o limite do PHP';
$upload['erros'][2] = 'O arquivo ultrapassa o limite de tamanho especifiado no HTML';
$upload['erros'][3] = 'O upload do arquivo foi feito parcialmente';
$upload['erros'][4] = 'Não foi feito o upload do arquivo';



if($acao == 'deletar') {

	$clienteDAO->deletar($id);
	$msg = 'Cliente excluído com sucesso';

	header("Location: clientes.php?msg=$msg");
} else if($acao == 'cadastrar') {

	if($_FILES['imagem']['name'] != '') {

		if ($_FILES['imagem']['error'] != 0) {
		  $msg = "Não foi possível fazer o upload, erro:" . $upload['erros'][$_FILES['imagem']['error']];
		  header("Location: form_cliente.php?msg=$msg");
		  exit;
		}

		$imagem = explode('.', $_FILES['imagem']['name']);
		$extensao = strtolower(end($imagem));
		if(array_search($extensao, $upload['extensoes']) === false) {
		  $msg = "Por favor, envie arquivos com as seguintes extensões: jpg, png ou gif";
		  header("Location: form_cliente.php?msg=$msg");
		  exit;
		}
		$nome_final = $imagem[0] . '-' . date('YmdHmi') . '.' . $extensao;
		// Depois verifica se é possível mover o arquivo para a pasta escolhida
		if (move_uploaded_file($_FILES['imagem']['tmp_name'], $upload['pasta_clientes'] . $nome_final)) {
			$cliente->setImagem($nome_final);
		} else {
		  // Não foi possível fazer o upload, provavelmente a pasta está incorreta
		  $msg = "Não foi possível enviar o arquivo, tente novamente";
		  header("Location: form_cliente.php?msg=$msg");
		  exit;
		}
	}

	$cliente->setNome($_POST['nome']);
	$cliente->setCpf($_POST['cpf']);
	$cliente->setDtNascimento($_POST['dt_nascimento']);
	$cliente->setSexo($_POST['sexo']);
	$cliente->setCelular($_POST['celular']);
	$cliente->setEmail($_POST['email']);
	$cliente->setSenha($_POST['senha']);
	$cliente->setCep($_POST['cep']);
	$cliente->setLogradouro($_POST['logradouro']);
	$cliente->setComplemento($_POST['complemento']);
	$cliente->setNumero($_POST['numero']);
	$cliente->setCidade($_POST['cidade']);
	$cliente->setEstado($_POST['estado']);
	$cliente->setBairro($_POST['bairro']);
	$id_cliente = $clienteDAO->insereCliente($cliente);
	$msg = 'Cliente cadastrado com sucesso';

	header("Location: form_cliente.php?id=$id_cliente&msg=$msg");

} else if($acao == 'editar') {

	if($_POST['senha'] != ''){
		$cliente->setSenha($_POST['senha']);
	}
	$id_cliente = $_POST['id'];


	if($_FILES['imagem']['name'] != '') {

		if ($_FILES['imagem']['error'] != 0) {
		  $msg = "Não foi possível fazer o upload, erro:" . $upload['erros'][$_FILES['imagem']['error']];
		  header("Location: form_cliente.php?id=$id_cliente&msg=$msg");
		  exit;
		}

		$imagem = explode('.', $_FILES['imagem']['name']);
		$extensao = strtolower(end($imagem));
		if(array_search($extensao, $upload['extensoes']) === false) {
		  $msg = "Por favor, envie arquivos com as seguintes extensões: jpg, png ou gif";
		  header("Location: form_cliente.php?id=$id_cliente&msg=$msg");
		  exit;
		}
		$nome_final = $imagem[0] . '-' . date('YmdHmi') . '.' . $extensao;

		

		// Depois verifica se é possível mover o arquivo para a pasta escolhida
		if (move_uploaded_file($_FILES['imagem']['tmp_name'], $upload['pasta_clientes'] . $nome_final)) {

			//incluindo a imagem nova no registro do Cliente
			$cliente->setImagem($nome_final);

			//alimentando um Cliente temporário
			$clienteTemp = $clienteDAO->get($id_cliente);
			//montando link da imagem atual do cliente, representado pelo cliente temporario
			$imagem_a_remover = $upload['pasta_clientes'] . $clienteTemp->getImagem();
			//removendo a imagem antiga
			if( $clienteTemp->getImagem() != '' AND file_exists($imagem_a_remover) ) {
				unlink($imagem_a_remover);
			}

		} else {
		  // Não foi possível fazer o upload, provavelmente a pasta está incorreta
		  $msg = "Não foi possível enviar o arquivo, tente novamente";
		  header("Location: form_cliente.php?id=$id_cliente&msg=$msg");
		  exit;
		}
	}

	$cliente->setId($_POST['id']);
	$cliente->setNome($_POST['nome']);
	$cliente->setCpf($_POST['cpf']);
	$cliente->setDtNascimento($_POST['dt_nascimento']);
	$cliente->setSexo($_POST['sexo']);
	$cliente->setCelular($_POST['celular']);
	$cliente->setEmail($_POST['email']);
	$cliente->setCep($_POST['cep']);
	$cliente->setLogradouro($_POST['logradouro']);
	$cliente->setComplemento($_POST['complemento']);
	$cliente->setNumero($_POST['numero']);
	$cliente->setCidade($_POST['cidade']);
	$cliente->setEstado($_POST['estado']);
	$cliente->setBairro($_POST['bairro']);
	$clienteDAO->alteraCliente($cliente);
	$msg = 'Cliente alterado com sucesso';
	
	header("Location: form_cliente.php?id=$id_cliente&msg=$msg");

} else if($acao == 'removeImagem') {
	$cliente = $clienteDAO->get($id);

	$imagem_a_remover = $upload['pasta_clientes'] . $cliente->getImagem();
	//removendo a imagem antiga
	if( file_exists($imagem_a_remover) ) {
		unlink($imagem_a_remover);
	}
	$cliente->setImagem('--');
	$clienteDAO->alteraCliente($cliente);

	$msg = 'Imagem removida com sucesso';
	
	header("Location: clientes.php?msg=$msg");

}



