<?php

class ImagemDAO extends Model
{
    
    public function __construct()
    {
        parent::__construct();
        $this->tabela = 'imagens';
        $this->class = 'Imagem';
    }

    public function insereImagem(Imagem $imagem) {
    	$values = "null, 
    				'{$imagem->getDescricao()}',
    				'{$imagem->getCaminho()}',
    				'{$imagem->getProdutoId()}'";
    	return $this->inserir($values);
    }

    public function alteraImagem(Imagem $imagem) {
    	$values = "descricao = '{$produto->getDescricao()}',
    				caminho = '{$produto->getCaminho()}',
    				produto_id = '{$produto->getProdutoId()}'";
    	$this->alterar($imagem->getId(), $values);
    }

    public function listarPorProduto($produto_id)
    {
        $sql = "SELECT * FROM {$this->tabela} WHERE produto_id = {$produto_id}";
        $stmt = $this->db->prepare($sql);
        $stmt->setFetchMode(PDO::FETCH_CLASS, $this->class);
        $stmt->execute();
        return $stmt->fetchAll();
    }
}