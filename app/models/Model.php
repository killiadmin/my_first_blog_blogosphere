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

/*    protected function connectionUser($table, $obj , $mail, $password)
    {
        $this->getConnectionDataBase();
        $datas = [];

        $sqlCheckUser = "SELECT *
                         FROM " . $table . "
                         WHERE mail =". $mail;

            $checkIfUserExist = self::$_db->prepare($sqlCheckUser);
            $checkIfUserExist->execute();

        if ($checkIfUserExist->rowcount() > 0 && password_verify($password)) {
                while ($data = $checkIfUserExist->fetch(PDO::FETCH_ASSOC)) {
                    $datas[] = new $obj($data);
                }
        }

        return $datas;
        // Close cursor after query execution
        $checkIfUserExist->closeCursor();
    }*/

    protected function connectionUser($table, $obj, $mail, $password)
    {
        // Établissement de la connexion à la base de données
        $this->getConnectionDataBase();
        $datas = [];

        // Requête SQL pour vérifier l'existence de l'utilisateur par email
        $sqlCheckUser = "SELECT *
                     FROM " . $table . "
                     WHERE mail = :mail";

        // Préparation de la requête avec liaison de paramètres
        $checkIfUserExist = self::$_db->prepare($sqlCheckUser);
        $checkIfUserExist->bindValue(':mail', $mail, PDO::PARAM_STR);
        $checkIfUserExist->execute();

        // Vérification du nombre de lignes retournées par la requête
        if ($checkIfUserExist->rowCount() > 0) {
            // Récupération des données de l'utilisateur
            $data = $checkIfUserExist->fetch(PDO::FETCH_ASSOC);
            // Vérification du mot de passe à l'aide de password_verify
            if (password_verify($password, $data['password'])) {
                // Création d'une instance de l'objet utilisateur
                $datas[] = new $obj($data);
            }
        }

        // Fermeture du curseur avant de retourner les données
        $checkIfUserExist->closeCursor();

        // Retour des données de l'utilisateur
        return $datas;
    }

    //Method to insert a new post in the database
    protected function createOne($table)
    {
        $this->getConnectionDataBase();

        // Prepare the SQL query
        $sql = "INSERT INTO $table (idUserAssociated, title, chapo, content, dateCreate, dateUpdate) VALUES (?, ?, ?, ?, ?, ?)";
        $query = self::$_db->prepare($sql);

        // Validate and sanitize user input
        $title = isset($_POST['title']) ? trim($_POST['title']) : '';
        $chapo = isset($_POST['chapo']) ? trim($_POST['chapo']) : '';
        $content = isset($_POST['content']) ? trim($_POST['content']) : '';

        // Check for empty fields
        if (empty($title) || empty($chapo) || empty($content)) {
            $error = "Tous les champs doivent être remplis.";
            // You can redirect or handle the error as needed
            return $error;
        }

        $currentDate = date('Y-m-d H:i:s');

        $idUserAssociated = '1'; // Replace with the actual user ID

        // Bind the values and run the query
        if ($query->execute([$idUserAssociated, $title, $chapo, $content, $currentDate, $currentDate])) {
            $successMessage = "L'article a été ajouté avec succès.";
            // You can redirect or handle the success as needed
            return $successMessage;
        } else {
            $errorMessage = "Une erreur est survenue lors de l'ajout de l'article.";
            // You can redirect or handle the error as needed
            return $errorMessage;
        }

        // Close cursor after query execution
        $query->closeCursor();
    }


    protected function createOneComment($table, $tableCheck, $id)
    {
        $this->getConnectionDataBase();
        $sqlCheckPost = "SELECT * 
                         FROM " . $tableCheck . "
                         WHERE idPost=" . $id;
        $checkPostExist = self::$_db->prepare($sqlCheckPost);
        $checkPostExist->execute();

        if ($checkPostExist->rowCount() > 0) {
            $sqlInsertComment = "INSERT INTO " . $table . " (idUserAssociated, idPostAssociated, content, dateCreate, dateUpdate) VALUES (?, ?, ?, ?, ?)";
            $sqlPrepareComment = self::$_db->prepare($sqlInsertComment);

            // Check if the values exist before using them
            $contentComment = isset($_POST['contentComment']) ? $_POST['contentComment'] : '';

            $idUserAssociated = '1';
            $idPostAssociated = $id;

            // Use the date() function to get the current date in the correct format
            $currentDate = date('Y-m-d H:i:s');
            $dateUpdate = $currentDate;

            // Bind the values and run the query
            $sqlPrepareComment->execute([$idUserAssociated, $idPostAssociated ,$contentComment , $currentDate, $dateUpdate]);

            // Close cursor after query execution
            $sqlPrepareComment->closeCursor();
        }
    }

    protected function deleteOne ($table, $tableCheck, $id)
    {
        $this->getConnectionDataBase();
        $sqlComment = "SELECT * 
                       FROM " . $tableCheck . "
                       WHERE idPostAssociated=" . $id;
        $checkCommentsExists = self::$_db->prepare($sqlComment);
        $checkCommentsExists->execute();

        if ($checkCommentsExists->rowCount() > 0) {
            $sqlDeleteComment = "DELETE 
                                 FROM " . $tableCheck . "
                                 WHERE idPostAssociated=" . $id;
            $sqlDeleteComment = self::$_db->prepare($sqlDeleteComment);
            $sqlDeleteComment->execute();
        }

        $sql = "DELETE 
                FROM " . $table . "
                WHERE idPost=" . $id;
        $query = self::$_db->prepare($sql);
        $query->execute();

        // Close cursor after query execution
        $query->closeCursor();
    }

    protected function updateOne($table, $tableJoin, $frstItem, $scdItem, $thrdItem, $forItem, $fivItem, $id)
    {
        $this->getConnectionDataBase();

        $sqlPost = "SELECT * 
                    FROM " . $table . "
                    WHERE idPost=?";
        $checkPostExists = self::$_db->prepare($sqlPost);
        $checkPostExists->execute([$id]);

        if ($checkPostExists->rowCount() > 0) {
            try {
                // Récupérer les données POST et les valider
                $title = isset($_POST['title']) ? trim($_POST['title']) : '';
                $name = isset($_POST['name']) ? trim($_POST['name']) : '';
                $username = isset($_POST['username']) ? trim($_POST['username']) : '';
                $chapo = isset($_POST['chapo']) ? trim($_POST['chapo']) : '';
                $content = isset($_POST['content']) ? trim($_POST['content']) : '';

                $currentDate = date('Y-m-d H:i:s');

                // Requête préparée pour la mise à jour
                $sqlUpdatePost = "UPDATE " . $table . " 
                              JOIN " . $tableJoin . "
                              ON " . $table . ".idUserAssociated = " . $tableJoin . ".idUser
                              SET 
                              " . $frstItem . "=?,
                              " . $scdItem . "=?,
                              " . $thrdItem . "=?,
                              " . $forItem . "=?,
                              " . $fivItem . "=?,
                              dateUpdate = ?
                              WHERE idPost=?";

                $sqlExecUpdatePost = self::$_db->prepare($sqlUpdatePost);

                // Exécuter la mise à jour avec les valeurs liées
                $sqlExecUpdatePost->execute([$title, $name, $username, $chapo, $content, $currentDate, $id]);
            } catch (PDOException $e) {
                // Gérer les erreurs
                echo "Erreur : " . $e->getMessage();
            } finally {
                if ($sqlExecUpdatePost) {
                    $sqlExecUpdatePost->closeCursor();
                }
            }
        }
    }

}