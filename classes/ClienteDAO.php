<?php
require_once 'Model.php';

class ClienteDAO extends Model
{
    public function __construct()
    {
        parent::__construct();
        $this->class = 'Cliente';
        $this->tabela = 'clientes';
    }
    public function insereCliente(Cliente $cliente)
    {
    	$values = "null,
				   '{$cliente->getNome()}',
				   '{$cliente->getCpf()}',
				   '{$cliente->getDtNascimentoBD()}',
				   '{$cliente->getSexo()}',
				   '{$cliente->getEmail()}',
				   '{$cliente->getCelular()}',
				   '{$cliente->getCep()}',
				   '{$cliente->getLogradouro()}',
				   '{$cliente->getComplemento()}',
				   '{$cliente->getNumero()}',
				   '{$cliente->getBairro()}',
				   '{$cliente->getCidade()}',
				   '{$cliente->getEstado()}',
				   '{$cliente->getImagem()}'
    				";

    	return $this->insert($values);
    }
    public function alteraCliente(Cliente $cliente)
    {
    	$values = "nome = '{$cliente->getNome()}',
				   cpf = '{$cliente->getCpf()}',
				   dt_nascimento = '{$cliente->getDtNascimentoBD()}',
				   sexo = '{$cliente->getSexo()}',
				   email = '{$cliente->getEmail()}',
				   celular = '{$cliente->getCelular()}',
				   cep = '{$cliente->getCep()}',
				   logradouro = '{$cliente->getLogradouro()}',
				   complemento = '{$cliente->getComplemento()}',
				   numero = '{$cliente->getNumero()}',
				   bairro = '{$cliente->getBairro()}',
				   cidade = '{$cliente->getCidade()}',
				   estado = '{$cliente->getEstado()}',
				   imagem = '{$cliente->getImagem()}'
    				";
    	$this->alterar($cliente->getId(), $values);
    }

    public function listar($pesquisa = '')
    {
    	if($pesquisa != '') {
    		$sql = "SELECT * FROM {$this->tabela}
    				WHERE nome LIKE '%{$pesquisa}%'
    					OR email LIKE '%{$pesquisa}%'
    					OR cpf LIKE '%{$pesquisa}%'";
    	} else {
    		$sql = "SELECT * FROM {$this->tabela}";
    	}
    	$stmt = $this->db->prepare($sql);
    	$stmt->setFetchMode(PDO::FETCH_CLASS, $this->class);
    	$stmt->execute();
    	return $stmt->fetchAll();
    }
}