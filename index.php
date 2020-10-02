<?php
session_start();
require_once "Lib_db.php";


?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <title>ООО «Энергосоюз»</title>

    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <link rel="stylesheet" href="css/main.css">

    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@200;400;600&family=Open+Sans:wght@400;700&display=swap" rel="stylesheet">



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

    <header id="header" style="min-height: 106px;">
        <div style="top: 0px; position: static;">

            <div class="container">
                <div class="row">
                    <div class="col-3 pr-5 justify-content-start">
                        <div>
                            <a href="/"><img alt="ЭНЕРГОСОЮЗ" height="100" width="190" src="img/logo 2.png">
                            </a>
                        </div>
                    </div>
                    <div class="col-9 d-flex justify-content-end align-items-center ">
                        <div class="d-none d-md-flex mr-4">
                            <div class="pr-4 ">
                                <object type="image/svg+xml" data="img/map-marker.svg" width="20" height="20">
                                    <img src="/img/letter-1.png" width="20" height="20" alt="image format png" />
                                </object>
                            </div>
                            <div>
                                <span style="font-size: 14px;">Адрес</span>
                                <p class="mb-0" style="font-size: 13px;"><strong>г. Краснодар, ул. Российская, д.
                                        47</strong></p>
                            </div>
                        </div>
                        <div class="d-none d-lg-flex d mr-4">
                            <div class="pr-2">
                                <object type="image/svg+xml" data="img/mobile.svg" width="20" height="20">
                                    <img src="/img/letter-1.png" width="20" height="20" alt="image format png" />
                                </object>
                            </div>
                            <div>
                                <div>
                                    <span style="font-size: 14px;">Телефон</span>
                                    <p class="mb-0" style="font-size: 13px;"><strong><a class="orangeRed_text" href="tel:+7 101 101 1010">+7 101 101 1010</a></strong></p>
                                </div>
                            </div>
                        </div>
                        <div class="d-none d-sm-flex">
                            <div class="pr-2">
                                <object type="image/svg+xml" data="img/letter-1.svg" width="20" height="20">
                                    <img src="/img/letter-1.png" width="20" height="20" alt="image format png" />
                                </object>
                            </div>
                            <div>
                                <div>
                                    <span style="font-size: 14px;">E-mail</span>
                                    <p class="mb-0" style="font-size: 13px;"><strong><a class="orangeRed_text" href="mailto:office.energo@click.com">office.energo@click.com</a></strong>
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </header>
    <!--  -->
    <hr class="separator px-0 py-0 my-0 mx-0">
    <nav class="sticky-top px-0 py-0 my-0 mx-0">
        <div class="navigation bg-white" role="navigation">
            <div class="container ">
                <div class="row">
                    <div class="col-12">
                        <nav class="navbar navbar-expand-lg navbar-light gb-light">

                            <div class="collapse navbar-collapse order-lg-0 order-1" id="navContent">
                                <ul class="navbar-nav">
                                    <li class="nav-item"><a href="index.php" class="nav-link data-menu">Главная</a></li>
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

            <div class="container-fluid" id="Caurosel">
                <div class="row no-gutters">
                    <div class="col-12">
                        <div id="carouselMy" class="carousel carousel slide" data-ride="carousel">
                            <div class="carousel-inner">
                                <div class="carousel-item active">
                                    <img class="img-fluid d-block w-100 slide-big" src="img/MainPage/slide-1.jpg">
                                    <div class="carousel-caption text-white orangeRed_text">
                                        <h5 style="text-shadow: 1px 1px 2px black, 0 0 1em black;"><b>ПОКАЗАНИЯ</b></h5>
                                        <p class="fonts-Sans" style="text-shadow: 1px 1px 2px black, 0 0 1em black;">Теперь вы можете вносить ваши показания онлайн</p>
                                    </div>
                                </div>
                                <div class="carousel-item">
                                    <img class="img-fluid d-block w-100 slide-big" src="img/MainPage/slide-2.jpg">
                                    <div class="carousel-caption orangeRed_text">
                                        <h5 style="text-shadow: 1px 1px 2px orange, 0 0 1em white;"><b>УСЛУГИ</b></h5>
                                        <p class="fonts-Sans" style="text-shadow: 1px 1px 2px orange, 0 0 1em white;">Мы лидер на рынке по оказыванию своих услуг</p>
                                    </div>
                                </div>

                            </div>
                            <a class="carousel-control-prev" href="#carouselMy" data-slide="prev">
                                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                            </a>
                            <a class="carousel-control-next" href="#carouselMy" data-slide="next">
                                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                            </a>
                            <ol class="carousel-indicators">
                                <li data-target="#carouselMy" data-slide-to="0" class="active"></li>
                                <li data-target="#carouselMy" data-slide-to="1" class="active"></li>
                            </ol>
                        </div>
                    </div>
                </div>
            </div>

            <section name="Company">
                <div class=" bg-dark">
                    <div class="container bg-dark pt-5" style="height: 170px;">
                        <div class="row justify-content-center">
                            <div class="col-lg-9 textСenter text-white fonts-Sans">
                                <h3><em><strong>ООО "Энергосоюз"</strong></em></h3>
                            </div>
                            <div class="col-3  fonts-Montserrat" style="text-align: center">
                                <a type="button" href="Services.php" class="btn  orangeRed_btn btn-circle px-5 py-0 py-md-2 px-lg-2 mx-md-0 mt-2">
                                    НАШИ УСЛУГИ
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </section>


            <section name="About">
                <div>
                    <div class="container bg-white">
                        <div class="row justify-content-center">
                            <div class="col-sm-7 col-xl-4 col-lg-4 text-center mb-5 mb-lg-0 card1">
                                <div class="card border-0">
                                    <img src="img/MainPage/WhoWe3.jpg" alt="art" class="card-img-top img-fluid rounded">
                                    <div class="card-header">
                                        <h5 class="card-title">
                                            <em><strong>Кто мы</strong></em>
                                        </h5>
                                    </div>
                                    <div class="card-body">
                                        <p class="card-text lead textSize">
                                            Компания «Энергосоюз» оказывает комплексный подход по оказыванию
                                            услуг в области энергетики и ЖКХ.
                                            Мы являемся специалистами в данных отраслях!
                                        </p>
                                        <a class="orangeRed_text btn btn-link-warning border-0" href="AboutUs.php" id="link">
                                            <em><b>УЗНАТЬ БОЛЬШЕ</b></em><span class="orangeRed_text badge badge-light"><b>
                                                    <h6>&gt;</h6>
                                                </b></span>
                                        </a>
                                    </div>
                                </div>
                            </div>

                            <div class="col-sm-7 col-xl-4 col-lg-4 text-center mb-5 mb-lg-0 card2">
                                <div class="card border-0">
                                    <img src="img/MainPage/WhoWe2.jpg" alt="art" class="card-img-top img-fluid rounded">
                                    <div class="card-header">
                                        <h5 class="card-title">
                                            <em><strong>Наши услуги</strong></em>
                                        </h5>
                                    </div>
                                    <div class="card-body">
                                        <p class="card-text lead textSize">
                                            ООО «Энергосоюз» оказывает услуги по информационно-рассчётному
                                            обслуживанию организаций жилищьно-комунального хозяйства...
                                        </p>
                                        <a class="orangeRed_text btn btn-link-warning border-0" href="Services.php" id="link">
                                            <em><b>УЗНАТЬ БОЛЬШЕ</b></em><span class="orangeRed_text badge badge-light"><b>
                                                    <h6>&gt;</h6>
                                                </b></span>
                                        </a>
                                    </div>
                                </div>
                            </div>

                            <div class="col-sm-7 col-xl-4 col-lg-4 text-center mb-0 card1">
                                <div class="card border-0">
                                    <img src="img/MainPage/WhoWe4.jpg" alt="art" class="card-img-top img-fluid rounded">
                                    <div class="card-header">
                                        <h5 class="card-title">
                                            <em><strong>Безопасность</strong></em>
                                        </h5>
                                    </div>
                                    <div class="card-body">
                                        <p class="card-text lead textSize">
                                            Мы бережно храним всю информацию переданую вами нам!
                                            Передача осущевствляется по защищёным каналам связи
                                            с использованием специальных программными средствами
                                        </p>
                                        <a class="orangeRed_text btn btn-link-warning border-0" href="contacts.php" id="link">
                                            <em><b>УЗНАТЬ БОЛЬШЕ</b></em><span class="orangeRed_text badge badge-light"><b>
                                                    <h6>&gt;</h6>
                                                </b></span>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>

            <section>
                <div style="background-color: #f1f3f7; border-color: #707070;">
                    <div class="container pt-5 pb-5">
                        <div class="row mb-4">
                            <div class="col-12  fonts-Sans ">
                                <h2><b><strong>Преимущества работы с нами</strong></b></h2>
                            </div>
                        </div>
                        <div id="features" class="row align jusify-content-center text-center mb-4 pb-2">
                            <div class="col-sm-6 col-lg-2">
                                <object type="image/svg+xml" data="img/Качество.svg" width="82" style="height: 82px; opacity: 1;"></object>
                                <p class="lead textSize">Гарантийное обслуживание на каждый вид выполняемых работ </p>
                            </div>
                            <div class="col-sm-6 col-lg-2">

                                <object type="image/svg+xml" data="img/своевременное.svg" width="82" style="height: 82px; opacity: 1;"></object>
                                <p class="lead textSize">Своевременное и качественное исполнение заказов</p>
                            </div>
                            <div class="col-sm-6 col-lg-2">

                                <object type="image/svg+xml" data="img/рост.svg" width="82" style="height: 82px; opacity: 1;"></object>
                                <p class="lead textSize">Услуги высокого качества</p>
                            </div>
                            <div class="col-sm-6 col-lg-2">

                                <object type="image/svg+xml" data="img/Лампа.svg" width="82" style="height: 82px; opacity: 1;"></object>
                                <p class="lead textSize">Лучше в своем деле</p>
                            </div>
                            <div class="col-sm-6 col-lg-2">

                                <object type="image/svg+xml" data="img/цены.svg" width="82" style="height: 82px; opacity: 1;"></object>
                                <p class="lead textSize">Приемлемые цены на наши услуги</p>
                            </div>
                            <div class="col-sm-6 col-lg-2">

                                <object type="image/svg+xml" data="img/Специалист.svg" width="82" style="height: 82px; opacity: 1;"></object>
                                <p class="lead textSize">Консультации специалистов</p>
                            </div>
                        </div>

                    </div>
                </div>
            </section>


            <section>
                <div class="bg-light">
                    <div class="container  pt-5 pb-5">
                        <div class="row">
                            <div class="col-12 jusify-content-center">
                                <div class="mb-4 fonts-Montserrat">
                                    <h2 class="">
                                        <h2><b>Почему мы</b></h2>
                                    </h2>
                                </div>
                                <div class="fonts-Sans">
                                    <p class="mb-3">
                                        Наши технологии и информационно-технические базы позволяют нам
                                        предложить нашим партнерам наилучшие решения
                                        по бизнесу
                                    </p>
                                    <p class="mb-4">
                                        Мы обеспечиваем оказываем услуги по информационно-рассчётному
                                        обслуживанию организаций жилищьно-комунального хозяйства (ЖКХ, ЖСК,
                                        ресурсоснабжающих организаций).
                                    </p>
                                    <p class="mb-4">
                                        Мы предлагаем оказывание качественных услуг от гарантирующих поставщиков
                                        электроэнергии нашим клиентам.
                                    </p>
                                    <p class="mb-4">
                                        Мы обладаем компетентностью по осуществлению деятельности
                                        по техническому обслуживанию, монтажу, ремонту в области энергетики.
                                    </p>
                                    <p class="mb-4">
                                        Мы бережно храним всю информацию переданую вами нам!
                                        Передача осущевствляется по защищёным каналам связи
                                        с использованием специальных программными средствами
                                    </p>
                                    <p class="mb-4">
                                        Деятельность нашей компании соответствует всем нормативным правовым и
                                        техническим актам по требованиям к безопасности при взаимодейсвии с данными.
                                    </p>
                                    <div class="d-block d-sm-inline-block text-center">
                                        <a class="btn btn-rounded btn-circle orangeRed_btn text-color-light px-2" href="AboutUs.php">БОЛЬШЕ О
                                            НАС</a>
                                        <span class="d-block d-sm-inline-block mt-2 mt-sm-0 ml-sm-3">или
                                            <a class="mt-2  orangeRed_text" href="contacts.php">СВЯЖИТЕСЬ С НАМИ</a>
                                        </span>
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>
            </section>

        </div>
    </main>



    <footer>
        <section>
            <div class="footer bg-dark" role="footer">
                <div class="container  pt-5" id=" footer">
                    <div class="row pb-5">
                        <div class="col-3 justify-content-start mb-3 pt-3 pb-2">
                            <div>
                                <a href="/"><img alt="ЭНЕРГОСОЮЗ" height="80" width="140" src="img/logo 2.png"></a>
                            </div>
                        </div>

                        <div class="col-lg-4 ml-auto mb-4 mb-lg-0">
                            <div>

                                <ul style="list-style-type : square">
                                    <li class="caption notStyle mb-3 text-white">
                                        <h4>Контакты:</h4>
                                    </li>
                                    <li class=" textSize mb-2">
                                        <address></address><strong class="fonts-Sans text-white">Адрес:</strong>
                                        <a href="contacts.php" class="text-muted">г. Краснодар ул.
                                            Российская д. 47</a>
                                    </li>


                                    <li class=" textSize mb-2"><strong class="fonts-Sans text-white ">Телефон:</strong> <a href="tel:+7 131 101 1010" class="text-muted">+7 101 101 1010</a>
                                    </li>

                                    <li class="lead textSize mb-2"><strong class="fonts-Sans text-white">Email:</strong> <a href="unsafe:mail:office.energo@click.com" class="text-muted">office.energo@click.com</a></li>

                                </ul>
                            </div>
                        </div>
                        <div class="col-lg-3">
                            <div>
                                <ul style="list-style-type : square">
                                    <li class="caption notStyle mb-3 text-white">
                                        <h4>Быстрые
                                            ссылки:</h4>
                                    </li>
                                    <li class=" textSize mb-2 fonts-Sans "><a href="AboutUs.php" class="text-muted">О
                                            компании</a></li>
                                    <li class=" textSize mb-2 fonts-Sans"><a href="Services.php" class="text-muted">Услуги</a></li>
                                    <li class=" textSize mb-2 fonts-Sans"><a href="contacts.php" class="text-muted">Контакты</a></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <div class="row pb-2">
                        <div class="col-12 text-center">
                            <p class="text-md-right pb-0 mb-0 fonts-Sans text-muted pr-5 "><b>© ООО
                                    «Энергосоюз», 2020</b> </p>
                        </div>
                    </div>

                </div>
            </div>



            </div>
            </div>
        </section>
    </footer>


    <script>
        $('.carousel').carousel(function() {
            interval: 1500;
        });
    </script>

    <script src="https://kit.fontawesome.com/09738bb7f2.js" crossorigin="anonymous"></script>
    <script src="http://code.jquery.com/jquery-latest.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.3/umd/popper.min.js" integrity="sha384-vFJXuSJphROIrBnz7yo7oB41mKfc8JzQZiCq4NCceLEaO4IHwicKwpJf9c9IpFgh" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.2/js/bootstrap.min.js" integrity="sha384-alpBpkh1PFOepccYVYDB4do5UnbKysX5WZXm3XxPqe5iKTfUKjNkCk9SaVuEZflJ" crossorigin="anonymous"></script>
    <script src="js/main.js"></script>




</body>

</html>