<?php

$server = "127.0.0.1";
$login = "root";
$pass = "root";
$name_db = "myelectro";

@$connect = mysqli_connect($server, $login, $pass, $name_db);
$db = $connect;

if ($db  == False) {
    echo "Соединение не удалось";
}

if ($connect == False) {
    echo "Соединение не удалось";
}
