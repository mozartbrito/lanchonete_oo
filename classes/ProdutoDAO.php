<?php
require 'Model.php';
class ProdudoDAO extends Model
{
    public function __construct()
    {
        $this->tabela = 'produtos';
    }
}