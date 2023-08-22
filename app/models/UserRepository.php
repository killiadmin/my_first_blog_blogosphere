<?php

class UserRepository extends Model
{
    //Function that will retrieve users from the users table
    public function getUsers()
    {
        return $this->getAll('users', 'User');
    }

    public function getUser($id)
    {
        return $this->getOneUser('users', 'User', 1);
    }

    public function connection($mail, $password)
    {
        return $this->connectionUser('users', 'User' ,$mail, $password);
    }

    public function isEmailTaken($mail){
        return $this->checkIfEmailTaken('users', $mail);
    }

    public function createUser($name, $username, $mail, $password)
    {
        return $this->methodForCreateUser('users', $name, $username, $mail, $password);
    }

    public function checkInfosRegister($name, $username, $mail)
    {
        return $this->methodForGetInfosregister('users', 'User' , $name, $username, $mail);
    }
}