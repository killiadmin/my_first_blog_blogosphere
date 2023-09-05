<?php

class Post
{
    private $_idPost;
    private $_idUserAssociated;
    private $_title;
    private $_chapo;
    private $_content;
    private $_dateCreate;
    private $_dateUpdate;
    private $_name;
    private $_userName;

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
    public function setIdPost(int $idPost)
    {
        $idPost = (int) $idPost;
        if ($idPost > 0) {
            $this->_idPost = $idPost;
        }
    }

    public function setIdUserAssociated(int $idUserAssociated)
    {
        if ((int) ($idUserAssociated)) {
            $this->_idUserAssociated = $idUserAssociated;
        }
    }

    public function setTitle(string $title)
    {
        if (is_string($title)) {
            $this->_title = $title;
        }
    }

    public function setChapo(string $chapo)
    {
        if (is_string($chapo)) {
            $this->_chapo = $chapo;
        }
    }

    public function setContent(string $content)
    {
        if (is_string($content)) {
            $this->_content = $content;
        }
    }

    public function setDateCreate(string $dateCreate)
    {
        $this->_dateCreate = $dateCreate;
    }

    public function setDateUpdate(string $dateUpdate)
    {
        $this->_dateUpdate = $dateUpdate;
    }

    public function setName(string $name)
    {
        if (is_string($name)) {
            $this->_name = $name;
        }
    }
    public function setUserName(string $userName)
    {
        if (is_string($userName)) {
            $this->_userName = $userName;
        }
    }

    //getters

    public function idPost()
    {
        return $this->_idPost;
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

    public function name()
    {
        return$this->_name;
    }

    public function userName()
    {
        return$this->_userName;
    }
}