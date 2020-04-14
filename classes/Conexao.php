<?php

class Conexao
{
	private $host;
	private $user;
	private $password;
	private $conn;

	public function __construct() {
		$this->host = 'mysql:host=localhost;dbname=loja_senac';
		$this->user = 'root';
		$this->password = 'root';
	}

    public function conectar() {
    	try {
			$conn = new PDO(
							$this->host,
							$this->user, 
							$this->password
						);

			return $conn;
			
		} catch (PDOException $e) {
			echo 'Erro na conexao. Código: ' . $e->getCode();
		}
    }
}