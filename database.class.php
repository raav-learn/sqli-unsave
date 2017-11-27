<?php

class Db {

    private $connection = null;

    function __construct()
    {
        $servername = "localhost";
        $username   = "sqliunsave";
        $password   = "";
        $dbname     = "sqli-unsave";

        try {
            $this->connection = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
            // set the PDO error mode to exception
            $this->connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (Exception $ex) {
            // exception handling
            echo "Connection failed";
            exit;
        }
    }

    function register($username, $email, $password) {
        try {
            $sql = "INSERT INTO `users` (`username`, `email`, `password`)
                    VALUES ('$username', '$email', '$password')"; //sqli ready xD

            // use exec() because no results are returned
            $this->connection->exec($sql);
        }
        catch(PDOException $e)
        {
            echo $sql . "<br>" . $e->getMessage();
            // exception handling
        }
    }

    function save_hash($plain_password, $secure_password) {
        try {
            $sql = "INSERT IGNORE INTO `hashlist` (`password`, `hash`)
                    VALUES (:plain, :secure)"; //sqli ready xD

            // prepare sql and bind parameters
            $stmt = $this->connection->prepare($sql);
            $stmt->bindParam(':plain', $plain_password);
            $stmt->bindParam(':secure', $secure_password);
            $stmt->execute();
        }
        catch(PDOException $e)
        {
            //echo $sql . "<br>" . $e->getMessage();
            // exception handling
        }
    }

    function close() {
        $this->connection = null;
    }
}