<?php
session_start();
require_once ("database.class.php");
$db = new Db();

if (isset($_SESSION['user'])) {
    header("Location: loggedin.php");
    exit;
}

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
$hashed = md5($password);
$db->save_hash($password, $hashed); //save hash for md5 reverse lookup
$db->register($username, $email, $hashed);

header("Location: index.php?msg=registered");
exit;
//echo "Register, you can now login with the following credentials\n
//Username: $username,\n
//Password: $password,";

