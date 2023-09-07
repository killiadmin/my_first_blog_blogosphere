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

    /**
     * Method to select all data in a table
     * @param $table
     * @param $obj
     * @return array
     * @throws Exception
     */

    protected function getAll(string $table, string $obj)
    {
        $this->getConnectionDataBase();
        $datas = [];

        if ($table === 'posts') {
            $sql = "SELECT idPost, ${table}.idUserAssociated, title, chapo, ${table}.content, ${table}.dateCreate, ${table}.dateUpdate, name, username
                    FROM $table
                    JOIN users
                    ON users.idUser = ${table}.idUserAssociated
                    ORDER BY ${table}.dateCreate DESC";
        } elseif ($table === 'comments') {
            $sql = "SELECT idComment, ${table}.idUserAssociated, idPostAssociated, ${table}.content, ${table}.dateCreate, ${table}.dateUpdate 
                    FROM $table
                    ORDER BY ${table}.dateCreate DESC";
        } else {
            $sql = "SELECT idUser, name, username, picture, quote, mail, password, status, activated, ${table}.dateCreate
                    FROM $table
                    ORDER BY ${table}.dateCreate DESC";
        }

        $query = self::$_db->prepare($sql);

        if ($query->execute()) {
            while ($data = $query->fetch(PDO::FETCH_ASSOC)) {
                $datas[] = new $obj($data);
            }
        } else {
            throw new Exception("Error, data is unavailable");
        }

        return $datas;
    }

    /**
     * Method to select data with his id
     * @param $table
     * @param $tableJoin
     * @param $obj
     * @param $id
     * @return array
     */

    protected function getOne(string $table, string $tableJoin, string $obj, int $id)
    {
        $this->getConnectionDataBase();
        $datas = [];

        if ($table === 'comments') {
            $idReference = 'idPostAssociated';
            $orderByCustom = 'idComment';
        } elseif ($table === 'posts') {
            $idReference = 'idPost';
            $orderByCustom = 'idPost';
        }

        $sql = "SELECT * 
            FROM $table
            JOIN $tableJoin
            ON $table.idUserAssociated = $tableJoin.idUser
            WHERE $table.$idReference = :id
            ORDER BY $table.$orderByCustom DESC";

        $query = self::$_db->prepare($sql);
        $query->bindParam(':id', $id, PDO::PARAM_INT);

        if ($query->execute()) {
            while ($data = $query->fetch(PDO::FETCH_ASSOC)) {
                $datas[] = new $obj($data);
            }
        } else {
            throw new Exception("Error, data is unavailable");
        }

        return $datas;
    }

    /**
     * Method to select User with his id
     * @param string $table
     * @param string $obj
     * @param int $id
     * @return array
     */

    protected function getOneUser(string $table, string $obj, int $id)
    {
        $this->getConnectionDataBase();
        $datas = [];

        $sql = "SELECT idUser, name, username, picture, quote, status, activated 
                FROM $table
                WHERE idUser = :id";

        $query = self::$_db->prepare($sql);
        $query->bindParam(':id', $id, PDO::PARAM_INT);

        if ($query->execute()) {
            while ($data = $query->fetch(PDO::FETCH_ASSOC)) {
                $datas[] = new $obj($data);
            }
        } else {
            throw new Exception("Error, data is unavailable");
        }

        //Return datas to users
        return $datas;
    }

    /**
     * Method to connection for users
     * @param string $table
     * @param string $obj
     * @param string $mail
     * @param string $password
     * @return array
     */

    protected function connectionUser(string $table, string $obj, string $mail, string $password)
    {
        $this->getConnectionDataBase();
        $datas = [];

        $sqlCheckUser = "SELECT *
                         FROM $table
                         WHERE mail = :mail";

        $checkIfUserExist = self::$_db->prepare($sqlCheckUser);
        $checkIfUserExist->bindValue(':mail', $mail, PDO::PARAM_STR);

        if ($checkIfUserExist->execute() && $checkIfUserExist->rowCount() > 0) {
            $data = $checkIfUserExist->fetch(PDO::FETCH_ASSOC);
            //Verifying password using password_verify
            if (password_verify($password, $data['password'])) {
                $datas[] = new $obj($data);
            }
        }

        //Return datas to users
        return $datas;
    }

    /**
     * Method to verifying if mail is taken for new users
     * @param string $table
     * @param string $mail
     * @return bool
     * @throws Exception
     */

    protected function checkIfEmailTaken(string $table, string $mail)
    {
        $this->getConnectionDataBase();

        $sqlCheckIsEmailTaken = "SELECT mail 
                                 FROM $table
                                 WHERE mail = :mail";

        $checkMail = self::$_db->prepare($sqlCheckIsEmailTaken);
        $checkMail->bindValue(':mail', $mail, PDO::PARAM_STR);

        if ($checkMail->execute()) {
            $result = $checkMail->fetch();
            // Verifying e-mail is taken
            if ($result) {
                return true;
            }
        } else {
            throw new Exception("Error, data is unavailable");
        }

        $checkMail->closeCursor();

        return false;
    }

    /**
     * Method for create new user in the database
     * @param string $table
     * @param string $name
     * @param string $username
     * @param string $mail
     * @param string $password
     * @return string
     */

    protected function methodForCreateUser (string $table, string $name, string $username, string $mail, string $password)
    {
        $this->getConnectionDataBase();

        $sqlCreateUser = "INSERT INTO " . $table . " (name, username, picture, quote, mail, password, status ,dateCreate) VALUES (?, ?, ?, ?, ?, ?, ?, ?)";
        $execCreateUser = self::$_db->prepare($sqlCreateUser);

        if (empty($name) || empty($username) || empty($mail) || empty($password)) {
            return "All fields must be completed.";
        }

        $date = date("Y-m-d H:i:s");
        $status = 'reader';
        $picture = 'photo_default.jpeg';
        $quote = "I'm a new reader";

        if ($execCreateUser->execute([ $name, $username, $picture, $quote, $mail, $password, $status, $date])) {
            return "The user is registered.";
        } else {
            return "An error occurred during user registration.";
        }

        $query->closeCursor();
    }

    /**
     * Method to verifying if user exist
     * @param string $table
     * @param string $obj
     * @param string $name
     * @param string $username
     * @param string $mail
     * @return array|string
     */

    protected function methodForGetInfosregister(string $table, string $obj, string $name, string $username, string $mail)
    {
        $this->getConnectionDataBase();
        $datas = [];

        $sqlCheckInfosRegister = "SELECT idUser, name, username, mail, status
                                  FROM $table
                                  WHERE name = :name
                                  AND username = :username
                                  AND mail = :mail";

        $checkinfosRegister = self::$_db->prepare($sqlCheckInfosRegister);
        $checkinfosRegister->bindParam(':name', $name, PDO::PARAM_STR);
        $checkinfosRegister->bindParam(':username', $username, PDO::PARAM_STR);
        $checkinfosRegister->bindParam(':mail', $mail, PDO::PARAM_STR);

        if ($checkinfosRegister->execute()) {
            if ($checkinfosRegister->rowCount() > 0) {
                while ($data = $checkinfosRegister->fetch(PDO::FETCH_ASSOC)) {
                    $datas[] = new $obj($data);
                }

                //Return datas to user register
                return $datas;
            } else {
                return 'There was a problem registering the user';
            }
        } else {
            throw new Exception("Error, data is unavailable");
        }
    }

    /**
     * Method to insert a new post in the database
     * @param $table
     * @return string
     */

    protected function createOne(string $table)
    {
        $this->getConnectionDataBase();

        $sql = "INSERT INTO $table (idUserAssociated, title, chapo, content, dateCreate, dateUpdate) VALUES (?, ?, ?, ?, ?, ?)";
        $query = self::$_db->prepare($sql);

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

        $idUserAssociated = '1';

        // Bind the values and run the query
        if ($query->execute([$idUserAssociated, $title, $chapo, $content, $currentDate, $currentDate])) {
            return "The article was added successfully.";
        } else {
            return "An error occurred while adding the article.";
        }

        $query->closeCursor();
    }


    /**
     * Method to insert a comment in the table with user data
     * @param $table
     * @param $tableCheck
     * @param $id
     * @param $idUser
     * @return void
     */
    protected function createOneComment(string $table, string $tableCheck, int $id, int $idUser)
    {
        $this->getConnectionDataBase();
        $sqlCheckPost = "SELECT * 
                         FROM $tableCheck
                         WHERE idPost=" . $id;
        $checkPostExist = self::$_db->prepare($sqlCheckPost);
        $checkPostExist->execute();

        if ($checkPostExist->rowCount() > 0) {
            $sqlInsertComment = "INSERT INTO " . $table . " (idUserAssociated, idPostAssociated, content, dateCreate, dateUpdate) VALUES (?, ?, ?, ?, ?)";
            $sqlPrepareComment = self::$_db->prepare($sqlInsertComment);

            // Check if the values exist before using them
            $contentComment = isset($_POST['contentComment']) ? $_POST['contentComment'] : '';

            $idUserAssociated = $idUser;
            $idPostAssociated = $id;

            // Use the date function to get the current date in the correct format
            $currentDate = date('Y-m-d H:i:s');
            $dateUpdate = $currentDate;

            // Bind the values and run the query
            $sqlPrepareComment->execute([$idUserAssociated, $idPostAssociated ,$contentComment , $currentDate, $dateUpdate]);

            $sqlPrepareComment->closeCursor();
        }
    }

    /**
     * Method for Delete posts and if comments is associated so delete then
     * @param string $table
     * @param string $tableCheck
     * @param int $id
     * @return void
     */
    protected function deleteOne (string $table, string $tableCheck, int $id)
    {
        $this->getConnectionDataBase();
        $sqlComment = "SELECT * 
                       FROM $tableCheck
                       WHERE idPostAssociated=" . $id;
        $checkCommentsExists = self::$_db->prepare($sqlComment);
        $checkCommentsExists->execute();

        if ($checkCommentsExists->rowCount() > 0) {
            $sqlDeleteComment = "DELETE 
                                 FROM $tableCheck
                                 WHERE idPostAssociated=" . $id;
            $sqlDeleteComment = self::$_db->prepare($sqlDeleteComment);
            $sqlDeleteComment->execute();
        }

        $sql = "DELETE 
                FROM $table
                WHERE idPost=" . $id;
        $query = self::$_db->prepare($sql);
        $query->execute();

        $query->closeCursor();
    }

    /**
     * Method to update a post, on a new author is assigned his id will be assigned to the post
     * @param $table
     * @param $tableJoin
     * @param $setTitle
     * @param $setChapo
     * @param $setContent
     * @param $id
     * @return false
     */

    protected function updateOne(string $table, string $tableJoin, string $setTitle, string $setChapo, string $setContent, int $id)
    {
        $this->getConnectionDataBase();

        $sqlPost = "SELECT * 
                FROM $table
                WHERE idPost=?";
        $checkPostExists = self::$_db->prepare($sqlPost);
        $checkPostExists->execute([$id]);

        if ($checkPostExists->rowCount() > 0) {
            try {
                // Retrieve POST data and validate it
                $title = isset($_POST['title']) ? trim($_POST['title']) : '';
                $name = isset($_POST['name']) ? trim($_POST['name']) : '';
                $username = isset($_POST['username']) ? trim($_POST['username']) : '';
                $chapo = isset($_POST['chapo']) ? trim($_POST['chapo']) : '';
                $content = isset($_POST['content']) ? trim($_POST['content']) : '';

                // Check if user exists in database
                $sqlCheckUser = "SELECT * FROM $tableJoin WHERE name=? AND username=?";
                $checkUserExists = self::$_db->prepare($sqlCheckUser);
                $checkUserExists->execute([$name, $username]);

                if ($checkUserExists->rowCount() > 0) {
                    $userData = $checkUserExists->fetch(PDO::FETCH_ASSOC);
                    $userId = $userData['idUser'];

                    $currentDate = date('Y-m-d H:i:s');

                    $sqlUpdatePost = "UPDATE $table 
                                  JOIN $tableJoin
                                  ON $table.idUserAssociated = $tableJoin.idUser
                                  SET $setTitle=?,
                                  idUserAssociated=?,
                                  $setChapo=?,
                                  $setContent=?,
                                  dateUpdate = ?
                                  WHERE $table.idPost=?";

                    $sqlExecUpdatePost = self::$_db->prepare($sqlUpdatePost);
                    $sqlExecUpdatePost->execute([$title, $userId, $chapo, $content, $currentDate, $id]);
                } else {
                    $datas = [];
                    while ($data = $checkUserExists->fetch(PDO::FETCH_ASSOC)) {
                        $datas[] = $data;
                    }

                    if (empty($datas)) {
                        $datas[] = 'erreurStatus';
                    }

                    return $datas;
                }
            } catch (PDOException $e) {
                echo "Erreur : " . $e->getMessage();
            }
        }
    }

}