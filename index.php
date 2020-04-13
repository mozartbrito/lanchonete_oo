<?php
require_once 'classes/Categoria.php';

$categoria1 = new Categoria();

$categoria1->setId(10);
$categoria1->setNome('Frios');
echo '<pre>';
echo $categoria1->getNome();
//print_r($categoria1);
?>