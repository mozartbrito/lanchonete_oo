<?php

class Imagem{
	
	private $id;    
	private $descricao;
	private $caminho;
	private $produto_id;


    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param mixed $id
     *
     * @return self
     */
    public function setId($id)
    {
        $this->id = $id;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getDescricao()
    {
        return $this->descricao;
    }

    /**
     * @param mixed $descricao
     *
     * @return self
     */
    public function setDescricao($descricao)
    {
        $this->descricao = $descricao;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getCaminho()
    {
        return $this->caminho;
    }

    /**
     * @param mixed $caminho
     *
     * @return self
     */
    public function setCaminho($caminho)
    {
        $this->caminho = $caminho;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getProdutoId()
    {
        return $this->produto_id;
    }

    /**
     * @param mixed $produto_id
     *
     * @return self
     */
    public function setProdutoId($produto_id)
    {
        $this->produto_id = $produto_id;

        return $this;
    }
}