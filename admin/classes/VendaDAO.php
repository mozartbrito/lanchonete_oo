<?php
require_once 'Model.php';
class VendaDAO extends Model
{
    public function __construct()
    {
    	parent::__construct();
        $this->tabela = 'vendas';
        $this->class  = 'Venda';
    }

    public function insereVenda(Venda $venda)
    {
    	$values = "null, 
    				'{$venda->getCodigo()}',
    				'{$venda->getClienteId()}', 
                    '{$venda->getDataVendaBD()}',
                    '{$venda->getStatus()}', 
                    '{$venda->getDataFinalizacaoBD()}', 
                    '{$venda->getFormaPagamento()}', 
                    '{$venda->getDataPagamentoBD()}'";
    	return $this->inserir($values);
    }

    public function alteraVenda(Venda $venda) {
    	/*$values = "nome = '{$venda->getNome()}',
    				preco = '{$venda->getPrecoBD()}',
                    qtd = '{$venda->getQtd()}',
                    descricao = '{$venda->getDescricao()}',
    				categoria = '{$venda->getCategoria()->getId()}'";
    	$this->alterar($venda->getId(), $values);*/
    }

    public function listar($pesquisa = '')
    {
        if($pesquisa != '') {
            $sql = "SELECT * FROM {$this->tabela} 
                    WHERE codigo like '%{$pesquisa}%'
                        ";
                       /* OR descricao like '%{$pesquisa}%'
                        OR qtd like '%{$pesquisa}%'*/
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