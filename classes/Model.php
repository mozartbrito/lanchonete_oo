<?php
/**
 * summary
 */
class Model
{
	protected $tabela;

    public function inserir($values)
    {
    	$sql = "INSERT INTO {$this->tabela} VALUES ('{$values}')";
    	echo $sql;
    }

}