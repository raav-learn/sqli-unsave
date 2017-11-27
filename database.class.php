<?php

class Db {

    private $connection = null;

    function __construct()
    {
        $servername = "localhost";
        $username   = "sqliunsave";
        $password   = "sqliunsave";
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

    function register($username, $email, $password, $password_secure) {
        try {
            $sql = "INSERT INTO users (username, email, password, password_secure)
                    VALUES ($username, $email, $password, $password_secure)"; //sqli ready xD

            // use exec() because no results are returned
            $this->connection->exec($sql);
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