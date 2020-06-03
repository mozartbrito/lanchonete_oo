<?php
require_once 'Model.php';
class VendaProdutoDAO extends Model
{
    public function __construct()
    {
    	parent::__construct();
        $this->tabela = 'vendas_produtos';
        $this->class  = 'VendaProduto';
    }

    public function insereVendaProduto(VendaProduto $venda_produto)
    {
    	$values = "null, 
    				'{$venda_produto->getVendaId()}',
    				'{$venda_produto->getProdutoId()}', 
                    '{$venda_produto->getValor()}',
                    '{$venda_produto->getQtd()}', 
                    '{$venda_produto->getDesconto()}'";
    	return $this->inserir($values);
    }

    public function alteraVendaProduto(VendaProduto $venda_produto) {
    	/*$values = "nome = '{$venda_produto->getNome()}',
    				preco = '{$venda_produto->getPrecoBD()}',
                    qtd = '{$venda_produto->getQtd()}',
                    descricao = '{$venda_produto->getDescricao()}',
    				categoria = '{$venda_produto->getCategoria()->getId()}'";
    	$this->alterar($venda_produto->getId(), $values);*/
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
    public function filtrar($condicao = '')
    {
        $where = '';
        if($condicao != '') {
            $where = " WHERE {$condicao}";
        }
        $sql = "SELECT p.*, c.nome as nome_categoria FROM {$this->tabela} p
                LEFT JOIN categorias c ON p.categoria = c.id
                {$where}";
                //echo $sql; exit;
        $stmt = $this->db->prepare($sql);
        $stmt->setFetchMode(PDO::FETCH_CLASS, $this->class);
        $stmt->execute();
        return $stmt->fetchAll();
    }

}