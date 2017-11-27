<?php

//Check if all parameters are present
if (!(
       (isset($_POST['username'])   && $_POST['username'] != "")
    && (isset($_POST['password'])   && $_POST['password'] != "")
)) {
    echo "Missing parameterss";
    exit;
}

$username   = $_POST['username'];
$password   = $_POST['password'];

require_once ("database.class.php");

$db = new Db();
$hashed = md5($password);
$db->save_hash($password, $hashed); //save hash for md5 reverse lookup
$user = $db->login($username, $hashed);

if ($user == false) {
    header("Location: index.php?msg=account%20incorrect");
    exit;
} else {
    header("Location: index.php?msg=Welcome%20".$user['email']);
    exit;
}
//echo "Register, you can now login with the following credentials\n
//Username: $username,\n
//Password: $password,";

