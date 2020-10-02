<?php
/*подключение библиотек*/
//хапуск сессий, для приминения массива сессии
session_start();
require_once "Lib_db.php";


if ($_SESSION['user']) {
    header('Location:../index.php');
}


// TO-DO : НЕТ ВАЛИДАЦИИ ВООБЩЕ, ДАЖЕ НЕ ЗАПОЛНЕННЫЕ ДАННЫЕ ПРОХОДЯТ !!!
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset='UTF-8'>
    <meta name='viewport' content='width=device-width, initial-scale=1.0'>
    <meta name='viewport' content='width=device-width, initial-scale=1, shrink-to-fit=no'>

    <title>ООО «Энергосоюз»</title>

    <link rel='stylesheet' href='https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css' integrity='sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm' crossorigin='anonymous'>
    <link rel='stylesheet' href='css/main.css'>

    <link href='https://fonts.googleapis.com/css2?family=Montserrat:wght@200;400;600&family=Open+Sans:wght@400;700&display=swap' rel='stylesheet'>

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
            <div class="container">
                <div class="row pt-5 pb-5">
                    <!-- <div class="col-6"></div>
                    <div class="col-6"></div> -->
                    <div class="col-12">
                        <form action="/vendor/signup.php" method="post" enctype="multipart/form-data">
                            <div class="form-row justify-content-center">
                                <div class="col-md-6 col-12">
                                    <div class="form-group">
                                        <label for="surname">Фамилия</label>
                                        <input type="text" required name="surname" class="form-control" id="surname" aria-describedby="surnameHelp" placeholder="Ваша фамилия">
                                        <small id="surnameHelp"></small>
                                    </div>
                                </div>
                            </div>
                            <div class="form-row justify-content-center">
                                <div class="col-md-6 col-12">
                                    <div class="form-group">
                                        <label for="first_name">Имя</label>
                                        <input type="text" required name="first_name" class="form-control" id="first_name" aria-describedby="first_nameHelp" placeholder="Ваше имя">
                                        <small id="first_nameHelp"></small>
                                    </div>
                                </div>
                            </div>
                            <div class="form-row justify-content-center">
                                <div class="col-md-6 col-12">
                                    <div class="form-group">
                                        <label for="last_name">Отчество</label>
                                        <input type="text" name="last_name" class="form-control" id="last_name" aria-describedby="last_nameHelp" placeholder="Ваше отчество">
                                        <small id="last_nameHelp"></small>
                                    </div>
                                </div>
                            </div>
                            <div class="form-row justify-content-center">
                                <div class="col-md-6 col-12">
                                    <div class="form-group">
                                        <label for="login">Логин</label>
                                        <input type="text" required name="login" class="form-control" id="login" aria-describedby="loginHelp" placeholder="Логин">
                                        <small id="loginHelp"></small>
                                    </div>
                                </div>
                            </div>
                            <div class="form-row justify-content-center">
                                <div class="col-md-6 col-12">
                                    <div class="form-group">
                                        <label for="avatar">Фото вашего профиля</label>
                                        <input type="file" name="avatar" class="form-control orangeWhite_btn" id="avatar" aria-describedby="avatarHelp" placeholder="Фото">
                                        <small id="avatarHelp"></small>
                                    </div>
                                </div>
                            </div>
                            <div class="form-row justify-content-center">
                                <div class="col-md-6 col-12">
                                    <div class="form-group">
                                        <label for="email">Электронная почта</label>
                                        <input type="email" required name="email" class="form-control" id="email" aria-describedby="emailHelp" placeholder="Email адресс">
                                        <small id="emailHelp"></small>
                                    </div>
                                </div>
                            </div>
                            <div class="form-row justify-content-center">
                                <div class="col-md-6 col-12">
                                    <div class="form-group">
                                        <label for="telephone">Телефон</label>
                                        <input type="tel" name="telephone" class="form-control" id="telephone" aria-describedby="telephoneHelp" placeholder="Ваш мобильный/домашний">
                                        <small id="telephoneHelp"></small>
                                    </div>
                                </div>
                            </div>

                            <div class="form-row justify-content-center">
                                <div class="col-md-6 col-12">
                                    <div class="form-group">
                                        <label for="MyHome">Данные по дому</label>
                                        <input type="text" name="MyHome" data-toggle="modal" data-target="#Modalhome" class="form-control" id="MyHome" aria-describedby="MyHomeHelp" placeholder="Введите данные по собсвенности">
                                        <small id="MyHomeHelp"></small>
                                    </div>
                                </div>
                            </div>



                            <!-- МОДАЛЬНОЕ ОКНО ДВВОДА ДАННЫХ ПО ДОМУ -->

                            <div class="modal fade" id="Modalhome">
                                <div class="modal-dialog modal-lg">
                                    <div class="modal-content">

                                        <div class="modal-header">
                                            <h5 class="modal-title">Данные о доме</h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <div class="modal-body">
                                            <div class="form-row">
                                                <div class="col-md-6 col-12 justify-conten-center">
                                                    <div class="form-row justify-content-center">
                                                        <div class="col-12">
                                                            <div class="form-group">
                                                                <label for="city">Город</label>
                                                                <input type="text" required name="city" class="form-control" id="city" aria-describedby="cityHelp" placeholder="Ваш город">
                                                                <small id="cityHelp"></small>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="form-row justify-content-center">
                                                        <div class="col-12">
                                                            <div class="form-group">
                                                                <p>
                                                                    <label for="section">Выберите район</label>
                                                                    <select id="section" class="form-control" required name="section">
                                                                        <option disabled selected>Ваш район:</option>
                                                                        <optgroup label="Центральный округ">
                                                                            <option value="ЗИП – Завод измерительных приборов">ЗИП – Завод измерительных приборов</option>
                                                                            <option value="ККБ – Краевой клинической больницы">ККБ – Краевой клинической больницы</option>
                                                                            <option value="ЦМР – Центральный">ЦМР – Центральный</option>
                                                                            <option value="ЧМР – Черемушки">ЧМР – Черемушки</option>
                                                                            <option value="ШМР – Школьный">ШМР – Школьный</option>
                                                                        </optgroup>
                                                                        <optgroup label="Западный округ">
                                                                            <option value="СХИ – Сельскохозяйственный институт">СХИ – Сельскохозяйственный институт</option>
                                                                            <option value="ФМР – Фестивальный">ФМР – Фестивальный</option>
                                                                            <option value="ЦМР – Центральный">ЦМР – Центральный</option>
                                                                            <option value="ЮМР – Юбилейный">ЮМР – Юбилейный</option>
                                                                        </optgroup>
                                                                        <optgroup label="Карасунский округ">
                                                                            <option value="lumia 950">ГМР – Гидростроителей</option>
                                                                            <option value="КМР – Комсомольский">КМР – Комсомольский</option>
                                                                            <option value="КСК – Камвольно-суконный комбинат">КСК – Камвольно-суконный комбинат</option>
                                                                            <option value="ПМР – Пашковский">ПМР – Пашковский</option>
                                                                            <option value="РМЗ – Ремонтно-механический завод">РМЗ – Ремонтно-механический завод</option>
                                                                            <option value="ХБК – Хлопчато-бумажный комбинат">ХБК – Хлопчато-бумажный комбинат</option>
                                                                            <option value="ЧМР – Черемушки">ЧМР – Черемушки</option>
                                                                        </optgroup>
                                                                        <optgroup label="Прикубанский округ">
                                                                            <option value="ВМР – Витамин-комбинат">ВМР – Витамин-комбинат</option>
                                                                            <option value="ЖМР – пос. им. Жукова">ЖМР – пос. им. Жукова</option>
                                                                            <option value="ЗИП – Завод измерительных приборов">ЗИП – Завод измерительных приборов</option>
                                                                            <option value="ККБ – Краевой клинической больницы">ККБ – Краевой клинической больницы</option>
                                                                            <option value="МХГ – Микрохирургии глаза">МХГ – Микрохирургии глаза</option>
                                                                            <option value="РИП – Завод радиоизмерительных приборов">РИП – Завод радиоизмерительных приборов</option>
                                                                            <option value="СМР – Славянский">СМР – Славянский</option>
                                                                            <option value="СХИ – Сельскохозяйственный институт">СХИ – Сельскохозяйственный институт</option>
                                                                            <option value="ФМР – Фестивальный">ФМР – Фестивальный</option>
                                                                            <option value="ШМР – Школьный">ШМР – Школьный</option>
                                                                            <option value="ЮМР – Юбилейный">ЮМР – Юбилейный</option>
                                                                        </optgroup>
                                                                        <optgroup label="Пригород">
                                                                            <option value="п. Белозерный">п. Белозерный</option>
                                                                            <option value="п. Знаменский">п. Знаменский</option>
                                                                            <option value="п. Индустриальный">п. Индустриальный</option>
                                                                            <option value="п. Калинино">п. Калинино</option>
                                                                            <option value="п. Колосистый">п. Колосистый</option>
                                                                            <option value="п. Лазурный ">п. Лазурный </option>
                                                                            <option value="п. Лорис ">п. Лорис </option>
                                                                            <option value="п. Новознаменский">п. Новознаменский</option>
                                                                            <option value="п. Новознаменский">п. Новознаменский</option>
                                                                            <option value="п. Новокорсунская ">п. Новокорсунская </option>
                                                                            <option value="п. Плодородный">п. Плодородный</option>
                                                                            <option value="п. Российский">п. Российский</option>
                                                                            <option value="п. Северный">п. Северный</option>
                                                                            <option value="п. Южный">п. Южный</option>
                                                                            <option value="п. Яблоновский">п. Яблоновский</option>
                                                                            <option value="ст. Елизаветинская">ст. Елизаветинская</option>
                                                                            <option value="ст. Новотитаровская ">ст. Новотитаровская </option>
                                                                        </optgroup>
                                                                    </select>
                                                                </p>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="form-row justify-content-center">
                                                        <div class="col-12">
                                                            <div class="form-group">
                                                                <label for="street">Улица</label>
                                                                <input type="text" required name="street" class="form-control" id="street" aria-describedby="streetHelp" placeholder="Название вашей улицы">
                                                                <small id="streetHelp"></small>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="form-row justify-content-center">
                                                        <div class="col-12">
                                                            <div class="form-group">
                                                                <label for="house">Дом</label>
                                                                <input type="text" required name="house" class="form-control" id="house" aria-describedby="houseHelp" placeholder="Номер вашего дома">
                                                                <small id="houseHelp"></small>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="form-row justify-content-center">
                                                        <div class="col-12">
                                                            <div class="form-group">
                                                                <label for="flat">Квартира/офис/кабинет</label>
                                                                <input type="text" required name="flat" class="form-control" id="flat" aria-describedby="flatHelp">
                                                                <small id="flatHelp"></small>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-md-6 col-12 justify-conten-center">
                                                    <div class="form-row justify-content-center">
                                                        <div class="col-12">
                                                            <div class="form-group">
                                                                <label for="year">Год регистрации ПУ электроэнергии</label>
                                                                <input type="text" class="form-control" id="year" name="year" aria-describedby="yearHelp"">
                                                                    <small id=" yearHelp"></small>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="form-row justify-content-center">
                                                        <div class="col-12">
                                                            <div class="form-group">
                                                                <label for="floor">Этажность дома</label>
                                                                <input type="text" name="floor" class="form-control" id="floor" aria-describedby="floorHelp">
                                                                <small id="floorHelp"></small>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="form-row justify-content-center">
                                                        <div class="col-12">
                                                            <div class="form-group">
                                                                <label for="area">Жилплощадь(м2)</label>
                                                                <input type="text" name="area" class="form-control" id="area" aria-describedby="areaHelp">
                                                                <small id="areaHelp"></small>
                                                            </div>
                                                        </div>
                                                    </div>

                                                </div>
                                            </div>
                                        </div>
                                        <div class="modal-footer justify-content-center ">
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true"><img src="img/check-true.png" width="42" style="height: 42px;" alt="подтверждение"></span>
                                            </button>
                                        </div>

                                    </div>
                                </div>
                            </div>
                            <!-- МОДАЛЬНОЕ ОКНО ДВВОДА ДАННЫХ ПО ДОМУ -->


                            <div class="form-row justify-content-center">
                                <div class="col-md-6 col-12">
                                    <div class="form-group">
                                        <label for="password">Пароль</label>
                                        <input type="password" required name="password" class="form-control" id="password" aria-describedby="passwordHelp" placeholder="Пароль">
                                        <small id="passwordHelp"></small>
                                    </div>
                                </div>
                            </div>
                            <div class="form-row justify-content-center">
                                <div class="col-md-6 col-12">
                                    <div class="form-group">
                                        <label for="password">Подтвердите пароль</label>
                                        <input type="password" required name="password_confirm" class="form-control" id="password_confirm" aria-describedby="passwordHelp" placeholder="Тот же пароль">
                                        <small id="passwordHelp"></small>
                                    </div>
                                </div>
                            </div>
                            <div class="form-row justify-content-center">
                                <div class="col-md-6 col-12">
                                    <div class="form-group">
                                        <input type="submit" class="form-control orangeRed_btn" value="Зарегистрироваться">
                                    </div>
                                </div>
                            </div>
                            <div class="row justify-content-center">
                                <div class="col-md-6 col-12">
                                    <div class="pt-3">
                                        <label for="Signin">У вас уже есть аккаунт?</label>
                                        <a href="#Modal" data-toggle="modal" id="Signin">Авторизоваться</a>

                                        <?php

                                        //Если сессия существует то есть блок <p> с ее выводом
                                        if ($_SESSION['message']) {
                                            //Эта ссесия получается на странице signup в ситуации(if)
                                            echo ' <P class="msg text-center" style="border: 2px solid #ffa706; padding:10px;">' .
                                                $_SESSION['message'] . '</P>';
                                        };

                                        //При ситуации её нужно уничтожить, чтобы после перезагрузки её не было
                                        unset($_SESSION['message']);

                                        ?>

                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </main>


    <?php
    Add_Footer();

    ?>


    <script src='https://kit.fontawesome.com/09738bb7f2.js' crossorigin='anonymous'></script>
    <script src='http://code.jquery.com/jquery-latest.js'></script>
    <script src='https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.3/umd/popper.min.js' integrity='sha384-vFJXuSJphROIrBnz7yo7oB41mKfc8JzQZiCq4NCceLEaO4IHwicKwpJf9c9IpFgh' crossorigin='anonymous'></script>
    <script src='https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.2/js/bootstrap.min.js' integrity='sha384-alpBpkh1PFOepccYVYDB4do5UnbKysX5WZXm3XxPqe5iKTfUKjNkCk9SaVuEZflJ' crossorigin='anonymous'></script>

    <script src='js/main.js'></script>
</body>

</html>