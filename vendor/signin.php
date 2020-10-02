<?php
session_start();
require_once 'connect.php';

$login = $_POST['login'];
$password = md5($_POST['password']);

$check_user = mysqli_query($connect, "SELECT * FROM `user` WHERE BINARY `login` = '$login' AND `password` = '$password' LIMIT 1");

//проверяем вернулось ли что-то из БД
if (mysqli_num_rows($check_user) > 0) {

    //Преобразуем полученную строку из БД в массив ассоциативный
    $user = mysqli_fetch_assoc($check_user);

    // Массив помещаем в сессию-массив (Это то что пользователь будет использовать как свои данные)
    $_SESSION['user'] = [
        "id" => $user['id'],
        "login" => $user['login'],
        "avatar" => $user['avatar'],
        "surname" => $user['surname'],
        "first_name" => $user['first_name'],
        "last_name" => $user['last_name'],
        "email" => $user['email'],
        "telephone" => $user['telephone'],
        "password" => $user['password'],
        "status" => $user['status']
    ];
    

    header('Location:../profile.php');
} else {
    $_SESSION['message'] = 'Не верный логин или пароль';
    header('Location:../index.php');
}
