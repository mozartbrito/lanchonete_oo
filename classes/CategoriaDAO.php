<?php
require 'Model.php';
class CategoriaDAO extends Model
{   
    public function __construct() {
    	$this->tabela = 'categorias';
    }
}