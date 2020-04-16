<?php
require_once 'Model.php';
class ProdutoDAO extends Model
{
    public function __construct()
    {
    	parent::__construct();
        $this->tabela = 'produtos';
        $this->class  = 'Produto';
    }

    public function insereProduto(Produto $produto)
    {
    	$values = "null, 
    				'{$produto->getNome()}',
    				'{$produto->getPreco()}', 
    				'{$produto->categoria->getId()}'";
    	echo $values; exit;
    	return $this->inserir($values);
    }

     public function alteraProduto(Produto $produto) {
    	$values = "nome = '{$produto->getNome()}',
    				preco = '{$produto->getPrecoBD()}',
    				categoria = '{$produto->getCategoria()->getId()}'";
    	$this->alterar($produto->getId(), $values);
    }
}