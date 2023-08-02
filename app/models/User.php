<?php
namespace app\models;

class User
{
    private $_id;
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

    public function hydrate (array $data)
    {
        foreach ($data as $key => $value) {
            $method = 'set'.ucfirst($key);
            if (method_exists($this, $method)) {
                $this->method($value);
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

    public function setName($name)
    {
        if (is_string($name)) {
            $this->_name = $name;
        }
    }

    public function setUserName($username)
    {
        if (is_string($username)) {
            $this->_username = $username;
        }
    }

    public function setPicture($picture)
    {
        if (is_string($picture)) {
            $this->_picture = $picture;
        }
    }

    public function setQuote($quote)
    {
        if (is_string($quote)){
            $this->_quote = $quote;
        }
    }
    public function setMail($mail)
    {
        if (is_string($mail)) {
            $this->_mail = $mail;
        }
    }

    public function setPassword($password)
    {
        if (is_string($password)) {
            $this->_password = $password;
        }
    }

    public function setStatus($status)
    {
        if (is_string($status)) {
            $this->_status = $status;
        }
    }

    public function setActivated($activated)
    {
        if ((int) $activated) {
            $this->_activated = $activated;
        }

    }

    public function setDateCreate($dateCreate)
    {
        $this->_dateCreate = $dateCreate;
    }

    //getters

    public function id()
    {
        return $this->_id;
    }

    public function name()
    {
        return $this->_name;
    }

    public function username()
    {
        return $this->_username;
    }

    public function picture()
    {
        return $this->_picture;
    }

    public function quote()
    {
        return $this->_quote;
    }

    public function mail()
    {
        return $this->_mail;
    }

    public function password()
    {
        return $this->_password;
    }

    public function status()
    {
        return $this->_status;
    }

    public function activated()
    {
        return $this->_activated;
    }

    public function dateCreate()
    {
        return $this->_dateCreate;
    }
}