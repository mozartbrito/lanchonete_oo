<?php 
require 'classes/Categoria.php';
require 'classes/CategoriaDAO.php';

$categoria = new Categoria();
$categoriaDAO = new CategoriaDAO();

$categoria->setNome($_POST['nome']);

$categoriaDAO->insereCategoria($categoria);

$categorias = $categoriaDAO->listar();

echo '<pre>';
print_r($categorias);