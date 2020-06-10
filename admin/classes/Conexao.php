<?php

class Conexao
{
	private $host;
	private $user;
	private $password;
	private $conn;

	public function __construct() {
		$this->host = 'mysql:host=localhost;dbname=lanchonete_api';
		$this->user = 'root';
		$this->password = 'root';
	}

    public function conectar() {
    	try {
			$conn = new PDO(
							$this->host,
							$this->user, 
							$this->password,
							array(
								PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
								PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8"
							)
						);

			return $conn;
			
		} catch (PDOException $e) {
			echo 'Erro na conexao. Erro reportado: ' . $e->getMessage();
			exit;
		}
    }
}