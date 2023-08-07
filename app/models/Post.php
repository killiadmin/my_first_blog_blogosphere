<?php

class Post
{
    private $_id;
    private $_idUserAssociated;
    private $_title;
    private $_chapo;
    private $_content;
    private $_dateCreate;
    private $_dateUpdate;

    public function __construct(array $data)
    {
        $this->hydrate($data);
    }

    public function hydrate (array $data)
    {
        foreach ($data as $key => $value) {
            $method = 'set'.ucfirst($key);
            if (method_exists($this, $method)) {
                $this->$method($value);
            }
        }
    }

    //setters
    public function setId($id)
    {
        $id = (int) $id;
        if ($id > 0) {
            $this->_id = $id;
        }
    }

    public function setIdUserAssociated($idUserAssociated)
    {
        if ((int) ($idUserAssociated)) {
            $this->_idUserAssociated = $idUserAssociated;
        }
    }

    public function setTitle($title)
    {
        if (is_string($title)) {
            $this->_title = $title;
        }
    }

    public function setChapo($chapo)
    {
        if (is_string($chapo)) {
            $this->_chapo = $chapo;
        }
    }

    public function setContent($content)
    {
        if (is_string($content)) {
            $this->_content = $content;
        }
    }

    public function setDateCreate($dateCreate)
    {
        $this->_dateCreate = $dateCreate;
    }

    public function setDateUpdate($dateUpdate)
    {
        $this->_dateUpdate = $dateUpdate;
    }

    //getters

    public function id()
    {
        return $this->_id;
    }

    public function idUserAssociated()
    {
        return $this->_idUserAssociated;
    }

    public function title()
    {
        return $this->_title;
    }

    public function chapo()
    {
        return $this->_chapo;
    }

    public function content()
    {
        return $this->_content;
    }

    public function dateCreate()
    {
        return $this->_dateCreate;
    }

    public function dateUpdate()
    {
        return $this->_dateUpdate;
    }
}