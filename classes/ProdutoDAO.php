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
    				'{$produto->getPrecoBD()}', 
                    '{$produto->getCategoria()->getId()}',
                    '{$produto->getQtd()}', 
                    '{$produto->getDescricao()}'";
    	return $this->inserir($values);
    }

    public function alteraProduto(Produto $produto) {
    	$values = "nome = '{$produto->getNome()}',
    				preco = '{$produto->getPrecoBD()}',
                    qtd = '{$produto->getQtd()}',
                    descricao = '{$produto->getDescricao()}',
    				categoria = '{$produto->getCategoria()->getId()}'";
    	$this->alterar($produto->getId(), $values);
    }

    public function listar($pesquisa = '')
    {
        if($pesquisa != '') {
            $sql = "SELECT * FROM {$this->tabela} 
                    WHERE nome like '%{$pesquisa}%'
                        OR descricao like '%{$pesquisa}%'
                        OR qtd like '%{$pesquisa}%'";
        } else {
            $sql = "SELECT * FROM {$this->tabela}";
        }
        $stmt = $this->db->prepare($sql);
        $stmt->setFetchMode(PDO::FETCH_CLASS, $this->class);
        $stmt->execute();
        return $stmt->fetchAll();
    }

}