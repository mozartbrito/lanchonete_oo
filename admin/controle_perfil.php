<?php
require_once './includes/validacao.php';
require_once './includes/funcoes.php';
$permissoes = retornaControle('perfil');
$permissoesPermissao = retornaControle('permissao');

if(empty($permissoes)) {
	header("Location: adminstrativa.php?msg=Acesso negado.");
}
require 'classes/Perfil.php';
require 'classes/PerfilDAO.php';

$perfil = new Perfil();
$perfilDAO = new PerfilDAO();

$acao = $_GET['acao'];
$id = '';
if(isset($_GET['id']) && $_GET['id'] != '') {
	$id = $_GET['id'];
}

if($acao == 'deletar' && $permissoes['delete']) {

	$perfilDAO->deletar($id);
	$msg = 'Perfil excluído com sucesso';

	header("Location: perfis.php?msg=$msg");

} else if($acao == 'cadastrar' && $permissoes['insert']) {

	$perfil->setDescricao($_POST['descricao']);
	$perfil->setStatus($_POST['status']);
	$id_perfil = $perfilDAO->inserePerfil($perfil);
	$msg = 'Perfil cadastrado com sucesso';

	header("Location: form_perfil.php?id=$id_perfil&msg=$msg");

} else if($acao == 'editar' && $permissoes['update']) {
	$id_perfil = $_POST['id'];

	$perfil->setId($_POST['id']);
	$perfil->setDescricao($_POST['descricao']);
	$perfil->setStatus($_POST['status']);
	$perfilDAO->alteraPerfil($perfil);
	$msg = 'Perfil alterado com sucesso';
	
	header("Location: form_perfil.php?id=$id_perfil&msg=$msg");
} else if($acao == 'cadastraPermissao' && !empty($permissoesPermissao)) {

	require 'classes/Permissao.php';
	require 'classes/PermissaoDAO.php';
	$permissaoDAO = new PermissaoDAO();
	$permissao = new Permissao();
	$id_perfil = $_POST['perfil_id'];

	
	$permissao->setPerfilId($_POST['perfil_id']);
	$permissao->setControleId($_POST['controle_id']);
	$permissao->setSelect($_POST['select'] ?? 0);
	$permissao->setInsert($_POST['insert'] ?? 0);
	$permissao->setUpdate($_POST['update'] ?? 0);
	$permissao->setDelete($_POST['delete'] ?? 0);
	$permissao->setShow($_POST['show'] ?? 0);
	
	$tem_controle = $permissaoDAO->verificaControlePerfil($_POST['controle_id'],$_POST['perfil_id']);

	if(!empty($tem_controle)) {
		$msg = 'Permissão já estava cadastrada!';
	}else {
		$permissaoDAO->inserePermissao($permissao);
		$msg = 'Permissão cadastrada com sucesso';

		if($id_perfil == $_SESSION['id_perfil']) {
			require 'classes/UsuarioDAO.php';
			$usuarioDAO = new UsuarioDAO();
			$permissoes = $usuarioDAO->getPermissoes($id_perfil);
			$_SESSION['permissoes'] = $permissoes;
		}

	}


	header("Location: form_perfil.php?id=$id_perfil&msg=$msg");

} else if($acao == 'deletaPermissao' && !empty($permissoesPermissao)) {
	require 'classes/Permissao.php';
	require 'classes/PermissaoDAO.php';

	$permissaoDAO = new PermissaoDAO();

	$id_permissao = $_GET['id_permissao'];
	$id_perfil = $_GET['id_perfil'];

	$permissaoDAO->deletar($id_permissao);

	if($id_perfil == $_SESSION['id_perfil']) {
		require 'classes/UsuarioDAO.php';
		$usuarioDAO = new UsuarioDAO();
		$permissoes = $usuarioDAO->getPermissoes($id_perfil);
		$_SESSION['permissoes'] = $permissoes;
	}

	$msg = 'Permissão excluída com sucesso';

	header("Location: form_perfil.php?id=$id_perfil&msg=$msg");
} else {
	$msg = 'Não possui permissão.';

	header("Location: perfis.php?msg=$msg");
}