<?php
require_once 'Model.php';
class RelatorioDAO extends Model
{
    public function __construct()
    {
        parent::__construct();
    }
    public function contar($table = 'clientes', $condicao = '')
    {
    	$where = '';
    	if($condicao != '') {
    		$where = "WHERE {$condicao}";
    	}
    	$sql = "SELECT count(*) as total FROM {$table} {$where};";
    	$stmt = $this->db->prepare($sql);
    	$stmt->execute();
    	return $stmt->fetch(PDO::FETCH_ASSOC);	
    }
    public function contarProdutosCategoria($table = 'produtos', $condicao = '')
    {
        $where = '';
        if($condicao != '') {
            $where = "WHERE {$condicao}";
        }
        $sql = "SELECT c.nome as categoria, count(*) as total 
                FROM {$table} p
                LEFT JOIN categorias c ON c.id = p.categoria
                GROUP BY p.categoria
                {$where};";
        $stmt = $this->db->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);  
    }
}