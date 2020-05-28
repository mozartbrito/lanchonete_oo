<?php

class VendaProduto
{
    private $id;
    private $venda_id;
    private $produto_id;
    private $valor;
    private $qtd;
    private $desconto;
    private $venda;

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
    public function getVendaId()
    {
        return $this->venda_id;
    }

    /**
     * @param mixed $venda_id
     *
     * @return self
     */
    public function setVendaId($venda_id)
    {
        $this->venda_id = $venda_id;

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

    /**
     * @return mixed
     */
    public function getValor()
    {
        return $this->valor;
    }

    /**
     * @param mixed $valor
     *
     * @return self
     */
    public function setValor($valor)
    {
        $this->valor = $valor;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getQtd()
    {
        return $this->qtd;
    }

    /**
     * @param mixed $qtd
     *
     * @return self
     */
    public function setQtd($qtd)
    {
        $this->qtd = $qtd;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getDesconto()
    {
        return $this->desconto;
    }

    /**
     * @param mixed $desconto
     *
     * @return self
     */
    public function setDesconto($desconto)
    {
        $this->desconto = $desconto;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getVenda()
    {
        return $this->venda;
    }

    /**
     * @param mixed $venda
     *
     * @return self
     */
    public function setVenda(Venda $venda)
    {
        $this->venda = $venda;

        return $this;
    }
}