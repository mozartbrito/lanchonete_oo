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
    	$values = "null, '{$usuario->getNome()}','{$usuario->getEmail()}', '{$usuario->getSenha()}'";
    	return $this->inserir($values);
    }
    public function alteraUsuario(Usuario $usuario)
    {
    	$altera_senha = ($usuario->getSenha() != '' ? ", senha = '{$usuario->getSenha()}'" : '');
    	$values = "
			nome = '{$usuario->getNome()}'
			, email = '{$usuario->getEmail()}'
			{$altera_senha}
    	";

    	$this->alterar($usuario->getId(), $values);
    }
}