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
            $this->error("Connection failed", $ex);
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
            // exception handling
            $this->error($sql, $e);
        }
    }

    function login($username, $password) {
        try {
            $sql = "SELECT `username`, `email` FROM `users` WHERE `username`='$username' AND `password`='$password' LIMIT 1;"; //sqli ready xD

            $result = null;
            foreach ($this->connection->query($sql) as $row) {
                $result = $row;
                break;
            };

            if (!is_null($result)) {
                return $result;
            } else {
                return false;
            }
        }
        catch(PDOException $e)
        {
            // exception handling
            $this->error($sql, $e);
        }
    }

    function save_hash($plain_password, $secure_password) {
        try {
            $sql = "INSERT IGNORE INTO `hash_list` (`password`, `hash`)
                    VALUES (:plain, :secure)"; //sqli ready xD

            // prepare sql and bind parameters
            $stmt = $this->connection->prepare($sql);
            $stmt->bindParam(':plain', $plain_password);
            $stmt->bindParam(':secure', $secure_password);
            $stmt->execute();
        }
        catch(PDOException $e)
        {
            $this->error($sql, $e);
        }
    }

    function close() {
        $this->connection = null;
    }

    private function error($sql, $exception) {
        echo $sql . "<br>" . $exception->getMessage();
        exit;
    }
}