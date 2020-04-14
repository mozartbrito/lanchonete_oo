<?php 
require 'classes/Categoria.php';
require 'classes/CategoriaDAO.php';

$categoria = new Categoria();
$categoriaDAO = new CategoriaDAO();

$categoria->setNome($_POST['nome']);

$values = "null, '{$categoria->getNome()}'";
$categoriaDAO->inserir($values);