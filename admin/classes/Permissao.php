<?php
class Permissao
{
	private $id;
	private $controle_id;
	private $perfil_id;
	private $select;
	private $delete;
	private $update;
	private $insert;
	private $show;

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
    public function getControleId()
    {
        return $this->controle_id;
    }

    /**
     * @param mixed $controle_id
     *
     * @return self
     */
    public function setControleId($controle_id)
    {
        $this->controle_id = $controle_id;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getPerfilId()
    {
        return $this->perfil_id;
    }

    /**
     * @param mixed $perfil_id
     *
     * @return self
     */
    public function setPerfilId($perfil_id)
    {
        $this->perfil_id = $perfil_id;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getSelect()
    {
        return $this->select;
    }

    /**
     * @param mixed $select
     *
     * @return self
     */
    public function setSelect($select)
    {
        $this->select = $select;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getDelete()
    {
        return $this->delete;
    }

    /**
     * @param mixed $delete
     *
     * @return self
     */
    public function setDelete($delete)
    {
        $this->delete = $delete;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getUpdate()
    {
        return $this->update;
    }

    /**
     * @param mixed $update
     *
     * @return self
     */
    public function setUpdate($update)
    {
        $this->update = $update;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getInsert()
    {
        return $this->insert;
    }

    /**
     * @param mixed $insert
     *
     * @return self
     */
    public function setInsert($insert)
    {
        $this->insert = $insert;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getShow()
    {
        return $this->show;
    }

    /**
     * @param mixed $show
     *
     * @return self
     */
    public function setShow($show)
    {
        $this->show = $show;

        return $this;
    }
}