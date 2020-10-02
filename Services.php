<?php
/*подключение библиотек*/
session_start();
require_once "vendor/connect.php";
require_once "Lib_db.php";


$table = "typet";
$typet =  get_listStatus($table);
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
            <section>
                <div style="background-color: #f1f3f7; border-color: #707070;">
                    <div class="container pt-5 pb-5">
                        <div class="row mb-4">
                            <div class="col-6  fonts-Montserrat text-start">
                                <b><strong>Услуги</strong></b>
                            </div>
                            <div class="col-6 ">
                                <ul class="breadcrumb justify-content-end " style="background-color: #f1f3f7;">
                                    <li class="breadcrumb-item"><a href="index.php" class="text-muted">Главная</a></li>
                                    <li class="breadcrumb-item actve"><a href="#" class="text-muted">Услуги</a></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </section>


            <section name="Company">
                <div class="bg-light">
                    <div class="container pt-5 pb-5">
                        <div class="row">
                            <div class="col-12">
                                <nav class="nav nav-pills justify-content-lg-between justify-content-center text-center">

                                    <a class="col-lg-5 col-8  nav-item nav-link active rounded-0" id="nav1-1" data-toggle="tab" aria-controls="tab1-1" href="#tab1-1" style="transform: skewX(-10deg);">
                                        Обслуживание приборов учета электроэнергии
                                    </a>

                                    <a class="col-lg-5 col-8 nav-item nav-link rounded-0" id="nav1-2" data-toggle="tab" aria-controls="tab1-2" href="#tab1-2" style="transform: skewX(-10deg);">
                                        Услуги для гарантирующих поставщиков электроэнергии
                                    </a>

                                    <a class=" col-lg-5 col-8   nav-item nav-link rounded-0" id="nav1-3" data-toggle="tab" aria-controls="tab1-3" href="#tab1-3" style="transform: skewX(-10deg);">
                                        Монтаж и обслуживание коммунальных ресурсов
                                    </a>
                                    <a class="col-lg-5 col-8  nav-item nav-link rounded-0" id="nav1-4" data-toggle="tab" aria-controls="tab1-4" href="#tab1-4" style="transform: skewX(-10deg);">
                                        Печать и доставка квитанций и уведомлений
                                    </a>


                                </nav>
                                <div class="tab-content pt-5 ">
                                    <div class="tab-pane fade show active" id="tab1-1" aria-labelledby="nav1-1">

                                        <h4 class="text-center">
                                            <strong>
                                                <em class="fonts-Montserrat">Обслуживание приборов учета
                                                    электроэнергии</em>
                                            </strong>
                                        </h4>

                                        <p class="pt-3">
                                            Специалисты нашей компании выполняют весь комплекс работ по
                                            установке, замене, настройке и обслуживанию приборов учёта электро-энергии на все территории
                                            области Краснодарского края!
                                        </p>

                                        <ul class="push">
                                            <?php foreach ($typet as $typets) : ?>
                                                <li><?= $typets['type'] ?></li>
                                            <?php endforeach; ?>
                                        </ul>

                                    </div>


                                    <div class="tab-pane fade" id="tab1-2" aria-labelledby="nav1-2">
                                        <h4 class="text-center">
                                            <strong>
                                                <em class="fonts-Montserrat">Услуги для гарантирующих поставщиков
                                                    электроэнергии</em>
                                            </strong>
                                        </h4>

                                        <p class="pt-3">
                                            Наша компания предоставлет комплекс услуг для гарантирующих поставщиков энергитических компаний
                                            территориально расположенных как в Краснодарском крае, так и за его пределами
                                        </p>

                                        <ul class="push">
                                            <?php foreach ($typet as $typets) : ?>
                                                <li><?= $typets['type'] ?></li>
                                            <?php endforeach; ?>
                                        </ul>
                                    </div>


                                    <div class="tab-pane fade" id="tab1-3" aria-labelledby="nav1-3">
                                        <h4 class="text-center">
                                            <strong>
                                                <em class="fonts-Montserrat">Монтаж и обслуживание коммунальных
                                                    ресурсов</em>
                                            </strong>
                                        </h4>

                                        <p class="pt-3">
                                            Наша компания выполняют весь комплекс работ по монтажу и обслуживанию коммунальных ресурсов
                                        </p>

                                        <ul class="push">
                                            <?php foreach ($typet as $typets) : ?>
                                                <li><?= $typets['type'] ?></li>
                                            <?php endforeach; ?>
                                        </ul>
                                    </div>
                                    <div class="tab-pane fade" id="tab1-4" aria-labelledby="nav1-4">
                                        <h4 class="text-center">
                                            <strong>
                                                <em class="fonts-Montserrat">Печать и доставка квитанций и уведомлений</em>
                                            </strong>
                                        </h4>

                                        <p class="pt-3">
                                            Нами предоставляется гарантийная печать по оказанию нашим клиентам услуг, ежемесечная квитация на оплату услуг,
                                            а также полная информационная поддержка нашими специалистами!
                                        </p>

                                        <ul class="push">
                                            <?php foreach ($typet as $typets) : ?>
                                                <li><?= $typets['type'] ?></li>
                                            <?php endforeach; ?>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
            </section>

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