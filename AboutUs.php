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

    <main>


        <div class="main" role="main">
            <section>
                <div style="background-color: #f1f3f7; border-color: #707070;">
                    <div class="container pt-5 pb-5">
                        <div class="row mb-4">
                            <div class="col-6  fonts-Montserrat text-start">
                                <b><strong>О компании</strong></b>
                            </div>
                            <div class="col-6 ">
                                <ul class="breadcrumb justify-content-end " style="background-color: #f1f3f7;">
                                    <li class="breadcrumb-item"><a href="index.php" class="text-muted">Главная</a></li>
                                    <li class="breadcrumb-item actve"><a href="AboutUs.php" class="text-muted">О компании</a></li>
                                </ul>
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
                                <div class="text-center">
                                    <small class="orangeRed_text">ИНФОРМАЦИЯ О НАС</small>
                                    <h2 class="mb-4 fonts-Montserrat">
                                        <b>ООО «Энергосоюз»</b>
                                    </h2>
                                </div>
                                <div class="fonts-Sans text-muted">
                                    <p class="mb-3 text-center">
                                        ООО «Энергосоюз», оказывает широкий спектр услуг своим клиентам на всей территории
                                        Краснодарского края уже более 15 лет.
                                    </p>
                                    <p class="mb-4 text-center">
                                        Мы обеспечиваем оказываем услуги по информационно-рассчётному
                                        обслуживанию организаций ресурсоснабжающих организаций работающих как в пределах Краснодарского края,
                                        так и по всей России
                                    </p>
                                    <p class="mb-4 text-center">
                                        Благодаря накопленному нами опыты ООО «Энергосоюз» является лидером в Краснодарском крае, по обслуживанию и
                                        замене приборов учета электро-энергии.
                                    </p>
                                    <p class="mb-4 text-center">
                                        А наши ресурсы позволяют нам оказывать услуги в таких видах деятельности как
                                        установка и настройка прибора учёта электроэнергии, Проведение испытаний и измерений системы электроснабжения жилого дома,
                                        проверка исправности электрической проводки, Устранение незначительных неисправностей электротехнических устройств,
                                        проверка мощности электроснабжения, укрепление электроприбора на высоте, программирование прибора учёта электрической энергии
                                    </p>
                                    <p class="mb-4 text-center">
                                        Также мы оказываем улуги по замене и настройке приборов учёта электро-энергии относящихся как однатарифному, двухтарифному,
                                        так и 3-х тарифному плану потребления электроэнергии. Нашим клиентам, зарегестрировавшим на данном сайте свою учётную запись
                                        мы прелагаем возможность оформить онлайн заявку на оказание наших услуг,
                                        а также предоставить свои показания по прибору учёта электроэнергии.
                                    </p>
                                    <p class="mb-4 text-center">
                                        <b>ВНИМАНИЕ!</b> Для абонентов ООО «Энергосоюз» проживающих в многокваритирных дамах «Энергосоюз»
                                        оказывает специальный пакет услуг по замене, настройке и обслуживанию приборов учёта во всем доме на основе
                                        заключаемого договора между жильзами дома и нашей компанией, всем жильцам данного дома ежемесечно будет приходить
                                        квитанция в упакованном конверте с логотипом ООО «Энергосоюз» для оплаты счетов электроэнергии, зарегестрированнм пользователям
                                        предоставляется возможность предворительно внести свои показания онлайн на данном сайте

                                    </p>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>
            </section>

            <!-- class="orangeRed_btn" -->
            <section style="background: linear-gradient(orange, #ff4500, red);">
                <div class="container">
                    <div class="row mb-5 px-3 px-sm-0">

                        <div class="col order-1 scale-0  p-0" style="z-index: 1; 
                        bottom: 25px;">
                            <img alt="" class="img-fluid" src="img/work-1.jpg"></div>

                        <div class="col order-2 scale-1  p-0 " style="z-index: 1; 
                        bottom: 40px;">
                            <img alt="" class="img-fluid" src="img/work-3.jpg"></div>

                        <div class="col order-3 scale-0 p-0" style="z-index: 1; 
                        bottom: 25px;">
                            <img alt="" class="img-fluid" src="img/work-2.jpg"></div>
                    </div>
                    <div class="row align-items-baseline mt-5">
                        <div class="col-lg-4">
                            <div>
                                <div class="pr-3 text-center">
                                    <object type="image/svg+xml" data="img/рост — желтая.svg" width="62" style="height: 62px; opacity: 1;">
                                    </object>
                                </div>
                                <div class="text-center">
                                    <h2 class="font-weight-bold text-light mb-3 fonts-Montserrat" style="font-size: 17.6px;">
                                        Высокое качество исполнения
                                    </h2>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-4">
                            <div>
                                <div class=" pr-3 text-center">
                                    <object type="image/svg+xml" data="img/Лампа — желтая.svg" width="82" style="height: 82px; opacity: 1;">
                                    </object>
                                </div>
                                <div class="text-center">
                                    <h2 class="font-weight-bold text-light mb-3 fonts-Montserrat" style="font-size: 17.6px;">
                                        Качественное и сертифицированное оборудование!
                                    </h2>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-4">
                            <div>
                                <div class="pr-3 text-center">
                                    <object type="image/svg+xml" data="img/Качество — желтая.svg" width="62" style="height: 62px; opacity: 1;">
                                    </object>
                                </div>
                                <div class="text-center">
                                    <h2 class="font-weight-bold text-light mb-3 fonts-Montserrat" style="font-size: 17.6px;">
                                        Гарантия на все виды оказываемых нами услуг
                                    </h2>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>

            <section name="Company">
                <div class="bg-light">
                    <div class="container pt-5 pb-5">
                        <div class="row pt-5 pb-5 justify-content-center">
                            <div class="col-12 pb-3 pt-5 text-center text-dark fonts-Montserrat">
                                <em><strong>Предлагаем вам ознакомиться с перечнем наших услуг</strong></em>
                            </div>
                            <div class="col-12  pb-5 fonts-Sans" style="text-align: center">
                                <a type="button" href="Services.php" class="btn btn-lg py-2 px-3 orangeRed_btn btn-circle">
                                    Наши услуги
                                </a>
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