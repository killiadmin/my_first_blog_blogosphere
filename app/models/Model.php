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
        $sql = "SELECT * FROM " . $table;
        $query = self::$_db->prepare($sql);
        $query->execute();

        while ($data = $query->fetch(PDO::FETCH_ASSOC)) {
            $datas[] = new $obj($data);
        }

        return $datas;
        $query->closeCursor();
    }


    protected function getOne($table, $obj, $id)
    {
        $this->getConnectionDataBase();
        $datas = [];
        $sql = "SELECT * FROM " . $table . " WHERE id=" . $id;
        $query = self::$_db->prepare($sql);
        $query->execute();

        while ($data = $query->fetch(PDO::FETCH_ASSOC)) {
            $datas[] = new $obj($data);
        }

        return $datas;
        $query->closeCursor();
    }



}