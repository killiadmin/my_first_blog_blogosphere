<?php
namespace app\models;
use app\models\Model;

class UserRepository extends Model
{
    //Fonction qui va récupérer les utilisateurs dans la table utilisateurs
    public function getUsers()
    {
        return $this->getAll('users', User);
    }
}