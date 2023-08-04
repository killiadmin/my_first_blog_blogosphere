<?php

class UserRepository extends Model
{
    //Function that will retrieve users from the users table
    public function getUsers()
    {
        return $this->getAll('users', 'User');
    }
}