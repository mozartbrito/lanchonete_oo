<?php
require_once 'Model.php';
class PermissaoDAO extends Model
{

    public function __construct()
    {
        parent::__construct();
        $this->tabela = 'permissoes';
        $this->class = 'Permissao';
    }

    public function inserePermissao(Permissao $permissao) {
    	$values = "null, 
                    '{$permissao->getControleId()}', 
                    '{$permissao->getPerfilId()}', 
                    '{$permissao->getSelect()}', 
                    '{$permissao->getDelete()}', 
                    '{$permissao->getUpdate()}', 
                    '{$permissao->getInsert()}', 
                    '{$permissao->getShow()}'";
    	return $this->inserir($values);
    }
    public function listarControles($condicao = '')
    {
        $where = '';
        if($condicao != '') {
            $where = " WHERE {$condicao}";
        }
        $sql = "SELECT p.*, c.nome as controle FROM {$this->tabela} p
                LEFT JOIN controles c ON c.id = p.controle_id
                 {$where}";
        $stmt = $this->db->prepare($sql);
        $stmt->setFetchMode(PDO::FETCH_CLASS, $this->class);
        $stmt->execute();
        return $stmt->fetchAll();
    }
}