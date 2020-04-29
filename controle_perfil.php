<?php 
require 'classes/Perfil.php';
require 'classes/PerfilDAO.php';

$perfil = new Perfil();
$perfilDAO = new PerfilDAO();

$acao = $_GET['acao'];
$id = '';
if(isset($_GET['id']) && $_GET['id'] != '') {
	$id = $_GET['id'];
}

if($acao == 'deletar') {

	$perfilDAO->deletar($id);
	$msg = 'Perfil excluído com sucesso';

	header("Location: perfis.php?msg=$msg");

} else if($acao == 'cadastrar') {

	$perfil->setDescricao($_POST['descricao']);
	$perfil->setStatus($_POST['status']);
	$id_perfil = $perfilDAO->inserePerfil($perfil);
	$msg = 'Perfil cadastrado com sucesso';

	header("Location: form_perfil.php?id=$id_perfil&msg=$msg");

} else if($acao == 'editar') {
	$id_perfil = $_POST['id'];

	$perfil->setId($_POST['id']);
	$perfil->setDescricao($_POST['descricao']);
	$perfil->setStatus($_POST['status']);
	$perfilDAO->alteraPerfil($perfil);
	$msg = 'Perfil alterado com sucesso';
	
	header("Location: form_perfil.php?id=$id_perfil&msg=$msg");
} else if($acao == 'cadastraPermissao') {

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
	
	$permissaoDAO->inserePermissao($permissao);

	$msg = 'Permissão cadastrada com sucesso';

	header("Location: form_perfil.php?id=$id_perfil&msg=$msg");

} 