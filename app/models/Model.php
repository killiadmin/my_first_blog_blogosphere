<?php

abstract class Model
{
    private static $_db;

    //We connect to the database

    private static function setConnectionDataBase()
    {
        self::$_db = new PDO ('mysql:host=127.0.0.1;port=8889;dbname=u746425507_blogorama;charset=utf8', 'root', 'azerty');

        //Error handling PDO
        self::$_db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_WARNING);
    }

    //Check if the db is not already connected
    protected function getConnectionDataBase ()
    {
        if (self::$_db === null) {
            self::setConnectionDataBase();
            return self::$_db;
        }
    }

    //Method to select all data in a table

    protected function getAll($table, $obj)
    {
        $this->getConnectionDataBase();
        $datas = [];
        if($table === 'posts'){
            $sql = "SELECT *
                    FROM " . $table . "
                    JOIN users
                    ON users.idUser =" . $table . ".idUserAssociated
                    ORDER BY " . $table . ".dateCreate DESC";
        } else {
            $sql = "SELECT * 
                    FROM " . $table . " 
                    ORDER BY dateCreate DESC";
        }
        $query = self::$_db->prepare($sql);
        $query->execute();

        while ($data = $query->fetch(PDO::FETCH_ASSOC)) {
            $datas[] = new $obj($data);
        }

        return $datas;

        // Close cursor after query execution
        $query->closeCursor();
    }


    protected function getOne($table, $tableJoin, $obj, $id)
    {
        $this->getConnectionDataBase();
        $datas = [];

        if ($table === 'comments') {
            $idReference = 'idPostAssociated';
        } elseif ($table === 'posts') {
            $idReference = $table . '.idPost';
        }

        $sql = "SELECT * 
            FROM " . $table . "
            JOIN " . $tableJoin . "
            ON " . $table . ".idUserAssociated=" . $tableJoin . ".idUser
            WHERE " . $idReference . "=" . $id;

        $query = self::$_db->prepare($sql);
        $query->execute();

        while ($data = $query->fetch(PDO::FETCH_ASSOC)) {
            $datas[] = new $obj($data);
        }

        // Close cursor before returning the data
        $query->closeCursor();

        return $datas;
    }



    protected function getOneUser($table, $obj, $id)
    {
        $this->getConnectionDataBase();
        $datas = [];

        $sql = "SELECT * 
                FROM " . $table . "
                WHERE idUser=" . $id;

        $query = self::$_db->prepare($sql);
        $query->execute();

        while ($data = $query->fetch(PDO::FETCH_ASSOC)) {
            $datas[] = new $obj($data);
        }

        return $datas;

        // Close cursor after query execution
        $query->closeCursor();
    }

    //Method to insert a new post in the database
    protected function createOne($table)
    {
        $this->getConnectionDataBase();
        $sql = "INSERT INTO " . $table . " (idUserAssociated, title, chapo, content, dateCreate, dateUpdate) VALUES (?, ?, ?, ?, ?, ?)";
        $query = self::$_db->prepare($sql);

        // Check if the values exist before using them
        $title = isset($_POST['title']) ? $_POST['title'] : '';
        $chapo = isset($_POST['chapo']) ? $_POST['chapo'] : '';
        $content = isset($_POST['content']) ? $_POST['content'] : '';

        // Use the date() function to get the current date in the correct format
        $currentDate = date('Y-m-d');
        $dateUpdate = $currentDate;

        $idUserAssociated = ' 10';

        // Bind the values and run the query
        $query->execute([$idUserAssociated, $title, $chapo, $content, $currentDate, $dateUpdate]);

        // Close cursor after query execution
        $query->closeCursor();
    }

    protected function deleteOne ($table, $id)
    {
        $this->getConnectionDataBase();
        $sql = "DELETE 
                FROM " . $table . "
                WHERE idPost=" . $id;
        $query = self::$_db->prepare($sql);
        $query->execute();

        // Close cursor after query execution
        $query->closeCursor();

    }
}