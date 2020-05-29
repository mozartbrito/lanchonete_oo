<?php 
session_start();
if(isset($_SESSION['perfil']) && $_SESSION['perfil'] != 'Cliente') {
	$compras = $_SESSION['compras'];
	session_destroy();
	$_SESSION['compras'] = $compras;
	echo 'vc nao esta logado';

}/*else if(!isset($_SESSION['perfil'])) {
	echo 'vc nao esta logado';

} */else if(isset($_SESSION['perfil']) && $_SESSION['perfil'] == 'Cliente') {
	echo 'vc esta logado';
}


echo '<pre>';
print_r($_SESSION);
?>