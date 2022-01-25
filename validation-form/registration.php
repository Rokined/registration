<?php
$login = filter_var(trim($_POST['login']), FILTER_UNSAFE_RAW);
$name = filter_var(trim($_POST['name']), FILTER_UNSAFE_RAW);
$password = filter_var(trim($_POST['password']), FILTER_UNSAFE_RAW);

if( mb_strlen($login) < 4 || mb_strlen($login) > 90 ){
    echo '<br>'. "Недопустимая длинна логина";
    exit();
} else if (mb_strlen($name) < 4 || mb_strlen($name) > 30 ){
    echo '<br>'. "Недопустимая длинна имени";
    exit();
} else if (mb_strlen($password) < 4 ){
    echo '<br>'. "Пароль слишком короткий";
    exit();
}

$password = md5($password."afqdfdf242");

include('connect.php');

$mysqli = new mysqli($_localhost, $_localhost_name, $_localhost_password, $_localhost_db);
$mysqli->query("INSERT INTO `users` (`login`, `password`, `name`) VALUES ('$login', '$password', '$name')");
$mysqli->close();

header('location:/teamplates/registration-success.html');
?>