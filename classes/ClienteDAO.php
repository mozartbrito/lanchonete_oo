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
				   '{$cliente->getDtNascimento()}',
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
				   dt_nascimento = '{$cliente->getDtNascimento()}',
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
}