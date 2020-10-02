<?php
session_start();
/*подключение библиотек*/
require_once "vendor/connect.php";
require_once "Lib_db.php";

//Система защиты от не администраторов
if (!($_SESSION['user']['status'] == 1)) {
    header('Location:../index.php');
}


//ИЗМЕНЕНИЕ AJAX
if (isset($_POST['new_val'])) {

    $table = $_POST['table'];

    if (update_option($table)) {
        exit("Настрока сохранена");
    } else {
        exit("Ошибка сохраненения");
    }
}




//ИЗМЕНЕНИЕ v2 AJAX
if (isset($_FILES['imageUp'])) {
    //  $FILE =   $_FILES['imageUp']['name'];
    //  $path = 'uploads/' . time() . $_FILES['imageUp']['name'];
    // $_POST['Up_surname']

    $table = $_POST['table'];

    if (Update_option_user($table)) {
        exit("Настрока сохранена");
    } else {
        exit("Ошибка сохраненения");
    }
}



//ПОЛУЧЕНИЕ СТРОКИ ДЛЯ ИЗМЕНЕНИЯ-2 AJAX
if (isset($_POST['strToupdate'])) {

    $table = $_POST['table'];


    if (update_str_option($table)) {

        $options = update_str_option($table);

        $arr = [

            "id" => $options[$_POST["id"]]["id"],
            "first_name" => $options[$_POST["id"]]["first_name"],
            "surname" => $options[$_POST["id"]]["surname"],
            "last_name" => $options[$_POST["id"]]["last_name"],
            "login" => $options[$_POST["id"]]["login"],
            "password" => $options[$_POST["id"]]["password"],
            "email" => $options[$_POST["id"]]["email"],
            "telephone" => $options[$_POST["id"]]["telephone"],
            "avatar" => $options[$_POST["id"]]["avatar"],
            "status" => $options[$_POST["id"]]["status"]

        ];

        $res = json_encode($arr, JSON_UNESCAPED_UNICODE);

        exit($res);
    } else {
        exit("Ошибка сохраненения");
    }
}






//УДАЛЕНИЕ AJAX
if (isset($_POST['del'])) {

    $table = $_POST['table'];


    if (del_option($table)) {
        exit("Настрока сохранена");
    } else {
        exit("Ошибка сохраненения");
    }
}


//ДОБАВЛЕНИЕ AJAX
if (isset($_FILES['image'])) {

    // $FILE =   $_FILES['image']['name'];
    //    $path = 'uploads/' . time() . $_FILES['image']['name'];

    $table = $_POST['table'];

    if (Add_option_user($table)) {
        exit("Настрока сохранена");
    } else {
        exit("Ошибка сохраненения");
    }
}


//TO-DO // 1) ПОЛУЧЕНИЕ МАССИВА SELECT ЗАПРОСА (ИЗ functions.php)
$table = "user";
$options = get_options($table);



//ФУНКЦИЯ ВЫДАЕТ ДАННЫЕ ПОЛЬЗОВАТЕЛЯ НУЖНОГО
$iduser = $_SESSION['user']['id'];
$userid = get_user($iduser);
?>
<!-- склеиваем страницы (+имя этой страницы) -->


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset='UTF-8'>
    <meta name='viewport' content='width=device-width, initial-scale=1.0'>
    <meta name='viewport' content='width=device-width, initial-scale=1, shrink-to-fit=no'>

    <title>Данные пользователей</title>

    <link rel='stylesheet' href='https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css' integrity='sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm' crossorigin='anonymous'>
    <link rel="stylesheet" href="css/main.css">

    <link href='https://fonts.googleapis.com/css2?family=Montserrat:wght@200;400;600&family=Open+Sans:wght@400;700&display=swap' rel='stylesheet'>

    <!-- Автовызов модульного окна при открытии страницы с сесией-переменой от регестрации-->
    <script>
        window.onload = (function() {
            <?php if ($_SESSION['message']) { ?>

                $("#Modal").modal('show');

            <?php };
            //Это промежуточна сессия (матрешка в матрешке)
            $_SESSION['delSession'] = 'del'; ?>
        });
    </script>
</head>

<body>

    <?php
    Add_Header();
    ?>
    <hr class="separator px-0 py-0 my-0 mx-0">
    <nav class="sticky-top ">
        <div class="navigation bg-white" role="navigation">
            <div class="container ">
                <div class="row">
                    <div class="col-12">
                        <nav class="navbar navbar-expand-lg navbar-light gb-light">
                            <!-- <a href="#" class="navbar-brand"><a href="/"><img alt="ЭНЕРГОСОЮЗ" height="45" width="70" src="img/logo 2.png"> -->
                            </a></a>

                            <div class="collapse navbar-collapse order-lg-0 order-1" id="navContent">
                                <ul class="navbar-nav">
                                    <li class="nav-item"><a href="index.php" class=" nav-link data-menu">Главная</a></li>
                                    <li class="nav-item"><a href="AboutUs.php" class="nav-link data-menu">О компании</a></li>
                                    <li class="nav-item"><a href="news.php" class="nav-link data-menu">Новости</a></li>
                                    <li class="nav-item"><a href="Services.php" class="nav-link data-menu">Услуги</a></li>
                                    <li class="nav-item"><a href="contacts.php" class="nav-link data-menu">Контакты</a></li>
                                </ul>
                            </div>

                            <form action="" class="ml-auto" style="margin-right: 10px;">

                                <?php if ($_SESSION['user']) { ?>
                                    <a class="btn orangeRed_btn btn-circle px-2" href="profile.php">
                                        Личный кабинет
                                    </a>
                                    <!-- type="button"  -->
                                <?php } else { ?>
                                    <button class="btn orangeRed_btn btn-circle px-2" type="button" data-toggle="modal" data-target="#Modal">
                                        Авторизоваться
                                    </button>
                                <?php }; ?>

                            </form>

                            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navContent">
                                <span class="navbar-toggler-icon"></span>
                            </button>
                        </nav>

                    </div>
                </div>
            </div>
        </div>

    </nav>

    <!-- модульное окно -->


    <div class="modal fade" id="Modal">
        <div class="modal-dialog">
            <div class="modal-content">
                <form action="vendor/signin.php" method="POST">
                    <div class="modal-header">
                        <h5 class="modal-title">Авторизация</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="form-row">
                            <div class="col-12 justify-conten-center">
                                <form action="Profile.php" method="get">
                                    <div class="form-group">
                                        <label for="login">Логин:</label>
                                        <input type="text" name="login" class="form-control" id="login" aria-describedby="loginHelp" placeholder="Ваш логин">
                                        <small id="loginHelp"></small>
                                    </div>
                            </div>
                            <div class="col-12 justify-conten-center">
                                <div class="form-group">
                                    <label for="password">Пароль:</label>
                                    <input type="password" name="password" class="form-control" id="password" placeholder="Ваш пароль" aria-describedby="passwordHelp">
                                    <small id="passwordHelp"></small>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer justify-content-between ">
                        <button type="submit" class="btn orangeRed_btn btn-circle px-2">Авторизоваться</button>
                        <p></p>
                        <a href="/Register.php" class="my_link_1 orangeRed">Регистрация аккаунта</a>
                    </div>

                    <?php
                    if ($_SESSION['delSession']) {
                        echo ' <P class="msg text-center orangeRed_text" style="padding:10px; font-size: 20px;">' .
                            $_SESSION['message'] . '</P>';

                        unset($_SESSION['message']);
                        unset($_SESSION['delSession']);
                    };
                    ?>

                </form>


            </div>
        </div>
    </div>


    <main>
        <!--overflow-y:auto; display:table -->
        <div class="main" role="main">
            <div class="container-fluid border-bottom border-warning" style="background-color: #f1f3f7;">
                <div class="container">
                    <div class="row">
                        <div class="col-12 pl-5 pb-2 justify-content-end ">
                            <ul class="breadcrumb justify-content-end my-0 py-0" style="background-color: #f1f3f7;">
                                <li class="breadcrumb-item"><a href="index.php" class="text-muted">Главная</a></li>
                                <li class="breadcrumb-item actve"><a href="profile.php" class="text-muted">Личный кабинет</a></li>
                                <li class="breadcrumb-item actve"><a href="#" class="text-muted">Данные пользователей</a></li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>

            <div class="container-fluid bg-white">
                <div class="container">
                    <div class="row py-5  justify-content-center text-align-center">
                        <div class="col-4 py-5  ">
                            <?php foreach ($userid as $userids) : ?>
                                <img class="rounded-circle  border bareder-warning mx-auto d-block" src="<?= $userids['avatar'] ?>" style="overflow: hidden; width: 200px; height: 200px; object-fit: cover;" alt="Аватар пользователя">
                                <h2 class="text-center"><?= $userids['login'] ?></h2>
                            <?php endforeach; ?>
                        </div>
                    </div>
                </div>
            </div>
            <div class="container-fluid border-top border-warning" style="background-color: #f1f3f7;">
                <div class="container">
                    <div class="row">
                        <div class="col-12 pl-5 pb-2">
                            <b><strong>Данные пользователей</strong></b>
                        </div>
                    </div>
                </div>
            </div>

            <div class="container bg-white">

                <div class="row">
                    <div class="col-12 pt-2">
                        <ul class="nav nav-pills text-center justify-content-between">
                            <li class="nav-item pl-4">
                                <input class="btn px-3 orangeRed_btn btn-circle" type="button" onclick="history.back();" value="Вернуться Назад" />
                            </li>

                            <li class="nav-item">
                                <button type="button" style="border-radius: 35px; color:#FF4500; background-color: #ffffff;" class="nav-link nav-item btn px-3 dropdown-toggle" id="nav-2" data-toggle="dropdown">Панель администратора</button>

                                <div class="dropdown-menu dropdown-menu-right pt-0" aria-labelledby="nav-2">
                                    <h5 class="orangeRed_btn dropdown-header text-center"><b>СПРАВОЧНИКИ САЙТА</b></h5>
                                    <a href="edit_typet.php" type="button" class="btn btn-danger dropdown-item">Услуги компании</a>
                                    <a href="edit_home.php" type="button" class="btn btn-danger dropdown-item">Обслуживаемые дома</a>
                                    <a href="edit_user.php" type="button" class="btn btn-danger dropdown-item">Личные данные пользователей</a>
                                    <a href="edit_personal.php" type="button" class="btn btn-danger dropdown-item">Сотрудники компании</a>

                                    <div class="dropdown-divider"></div>
                                    <h5 class="orangeRed_btn dropdown-header text-center"><b>СЕРВИС САЙТА</b></h5>
                                    <a href="edit_news.php" type="button" class="btn btn-danger dropdown-item">Новостная лента</a>
                                    <a href="edit_electro.php" type="button" class="btn btn-danger dropdown-item">Показания потребителей</a>
                                    <a href="edit_orders.php" type="button" class="btn btn-danger dropdown-item">Выполнение заявок</a>

                                </div>
                            </li>
                        </ul>

                        <div class="tab-content ">
                            <div class="tab-pane fade show active" id="tab2-1" aria-labelledby="nav2-1">

                                <div class="row justify-content-center">

                                    <!-- ПОИСКОВАЯ СИСТЕМА ДЛЯ ТАБЛИЦЫ С КЛАССОМ results -->
                                    <div class="col-sm-4 col-12 mt-3">
                                        <form>
                                            <div class="form-group">
                                                <input ENGINE="text" class="searchKey form-control" placeholder="Поиск данных" />
                                            </div>
                                        </form>
                                    </div>


                                    <!-- КНОПКИ УПРАВЛЕНИЯ -->
                                    <div class="col-12 pb-2 pt-2">
                                        <div class="pr-3 text-center bg-white">
                                            <a class="btns px-3" data-remove="remove" <? if(!id) { ?> style="pointer-events: none";
                                                <? } ?> >
                                                <img src="img/remove.png" alt="delite" width="42" height="42">
                                            </a>

                                            <a class="btns px-3" data-update="update" <? if(!id) { ?> style="pointer-events: none";
                                                <? } ?>>
                                                <img src="img/update.png" alt="update" width="42" height="42">
                                            </a>

                                            <a class="btns px-3" data-add="add" <? if(!id) { ?> style="pointer-events: none";
                                                <? } ?>>
                                                <img src="img/add.png" alt="add" width="42" height="42">
                                            </a>
                                        </div>
                                    </div>

                                    <div class="col-12 table-responsive">

                                        <!-- ТАБЛИЦА -->

                                        <table class="table-striped table-hover results" id="table" style="width: 100%;">
                                            <!-- table-sm-->
                                            <thead class="bg-dark border_tr text-center">
                                                <tr>
                                                    <th>ID</th>
                                                    <th>Логин</th>
                                                    <th>Фамилия</th>
                                                    <th>Имя</th>
                                                    <th>Отчество</th>
                                                    <th>Почта</th>
                                                    <th>Телефон</th>
                                                    <th>Аватар</th>
                                                    <th>Статус</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php foreach ($options as $option) : ?>
                                                    <tr class="tr" id="<?= $option['id'] ?>">
                                                        <!-- обернули в div -> для EI + edit -> стили css -->

                                                        <th class="text-center table-active" style="vertical-align: middle">

                                                            <div class="edit" data-name="id" data-id="<?= $option['id'] ?>"><?= $option['id'] ?></div>

                                                        </th>
                                                        <td class="text-center" style="vertical-align: middle;">
                                                            <!-- ДЛЯ РЕДАКТИРУЕМЫХ ПОЛЕЙ: contenteditable + в data: id -> ID поля этого; name -> имя поля, как в БЛ -->
                                                            <div class="edit" data-id="<?= $option['id'] ?>" data-name="login" contenteditable><?= $option['login'] ?></div>

                                                        </td>
                                                        <td class="text-center" style="vertical-align: middle">

                                                            <div class="edit" data-id="<?= $option['id'] ?>" data-name="surname" contenteditable><?= $option['surname'] ?></div>

                                                        </td>
                                                        <td class="text-center" style="vertical-align: middle">

                                                            <div class="edit" data-id="<?= $option['id'] ?>" data-name="first_name" contenteditable><?= $option['first_name'] ?></div>

                                                        </td>
                                                        <td class="text-center" style="vertical-align: middle">

                                                            <div class="edit" data-id="<?= $option['id'] ?>" data-name="last_name" contenteditable><?= $option['last_name'] ?></div>

                                                        </td>
                                                        <td class="text-center" style="vertical-align: middle">

                                                            <div class="edit" data-id="<?= $option['id'] ?>" data-name="email" contenteditable><?= $option['email'] ?></div>

                                                        </td>
                                                        <td class="text-center" style="vertical-align: middle">

                                                            <div class="edit" data-id="<?= $option['id'] ?>" data-name="telephone" contenteditable><?= $option['telephone'] ?></div>

                                                        </td>
                                                        <td>
                                                            <img class="edit img-fluid responsive image mx-auto d-block img-thumbnail" style=" width: 100% \9; max-height: 100px;" data-id="<?= $option['id'] ?>" data-name="avatar" src="<?= $option['avatar'] ?>" alt="">
                                                            <!-- <div  contenteditable></div> -->
                                                        </td>


                                                        <td class="text-center">
                                                            <form>
                                                                <input type="checkbox" class="chk" data-id="<?= $option['id'] ?>" data-name="status" <? if($option['status']=="1" ){ ?> checked
                                                                <? } ?>>
                                                            </form>
                                                        </td>

                                                    </tr>
                                                <?php endforeach; ?>
                                            </tbody>
                                        </table>

                                        <div id="loader"><span></span></div>
                                        <div id="mes-edit"></div>

                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>

            </div>

        </div>
        </div>
    </main>


    <!-- МОДОЛЬНОЕ ОКНО ИЗМЕНЕНИЯ -->
    <div class="modal fade" id="UpdateTypet">
        <div class="modal-dialog modal-dialog-centered modal-lg">
            <div class="modal-content ">
                <form id="UpForm">
                    <div class="modal-header">
                        <h5 class="modal-title">Создание пользователя</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="container-fluid">

                            <div class="form-row">
                                <div class="col-6" id="output">
                                    <!-- будем очищать содержимое и присваивать новое, такое-же, но с нов.фотографией |ИЛИ| изменять значение атребута src на имя -->
                                    <img name="Up_photo" id="Up_photo" data-name="Up_photo" class="img-fluid responsive image mx-auto d-block img-thumbnail" style=" width: 100% \9; min-height: 300px; max-height: 300px;" height="300px" src="img/User-avatar2.png" alt="Аватарка пользователя">
                                </div>

                                <!-- ДЛЯ ОТОБРАЖЕНИЯ В МУЛЯЖЕ В ФОРМЕ МОДЮОКНА ЕСТЬ "СКРЫТЫЙ IMG СО СВОИМИ СТИЛЯМИ -->
                                <div style="display: none;" class="col-6" id="outputNone">
                                    <!-- будем очищать содержимое и присваивать новое, такое-же, но с нов.фотографией |ИЛИ| изменять значение атребута src на имя -->
                                    <img name="Up_photo2" id="Up_photo2" data-name="Up_photo2" class="edit img-fluid responsive image mx-auto d-block img-thumbnail" style=" width: 100% \9; max-height: 100px;" src="img/User-avatar2.png" alt="Аватарка пользователя">
                                </div>

                                <div class="col-6 justify-content-center">
                                    <div class="row">
                                        <div class="col-12">
                                            <div class="form-group">
                                                <label for="Up_surname"></label>Фамилия:</label>
                                                <input type="text" name="Up_surname" data-name="Up_surname" class="form-control" id="Up_surname" placeholder="Введите фамилию" aria-describedby="Up_surnameHelp" value="">
                                                <small id="Up_surnameHelp"></small>
                                            </div>
                                        </div>
                                        <div class="col-12 justify-content-center">
                                            <div class="form-group">
                                                <label for="Up_first_name"></label>Имя:</label>
                                                <input type="text" name="Up_first_name" data-name="Up_first_name" class="form-control" id="Up_first_name" placeholder="Введите имя" aria-describedby="Up_first_nameHelp" value="">
                                                <small id="Up_first_nameHelp"></small>
                                            </div>
                                        </div>
                                        <div class="col-12 justify-content-center">
                                            <div class="form-group">
                                                <label for="Up_last_name"></label>Отчество:</label>
                                                <input type="text" name="Up_last_name" data-name="Up_last_name" class="form-control" id="Up_last_name" placeholder="Введите отчество" aria-describedby="Up_last_nameHelp" value="">
                                                <small id="Up_last_nameHelp"></small>
                                            </div>
                                        </div>
                                        <div class="col-12">
                                            <div class="form-group">
                                                <label for="Up_login"></label>Логин:</label>
                                                <input type="text" name="Up_login" data-name="Up_login" class="form-control" id="Up_login" placeholder="Введите логин" aria-describedby="Up_loginHelp" value="">
                                                <small id="Up_loginHelp"></small>
                                            </div>
                                        </div>
                                        <div class="col-12">
                                            <div class="form-group">
                                                <label for="Up_Password"></label>Пароль:</label>
                                                <input type="password" name="Up_Password" data-name="Up_Password" class="form-control" id="Up_Password" placeholder="Введите пароль" aria-describedby="Up_PasswordHelp" value="">
                                                <small id="Up_PasswordHelp"></small>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                            </div>
                            <div class="form-row py-1 pr-5">
                                <div class="col-6 ">
                                    <form enctype="multipart/form-data">
                                        <input id="Up_file" class="rounded" data-name="Up_avatar" type="file" name="Up_avatar" value="Выбрать фото">
                                    </form>
                                </div>
                            </div>

                            <div class="form-row justify-content-center">
                                <div class="col-6">
                                    <div class="form-group">
                                        <label for="Up_email"></label>Почта:</label>
                                        <input type="text" name="email" data-name="Up_email" class="form-control" id="Up_email" placeholder="Введите почту" aria-describedby="Up_emailHelp" value="">
                                        <small id="Up_emailHelp"></small>
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="form-group">
                                        <label for="Up_telephone"></label>Телефон:</label>
                                        <input type="text" name="Up_telephone" data-name="Up_telephone" class="form-control" id="Up_telephone" placeholder="Введите телефон" aria-describedby="Up_telephoneHelp" value="">
                                        <small id="Up_telephoneHelp"></small>
                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="form-group">
                                        <label for="Up_status">Статус администратора:</label>
                                        <input type="checkbox" id="Up_status" name="Up_status" data-id="<?= $_POST['id'] ?>" data-name="Up_status" checked="">
                                        <small id="Up_passwordHelp"></small>
                                    </div>
                                </div>
                            </div>
                            <div class="text-center">
                                <small id="Up_message"></small>
                            </div>

                        </div>
                    </div>
                    <div class="modal-footer justify-content-center">
                        <button type="button" id="subUpForm" class="btn orangeRed_btn">Изменить</button>
                    </div>
                </form>
            </div>
        </div>
    </div>




    <!-- МОДОЛЬНОЕ ОКНО ДОБАВЛЕНИЯ -->
    <div class="modal fade" id="AddModal">
        <div class="modal-dialog modal-dialog-centered modal-lg">
            <div class="modal-content ">
                <form id="AddForm">
                    <div class="modal-header">
                        <h5 class="modal-title">Создание пользователя</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="container-fluid">

                            <div class="form-row">
                                <div class="col-6" id="output">
                                    <!-- будем очищать содержимое и присваивать новое, такое-же, но с нов.фотографией |ИЛИ| изменять значение атребута src на имя -->
                                    <img name="photo" id="Add_photo" data-name="photo" class="img-fluid responsive image mx-auto d-block img-thumbnail" style=" width: 100% \9; min-height: 300px; max-height: 300px;" height="300px" src="img/User-avatar2.png" alt="Аватарка пользователя">
                                </div>

                                <!-- ДЛЯ ОТОБРАЖЕНИЯ В МУЛЯЖЕ В ФОРМЕ МОДЮОКНА ЕСТЬ "СКРЫТЫЙ IMG СО СВОИМИ СТИЛЯМИ -->
                                <div style="display: none;" class="col-6" id="outputNone">
                                    <!-- будем очищать содержимое и присваивать новое, такое-же, но с нов.фотографией |ИЛИ| изменять значение атребута src на имя -->
                                    <img name="photo2" id="Add_photo2" data-name="photo2" class="edit img-fluid responsive image mx-auto d-block img-thumbnail" style=" width: 100% \9; max-height: 100px;" src="img/User-avatar2.png" alt="Аватарка пользователя">
                                </div>

                                <div class="col-6 justify-content-center">
                                    <div class="row">
                                        <div class="col-12">
                                            <div class="form-group">
                                                <label for="surname"></label>Фамилия:</label>
                                                <input type="text" name="surname" data-name="surname" class="form-control" id="Add_surname" placeholder="Введите фамилию" aria-describedby="surnameHelp" value="">
                                                <small id="surnameHelp"></small>
                                            </div>
                                        </div>
                                        <div class="col-12 justify-content-center">
                                            <div class="form-group">
                                                <label for="first_name"></label>Имя:</label>
                                                <input type="text" name="first_name" data-name="first_name" class="form-control" id="Add_first_name" placeholder="Введите имя" aria-describedby="first_nameHelp" value="">
                                                <small id="first_nameHelp"></small>
                                            </div>
                                        </div>
                                        <div class="col-12 justify-content-center">
                                            <div class="form-group">
                                                <label for="last_name"></label>Отчество:</label>
                                                <input type="text" name="last_name" data-name="last_name" class="form-control" id="Add_last_name" placeholder="Введите отчество" aria-describedby="last_nameHelp" value="">
                                                <small id="last_nameHelp"></small>
                                            </div>
                                        </div>
                                        <div class="col-12">
                                            <div class="form-group">
                                                <label for="login"></label>Логин:</label>
                                                <input type="text" name="login" data-name="login" class="form-control" id="Add_login" placeholder="Введите логин" aria-describedby="loginHelp" value="">
                                                <small id="loginHelp"></small>
                                            </div>
                                        </div>
                                        <div class="col-12">
                                            <div class="form-group">
                                                <label for="Password"></label>Пароль:</label>
                                                <input type="password" name="Password" data-name="Password" class="form-control" id="Add_Password" placeholder="Введите пароль" aria-describedby="PasswordHelp" value="">
                                                <small id="PasswordHelp"></small>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                            </div>
                            <div class="form-row py-1 pr-5">
                                <div class="col-6 ">
                                    <form enctype="multipart/form-data">
                                        <input id="Add_file" class="rounded" data-name="avatar" type="file" name="Add_avatar" value="Выбрать фото">
                                    </form>
                                </div>
                            </div>

                            <div class="form-row justify-content-center">
                                <div class="col-6">
                                    <div class="form-group">
                                        <label for="email"></label>Почта:</label>
                                        <input type="text" name="email" data-name="email" class="form-control" id="Add_email" placeholder="Введите почту" aria-describedby="emailHelp" value="">
                                        <small id="emailHelp"></small>
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="form-group">
                                        <label for="telephone"></label>Телефон:</label>
                                        <input type="text" name="telephone" data-name="telephone" class="form-control" id="Add_telephone" placeholder="Введите телефон" aria-describedby="telephoneHelp" value="">
                                        <small id="telephoneHelp"></small>
                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="form-group">
                                        <label for="status">Статус администратора:</label>
                                        <input type="checkbox" id="Add_status" name="status" data-id="<?= $_POST['id'] ?>" data-name="status" checked="">
                                        <small id="passwordHelp"></small>
                                    </div>
                                </div>
                            </div>

                            <div class="text-center">
                                <small id="messageIn"></small>
                            </div>

                        </div>
                    </div>
                    <div class="modal-footer justify-content-center">
                        <button type="button" id="subAddForm" class="btn orangeRed_btn">Добавить пользователя</button>
                    </div>
                </form>
            </div>
        </div>
    </div>



    <?php
    Add_Footer();

    ?>

    <script src='https://kit.fontawesome.com/09738bb7f2.js' crossorigin='anonymous'></script>
    <script src='http://code.jquery.com/jquery-latest.js'></script>
    <script src='https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.3/umd/popper.min.js' integrity='sha384-vFJXuSJphROIrBnz7yo7oB41mKfc8JzQZiCq4NCceLEaO4IHwicKwpJf9c9IpFgh' crossorigin='anonymous'></script>
    <script src='https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.2/js/bootstrap.min.js' integrity='sha384-alpBpkh1PFOepccYVYDB4do5UnbKysX5WZXm3XxPqe5iKTfUKjNkCk9SaVuEZflJ' crossorigin='anonymous'></script>
    <script src='js/user.js'></script>
    <!-- <script src='js/main.js'></script> -->
</body>

</html>