<?php
require_once 'Model.php';
class PerfilDAO extends Model
{

    public function __construct()
    {
        parent::__construct();
        $this->tabela = 'perfis';
        $this->class = 'Perfil';
    }

    public function inserePerfil(Perfil $perfil) {
    	$values = "null, '{$perfil->getDescricao()}', '{$perfil->getStatus()}'";
    	return $this->inserir($values);
    }

    public function alteraPerfil(Perfil $perfil) {
    	$values = "nome = '{$perfil->getDescricao()}', status = '{$perfil->getStatus()}'";
    	$this->alterar($perfil->getId(), $values);
    }
}