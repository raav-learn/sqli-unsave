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

            #save
//            $sql = "INSERT INTO `users` (`username`, `email`, `password`)
//                    VALUES (:username, :email, :password)";
//
//            $stmt = $this->connection->prepare($sql);
//            $stmt->bindParam(':username', $username);
//            $stmt->bindParam(':email', $email);
//            $stmt->bindParam(':password', $password);
//            $stmt->execute();


            # Unsave
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
            #Save
//            $sql = "SELECT `id`, `username`, `email` FROM `users` WHERE `username`=:username AND `password`=:password LIMIT 1;";
//            $stmt = $this->connection->prepare($sql);
//            $stmt->bindParam(':username', $username);
//            $stmt->bindParam(':password', $password);
//            $result = null;
//
//            if ($stmt->execute()) {
//                while ($row = $stmt->fetch()) {
//                    $result = $row;
//                }
//            };

            #Unsave
            $sql = "SELECT `id`, `username`, `email` FROM `users` WHERE `username`='$username' AND `password`='$password' LIMIT 1;"; //sqli ready xD

            $result = null;
            foreach ($this->connection->query($sql) as $row) {
                $result = $row;
                break;
            };

            if (!is_null($result)) {
                return $result;
            }
        }
        catch(PDOException $e)
        {
            // exception handling
            $this->error($sql, $e);
        }

        return false;
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

    function get_user($id) {
        try {
            ## Getting data using prepared statement
//            $sql = "SELECT `id`, `username`, `email` FROM `users` WHERE `id`= ? LIMIT 1;";
//            $stmt = $this->connection->prepare($sql);
//
//            $result = null;
//            if ($stmt->execute([$id])) {
//                while ($row = $stmt->fetch()) {
//                    $result = $row;
//                }
//            };


            # Unsecure
            $sql = "SELECT `id`, `username`, `email` FROM `users` WHERE `id`=$id LIMIT 1;"; //sqli is probably possible

            $result = null;
            foreach ($this->connection->query($sql) as $row) {
                $result = $row;
                break;
            };

            if (!is_null($result)) {
                return $result;
            }
        }
        catch(PDOException $e)
        {
            // exception handling
            $this->error($sql, $e);
        }

        return false;
    }

    function get_user_by_username($username) {
        try {

//            ## Getting data using prepared statement
//            $sql = "SELECT `username` FROM `users` WHERE `username` LIKE ? LIMIT 100;";
//            $stmt = $this->connection->prepare($sql);
//            $result = [];
//            if ($stmt->execute(["%".$username."%"])) {
//                while ($row = $stmt->fetch()) {
//                    array_push($result, $row);
//                }
//            };

//          # Getting data using insecure statement
            $sql = "SELECT `username` FROM `users` WHERE `username` LIKE '%$username%' LIMIT 100;"; //sqli ready

            $result = [];
            foreach ($this->connection->query($sql) as $row) {
                array_push($result, $row);
            };

            return $result;
        }
        catch(PDOException $e)
        {
            // exception handling
            $this->error($sql, $e);
        }

        return false;
    }

    function close() {
        $this->connection = null;
    }

    private function error($sql, $exception) {
        ?>
        <!DOCTYPE html>
        <html>
        <title>SQLi Unsave | home</title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
        <link rel="stylesheet" href="https://www.w3schools.com/lib/w3-theme-teal.css">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.3.0/css/font-awesome.min.css">
        <body>
        <div class="w3-container">
            <div class="w3-container w3-red">
                <h2>SQL ERROR</h2>
                <p><?php echo $sql; ?></p>
            </div>
            <div class="w3-container w3-gray">
                <?php echo $exception->getMessage(); ?>
            </div>
        </div>
        <?php

        ?>
        </body></html>
        <?php
        exit;
    }
}