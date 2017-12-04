<?php
session_start();
$_SESSION['user'] = null;
header("Location: index.php?msg=You%20successfully%20logged%20out");
exit;