<?php
session_start();
require_once 'connect.php';


//Данные о клиенте
$surname = $_POST['surname'];
$first_name = $_POST['first_name'];
$last_name = $_POST['last_name'];
$login = $_POST['login'];
$email = $_POST['email'];
$telephone = $_POST['telephone'];

//Данные о адресе клиента
$city = $_POST['city'];
$section = $_POST['section'];
$street = $_POST['street'];
$house = $_POST['house'];
$flat = $_POST['flat'];
$year = $_POST['year'];
$floor = $_POST['floor'];
$area = $_POST['area'];


$password = $_POST['password'];
$password_confirm = $_POST['password_confirm'];

//если пароли совпадают
if ($password === $password_confirm) {

    //Загружаем файл аватарку (можно добавить при условии наличия, иначе загружается свой (см.конспект)) + time для уникальности имени
    $path = 'uploads/' . time() . $_FILES['avatar']['name'];

    //если ошибка при загрузке изображения
    if (!move_uploaded_file($_FILES['avatar']['tmp_name'], '../' . $path)) {

        // Создаем ссесию-переменную глобальную
        $_SESSION['message'] = 'Ошибка при загрузке фотографии';
        //header - переадресует автоматически на страницу!!   
        header('location: ../Register.php');
    }

    //Шифруем пароль для хранения в БД
    $password = md5($password);
    $status = 0;



    //Вставляем в БД user регестрирующегося ( TO-DO : Тут все регестрирующиеся становятся со status = "0")
    mysqli_query($connect, "INSERT INTO `user` (`id`, `login`, `password`, `surname`, `first_name`, `last_name`, `email`, `telephone`, `avatar`, `status`) VALUES (NULL, '$login', '$password', '$surname', '$first_name', '$last_name', '$email', '$telephone', '$path', '$status');");

    //Получаем id последнего добавленного пользователя (т.е этого)
    $idUser1 = mysqli_query($connect, "SELECT * FROM `user` WHERE `id`=LAST_INSERT_ID();");
    $userid2 = mysqli_fetch_assoc($idUser1); //Нужно было преобразовать в ассоц-массив
    $userid3 = $userid2['id'];

    //Вставляем в БД home пользователя из формы регистрации (cо связью с id регестрирующегося user)
    mysqli_query($connect, "INSERT INTO `home` (`id`, `id_user`, `city`, `section`, `street`, `house`, `flat`, `year`, `floor`, `area`) VALUES (NULL, '$userid3', '$city', '$section', '$street', '$house', '$flat', '$year', '$floor', '$area');");

    //Отправляем сообщение успешной регестрации 
    //на страницу на которой при наличии этой ссессии переменной сработает авто-открытие окна модульного
    $_SESSION['message'] = 'Регистрация пройдена успешна!';
    header('Location:../index.php');
}
//если не пароли совпадают остаемся на странице signup
else {
    // Создаем ссесию-переменную глобальную
    $_SESSION['message'] = 'Пароли не совпадают';
    //header - переадресует автоматически на страницу!!   
    header('location: ../Register.php');
}
