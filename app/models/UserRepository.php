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
}