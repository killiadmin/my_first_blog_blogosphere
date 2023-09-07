<?php

class Comment
{
    private $_idComment;
    private $_idUserAssociated;
    private $_idPostAssociated;
    private $_content;
    private $_dateCreate;
    private $_dateUpdate;
    private $_name;
    private $_userName;


    public function __construct(array $data)
    {
        $this->hydrate($data);
    }

    public function hydrate (array $data): void
    {
        foreach ($data as $key => $value) {
            $method = 'set'.ucfirst($key);
            if (method_exists($this, $method)) {
                $this->$method($value);
            }
        }
    }

    //setters
    public function setIdComment(int $idComment): void
    {
        $idComment = (int) $idComment;
        if ($idComment > 0) {
            $this->_idComment = $idComment;
        }
    }

    public function setIdUserAssociated(int $idUserAssociated): void
    {
        if ((int) ($idUserAssociated)) {
            $this->_idUserAssociated = $idUserAssociated;
        }
    }

    public function setIdPostAssociated(int $idPostAssociated): void
    {
        if ((int) ($idPostAssociated)) {
            $this->_idPostAssociated = $idPostAssociated;
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

    public function idComment(): int
    {
        return $this->_idComment;
    }

    public function idUserAssociated(): int
    {
        return $this->_idUserAssociated;
    }

    public function idPostAssociated(): int
    {
        return $this->_idPostAssociated;
    }

    public function content(): string
    {
        return $this->_content;
    }

    public function dateCreate(): string
    {
        $dateTime = DateTime::createFromFormat('Y-m-d H:i:s', $this->_dateCreate);
        if ($dateTime instanceof DateTime) {
            return $dateTime->format('Y-m-d H:i:s');
        }
        return '';
    }

    public function dateUpdate(): string
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