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

    if (Update_option_news($table)) {
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
            "img" => $options[$_POST["id"]]["img"],
            "header" => $options[$_POST["id"]]["header"],
            "text" => $options[$_POST["id"]]["text"],
            "content" => $options[$_POST["id"]]["content"],
            "period" => $options[$_POST["id"]]["period"],
            "status" => $options[$_POST["id"]]["status"],

            "id_employee" => $options[$_POST["id"]]["id_employee"]

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
    //    $FILE =   $_FILES['image']['name'];
    //    $path = 'uploads/' . time() . $_FILES['image']['name'];

    $table = $_POST['table'];

    if (Add_option_news($table)) {
        exit("Настрока сохранена");
    } else {
        exit("Ошибка сохраненения");
    }
}


// ПОЛУЧЕНИЕ МАССИВА СТРОК ТАБЛИЦЫ SELECT ЗАПРОСА
$table = "personal";
$personal =  get_options($table);
// $table = "personal";
// $options = get_options($table);
$options = get_options_news();




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

    <title>Новостная лента</title>

    <link rel='stylesheet' href='https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css' integrity='sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm' crossorigin='anonymous'>

    <link rel='stylesheet' href='css/main.css'>

    <link href='https://fonts.googleapis.com/css2?family=Montserrat:wght@200;400;600&family=Open+Sans:wght@400;700&display=swap' rel='stylesheet'>

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
        <div class="main" role="main">

            <div class="container-fluid border-bottom border-warning" style="background-color: #f1f3f7;">
                <div class="container">
                    <div class="row">
                        <div class="col-12 pl-5 pb-2 justify-content-end ">
                            <ul class="breadcrumb justify-content-end my-0 py-0" style="background-color: #f1f3f7;">
                                <li class="breadcrumb-item"><a href="index.php" class="text-muted">Главная</a></li>
                                <li class="breadcrumb-item actve"><a href="profile.php" class="text-muted">Личный кабинет</a></li>
                                <li class="breadcrumb-item actve"><a href="#" class="text-muted">Новостная лента</a></li>
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
                            <b><strong>Новостная лента</strong></b>
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

                        <div class="tab-content">
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
                                            <thead class="bg-dark border_tr text-center">
                                                <tr>
                                                    <th>ID</th>
                                                    <th>Заголовок</th>
                                                    <th>Описание</th>
                                                    <th>Контент</th>
                                                    <th>Изображение</th>
                                                    <th>Автор</th>
                                                    <th>Отображение в ленте</th>
                                                    <th>Дата публикации</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php foreach ($options as $option) : ?>
                                                    <tr class="tr" id="<?= $option['id'] ?>">
                                                        <!-- обернули в div -> для EI + edit -> стили css -->

                                                        <th class="text-center table-active" style="vertical-align: middle">
                                                            <div class="edit" data-name="id" data-id="<?= $option['id'] ?>"><?= $option['id'] ?></div>
                                                        </th>
                                                        <td>
                                                            <div class="edit clip scroll-box" data-id="<?= $option['id'] ?>" data-name="header" contenteditable><?= $option['header'] ?></div>
                                                        </td>
                                                        <td>
                                                            <div class="edit clip scroll-box" data-id="<?= $option['id'] ?>" data-name="text" contenteditable width><?= $option['text'] ?></div>
                                                        </td>
                                                        <td>
                                                            <div class="edit clip scroll-box" data-id="<?= $option['id'] ?>" data-name="content" contenteditable><?= $option['content'] ?></div>
                                                        </td>
                                                        <td>
                                                            <img data-id="<?= $option['id'] ?>" data-name="img" src="<?= $option['img'] ?>" alt="" contenteditable class="edit img-fluid responsive image mx-auto d-block img-thumbnail" style=" width: 100% \9; max-height: 150px;">
                                                        </td>
                                                        <!-- ТУТ data-id ПРЕДСТАВЛЯЕТ ID  -->
                                                        <td>
                                                            <div class="edit" data-id="<?= $option['id'] ?>" data-name="surname"><?= $option['surname'] ?></div>
                                                        </td>
                                                        <td class="text-center">
                                                            <form>
                                                                <input type="checkbox" class="chk" data-id="<?= $option['id'] ?>" data-name="status" <? if($option['status']=="1" ){ ?> checked
                                                                <? } ?>>
                                                            </form>
                                                        </td>
                                                        <td class="text-center">
                                                            <form>
                                                                <input type="date" class="date" data-id="<?= $option['id'] ?>" data-name="period" value="<?= $option['period'] ?>">
                                                            </form>
                                                        </td>


                                                    </tr>
                                                <?php endforeach; ?>
                                            </tbody>
                                            <tfoot>
                                                <tr>
                                                    <!-- Здесь появится блок ссылок постраничной навигации //-->
                                                    <td colspan="3"></td>
                                                </tr>
                                            </tfoot>
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
    <div class="modal fade" id="ModalTypet">
        <div class="modal-dialog modal-dialog-centered modal-lg">
            <div class="modal-content">
                <form id="UpForm">
                    <div class="modal-header">
                        <h5 class="modal-title">Изменение новости</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="container-fluid">

                            <div class="form-row">
                                <div class="col-12">
                                    <div class="form-group">
                                        <label for="surname"></label>Заголовок:</label>
                                        <input type="text" id="Up_header" data-name="Up_header" name="Up_header" required class="form-control" value="">
                                        <small id="surnameHelp"></small>
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="form-group">
                                        <label for="surname"></label>Описание:</label>
                                        <textarea class="scroll-box" id="Up_text" data-name="Up_text" name="Up_text" rows="5" required style="width:100%; resize: none"></textarea>
                                        <small id="surnameHelp"></small>
                                    </div>
                                </div>
                                <div class="col-6" id="output">
                                    <!-- будем очищать содержимое и присваивать новое, такое-же, но с нов.фотографией |ИЛИ| изменять значение атребута src на имя -->
                                    <img name="Up_photo" id="Up_photo" data-name="Up_photo" class="img-fluid responsive image mx-auto d-block img-thumbnail" style=" width: 100% \9; min-height: 100px; max-height: 170px;" height="300px" src="img/News.png" alt="Фото статьи">
                                </div>
                                <!-- ДЛЯ ОТОБРАЖЕНИЯ В МУЛЯЖЕ В ФОРМЕ МОДЮОКНА ЕСТЬ "СКРЫТЫЙ IMG СО СВОИМИ СТИЛЯМИ -->
                                <div style="display: none;" class="col-6" id="outputNone">
                                    <!-- будем очищать содержимое и присваивать новое, такое-же, но с нов.фотографией |ИЛИ| изменять значение атребута src на имя -->
                                    <img name="Up_photo2" id="Up_photo2" data-name="Up_photo2" class="edit img-fluid responsive image mx-auto d-block img-thumbnail" style=" width: 100% \9; max-height: 100px;" src="img/News.png" alt="Фото статьи">
                                </div>
                                <div class="col-12">
                                    <div class="form-group">
                                        <label for="Up_content"></label>Статья:</label>
                                        <textarea id="Up_content" data-name="Up_content" name="Up_content" rows="15" required style="width:100%; resize: none"></textarea>
                                    </div>
                                </div>
                            </div>


                            <div class="form-row py-1 pr-5">
                                <div class="col-6">
                                    <div class="form-group">
                                        <label for="Up_date"></label>Дата публикации:</label>
                                        <input type="date" id="Up_date" data-name="Up_date" name="Up_date" required data-id="" data-name="period" value="">
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="form-group">
                                        <select id="Up_surname" data-name="Up_surname" name="Up_surname" required style="width: 100%;">
                                            <optgroup label="Сотрудники">
                                                <?php foreach ($personal as $personals) : ?>
                                                    <option value="<?= $personals['id'] ?>"><?= $personals['surname'] ?></option>
                                                <?php endforeach; ?>
                                            </optgroup>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="form-row py-1 pr-5">
                                <div class="col-8">
                                    <form enctype="multipart/form-data">
                                        <label for="Up_file"></label>Изображение:</label>
                                        <input id="Up_file" data-name="Up_file" name="Up_file" class="rounded" type="file" value="Выбрать фото">
                                    </form>
                                </div>
                                <div class="col-4 ">
                                    <label for="status">Отображение в ленте</label>
                                    <input type="checkbox" id="Up_status" data-name="Up_status" name="Up_status" data-id="" checked="">
                                    <small id="passwordHelp"></small>
                                </div>
                            </div>
                            <div class="text-center">
                                <small id="Up_message"></small>
                            </div>

                        </div>
                    </div>
                    <div class="modal-footer justify-content-center">
                        <button type="button" id="subUpForm" class="btn orangeRed_btn">Изменить статью</button>
                    </div>
                </form>
            </div>
        </div>
    </div>




    <!-- МОДОЛЬНОЕ ОКНО ДОБАВЛЕНИЯ -->
    <div class="modal fade" id="AddModal">
        <div class="modal-dialog modal-dialog-centered modal-lg">
            <div class="modal-content">
                <form id="AddForm">
                    <div class="modal-header">
                        <h5 class="modal-title">Написание новой новости</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="container-fluid">

                            <div class="form-row">
                                <div class="col-12">
                                    <div class="form-group">
                                        <label for="surname"></label>Заголовок:</label>
                                        <input type="text" id="Add_header" data-name="Add_header" name="Add_header" required class="form-control" value="">
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="form-group">
                                        <label for="surname"></label>Описание:</label>
                                        <textarea id="Add_text" data-name="Add_text" name="Add_text" rows="5" required style="width:100%; resize: none"></textarea>
                                    </div>
                                </div>
                                <div class="col-6" id="output">
                                    <!-- будем очищать содержимое и присваивать новое, такое-же, но с нов.фотографией |ИЛИ| изменять значение атребута src на имя -->
                                    <img name="Add_photo" id="Add_photo" data-name="Add_photo" class="img-fluid responsive image mx-auto d-block img-thumbnail" style=" width: 100% \9; min-height: 100px; max-height: 170px;" height="300px" src="img/News.png" alt="Фото статьи">
                                </div>
                                <!-- ДЛЯ ОТОБРАЖЕНИЯ В МУЛЯЖЕ В ФОРМЕ МОДЮОКНА ЕСТЬ "СКРЫТЫЙ IMG СО СВОИМИ СТИЛЯМИ -->
                                <div style="display: none;" class="col-6" id="outputNone">
                                    <!-- будем очищать содержимое и присваивать новое, такое-же, но с нов.фотографией |ИЛИ| изменять значение атребута src на имя -->
                                    <img name="Add_photo2" id="Add_photo2" data-name="Add_photo2" class="edit img-fluid responsive image mx-auto d-block img-thumbnail" style=" width: 100% \9; max-height: 100px;" src="img/News.png" alt="Фото статьи">
                                </div>
                                <div class="col-12">
                                    <div class="form-group">
                                        <label for="Up_content"></label>Статья:</label>
                                        <textarea id="Add_content" data-name="Add_content" name="Add_content" rows="15" required style="width:100%; resize: none"></textarea>
                                    </div>
                                </div>
                            </div>


                            <div class="form-row py-1 pr-5">
                                <div class="col-6">
                                    <div class="form-group">
                                        <label for="Up_date"></label>Дата публикации:</label>
                                        <input type="date" id="Add_date" data-name="Add_date" name="Add_date" data-id="" required data-name="period" value="">
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="form-group">
                                        <select id="Add_surname" data-name="Add_surname" name="Add_surname" required style="width: 100%;">
                                            <optgroup label="Сотрудники">
                                                <?php foreach ($personal as $personals) : ?>
                                                    <option value="<?= $personals['id'] ?>"><?= $personals['id'] ?> | <?= $personals['surname'] ?></option>
                                                <?php endforeach; ?>
                                            </optgroup>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="form-row py-1 pr-5">
                                <div class="col-8">
                                    <form enctype="multipart/form-data">
                                        <label for="Add_file"></label>Изображение:</label>
                                        <input id="Add_file" data-name="Add_file" name="Add_file" class="rounded" type="file" value="Выбрать фото">
                                    </form>
                                </div>
                                <div class="col-4 ">
                                    <label for="status">Отображение в ленте</label>
                                    <input type="checkbox" id="Add_status" data-name="Add_status" name="Add_status" data-id="" checked="">
                                    <small id="passwordHelp"></small>
                                </div>
                            </div>
                            <div class="text-center">
                                <small id="Up_message"></small>
                            </div>

                        </div>
                    </div>
                    <div class="modal-footer justify-content-center">
                        <button type="button" id="subAddForm" class="btn orangeRed_btn">Добавить статью</button>
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

    <script src='js/news.js'></script>
</body>

</html>