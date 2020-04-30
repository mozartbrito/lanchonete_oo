<?php

require_once 'Model.php';

class UsuarioDAO extends Model
{
 
    public function __construct()
    {
     	parent::__construct();
     	$this->class = 'Usuario';
     	$this->tabela = 'usuarios';
    }

    public function insereUsuario(Usuario $usuario)
    {
    	$values = "null, '{$usuario->getNome()}','{$usuario->getEmail()}', '{$usuario->getSenha()}', '{$usuario->getImagem()}', '{$usuario->getPerfilId()}'";
    	return $this->inserir($values);
    }
    public function alteraUsuario(Usuario $usuario)
    {
    	$altera_senha = ($usuario->getSenha() != '' ? ", senha = '{$usuario->getSenha()}'" : '');
        $altera_imagem = ($usuario->getImagem() != '' ? ", imagem = '{$usuario->getImagem()}'" : '');

    	$values = "
			nome = '{$usuario->getNome()}'
			, email = '{$usuario->getEmail()}'
            , perfil_id = '{$usuario->getPerfilId()}'
            {$altera_imagem}
			{$altera_senha}
    	";

    	$this->alterar($usuario->getId(), $values);
    }

    public function getLogin($email, $senha)
    {
    	$sql = "SELECT u.*, p.descricao as perfil FROM {$this->tabela} u
                LEFT JOIN perfis p ON p.id = u.perfil_id
                WHERE email = :email AND senha = :senha";
        $stmt = $this->db->prepare($sql);
        $stmt->bindParam(':email', $email);
        $stmt->bindParam(':senha', $senha);
    	$stmt->setFetchMode(PDO::FETCH_CLASS, $this->class);
    	$stmt->execute();
    	return $stmt->fetch();
    }
    public function listarUsuarios($condicao = '')
    {
        $where = '';
        if($condicao != '') {
            $where = " WHERE {$condicao}";
        }
        $sql = "SELECT u.*, p.descricao as perfil FROM {$this->tabela} u
                LEFT JOIN perfis p ON p.id = u.perfil_id
                {$where}";
        $stmt = $this->db->prepare($sql);
        $stmt->setFetchMode(PDO::FETCH_CLASS, $this->class);
        $stmt->execute();
        return $stmt->fetchAll();
    }
    public function getPermissoes($id_perfil)
    {
        $sql = "SELECT p.descricao, pm.*, c.nome as controle
                FROM perfis p
                LEFT JOIN permissoes pm ON pm.perfil_id = p.id
                LEFT JOIN controles c ON c.id = pm.controle_id
                WHERE p.id = {$id_perfil}";
        $stmt = $this->db->prepare($sql);
        $stmt->setFetchMode(PDO::FETCH_ASSOC);
        $stmt->execute();
        return $stmt->fetchAll();
    }
}