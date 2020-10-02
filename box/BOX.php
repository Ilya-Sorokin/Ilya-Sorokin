<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css"
        integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <link rel="stylesheet" href="css/main.css">

    <link
        href="https://fonts.googleapis.com/css2?family=Montserrat:wght@200;400;600&family=Open+Sans:wght@400;700&display=swap"
        rel="stylesheet">

    <title>Document</title>
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
                                <object type="image/svg+xml" data="img/letter-1.svg" width="20" height="20">
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
                                <object type="image/svg+xml" data="img/letter-1.svg" width="20" height="20">
                                    <img src="/img/letter-1.png" width="20" height="20" alt="image format png" />
                                </object>
                            </div>
                            <div>
                                <div>
                                    <span style="font-size: 14px;">Телефон</span>
                                    <p class="mb-0" style="font-size: 13px;"><strong><a href="tel:+7 131 101 1010">+7
                                                131 101 1010</a></strong></p>
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
                                    <p class="mb-0" style="font-size: 13px;"><strong><a
                                                href="unsafe:mail:office@enegoUnion.ru">office@enegoUnion.ru</a></strong>
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </header>

    <?php

    $form = 1;

    ?>

    <!-- TO DO: При пролистывании ввеху отступ создающий прозрачную щель -->

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
                                    <li class="nav-item"><a href="#" class="nav-link">Главная</a></li>
                                    <li class="nav-item"><a href="AboutUs.php" class="nav-link">О компании</a></li>
                                    <li class="nav-item"><a href="#"
                                            class="nav-link">Новости</a></li>
                                    <li class="nav-item"><a href="Services.php"
                                            class="nav-link">Услуги</a></li>
                                    <li class="nav-item"><a href="#" class="nav-link">Контакты</a></li>
                                </ul>
                            </div>

                            <form action="" class="ml-auto" style="margin-right: 10px;">
                            
                            <?php if($form == 1) {?>
                                <button class="btn btn-success" type="button" data-toggle="modal" data-target="#Modal">
                                    Авторизироваться
                                </button>
                                <!-- type="button"  -->
                            <?php }
                            
                            else { ?>
                                <a class="btn btn-success" href="AboutUs.php">
                                Личный кабинет
                                </a>
                            <?php };?>

                            </form>

                            <button class="navbar-toggler" type="button" data-toggle="collapse"
                                data-target="#navContent">
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
            <div class="modal-header">
                <h5 class="modal-title">Авторизация</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-12 justify-conten-center">
                <form action="">
                <div class="form-group">
                        <label for="exampleInputEmail1">Логин</label>
                        <input type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Email адресс">
                        <small id="emailHelp">Будущая подсказка 1</small>
                    </div>
                    </div>
                    <div class="col-12 justify-conten-center">
                    <div class="form-group">
                        <label for="exampleInputPassword1">пароль</label>
                        <input type="password" class="form-control" id="exampleInputPassword1" placeholder="пароль" aria-describedby="PassHelp">
                        <small id="PassHelp">Будущая подсказка 2</small>
                    </div>
                    </div>
                    <div class="col-12">
                    <div class="form-check">
                        <input type="checkbox" class="form-check-input" id="exampleCheck1">
                        <label class="form-check-label" for="exampleCheck1">Запомнить меня</label>
                    </div>
                    </div>
                </form>
                </div>
            </div>
            <div class="modal-footer justify-content-between">
                <button type="button" class="btn btn-primary">Save changes</button>
                <a href="#">Регестрация аккаунта</a>
            </div>
           </div>
       </div>
   </div>

<!-- ---------------------------------------------------Рабочая область--------------------------------------------------------------- -->
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
                                    <li class="breadcrumb-item"><a href="#" class="text-muted" >Главная</a></li>
                                    <li class="breadcrumb-item actve"><a href="#" class="text-muted" >О компании</a></li>
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
                            <div class="col-12">
                                

                            </div>
                        </div>
                    </div>
                </div>
            </section>

        </div>
    </main>
    
<!-- ---------------------------------------------------Рабочая область--------------------------------------------------------------- -->
 
    <footer>
        <section>
            <div class="footer bg-dark" role="footer">
                <div class="container  pt-5" " id=" footer">
                <div class="row pb-5">
                                <div class="col-3 justify-content-start mb-3 pt-3 pb-2">
                                    <div>
                                        <a href="/"><img alt="ЭНЕРГОСОЮЗ" height="80" width="140"
                                                src="img/logo 2.png"></a>
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
                                                <a href="#" class="text-muted">г. Краснодар ул.
                                                    Российская д. 47</a>
                                            </li>


                                            <li class=" textSize mb-2"><strong
                                                    class="fonts-Sans text-white ">Телефон:</strong> <a
                                                    href="tel:+7 131 101 1010" class="text-muted">+7 131 101 1010</a>
                                            </li>

                                            <li class="lead textSize mb-2"><strong
                                                    class="fonts-Sans text-white">Email:</strong> <a
                                                    href="unsafe:mail:office@enego.ru"
                                                    class="text-muted">office@enego.ru</a></li>

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
                                            <li class=" textSize mb-2 fonts-Sans "><a href="#" class="text-muted">О
                                                    компании</a></li>
                                            <li class=" textSize mb-2 fonts-Sans"><a href="#"
                                                    class="text-muted">Услуги</a></li>
                                            <li class=" textSize mb-2 fonts-Sans"><a href="#"
                                                    class="text-muted">Контакты</a></li>
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



    <script src="https://kit.fontawesome.com/09738bb7f2.js" crossorigin="anonymous"></script>

    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"
        integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN"
        crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.3/umd/popper.min.js"
        integrity="sha384-vFJXuSJphROIrBnz7yo7oB41mKfc8JzQZiCq4NCceLEaO4IHwicKwpJf9c9IpFgh"
        crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.2/js/bootstrap.min.js"
        integrity="sha384-alpBpkh1PFOepccYVYDB4do5UnbKysX5WZXm3XxPqe5iKTfUKjNkCk9SaVuEZflJ"
        crossorigin="anonymous"></script>
    <script src="js/main.js"></script>
</body>

</html>