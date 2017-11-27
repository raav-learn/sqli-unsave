<?php

//Check if all parameters are present
if (!(
       (isset($_POST['username'])   && $_POST['username'] != "")
    && (isset($_POST['email'])      && $_POST['email'] != "")
    && (isset($_POST['password'])   && $_POST['password'] != "")
)) {
    echo "Missing parameterss";
    exit;
}

$username   = $_POST['username'];
$email      = $_POST['email'];
$password   = $_POST['password'];

require_once ("database.class.php");

$db = new Db();
$db->register($username, $email, $password, md5($password));

echo "Register, you can now login with the following credentials\n
Username: $username,\n
Password: $password,";

