<?php

class Venda
{
    private $id;
    private $codigo;
    private $cliente_id;
    private $data_venda;
    private $status;
    private $data_finalizacao;
    private $forma_pagamento;
    private $data_pagamento;
    private $produtos;

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
    public function getCodigo()
    {
        return $this->codigo;
    }

    /**
     * @param mixed $codigo
     *
     * @return self
     */
    public function setCodigo($codigo)
    {
        $this->codigo = $codigo;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getClienteId()
    {
        return $this->cliente_id;
    }

    /**
     * @param mixed $cliente_id
     *
     * @return self
     */
    public function setClienteId($cliente_id)
    {
        $this->cliente_id = $cliente_id;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getDataVenda()
    {
        return $this->data_venda;
    }

    /**
     * @param mixed $data_venda
     *
     * @return self
     */
    public function setDataVenda($data_venda)
    {
        $this->data_venda = $data_venda;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getStatus()
    {
        return $this->status;
    }

    /**
     * @param mixed $status
     *
     * @return self
     */
    public function setStatus($status)
    {
        $this->status = $status;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getDataFinalizacao()
    {
        return $this->data_finalizacao;
    }

    /**
     * @param mixed $data_finalizacao
     *
     * @return self
     */
    public function setDataFinalizacao($data_finalizacao)
    {
        $this->data_finalizacao = $data_finalizacao;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getFormaPagamento()
    {
        return $this->forma_pagamento;
    }

    /**
     * @param mixed $forma_pagamento
     *
     * @return self
     */
    public function setFormaPagamento($forma_pagamento)
    {
        $this->forma_pagamento = $forma_pagamento;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getDataPagamento()
    {
        return $this->data_pagamento;
    }

    /**
     * @param mixed $data_pagamento
     *
     * @return self
     */
    public function setDataPagamento($data_pagamento)
    {
        $this->data_pagamento = $data_pagamento;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getProdutos()
    {
        return $this->produtos;
    }

    /**
     * @param mixed $produtos
     *
     * @return self
     */
    public function setProdutos(Produto $produtos[])
    {
        $this->produtos = $produtos;

        return $this;
    }
}