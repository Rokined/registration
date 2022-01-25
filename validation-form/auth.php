<?php

error_reporting(E_ALL);
ini_set('display_errors', 'on');
mb_internal_encoding('UTF-8');

$name = filter_var(trim($_POST['name']), FILTER_UNSAFE_RAW);
$password = filter_var(trim($_POST['password']), FILTER_UNSAFE_RAW);


$password = md5($password."afqdfdf242");

include('connect.php');

$mysqli = new mysqli($_localhost, $_localhost_name, $_localhost_password, $_localhost_db);
$result = $mysqli->query("SELECT * FROM `users` WHERE (`name`='$name') AND (`password`='$password')");
$user = $result->fetch_assoc();
if (count($user) == 0 ) {
    header('location:/teamplates/autorization-error.html');
    exit();
}

setcookie('user', $user['name'], time() + 3600, "/");

$mysqli->close();

header('location:/teamplates/autorization-success.html');
?> 