<?php
/*подключение библиотек*/
session_start();
require_once "Lib_db.php";

?>




<!DOCTYPE html>
<html lang='en'>

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
    <main>
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
                                        <input type="password" name="password" class="form-control" id="password" placeholder="Пароль" aria-describedby="passwordHelp">
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
        <div class="main bg-secondary" role="main">
            <section>
                <div style="background-color: #f1f3f7; border-color: #707070;">
                    <div class="container pt-5 pb-5">
                        <div class="row mb-4">
                            <div class="col-6  fonts-Montserrat text-start">
                                <b><strong>Контакты организации</strong></b>
                            </div>
                            <div class="col-6 ">
                                <ul class="breadcrumb justify-content-end " style="background-color: #f1f3f7;">
                                    <li class="breadcrumb-item"><a href="index.php" class="text-muted">Главная</a></li>
                                    <li class="breadcrumb-item actve"><a href="contacts.php" class="text-muted">Контакты</a></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </section>

            <section>
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-md-6 col-xl-4 order-md-1 px-0">
                            <div class="img-fluid" style="min-height: 550px; background-image: url(/img/business-2.jpg); background-size: cover; background-position: center center; background-repeat: no-repeat;"></div>
                        </div>
                        <div class="col-md-6 bg-secondary col-xl-4 order-md-2 px-0">
                            <section class="h-100  ">

                                <div class="row my-5">
                                    <div class="col text-center">
                                        <div>
                                            <div class="bg-dark mb-3"><i class=" text-light"></i></div>
                                            <div class="">
                                                <div class="mb-4">
                                                    <h2 class="text-light  mb-0">Контакты</h2>
                                                </div>
                                            </div>
                                        </div>


                                        <span class="top-sub-title text-light">НАШ АДРЕС</span>
                                        <h3 class=" text-light mb-0"> г. Краснодар</h3><span class="d-block text-light mb-3">ул. Российская д. 47</span>
                                        <span class="d-block mb-3">
                                            <a class="my_link_1 popup-gmaps learn-more" href="#ModalMaps" data-toggle="modal" href="https://maps.google.com/maps?q=г. г. Краснодар, ул. Российская, д. 47&amp;z=18&amp;hl=ru&amp;t=m">МЫ НА КАРТЕ <i class="fas fa-angle-right"></i></a>
                                        </span>
                                        <a class="my_link_1" href="mailto:office.energo@click.com">office.energo@click.com</a>
                                        <span class="d-block mb-3">
                                            <a class="my_link_1" href="tel:+7 101 101 1010">+7 101 101 1010</a>
                                        </span>


                                        <div class="col-12  pb-5 fonts-Sans my-5" style="text-align: center">
                                            <a type="button" href="personal.php" class="btn orangeWhite_btn btn-circle px-2 ">
                                                Наши сотрудники
                                            </a>
                                        </div>

                                    </div>
                                </div>
                            </section>
                        </div>
                        <div class="col-md-6 col-xl-4 order-md-4 order-xl-3 px-0">
                            <div class="img-fluid" style="min-height: 550px; background-image: url(/img/business-1.jpg); background-size: cover; background-position: center; background-repeat: no-repeat;"></div>
                        </div>
                    </div>
                </div>
            </section>



        </div>
    </main>

    <div class="modal fade" id="ModalMaps">
        <div class="modal-dialog modal-dialog-centered modal-lg">
            <div class="modal-content">
                <form id="AddForm">
                    <div class="modal-header">
                        <h5 class="modal-title mx-auto">Организация на картах google</h5>
                        <button type="button" class="close mx-0 px-0" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <center>
                            <iframe class="img_maps" src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d2818.817643021609!2d39.01541281560423!3d45.04892227909821!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x40f045688204bb9d%3A0xdfb3b39c1dd628bd!2sUlitsa%20Rossiyskaya%2C%2047%2C%20Krasnodar%2C%20Krasnodarskiy%20kray%2C%20350901!5e0!3m2!1sen!2sru!4v1592241909569!5m2!1sen!2sru" width="700" height="450" frameborder="0" style="border:0;" allowfullscreen="" aria-hidden="false" tabindex="0"></iframe>
                        </center>
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

    <script src='js/main.js'></script>
</body>

</html>