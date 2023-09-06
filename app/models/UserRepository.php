<?php

class UserRepository extends Model
{
    //Function that will retrieve users from the users table
    public function getUsers()
    {
        return $this->getAll('users', 'User');
    }

    public function getUser()
    {
        return $this->getOneUser('users', 'User', 1);
    }

    public function connection(string $mail, string $password)
    {
        return $this->connectionUser('users', 'User' , $mail, $password);
    }

    public function isEmailTaken(string $mail){
        return $this->checkIfEmailTaken('users', $mail);
    }

    public function createUser(string $name, string $username, string $mail, string $password)
    {
        return $this->methodForCreateUser('users', $name, $username, $mail, $password);
    }

    public function checkInfosRegister(string $name, string $username, string $mail)
    {
        return $this->methodForGetInfosregister('users', 'User' , $name, $username, $mail);
    }
}