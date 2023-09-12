<?php

class User
{
    private $_idUser;
    private $_name;
    private $_username;
    private $_picture;
    private $_quote;
    private $_mail;
    private $_password;
    private $_status;
    private $_activated;
    private $_dateCreate;

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
    public function setIdUser(int $idUser): void
    {
        $idUser = (int) $idUser;
        if ($idUser > 0) {
            $this->_idUser = $idUser;
        }
    }

    public function setName(string $name): void
    {
        if (is_string($name)) {
            $this->_name = $name;
        }
    }

    public function setUserName(string $username): void
    {
        if (is_string($username)) {
            $this->_username = $username;
        }
    }

    public function setPicture(string $picture): void
    {
        if (is_string($picture)) {
            $this->_picture = $picture;
        }
    }

    public function setQuote(string $quote): void
    {
        if (is_string($quote)){
            $this->_quote = $quote;
        }
    }
    public function setMail(string $mail): void
    {
        if (is_string($mail)) {
            $this->_mail = $mail;
        }
    }

    public function setPassword(string $password): void
    {
        if (is_string($password)) {
            $this->_password = $password;
        }
    }

    public function setStatus(string $status): void
    {
        if (is_string($status)) {
            $this->_status = $status;
        }
    }

    public function setActivated(int $activated): void
    {
        if ((int) $activated) {
            $this->_activated = $activated;
        }

    }

    public function setDateCreate(string $dateCreate): void
    {
        $this->_dateCreate = $dateCreate;
    }

    //getters
    public function idUser(): int
    {
        return $this->_idUser;
    }

    public function name(): string
    {
        return $this->_name;
    }

    public function username(): string
    {
        return $this->_username;
    }

    public function picture(): string
    {
        return $this->_picture;
    }

    public function quote(): string
    {
        return $this->_quote;
    }

    public function mail(): string
    {
        return $this->_mail;
    }

    public function password(): string
    {
        return $this->_password;
    }

    public function status(): string
    {
        return $this->_status;
    }

    public function activated(): int
    {
        return $this->_activated ?? 0;
    }

    public function dateCreate(): string
    {
        $dateTime = DateTime::createFromFormat('Y-m-d H:i:s', $this->_dateUpdate);
        if ($dateTime instanceof DateTime) {
            return $dateTime->format('Y-m-d H:i:s');
        }
        return '';
    }
}