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
    public function setIdPost(int $idPost): void
    {
        $idPost = (int) $idPost;
        if ($idPost > 0) {
            $this->_idPost = $idPost;
        }
    }

    public function setIdUserAssociated(int $idUserAssociated): void
    {
        if ((int) ($idUserAssociated)) {
            $this->_idUserAssociated = $idUserAssociated;
        }
    }

    public function setTitle(string $title): void
    {
        if (is_string($title)) {
            $this->_title = $title;
        }
    }

    public function setChapo(string $chapo): void
    {
        if (is_string($chapo)) {
            $this->_chapo = $chapo;
        }
    }

    public function setContent(string $content): void
    {
        if (is_string($content)) {
            $this->_content = $content;
        }
    }

    public function setDateCreate(string $dateCreate): void
    {
        $this->_dateCreate = $dateCreate;
    }

    public function setDateUpdate(string $dateUpdate): void
    {
        $this->_dateUpdate = $dateUpdate;
    }

    public function setName(string $name): void
    {
        if (is_string($name)) {
            $this->_name = $name;
        }
    }
    public function setUserName(string $userName): void
    {
        if (is_string($userName)) {
            $this->_userName = $userName;
        }
    }

    //getters

    public function idPost(): int
    {
        return $this->_idPost;
    }

    public function idUserAssociated(): int
    {
        return $this->_idUserAssociated;
    }

    public function title(): string
    {
        return $this->_title;
    }

    public function chapo(): string
    {
        return $this->_chapo;
    }

    public function content(): string
    {
        return $this->_content;
    }

    public function dateCreate()
    {
        $dateTime = DateTime::createFromFormat('Y-m-d H:i:s', $this->_dateCreate);
        if ($dateTime instanceof DateTime) {
            return $dateTime->format('Y-m-d H:i:s');
        }
        return '';
    }

    public function dateUpdate()
    {
        $dateTime = DateTime::createFromFormat('Y-m-d H:i:s', $this->_dateUpdate);
        if ($dateTime instanceof DateTime) {
            return $dateTime->format('Y-m-d H:i:s');
        }
        return '';
    }

    public function name(): string
    {
        return$this->_name;
    }

    public function userName(): string
    {
        return$this->_userName;
    }
}