<?php
session_start();
/*подключение библиотек*/
require_once "vendor/connect.php";
require_once "Lib_db.php";

//Система защиты от не зарегистрированных
if (!($_SESSION['user'])) {
    header('Location:../index.php');
}



$id_user = $_SESSION['user']['id'];
//ФУНКЦИЯ ВЫДАЕТ ДОМА ПОЛЬЗОВАТЕЛЯ ПО ЕГО ID
$home = get_home_user($id_user);
//ФУНКЦИЯ ВЫДАЕТ ДАННЫЕ ПОЛЬЗОВАТЕЛЯ НУЖНОГО
$user = get_user($id_user);
//ФУНКЦИЯ ВЫДАЕТ УСЛУГИ
$table = "typet";
$typet = get_options($table);



//ВНЕСЕНИЕ ПОКАЗАНИЙ
if (isset($_POST['Т1'])) {

    if ($res = send_user_electro()) {
        exit("Настрока сохранена");
    } else {
        exit("Ошибка сохраненения");
    }
}

//ЗАКАЗ УСЛУГ
if (isset($_POST['User_typet'])) {

    if ($res = send_user_orders()) {
        exit("Настрока сохранена ");
    } else {
        exit("Ошибка сохраненения");
    }
}

// ПОЛУЧЕНИЕ ID ДОМА ( TO-DO единсвенный)
foreach ($home as $homes) :
    $_id_home = $homes['id'];
endforeach;

// ПОЛУЧЕНИЕ ИСТОРИИ ЗАКАЗОВ
$options = get_user_orders($_id_home);
// ПОЛУЧЕНИЕ ИСТОРИИ ПОКАЗАНИЙ
$electros = get_user_electro($_id_home);


//ПОЛУЧЕНИЕ ДАННЫХ О КЛИЕНТЕ
if (isset($_POST['Up_user'])) {

    if ($res = Update_user()) {
        exit("Настрока сохранена");
    } else {
        exit("Ошибка сохраненения");
    }
}
if (isset($_FILES['avaProfile'])) {

    if ($res = ava($id_user)) {
        exit($res);
    } else {
        exit("Ошибка сохраненения");
    }
}

?>
<!-- склеиваем страницы (+имя этой страницы) -->



<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset='UTF-8'>
    <meta name='viewport' content='width=device-width, initial-scale=1.0'>
    <meta name='viewport' content='width=device-width, initial-scale=1, shrink-to-fit=no'>

    <title>Личный кабинет</title>

    <link rel='stylesheet' href='https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css' integrity='sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm' crossorigin='anonymous'>
    <link rel='stylesheet' href='css/main.css'>

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
    <nav class="sticky-top px-0 py-0 my-0 mx-0">
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
                                        <label for="login">Логин</label>
                                        <input type="text" name="login" class="form-control" id="login" aria-describedby="loginHelp" placeholder="Ваш логин">
                                        <small id="loginHelp"></small>
                                    </div>
                            </div>
                            <div class="col-12 justify-conten-center">
                                <div class="form-group">
                                    <label for="password">пароль</label>
                                    <input type="password" name="password" class="form-control" id="password" placeholder="Пароль" aria-describedby="passwordHelp">
                                    <small id="passwordHelp"></small>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer justify-content-between ">
                        <button type="submit" class="btn orangeRed_btn btn-circle px-2">Авторизироваться</button>
                        <p></p>
                        <a href="/Register.php" class="my_link_1 orangeRed">Регестрация аккаунта</a>
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

    <!-- Защита: пропуск, если в сессии-массиве-user его элемент=admin, иначе вы user -->
    <?php if ($_SESSION['user']['status'] == 1) { ?>

        <main>
            <div class="main" role="main">

                <div class="container-fluid border-bottom border-warning" style="background-color: #f1f3f7;">
                    <div class="container">
                        <div class="row">
                            <div class="col-12 pl-5 pb-2 justify-content-end ">
                                <ul class="breadcrumb justify-content-end my-0 py-0" style="background-color: #f1f3f7;">
                                    <li class="breadcrumb-item"><a href="index.php" class="text-muted">Главная</a></li>
                                    <li class="breadcrumb-item actve"><a href="profile.php" class="text-muted">Личный кабинет</a></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="container-fluid bg-white">
                    <div class="container">
                        <div class="row py-5  justify-content-center align-content-center text-align-center">
                            <div class="col-md-4 py-5  ">
                                <?php foreach ($user as $users) : ?>
                                    <img class="rounded-circle imgProfile  border bareder-warning mx-auto d-block" src="<?= $users['avatar'] ?>" style="overflow: hidden; width: 200px; height: 200px; object-fit: cover;" alt="Аватар пользователя">
                                    <h2 class="text-center"><?= $users['login'] ?></h2>
                                <?php endforeach; ?>
                                <small class=" text-center editAva d-none ">
                                    изменить аватар
                                </small>

                                <input type="file" class="changeAva d-none" name="changeAva" id="changeAva">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="container-fluid border-top border-warning" style="background-color: #f1f3f7;">
                    <div class="container">
                        <div class="row">
                            <div class="col-12 pl-5 pb-2">
                                <b><strong>Личный кабинет</strong></b>
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
                                    <div class="row">
                                        <div class="col-12">
                                            <?php foreach ($user as $users) : ?>
                                                <form id="myForm" class="myForm ml-3">

                                                    <fieldset class="my-4 py-2">
                                                        <legend>Личные данные:</legend>
                                                        <div class="form-group form-row d-none">
                                                            <input type="text" class="form-control col-md-4 col-12 inputId" readonly id="Up_ID" value="<?= $_SESSION['user']['id'] ?>">
                                                        </div>
                                                        <div class="form-group form-row">
                                                            <label class="col-3" for="exampleInputEmail1">Фамилия:</label>
                                                            <input type="text" class="form-control col-md-4 col-12 inputId" readonly id="Up_surname" value="<?= $users['surname'] ?>">
                                                        </div>
                                                        <div class="form-group form-row">
                                                            <label class="col-3" for="exampleInputEmail1">Имя:</label>
                                                            <input type="text" class="form-control col-md-4 col-12 inputId" readonly id="Up_first_name" value="<?= $users['first_name'] ?>">
                                                        </div>
                                                        <div class="form-group form-row">
                                                            <label class="col-3" for="exampleInputEmail1">Отчество:</label>
                                                            <input type="text" class="form-control col-md-4 col-12 inputId" readonly id="Up_last_name" value="<?= $users['last_name'] ?>">
                                                        </div>
                                                    </fieldset>
                                                    <fieldset class="py-3">
                                                        <legend>Контактная информация:</legend>
                                                        <div class="form-group form-row">
                                                            <label class="col-3" for="exampleInputEmail1">Email:</label>
                                                            <input type="email" class="form-control col-md-4 col-12 inputId" readonly id="Up_email" value="<?= $users['email'] ?>">
                                                        </div>
                                                        <div class="form-group form-row">
                                                            <label class="col-3" for="exampleInputEmail1">Телефон:</label>
                                                            <input type="tel" class="form-control col-md-4 col-12 inputId" readonly id="Up_telephone" value="<?= $users['telephone'] ?>">
                                                        </div>
                                                    </fieldset>
                                                    <div class="form-row justify-content-between ">
                                                        <div class="col-9 ">
                                                            <div class="form-group">
                                                                <button type="button" class="btn orangeRed_btn btn-circle px-2" id="editBtn">Редактировать</button>
                                                                <input type="button" class="btn orangeRed_btn btn-circle px-2  d-none" value="Сохронить" id="saveBtn">
                                                            </div>
                                                        </div>
                                                        <div class="col-3">
                                                            <a class="my_link_1" href="vendor/logout.php">Покинуть профиль</a>
                                                        </div>
                                                    </div>
                                                </form>
                                            <?php endforeach; ?>

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

    <?php } else {
    ?>

        <main>
            <div class="main" role="main">


                <div class="container-fluid border-bottom border-warning" style="background-color: #f1f3f7;">
                    <div class="container">
                        <div class="row">
                            <div class="col-12 pl-5 pb-2 justify-content-end ">
                                <ul class="breadcrumb justify-content-end my-0 py-0" style="background-color: #f1f3f7;">
                                    <li class="breadcrumb-item"><a href="index.php" class="text-muted">Главная</a></li>
                                    <li class="breadcrumb-item actve"><a href="profile.php" class="text-muted">Личный кабинет</a></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="container-fluid bg-white">
                    <div class="container">
                        <div class="row py-5  justify-content-center text-align-center">
                            <div class="col-4 py-5  ">
                                <?php foreach ($user as $users) : ?>
                                    <img class="rounded-circle imgProfile  border bareder-warning mx-auto d-block" src="<?= $users['avatar'] ?>" style="overflow: hidden; width: 200px; height: 200px; object-fit: cover;" alt="Аватар пользователя">
                                    <h2 class="text-center"><?= $users['login'] ?></h2>
                                <?php endforeach; ?>
                                <small class=" text-center editAva d-none ">
                                    изменить аватар
                                </small>

                                <input type="file" class="changeAva d-none" name="changeAva" id="changeAva">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="container-fluid border-top border-warning" style="background-color: #f1f3f7;">
                    <div class="container">
                        <div class="row">
                            <div class="col-12 pl-5 pb-2">
                                <b><strong>Личный кабинет</strong></b>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="container bg-white">


                    <div class="row">
                        <div class="col-12 py-2 ">
                            <ul class="nav nav-pills text-center justify-content-between">
                                <li class="nav-item col-3">
                                    <a class="nav-link nav-item active" id="nav-1" data-toggle="tab" aria-controls="tab-1" href="#tab-1">Профиль</a>
                                </li>

                                <li class="nav-item col-3">
                                    <a class="nav-link nav-item" id="nav-2" data-toggle="tab" aria-controls="tab-2" href="#tab-2">Платежи</a>
                                </li>


                                <li class="nav-item col-3">
                                    <a class="nav-link nav-item" id="nav-3" data-toggle="tab" aria-controls="tab-3" href="#tab-3">Услуги</a>
                                </li>


                                <li class="nav-item col-3">
                                    <a class="nav-link nav-item" id="nav-4" data-toggle="tab" aria-controls="tab-4" href="#tab-4">Показания</a>
                                </li>

                            </ul>
                            <!-- --------------------------------КОНТЕНТ СТРАНИЦ ПОЛЬЗОВАТЕЛЯ-------------------------------- -->
                            <!-- --------------------------------ДАННЫЕ АККАУНТА-------------------------------- -->
                            <div class="tab-content ">
                                <div class="tab-pane fade show active" id="tab-1" aria-labelledby="nav-1">
                                    <div class="row">
                                        <div class="col-12">
                                            <?php foreach ($user as $users) : ?>
                                                <form id="myForm" class="myForm ml-3">

                                                    <fieldset class="my-4 py-2">
                                                        <legend>Личные данные:</legend>
                                                        <div class="form-group form-row d-none">
                                                            <input type="text" class="form-control col-md-4 col-12  inputId" readonly id="Up_ID" value="<?= $_SESSION['user']['id'] ?>">
                                                        </div>
                                                        <div class="form-group form-row">
                                                            <label class="col-md-3 col-12" for="exampleInputEmail1">Фамилия:</label>
                                                            <input type="text" class="form-control col-md-4 col-12  inputId" readonly id="Up_surname" value="<?= $users['surname'] ?>">
                                                        </div>
                                                        <div class="form-group form-row">
                                                            <label class="col-md-3 col-12" for="exampleInputEmail1">Имя:</label>
                                                            <input type="text" class="form-control col-md-4 col-12  inputId" readonly id="Up_first_name" value="<?= $users['first_name'] ?>">
                                                        </div>
                                                        <div class="form-group form-row">
                                                            <label class="col-md-3 col-12" for="exampleInputEmail1">Отчество:</label>
                                                            <input type="text" class="form-control col-md-4 col-12  inputId" readonly id="Up_last_name" value="<?= $users['last_name'] ?>">
                                                        </div>
                                                    </fieldset>
                                                    <fieldset class="py-3">
                                                        <legend>Контактная информация:</legend>
                                                        <div class="form-group form-row">
                                                            <label class="col-md-3 col-12" for="exampleInputEmail1">Email:</label>
                                                            <input type="email" class="form-control col-md-4 col-12  inputId" readonly id="Up_email" value="<?= $users['email'] ?>">
                                                        </div>
                                                        <div class="form-group form-row">
                                                            <label class="col-md-3 col-12" for="exampleInputEmail1">Телефон:</label>
                                                            <input type="tel" class="form-control col-md-4 col-12 inputId" readonly id="Up_telephone" value="<?= $users['telephone'] ?>">
                                                        </div>

                                                        <legend>Собственность:</legend>
                                                        <div class="col-md-7 col-12 form-group">
                                                            <select id="User_home" class="form-control" data-name="User_home" name="User_home" required style="width: 100%;">
                                                                <optgroup label="Лицевые счета и собственность">
                                                                    <?php foreach ($home as $homes) : ?>
                                                                        <option value="<?= $homes['id'] ?>"><?= $homes['id'] ?> | <?= " Район: " . $homes['section'] . ", Ул.: " . $homes['street'] . ", Д.: " . $homes['house'] . ", Кв.: " . $homes['flat'] ?></option>
                                                                    <?php endforeach; ?>
                                                                </optgroup>
                                                            </select>
                                                        </div>
                                                    </fieldset>
                                                    <div class="form-row justify-content-between ">
                                                        <div class="col-9">
                                                            <div class="form-group">
                                                                <button type="button" class="btn orangeRed_btn btn-circle px-2 " id="editBtn">Редактировать</button>
                                                                <input type="button" class="btn orangeRed_btn btn-circle px-2 d-none" value="Сохронить" id="saveBtn">
                                                            </div>
                                                        </div>
                                                        <div class="col-3">
                                                            <a class="my_link_1" href="vendor/logout.php">Покинуть профиль</a>
                                                        </div>
                                                    </div>
                                                </form>
                                            <?php endforeach; ?>

                                            <div id="loader"><span></span></div>
                                            <div id="mes-edit"></div>
                                        </div>
                                    </div>
                                </div>
                                <!-- ---------------------------------------ДАННЫЕ ПО ИСТОРИИ ПЛАТЕЖЕЙ ПОЛЬЗОВАТЕЛЯ------------------------------------ -->
                                <div class="tab-pane fade" id="tab-2" aria-labelledby="nav-2">
                                    <div class="row justify-content-center">

                                        <div id="loader"><span></span></div>
                                        <div id="mes-edit"></div>



                                        <div class="col-12 py-3 my-3">
                                            <nav class="nav nav-pills justify-content-lg-between justify-content-center text-center">

                                                <a class="col-lg-5 col-8  nav-item nav-link active rounded-0" id="nav1-1" data-toggle="tab" aria-controls="tab1-1" href="#tab1-1" style="transform: skewX(-10deg);">
                                                    История платежей по заказам
                                                </a>

                                                <a class="col-lg-5 col-8 nav-item nav-link rounded-0" id="nav1-2" data-toggle="tab" aria-controls="tab1-2" href="#tab1-2" style="transform: skewX(-10deg);">
                                                    История внесенных показаний
                                                </a>


                                            </nav>


                                            <div class="tab-content pt-5 ">
                                                <div class="col-12">
                                                    <form>
                                                        <div class="form-group">
                                                            <input ENGINE="text" class="searchKey form-control" placeholder="Поиск данных" />
                                                        </div>
                                                    </form>
                                                </div>
                                                <div class="tab-pane fade show active" id="tab1-1" aria-labelledby="nav1-1">


                                                    <div class="row justify-content-center">



                                                        <div class="col-12 table-responsive">

                                                            <table class="table-striped table-hover results" id="table" style="width: 100%;">
                                                                <thead class="bg-dark border_tr text-center">
                                                                    <tr>
                                                                        <th>ID</th>
                                                                        <th>Услуга</th>
                                                                        <th>Телефон</th>
                                                                        <th>Район</th>
                                                                        <th>Улица</th>
                                                                        <th>Дом</th>
                                                                        <th>Квартира</th>
                                                                        <th>Дата внесения</th>
                                                                        <th>Дата исплнения</th>
                                                                    </tr>
                                                                </thead>
                                                                <tbody>
                                                                    <?php foreach ($options as $option) : ?>
                                                                        <tr class="tr" id="<?= $option['id'] ?>">
                                                                            <!-- обернули в div -> для EI + edit -> стили css -->

                                                                            <td class="text-center">
                                                                                <div class="edit" data-name="id" data-id="<?= $option['id'] ?>"><?= $option['id'] ?></div>
                                                                            </td>
                                                                            <td>
                                                                                <div class="edit" data-id="<?= $option['id'] ?>" data-name="type"><?= $option['type'] ?></div>
                                                                            </td>
                                                                            <td>
                                                                                <div class="edit" data-id="<?= $option['id'] ?>" data-name="phone"><?= $option['phone'] ?></div>
                                                                            </td>
                                                                            <td>
                                                                                <div class="edit" data-id="<?= $option['id'] ?>" data-name="section"><?= $option['section'] ?></div>
                                                                            </td>
                                                                            <td>
                                                                                <div class="edit" data-id="<?= $option['id'] ?>" data-name="street"><?= $option['street'] ?></div>
                                                                            </td>
                                                                            <td>
                                                                                <div class="edit" data-id="<?= $option['id'] ?>" data-name="house"><?= $option['house'] ?></div>
                                                                            </td>
                                                                            <td>
                                                                                <div class="edit" data-id="<?= $option['id'] ?>" data-name="flat"><?= $option['flat'] ?></div>
                                                                            </td>
                                                                            <td class="text-center">
                                                                                <form>
                                                                                    <input type="date" class="date" data-id="<?= $option['id'] ?>" data-name="date" value="<?= $option['date'] ?>">
                                                                                </form>
                                                                            </td>
                                                                            <td class="text-center">
                                                                                <form>
                                                                                    <input type="date" class="date" data-id="<?= $option['id'] ?>" data-name="date2" value="<?= $option['date2'] ?>">
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

                                                <!-- -----------------История внесенных показаний--------------------------- -->
                                                <div class="tab-pane fade" id="tab1-2" aria-labelledby="nav1-2">
                                                    <div class="row justify-content-center">

                                                        <!-- ПОИСКОВАЯ СИСТЕМА ДЛЯ ТАБЛИЦЫ С КЛАССОМ results -->


                                                        <div class="col-12 table-responsive">

                                                            <table class="table-striped table-hover results" id="table" style="width: 100%;">
                                                                <thead class="bg-dark border_tr text-center">
                                                                    <tr>
                                                                        <th class="pr-1">ID</th>
                                                                        <th class="pr-1">Район</th>
                                                                        <th class="pr-1">Производственный участок</th>
                                                                        <th class="pr-1">Дом</th>
                                                                        <th class="pr-1">Кв.</th>
                                                                        <th class="pr-1">Пиковая зона</th>
                                                                        <th class="pr-1">Ночная зона</th>
                                                                        <th class="pr-1">Полупиковая зона</th>
                                                                        <th class="pr-1">Дата приема</th>
                                                                        <th class="pr-1">К оплате</th>
                                                                    </tr>
                                                                </thead>
                                                                <tbody>
                                                                    <?php foreach ($electros as $electro) : ?>
                                                                        <tr class="tr" id="<?= $electro['id'] ?>">
                                                                            <!-- обернули в div -> для EI + edit -> стили css -->

                                                                            <td class="text-center">
                                                                                <div class="edit" data-name="id" data-id="<?= $electro['id'] ?>"><?= $electro['id'] ?></div>
                                                                            </td>
                                                                            <td class="text-center">
                                                                                <div class="edit" data-id="<?= $electro['id'] ?>" data-name="section"><?= $electro['section'] ?></div>
                                                                            </td>
                                                                            <td class="text-center">
                                                                                <div class="edit" data-id="<?= $electro['id'] ?>" data-name="street"><?= $electro['street'] ?></div>
                                                                            </td>
                                                                            <td class="text-center">
                                                                                <div class="edit" data-id="<?= $electro['id'] ?>" data-name="house"><?= $electro['house'] ?></div>
                                                                            </td>
                                                                            <td class="text-center">
                                                                                <div class="edit" data-id="<?= $electro['id'] ?>" data-name="flat"><?= $electro['flat'] ?></div>
                                                                            </td>
                                                                            <td class="text-center">
                                                                                <div class="edit" data-id="<?= $electro['id'] ?>" data-name="T1"><?= $electro['T1'] ?></div>
                                                                            </td>
                                                                            <td class="text-center">
                                                                                <div class="edit" data-id="<?= $electro['id'] ?>" data-name="T2"><?= $electro['T2'] ?></div>
                                                                            </td>
                                                                            <td class="text-center">
                                                                                <div class="edit" data-id="<?= $electro['id'] ?>" data-name="T3"><?= $electro['T3'] ?></div>
                                                                            </td>
                                                                            <td class="text-center">
                                                                                <form>
                                                                                    <input type="date" class="date" data-id="<?= $electro['id'] ?>" data-name="date" value="<?= $electro['date'] ?>">
                                                                                </form>
                                                                            </td>
                                                                            <td class="text-center">
                                                                                <div class="edit" data-id="<?= $electro['id'] ?>" data-name="tariffCount"><?= $electro['tariffCount'] ?></div>
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
                                <!-- -----------------------------------------------ОНЛАЙН ЗАКАЗ УСЛУГ ПОЛЬЗОВАТЕЛЕМ-------------------------------------------- -->
                                <div class="tab-pane fade" id="tab-3" aria-labelledby="nav-3">
                                    <div class="row justify-content-center">
                                        <div class="col-sm-8 col-12">
                                            <form>
                                                <fieldset class="my-5 py-5">
                                                    <legend class="text-center"><b>Анкета для заказа услуг</b></legend>

                                                    <legend class="py-4">Информация об услуге:</legend>
                                                    <div class="col-12 form-group form-row">
                                                        <label for="User_typet">Тип услуги:</label>
                                                        <select class="form-control" id="User_typet" data-name="User_typet" name="User_typet" required style="width: 100%;">
                                                            <optgroup label="Тип услуги">
                                                                <?php foreach ($typet as $typets) : ?>
                                                                    <option value="<?= $typets['id'] ?>"><?= $typets['id'] ?> | <?= $typets['type'] ?></option>
                                                                <?php endforeach; ?>
                                                            </optgroup>
                                                        </select>
                                                    </div>
                                                    <legend class="py-4">Информация об заказчике:</legend>
                                                    <div class="form-group form-row">
                                                        <div class="col-12 form-group">
                                                            <label for="User_home">Адрес оказания услуги:</label>
                                                            <select class="form-control" id="User_home" data-name="User_home" name="User_home" required style="width: 100%;">
                                                                <optgroup label="Лицевые счета и собственность">
                                                                    <?php foreach ($home as $homes) : ?>
                                                                        <option value="<?= $homes['id'] ?>"><?= $homes['id'] ?> | <?= " Район: " . $homes['section'] . ", Ул.: " . $homes['street'] . ", Д.: " . $homes['house'] . ", Кв.: " . $homes['flat'] ?></option>
                                                                    <?php endforeach; ?>
                                                                </optgroup>
                                                            </select>
                                                        </div>

                                                        <div class="col-12 form-group">
                                                            <label for="User_phone">Контактный номер:</label>
                                                            <input type="text" id="User_phone" data-name="User_phone" name="User_phone" class="form-control" id="Face" required">
                                                        </div>
                                                    </div>


                                                    <div class="form-row justify-content-between ">
                                                        <div class="col-12">
                                                            <div class="form-group">
                                                                <button style="background-color: #FF4500; color: #ffffff;" type="button" class="btn btn-lg btn-circle mx-auto d-block px-3" id="Btn_order">Заказать</button>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </fieldset>
                                            </form>

                                            <div id="loader"><span></span></div>
                                            <div id="mes-edit"></div>
                                        </div>
                                    </div>
                                </div>
                                <!-- --------------------------------------------ОНЛАЙН ВНЕСЕНИЕ ПОКАЗАНИЙ ПО УЧАСТКУ-------------------------------------------- -->
                                <div class="tab-pane fade" id="tab-4" aria-labelledby="nav-4">
                                    <div class="row justify-content-center">
                                        <div class="col-md-8 col-12 ">
                                            <form>

                                                <fieldset class="my-5 py-5">
                                                    <legend class="text-center"><b>Анкета заполнения показаний</b></legend>

                                                    <legend class="py-4">Показания по тарифу:</legend>
                                                    <div class="form-group form-row">
                                                        <label for="Т1" class="col-md-3 col-12">Пиковая зона(Т1):</label>
                                                        <input type="text" class="form-control col-md-6 col-12" required name="Т1" id="Т1">
                                                    </div>
                                                    <div class="form-group form-row">
                                                        <label for="Т2" class="col-md-3 col-12">Ночная зона(Т2):</label>
                                                        <input type="text" class="form-control col-md-6 col-12" mame="Т2" id="Т2">
                                                    </div>
                                                    <div class="form-group form-row">
                                                        <label for="Т3" class="col-md-3 col-12">Полупиковая зона(Т3):</label>
                                                        <input type="text" class="form-control col-md-6 col-12" name="Т3" id="Т3">
                                                    </div>
                                                    <div class="form-group form-row">
                                                        <legend class="py-4">Адресс снятия показаний:</legend>
                                                        <div class="col-md-9 col-12 form-group">
                                                            <select id="User_home" data-name="User_home" name="User_home" required style="width: 100%;">
                                                                <optgroup label="Лицевые счета и собственность">
                                                                    <?php foreach ($home as $homes) : ?>
                                                                        <option value="<?= $homes['id'] ?>"><?= $homes['id'] ?> | <?= " Район: " . $homes['section'] . ", Ул.: " . $homes['street'] . ", Д.: " . $homes['house'] . ", Кв.: " . $homes['flat'] ?></option>
                                                                    <?php endforeach; ?>
                                                                </optgroup>
                                                            </select>
                                                        </div>
                                                    </div>
                                                    <div class="form-row justify-content-between ">
                                                        <div class="col-9 ">
                                                            <div class="form-group">
                                                                <button style="background-color: #FF4500; color: #ffffff;" type="button" class="btn  btn-circle  mx-auto d-block px-2" id="Btn_electro">Внести показания</button>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </fieldset>
                                            </form>

                                            <div id="loader"><span></span></div>
                                            <div id="mes-edit"></div>
                                        </div>
                                    </div>
                                </div>

                            </div>

                        </div>
                    </div>
        </main>



    <?php } ?>




    <?php
    Add_Footer();

    ?>

    <script src='https://kit.fontawesome.com/09738bb7f2.js' crossorigin='anonymous'></script>
    <script src='http://code.jquery.com/jquery-latest.js'></script>
    <script src='https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.3/umd/popper.min.js' integrity='sha384-vFJXuSJphROIrBnz7yo7oB41mKfc8JzQZiCq4NCceLEaO4IHwicKwpJf9c9IpFgh' crossorigin='anonymous'></script>
    <script src='https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.2/js/bootstrap.min.js' integrity='sha384-alpBpkh1PFOepccYVYDB4do5UnbKysX5WZXm3XxPqe5iKTfUKjNkCk9SaVuEZflJ' crossorigin='anonymous'></script>

    <script src='js/profile.js'></script>

</body>

</html>