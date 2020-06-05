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
    	$values = "status = '{$venda->getStatus()}'";
    	$this->alterar($venda->getId(), $values);
    }

    public function listar($condicao = '')
    {
        $where = '';
        if($condicao != '') {
            $where = " WHERE 
                        codigo LIKE '%{$condicao}%' OR 
                        nome  LIKE '%{$condicao}%' OR 
                        email  LIKE '%{$condicao}%' OR 
                        forma_pagamento  LIKE '%{$condicao}%' OR 
                        status  LIKE '%{$condicao}%' OR 
                        data_venda  LIKE '%{$condicao}%'";
        }
        $sql = "SELECT v.id, v.codigo,v.data_venda, v.forma_pagamento, v.status, c.nome, c.email 
                FROM {$this->tabela} v
                LEFT JOIN clientes c ON v.cliente_id = c.id
                {$where}
                ORDER BY id DESC";

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
    public function listaVendasCliente($condicao)
    {
        $where = '';
        if($condicao != '') {
            $where = " WHERE {$condicao}";
        }
        $sql = "SELECT v.id, v.codigo,v.data_venda, v.forma_pagamento, v.status 
                FROM {$this->tabela} v
                {$where}
                ORDER BY id DESC";
                //echo $sql; exit;
        $stmt = $this->db->prepare($sql);
        $stmt->setFetchMode(PDO::FETCH_CLASS, $this->class);
        $stmt->execute();
        return $stmt->fetchAll();
    }

}