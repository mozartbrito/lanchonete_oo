<?php 
session_start();
if(empty($_SESSION['nome'])){
	$msg = "Sessão finalizada.";
	header("Location: index.php?msg=$msg");
}