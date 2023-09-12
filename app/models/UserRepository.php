<?php

class UserRepository extends Model
{
    /**
     * Function that will retrieve users from the users table
     * @throws Exception
     */

    public function getUsers(): array
    {
        return $this->getAll('users', 'User');
    }

    /**
     * Function that will retrieve one user from the users table
     * @throws Exception
     */

    public function getUser(): array
    {
        return $this->getOneUser('users', 'User', 1);
    }

    /**
     * Function for connection user in the application
     * @param string $mail
     * @param string $password
     * @return array
     */

    public function connection(string $mail, string $password): array
    {
        return $this->connectionUser('users', 'User' , $mail, $password);
    }

    /**
     * Function for check if the mail exists in the database
     * @param string $mail
     * @return bool
     * @throws Exception
     */

    public function isEmailTaken(string $mail): bool
    {
        return $this->checkIfEmailTaken('users', $mail);
    }

    /**
     * Function for create user in the database
     * @param string $name
     * @param string $username
     * @param string $mail
     * @param string $password
     * @return string|null
     */

    public function createUser(string $name, string $username, string $mail, string $password): ?string
    {
        return $this->methodForCreateUser('users', $name, $username, $mail, $password);
    }

    /**
     * Function for check user exist in th database
     * @throws Exception
     */

    public function checkInfosRegister(string $name, string $username, string $mail): array
    {
        return $this->methodForGetInfosregister('users', 'User' , $name, $username, $mail);
    }
}
