<?php
header("Content-Type: text/html; charset=utf-8");




//----------------------------------------------Формирование страниц сайта------------------------------------------------------


function Add_Header()
{
    echo "<header id='header' style='min-height: 106px;'>
    <div style='top: 0px; position: static;'>

        <div class='container'>
            <div class='row'>
                <div class='col-3 pr-5 justify-content-start'>
                    <div>
                        <a href='/'><img alt='ЭНЕРГОСОЮЗ' height='100' width='190' src='img/logo 2.png'>
                        </a>
                    </div>
                </div>
                <div class='col-9 d-flex justify-content-end align-items-center'>
                    <div class='d-none d-md-flex mr-4'>
                        <div class='pr-4'>
                            <object type='image/svg+xml' data='img/map-marker.svg' width='20' height='20'>
                                <img src='/img/letter-1.png' width='20' height='20' alt='image format png' />
                            </object>
                        </div>
                        <div>
                            <span style='font-size: 14px;'>Адрес</span>
                            <p class='mb-0' style='font-size: 13px;'><strong>г. Краснодар, ул. Российская, д.
                                    47</strong></p>
                        </div>
                    </div>
                    <div class='d-none d-lg-flex d mr-4'>
                        <div class='pr-2'>
                            <object type='image/svg+xml' data='img/mobile.svg' width='20' height='20'>
                                <img src='/img/letter-1.png' width='20' height='20' alt='image format png' />
                            </object>
                        </div>
                        <div>
                            <div>
                                <span style='font-size: 14px;'>Телефон</span>
                                <p class='mb-0' style='font-size: 13px;'><strong><a class='orangeRed_text' href='tel:+7 101 101 1010'>+7 101 101 1010</a></strong></p>
                            </div>
                        </div>
                    </div>
                    <div class='d-none d-sm-flex'>
                        <div class='pr-2'>
                            <object type='image/svg+xml' data='img/letter-1.svg' width='20' height='20'>
                                <img src='/img/letter-1.png' width='20' height='20' alt='image format png' />
                            </object>
                        </div>
                        <div>
                            <div>
                                <span style='font-size: 14px;'>E-mail</span>
                                <p class='mb-0' style='font-size: 13px;'><strong><a class='orangeRed_text' href='unsafe:mail:office.energo@click.com'>office.energo@click.com</a></strong>
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</header>";
}



function Add_Footer()
{
    echo "<footer>
    <section>
        <div class='footer bg-dark' role='footer'>
            <div class='container  pt-5' ' id=' footer'>
            <div class='row pb-5'>
                            <div class='col-3 justify-content-start mb-3 pt-3 pb-2'>
                                <div>
                                    <a href='/'><img alt='ЭНЕРГОСОЮЗ' height='80' width='140'
                                            src='img/logo 2.png'></a>
                                </div>
                            </div>

                            <div class='col-lg-4 ml-auto mb-4 mb-lg-0'>
                                <div>

                                    <ul style='list-style-type : square'>
                                        <li class='caption notStyle mb-3 text-white'>
                                            <h4>Контакты:</h4>
                                        </li>
                                        <li class=' textSize mb-2'>
                                            <address></address><strong class='fonts-Sans text-white'>Адрес:</strong>
                                            <a href='contacts.php' class='text-muted'>г. Краснодар ул.
                                                Российская д. 47</a>
                                        </li>


                                        <li class=' textSize mb-2'><strong
                                                class='fonts-Sans text-white '>Телефон:</strong> <a
                                                href='tel:+7 101 101 1010' class='text-muted'>+7 101 101 1010</a>
                                        </li>

                                        <li class='lead textSize mb-2'><strong
                                                class='fonts-Sans text-white'>Email:</strong> <a
                                                href='unsafe:mail:office.energo@click.com'
                                                class='text-muted'>office.energo@click.com</a></li>

                                    </ul>
                                </div>
                            </div>
                            <div class='col-lg-3'>
                                <div>
                                    <ul style='list-style-type : square'>
                                        <li class='caption notStyle mb-3 text-white'>
                                            <h4>Быстрые
                                                ссылки:</h4>
                                        </li>
                                        <li class=' textSize mb-2 fonts-Sans '><a href='AboutUs.php' class='text-muted'>О
                                                компании</a></li>
                                        <li class=' textSize mb-2 fonts-Sans'><a href='Services.php'
                                                class='text-muted'>Услуги</a></li>
                                        <li class=' textSize mb-2 fonts-Sans'><a href='contacts.php'
                                                class='text-muted'>Контакты</a></li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                        <div class='row pb-2'>
                            <div class='col-12 text-center'>
                                <p class='text-md-right pb-0 mb-0 fonts-Sans text-muted pr-5 '><b>© ООО
                                        «Энергосоюз», 2020</b> </p>
                            </div>
                        </div>

                    </div>
                </div>



            </div>
        </div>
    </section>
</footer>";
}

//----------------------------------------------END <Формирование страниц сайта> END------------------------------------------------------


//---------------------------------------------- <Логика EDIT страниц сайта> ------------------------------------------------------

//----------------------------------------------------------- <EDIT_TYPET.PHP> ------------------------------------------------------


/*SELECT ПОЛУЧЕНИЕ УСЛУГ НА EDIT_TYPET.PHP */
function get_options($table)
{
    $table = $table;

    // обращение к глобалььной переменной для соединения с БД
    global $connect;
    // созд. запроса
    $query = "SELECT * FROM `$table`";
    // отправка запроса (mysqli_query(СТРОКА ПОДКЛЮЧЕНИЯ, ЗАПРОС) = ОТПРАВКА)
    $res = mysqli_query($connect, $query);
    // массив в который будет помещен ассоцюмассив(преобразованный отв.серв)
    $options = array();
    // ЦИКЛОМ ПОСТРОЧНО ЗАПИХИВАЕМ В МАССИВ И ВОЗВРОЩАЕМ 
    // ($row['id' чтобы у ассоц.массива были имена масивов масиввов в виде id, а не индекса)
    if ($res === FALSE) {
        die(mysqli_error($connect)); // если ошибка, узнаем
    }

    while ($row = mysqli_fetch_assoc($res)) {
        $options[$row['id']] = $row;
    }
    return $options;
}




/*DELETE НА EDIT_TYPET.PHP */
function del_option($table)
{

    $table = $table;

    global $connect;

    $id = (int) $_POST['id'];

    //  ЗАПРОС
    $query = "DELETE FROM `$table` WHERE `id` = '$id'";

    $res = mysqli_query($connect, $query);

    if ($res === FALSE) {
        die(mysqli_error($connect)); // если ошибка, узнаем
    }

    // ПРОВЕРКА: кОЛИЧЕСТВО СТРОК ИЗМЕННЕНЫХ
    if (mysqli_affected_rows($connect)) {
        return true;
    } else {
        return false;
    }
}



/* UPDATE (НА ЛЕТУ) НА EDIT_TYPET.PHP (если будет true)*/
function update_option($table)
{
    //     1) берем глоб.db - соединение
    global $connect;
    //  ПОЛУЧЕНИЕ ПЕРЕМЕННЫХ
    //имя таблицы
    $table = $table;
    //в field имя поля
    $field = $_POST['field'];
    //     2) в переменную value помещаем значение $_POST[new_val] фильтруя спец символы
    $value = mysqli_real_escape_string($connect, $_POST['new_val']);
    //     3) id возможен только числовое, приведение
    $id = (int) $_POST['id'];
    //  ЗАПРОС
    $query = "UPDATE `$table` SET $field = '$value' WHERE `id` = '$id'";

    $res = mysqli_query($connect, $query);

    if ($res === FALSE) {
        die(mysqli_error($connect)); // если ошибка, узнаем
    }

    // ПРОВЕРКА: кОЛИЧЕСТВО СТРОК затронутых последним INSERT, UPDATE, DELETE.
    if (mysqli_affected_rows($connect)) {
        return true;
    } else {
        return false;
    }
}


/* ПОЛУЧЕНИЕ МАССИВА-СТРОКИ ДЛЯ UPDATE-2 НА EDIT_TYPET.PHP*/
function update_str_option($table)
{

    global $connect;

    $table = $table;

    $id = (int) $_POST['id'];

    $query = "SELECT * FROM `$table` WHERE `id` = '$id'";
    $res = mysqli_query($connect, $query);


    if ($res === FALSE) {
        die(mysqli_error($connect)); // если ошибка, узнаем
    }

    // массив в который будет помещен ассоцюмассив(преобразованный отв.серв)
    $options = array();
    // ЦИКЛОМ ПОСТРОЧНО ЗАПИХИВАЕМ В МАССИВ И ВОЗВРОЩАЕМ 
    // ($row['id' чтобы у ассоц.массива были имена масивов масиввов в виде id, а не индекса)
    while ($row = mysqli_fetch_assoc($res)) {
        $options[$row['id']] = $row;
    }

    if (mysqli_affected_rows($connect)) {
        return $options;
    } else {
        return false;
    }
}


/* UPDATE-2 НА EDIT_TYPET.PHP */
function update_2($table)
{
    global $connect;
    $table = $table;
    $id = (int) $_POST['id'];
    $Up_type = $_POST['Up_type'];
    $Up_check = $_POST['Up_check'];

    //  в переменную Up_type помещаем значение $_POST[Up_type] фильтруя спец символы
    $Up_type = mysqli_real_escape_string($connect, $_POST['Up_type']);
    //  id возможен только числовое, приведение
    //$id = (int) $_POST['id'];
    //  ЗАПРОС
    $query = "UPDATE `$table` SET `type` = '$Up_type', `status` = '$Up_check' WHERE `typet`.`id` = '$id'";

    $res = mysqli_query($connect, $query);


    if ($res === FALSE) {
        die(mysqli_error($connect)); // если ошибка, узнаем
    }

    // ПРОВЕРКА: кОЛИЧЕСТВО СТРОК затронутых последним INSERT, UPDATE, DELETE.
    if (mysqli_affected_rows($connect)) {
        return true;
    } else {
        return false;
    }
}

/* ADD НА EDIT_TYPET.PHP */
function Add_option($table)
{

    global $connect;
    $table = $table;
    $id = (int) $_POST['id'];
    $Add_type = $_POST['Add_type'];
    $Add_status = $_POST['Add_status'];

    $Add_type = mysqli_real_escape_string($connect, $_POST['Add_type']);

    $query = "INSERT INTO `$table` (`id`, `type`, `status`) VALUES (NULL, '$Add_type', '$Add_status')";
    $res = mysqli_query($connect, $query);


    if ($res === FALSE) {
        die(mysqli_error($connect)); // если ошибка, узнаем
    }

    $id_last_type3 = mysqli_query($connect, "SELECT * FROM `typet` WHERE `id`=LAST_INSERT_ID();");
    $id_last_type2 = mysqli_fetch_assoc($id_last_type3); //Нужно было преобразовать в ассоц-массив
    $id_last_type = $id_last_type2['id'];
    // ПРОВЕРКА: кОЛИЧЕСТВО СТРОК затронутых последним INSERT, UPDATE, DELETE.

    // ПРОВЕРКА: кОЛИЧЕСТВО СТРОК затронутых последним INSERT, UPDATE, DELETE.
    if (mysqli_affected_rows($connect)) {
        return $id_last_type;
    } else {
        return false;
    }
}





//----------------------------------------------------------- <EDIT_USER.PHP> ------------------------------------------------------




function Add_option_user($table)
{

    global $connect;
    $table = $table;

    $Add_surname = $_POST['Add_surname'];
    $Add_first_name = $_POST['Add_first_name'];
    $Add_last_name = $_POST['Add_last_name'];
    $Add_login = $_POST['Add_login'];
    $Add_email = $_POST['Add_email'];
    $Add_Password = $_POST['Add_Password'];
    $Add_status = $_POST['Add_status'];
    $Add_telephone = $_POST['Add_telephone'];

    // Хешируем пароль
    $Add_Password = md5($Add_Password);

    $path = 'uploads/' . time() . $_FILES['image']['name'];

    //если ошибка при загрузке изображения
    if (!move_uploaded_file($_FILES['image']['tmp_name'], $path)) {
        return false;
    }


    $query = "INSERT INTO `user` (`id`, `first_name`, `surname`, `last_name`, `login`, `password`, `email`, `telephone`, `avatar`, `status`) VALUES (NULL, '$Add_first_name', '$Add_surname', '$Add_last_name', '$Add_login', '$Add_Password', '$Add_email', '$Add_telephone', '$path', '$Add_status');";
    $res = mysqli_query($connect, $query);


    if ($res === FALSE) {
        die(mysqli_error($connect)); // если ошибка, узнаем
    }


    // ПРОВЕРКА: кОЛИЧЕСТВО СТРОК затронутых последним INSERT, UPDATE, DELETE.
    if (mysqli_affected_rows($connect)) {
        return true;
    } else {
        return false;
    }
}





function Update_option_user($table)
{


    global $connect;
    $table = $table;

    // formData.append("imageUp", $("#Up_file")[0].files[0]);

    $Up_surname = $_POST['Up_surname'];
    $Up_first_name = $_POST['Up_first_name'];
    $Up_last_name = $_POST['Up_last_name'];

    $Up_login = $_POST['Up_login'];
    $Up_Password = $_POST['Up_Password'];
    $Up_email = $_POST['Up_email'];
    $Up_telephone = $_POST['Up_telephone'];
    $Up_status = $_POST['Up_status'];
    $Up_id = $_POST['id'];
    // ПЕРЕМЕННАЯ(ДОП.ДАННЫЕ) КОТОРАЯ БЫЛА ОПРЕДЕЛЕНА СРАВНЕНИЕМ ПОМЕНЯЛСЯ ЛИ ПАРОЛЬ В МОДАЛЬНОМ ОКНЕ ИЗМЕНЕНИЯ, ЕСЛИ НЕТ ПЕРЕМЕННАЯ = 0
    $Pass = $_POST['Pass'];
    //ХЕШИРУЕМ ПОЛУЧЕННЫЙ ПАРОЛЬ, ЕСЛИ ОН БЫЛ ИЗМЕНЕН
    if ($Pass == 1) {
        $Up_Password = md5($Up_Password);
    }

    $path = 'uploads/' . time() . $_FILES['imageUp']['name'];

    //если ошибка при загрузке изображения
    if (!move_uploaded_file($_FILES['imageUp']['tmp_name'], $path)) {
        return false;
    }

    $query = "UPDATE user SET `surname` = '$Up_surname', `first_name` = '$Up_first_name', `last_name` = '$Up_last_name', `login` = '$Up_login', `password` = '$Up_Password', `email` = '$Up_email', `telephone` = '$Up_telephone', `avatar` = '$path', `status` = '$Up_status' WHERE `id` = '$Up_id';";
    $res = mysqli_query($connect, $query);


    if ($res === FALSE) {
        die(mysqli_error($connect)); // если ошибка, узнаем
    }


    // ПРОВЕРКА: кОЛИЧЕСТВО СТРОК затронутых последним INSERT, UPDATE, DELETE.
    if (mysqli_affected_rows($connect)) {
        return true;
    } else {
        return false;
    }
}

//----------------------------------------------------------- <EDIT_HOME.PHP> ------------------------------------------------------


function get_options_home()
{

    // обращение к глобальной переменной-соединения
    global $connect;
    // созд. запроса
    $query = "SELECT home.`id`, user.`login`, home.`city`, home.`section`, home.`street`, home.`house`, home.`flat`, home.`year`, home.`floor`, home.`area` FROM `home` JOIN `user` ON (user.`id` = home.`id_user`);";
    // SELECT * FROM `$table`";
    // отправка запроса
    $res = mysqli_query($connect, $query);
    // массив в который будет помещен ассоцюмассив(преобразованный отв.серв)
    $options = array();
    // ЦИКЛОМ ПОСТРОЧНО ЗАПИХИВАЕМ В МАССИВ И ВОЗВРОЩАЕМ 
    // ($row['id' чтобы у ассоц.массива были имена масивов масиввов в виде id, а не индекса)
    if ($res === FALSE) {
        die(mysqli_error($connect)); // если ошибка, узнаем
    }

    while ($row = mysqli_fetch_assoc($res)) {
        $options[$row['id']] = $row;
    }
    return $options;

    
}


function Add_option_home($table)
{

    global $connect;
    $table = $table;

    $Add_section = $_POST['Add_section'];
    $Add_street = $_POST['Add_street'];
    $Add_house = $_POST['Add_house'];
    $Add_flat = $_POST['Add_flat'];
    $Add_login = $_POST['Add_login'];
    $Add_year = $_POST['Add_year'];
    $Add_floor = $_POST['Add_floor'];
    $Add_area = $_POST['Add_area'];


    $query = "INSERT INTO `home`(`id`, `id_user`, `city`, `section`, `street`, `house`, `flat`, `year`, `floor`, `area`) VALUES (NULL, '$Add_login', 'Краснодар', '$Add_section', '$Add_street', '$Add_house', '$Add_flat', '$Add_year', '$Add_floor','$Add_area')";
    $res = mysqli_query($connect, $query);


    if ($res === FALSE) {
        die(mysqli_error($connect)); // если ошибка, узнаем
    }


    // ПРОВЕРКА: кОЛИЧЕСТВО СТРОК затронутых последним INSERT, UPDATE, DELETE.
    if (mysqli_affected_rows($connect)) {
        return true;
    } else {
        return false;
    }
}


function Update_option_home($table)
{


    global $connect;
    $table = $table;


    $Up_section = $_POST['Up_section'];
    $Up_street = $_POST['Up_street'];
    $Up_house = $_POST['Up_house'];
    $Up_flat = $_POST['Up_flat'];
    $Up_year = $_POST['Up_year'];
    $Up_floor = $_POST['Up_floor'];
    $Up_area = $_POST['Up_area'];
    $Up_login = $_POST['Up_login'];
    $Up_id = $_POST['id'];


    $query = "UPDATE `home` SET `id_user`='$Up_login',`city`='Краснодар',`section`='$Up_section',`street`='$Up_street',`house`='$Up_house',`flat`='$Up_flat',`year`='$Up_year',`floor`='$Up_floor',`area`='$Up_area' WHERE `id` = '$Up_id'";
    $res = mysqli_query($connect, $query);


    if ($res === FALSE) {
        die(mysqli_error($connect)); // если ошибка, узнаем
    }


    // ПРОВЕРКА: кОЛИЧЕСТВО СТРОК затронутых последним INSERT, UPDATE, DELETE.
    if (mysqli_affected_rows($connect)) {
        return true;
    } else {
        return false;
    }
}

//----------------------------------------------------------- <EDIT_NEWS.PHP> ------------------------------------------------------

/* ВЫВОД ДАННЫХ В ТАБЛИЦУ ДЛЯ ТАБЛИЦЫ NEWS */
function get_options_news()
{

    // обращение к глобалььной(не из фун) переменной-соединения surname
    global $connect;
    // созд. запроса (LIMIT УСТАНОВИЛ Т.К ЗАПРОС ВОЗВРАЩАЕТ БОЛЕЕ ОДНОЙ СТРОКИ - ОШИБКА)
    $query = "SELECT 
    news.`id`, 
    news.`header`, 
    news.`text`, 
    news.`content`, 
    news.`img`, 
    personal.surname, 
    news.`status`, 
    news.`period` 
FROM `news`
JOIN personal ON (personal.id = news.id_employee)";
    // SELECT * FROM `$table`";
    // отправка запроса
    $res = mysqli_query($connect, $query);
    // массив в который будет помещен ассоцюмассив(преобразованный отв.серв)
    $options = array();
    // ЦИКЛОМ ПОСТРОЧНО ЗАПИХИВАЕМ В МАССИВ И ВОЗВРОЩАЕМ 
    // ($row['id' чтобы у ассоц.массива были имена масивов масиввов в виде id, а не индекса)
    if ($res === FALSE) {
        die(mysqli_error($connect)); // если ошибка, узнаем
    }

    while ($row = mysqli_fetch_assoc($res)) {
        $options[$row['id']] = $row;
    }
    return $options;
}



/* ADD НА EDIT_TYPET.PHP -------- НУЖНО ДОДЕЛАТЬ (ДОБАВЛЕНИЕ ФОТО)*/
function Add_option_news($table)
{

    global $connect;
    $table = $table;

    $Add_header = $_POST['Add_header'];
    $Add_text = $_POST['Add_text'];
    $Add_content = $_POST['Add_content'];
    $Add_date = $_POST['Add_date'];
    $Add_surname = $_POST['Add_surname'];
    $Add_status = $_POST['Add_status'];


    $Add_text = mysqli_real_escape_string($connect, $_POST['Add_text']);
    $Add_header = mysqli_real_escape_string($connect, $_POST['Add_header']);
    $Add_content = mysqli_real_escape_string($connect, $_POST['Add_content']);



    $path = 'uploads/' . time() . $_FILES['image']['name'];

    //если ошибка при загрузке изображения
    if (!move_uploaded_file($_FILES['image']['tmp_name'], $path)) {
        return false;
    }

    $query = "INSERT INTO `news` (`id`, `img`, `header`, `text`, `content`, `status`, `id_employee`, `period`) VALUES (NULL, '$path', '$Add_header', '$Add_text', '$Add_content', '$Add_status', '$Add_surname', '$Add_date')";
    $res = mysqli_query($connect, $query);


    if ($res === FALSE) {
        die(mysqli_error($connect)); // если ошибка, узнаем
    }


    // ПРОВЕРКА: кОЛИЧЕСТВО СТРОК затронутых последним INSERT, UPDATE, DELETE.
    if (mysqli_affected_rows($connect)) {
        return true;
    } else {
        return false;
    }
}

function Update_option_news($table)
{
    // update news t1 join personal t2 on t2.id = t1.id_employee set t1.id_employee = 2 where t1.id = 34;

    // formData.append("imageUp", $("#Up_file")[0].files[0]);

    global $connect;
    $table = $table;

    $Up_header = $_POST['Up_header'];
    $Up_text = $_POST['Up_text'];
    $Up_content = $_POST['Up_content'];
    $Up_date = $_POST['Up_date'];
    $Up_surname = $_POST['Up_surname'];
    $Up_status = $_POST['Up_status'];
    $Up_id = $_POST['id'];


    $Up_text = mysqli_real_escape_string($connect, $_POST['Up_text']);
    $Up_header = mysqli_real_escape_string($connect, $_POST['Up_header']);
    $Up_content = mysqli_real_escape_string($connect, $_POST['Up_content']);


    $path = 'uploads/' . time() . $_FILES['imageUp']['name'];

    //если ошибка при загрузке изображения
    if (!move_uploaded_file($_FILES['imageUp']['tmp_name'], $path)) {
        return false;
    }

    $query = "UPDATE news SET `img` = '$path', `header` = '$Up_header', `text` = '$Up_text', `content` = '$Up_content', `status` = '$Up_status', `id_employee` = '$Up_surname', `period` = '$Up_date' WHERE `id` = '$Up_id';";
    $res = mysqli_query($connect, $query);


    if ($res === FALSE) {
        die(mysqli_error($connect)); // если ошибка, узнаем
    }


    // ПРОВЕРКА: кОЛИЧЕСТВО СТРОК затронутых последним INSERT, UPDATE, DELETE.
    if (mysqli_affected_rows($connect)) {
        return true;
    } else {
        return false;
    }
}




//----------------------------------------------------------- <EDIT_ELECTRO.PHP> ------------------------------------------------------

/* ВЫВОД ДАННЫХ В ТАБЛИЦУ ДЛЯ ТАБЛИЦЫ NEWS */
function get_options_electro()
{

    // обращение к глобалььной(не из фун) переменной-соединения surname
    global $connect;
    // созд. запроса (LIMIT УСТАНОВИЛ Т.К ЗАПРОС ВОЗВРАЩАЕТ БОЛЕЕ ОДНОЙ СТРОКИ - ОШИБКА)
    $query = "SELECT  electro.`id`, electro.`date`, electro.`T1`, electro.`T2`, electro.`T3`, home.section, home.`street`, home.`house`, home.`flat`, electro.`tariffCount` FROM `electro` JOIN home ON (home.id = electro.id_home);";
    // SELECT * FROM `$table`";
    // отправка запроса
    $res = mysqli_query($connect, $query);
    // массив в который будет помещен ассоцюмассив(преобразованный отв.серв)
    $options = array();
    // ЦИКЛОМ ПОСТРОЧНО ЗАПИХИВАЕМ В МАССИВ И ВОЗВРОЩАЕМ 
    // ($row['id' чтобы у ассоц.массива были имена масивов масиввов в виде id, а не индекса)
    if ($res === FALSE) {
        die(mysqli_error($connect)); // если ошибка, узнаем
    }

    while ($row = mysqli_fetch_assoc($res)) {
        $options[$row['id']] = $row;
    }
    return $options;
}




function Add_option_electro($table)
{

    global $connect;
    $table = $table;


    $Add_T1 = $_POST['Add_T1'];
    $Add_T2 = $_POST['Add_T2'];
    $Add_T3 = $_POST['Add_T3'];
    $Add_date = $_POST['Add_date'];
    $Add_home = $_POST['Add_home'];

    $query = "INSERT INTO `electro` (`id`, `id_home`, `date`, `T1`, `T2`, `T3`) VALUES (NULL, '$Add_home', '$Add_date', '$Add_T1', '$Add_T2', '$Add_T3')";
    $res = mysqli_query($connect, $query);


    if ($res === FALSE) {
        die(mysqli_error($connect)); // если ошибка, узнаем
    }


    // ПРОВЕРКА: кОЛИЧЕСТВО СТРОК затронутых последним INSERT, UPDATE, DELETE.
    if (mysqli_affected_rows($connect)) {
        return true;
    } else {
        return false;
    }
}



function Update_option_electro($table)
{

    global $connect;
    $table = $table;

    $Up_T1 = $_POST['Up_T1'];
    $Up_T2 = $_POST['Up_T2'];
    $Up_T3 = $_POST['Up_T3'];
    $Up_date = $_POST['Up_date'];
    $Up_home = $_POST['Up_home'];
    $Up_id = $_POST['id'];



    $query = "UPDATE electro SET `id_home` = '$Up_home', `date` = '$Up_date', `T1` = '$Up_T1', `T2` = '$Up_T2', `T3` = '$Up_T3' WHERE `id` = '$Up_id';";
    $res = mysqli_query($connect, $query);


    if ($res === FALSE) {
        die(mysqli_error($connect)); // если ошибка, узнаем
    }


    // ПРОВЕРКА: кОЛИЧЕСТВО СТРОК затронутых последним INSERT, UPDATE, DELETE.
    if (mysqli_affected_rows($connect)) {
        return true;
    } else {
        return false;
    }
}

//----------------------------------------------------------- <EDIT_ORDERS.PHP> ------------------------------------------------------

/* ВЫВОД ДАННЫХ В ТАБЛИЦУ ДЛЯ ТАБЛИЦЫ NEWS */
function get_options_orders()
{

    // обращение к глобалььной(не из фун) переменной-соединения surname
    global $connect;
    // созд. запроса (LIMIT УСТАНОВИЛ Т.К ЗАПРОС ВОЗВРАЩАЕТ БОЛЕЕ ОДНОЙ СТРОКИ - ОШИБКА)
    $query = "SELECT  orders.`id`, typet.`type`, orders.`phone`, home.`section`, home.`street`, home.`house`, home.`flat`, personal.`surname`, orders.`date`, orders.`date2` FROM `orders` JOIN home ON (home.id = orders.id_home) JOIN personal ON (personal.id = orders.id_employee) JOIN typet ON (typet.id = orders.id_typet);";
    // SELECT * FROM `$table`";
    // отправка запроса
    $res = mysqli_query($connect, $query);
    // массив в который будет помещен ассоцюмассив(преобразованный отв.серв)
    $options = array();
    // ЦИКЛОМ ПОСТРОЧНО ЗАПИХИВАЕМ В МАССИВ И ВОЗВРОЩАЕМ 
    // ($row['id' чтобы у ассоц.массива были имена масивов масиввов в виде id, а не индекса)
    if ($res === FALSE) {
        die(mysqli_error($connect)); // если ошибка, узнаем
    }

    while ($row = mysqli_fetch_assoc($res)) {
        $options[$row['id']] = $row;
    }
    return $options;
}



function Add_option_orders($table)
{
    global $connect;
    $table = $table;

    $Add_phone = $_POST['Add_phone'];
    $Add_home = $_POST['Add_home'];
    $Add_typet = $_POST['Add_typet'];
    $Add_date = $_POST['Add_date'];
    $Add_employee = $_POST['Add_employee'];
    $Add_date2 = $_POST['Add_date2'];
    $table = $_POST['table'];

    $query = "INSERT INTO `orders`(`id`, `date`, `date2`, `id_home`, `phone`, `id_typet`, `id_employee`) VALUES (NULL,'$Add_date','$Add_date2','$Add_home','$Add_phone','$Add_typet','$Add_employee')";
    $res = mysqli_query($connect, $query);

    if ($res === FALSE) {
        die(mysqli_error($connect)); // если ошибка, узнаем
    }

    // ПРОВЕРКА: кОЛИЧЕСТВО СТРОК затронутых последним INSERT, UPDATE, DELETE.
    if (mysqli_affected_rows($connect)) {
        return true;
    } else {
        return false;
    }
}


function Update_option_orders($table)
{

    global $connect;
    $table = $table;

    $Up_phone = $_POST['Up_phone'];
    $Up_home = $_POST['Up_home'];
    $Up_typet = $_POST['Up_typet'];
    $Up_date = $_POST['Up_date'];
    $Up_employee = $_POST['Up_employee'];
    $Up_date2 = $_POST['Up_date2'];
    $Up_id = $_POST['id'];

    $query = "UPDATE orders SET `date` = '$Up_date', `date2` = '$Up_date2', `id_home` = '$Up_home', `phone` = '$Up_phone', `id_typet` = '$Up_typet', `id_employee` = '$Up_employee' WHERE `id` = '$Up_id';";
    $res = mysqli_query($connect, $query);


    if ($res === FALSE) {
        die(mysqli_error($connect)); // если ошибка, узнаем
    }


    // ПРОВЕРКА: кОЛИЧЕСТВО СТРОК затронутых последним INSERT, UPDATE, DELETE.
    if (mysqli_affected_rows($connect)) {
        return true;
    } else {
        return false;
    }
}
//---------------------------------------------- < EDIT_PERSONAL.PHP> ------------------------------------------------------

/* ADD НА EDIT_PERSONAL.PHP -------- НУЖНО ДОДЕЛАТЬ (ДОБАВЛЕНИЕ ФОТО)*/
function Add_option_personal($table)
{

    global $connect;
    $table = $table;

    $Add_surname = $_POST['Add_surname'];
    $Add_first_name = $_POST['Add_first_name'];
    $Add_last_name = $_POST['Add_last_name'];
    $Add_vacant = $_POST['Add_vacant'];
    $Add_education = $_POST['Add_education'];
    $Add_experience = $_POST['Add_experience'];
    $Add_telephone = $_POST['Add_telephone'];

    $path = 'uploads/' . time() . $_FILES['image']['name'];

    //если ошибка при загрузке изображения
    if (!move_uploaded_file($_FILES['image']['tmp_name'], $path)) {
        return false;
    }


    $query = "INSERT INTO `personal` (`id`, `first_name`, `surname`, `last_name`, `vacant`, `education`, `experience`, `telephone`, `avatar`) VALUES (NULL, '$Add_first_name', '$Add_surname', '$Add_last_name', '$Add_vacant', '$Add_education', '$Add_experience', '$Add_telephone', '$path')";
    $res = mysqli_query($connect, $query);


    if ($res === FALSE) {
        die(mysqli_error($connect)); // если ошибка, узнаем
    }


    // ПРОВЕРКА: кОЛИЧЕСТВО СТРОК затронутых последним INSERT, UPDATE, DELETE.
    if (mysqli_affected_rows($connect)) {
        return true;
    } else {
        return false;
    }
}


function Update_option_personal($table)
{
    global $connect;
    $table = $table;


    $Up_surname = $_POST['Up_surname'];
    $Up_first_name = $_POST['Up_first_name'];
    $Up_last_name = $_POST['Up_last_name'];
    $Up_vacant = $_POST['Up_vacant'];
    $Up_education = $_POST['Up_education'];
    $Up_experience = $_POST['Up_experience'];
    $Up_telephone = $_POST['Up_telephone'];
    $Up_id = $_POST['id'];


    $path = 'uploads/' . time() . $_FILES['imageUp']['name'];

    //если ошибка при загрузке изображения
    if (!move_uploaded_file($_FILES['imageUp']['tmp_name'], $path)) {
        return false;
    }

    $query = "UPDATE personal SET `first_name` = '$Up_first_name', `surname` = '$Up_surname', `last_name` = '$Up_last_name', `vacant` = '$Up_vacant', `education` = '$Up_education', `experience` = '$Up_experience', `telephone` = '$Up_telephone', `avatar` = '$path' WHERE `id` = '$Up_id';";
    $res = mysqli_query($connect, $query);


    if ($res === FALSE) {
        die(mysqli_error($connect)); // если ошибка, узнаем
    }


    // ПРОВЕРКА: кОЛИЧЕСТВО СТРОК затронутых последним INSERT, UPDATE, DELETE.
    if (mysqli_affected_rows($connect)) {
        return true;
    } else {
        return false;
    }
}

//---------------------------------------------- END <Логика EDIT страниц сайта> END ------------------------------------------------------








//----------------------------------------------  <Логика PROFILE сайта>  ------------------------------------------------------

/*SELECT ПОЛУЧЕНИЕ СОБСВЕННОСТИ КЛИЕНТА */
function get_home_user($id)
{
    $id = $id;

    // обращение к глобалььной(не из фун) переменной-соединения
    global $connect;
    // созд. запроса
    $query = "SELECT * FROM `home` WHERE `id_user` = '$id' LIMIT 1";
    // отправка запроса
    $res = mysqli_query($connect, $query);
    // массив в который будет помещен ассоцюмассив(преобразованный отв.серв)
    $options = array();
    // ЦИКЛОМ ПОСТРОЧНО ЗАПИХИВАЕМ В МАССИВ И ВОЗВРОЩАЕМ 
    // ($row['id' чтобы у ассоц.массива были имена масивов масиввов в виде id, а не индекса)
    if ($res === FALSE) {
        die(mysqli_error($connect)); // если ошибка, узнаем
    }

    while ($row = mysqli_fetch_assoc($res)) {
        $options[$row['id']] = $row;
    }
    return $options;
}


/*SELECT ПОЛУЧЕНИЕ ДАННЫХ КЛИЕНТА В ПРОФИЛЬ*/
function get_user($id)
{

    $id = $id;

    // обращение к глобалььной(не из фун) переменной-соединения
    global $connect;
    // созд. запроса
    $query = "SELECT * FROM `user` WHERE `id` = '$id'";
    // отправка запроса
    $res = mysqli_query($connect, $query);
    // массив в который будет помещен ассоцюмассив(преобразованный отв.серв)
    $options = array();
    // ЦИКЛОМ ПОСТРОЧНО ЗАПИХИВАЕМ В МАССИВ И ВОЗВРОЩАЕМ 
    // ($row['id' чтобы у ассоц.массива были имена масивов масиввов в виде id, а не индекса)
    if ($res === FALSE) {
        die(mysqli_error($connect)); // если ошибка, узнаем
    }

    while ($row = mysqli_fetch_assoc($res)) {
        $options[$row['id']] = $row;
    }
    return $options;
}

/*РЕДАКТИРОВАНИЕ ДАННЫХ КЛИЕНТА */
function Update_user()
{

    global $connect;

    $Up_surname = $_POST['Up_surname'];
    $Up_first_name = $_POST['Up_first_name'];
    $Up_last_name = $_POST['Up_last_name'];
    $Up_email = $_POST['Up_email'];
    $Up_telephone = $_POST['Up_telephone'];
    $Up_id = $_POST['id'];

    $query = "UPDATE user SET `first_name` = '$Up_first_name', `surname` = '$Up_surname', `last_name` = '$Up_last_name', `email` = '$Up_email', `telephone` = '$Up_telephone' WHERE `id` = '$Up_id'";
    $res = mysqli_query($connect, $query);


    if ($res === FALSE) {
        die(mysqli_error($connect)); // если ошибка, узнаем
    }


    // ПРОВЕРКА: кОЛИЧЕСТВО СТРОК затронутых последним INSERT, UPDATE, DELETE.
    if (mysqli_affected_rows($connect)) {
        return true;
    } else {
        return false;
    }

    // 
}



/* ВЫВОД ДАННЫХ В ТАБЛИЦУ ПОКАЗАНИЙ ДОМА */
function get_user_electro($_id_home)
{

    // обращение к глобалььной(не из фун) переменной-соединения surname
    global $connect;
    // созд. запроса (LIMIT УСТАНОВИЛ Т.К ЗАПРОС ВОЗВРАЩАЕТ БОЛЕЕ ОДНОЙ СТРОКИ - ОШИБКА)
    $query = "SELECT  electro.`id`, electro.`date`, electro.`T1`, electro.`T2`, electro.`T3`, home.section, home.`street`, home.`house`, home.`flat`, electro.`tariffCount` FROM `electro` JOIN home ON (home.id = electro.id_home) WHERE `id_home` = '$_id_home';";
    // SELECT * FROM `$table`";
    // отправка запроса
    $res = mysqli_query($connect, $query);
    // массив в который будет помещен ассоцюмассив(преобразованный отв.серв)
    $options = array();
    // ЦИКЛОМ ПОСТРОЧНО ЗАПИХИВАЕМ В МАССИВ И ВОЗВРОЩАЕМ 
    // ($row['id' чтобы у ассоц.массива были имена масивов масиввов в виде id, а не индекса)
    if ($res === FALSE) {
        die(mysqli_error($connect)); // если ошибка, узнаем
    }

    while ($row = mysqli_fetch_assoc($res)) {
        $options[$row['id']] = $row;
    }
    return $options;
}

/* ВНЕСЕНИЕ ПОКАЗАНИЙ ПОЛЬЗОВАТЕЛЕМ */
function send_user_electro()
{

    global $connect;

    $Т1 = $_POST['Т1'];
    $Т2 = $_POST['Т2'];
    $Т3 = $_POST['Т3'];
    $date =  date("Y-m-d"); // Получаем настоящее
    $User_home = $_POST['User_home'];


    $query = "INSERT INTO `electro` (`id`, `id_home`, `date`, `T1`, `T2`, `T3`) VALUES (NULL, '$User_home', '$date', '$Т1', '$Т2', '$Т3')";
    $res = mysqli_query($connect, $query);


    if ($res === FALSE) {
        die(mysqli_error($connect)); // если ошибка, узнаем
    }


    // ПРОВЕРКА: кОЛИЧЕСТВО СТРОК затронутых последним INSERT, UPDATE, DELETE.
    if (mysqli_affected_rows($connect)) {
        return true;
    } else {
        return false;
    }
}


function send_user_orders()
{

    global $connect;


    $id_employe = get_id_employe();

    foreach ($id_employe as $id_employes) :
        $id_employe = $id_employes['id'];
    endforeach;


    $User_typet = $_POST['User_typet'];
    $User_home = $_POST['User_home'];
    $User_phone = $_POST['User_phone'];
    $date =  date("Y-m-d"); // Получаем настоящее


    $query = "INSERT INTO `orders` (`id`, `date`, `date2`, `id_home`, `phone`, `id_typet`, `id_employee`) VALUES (NULL, '$date', NULL, '$User_home', '$User_phone', '$User_typet', '$id_employe');";
    $res = mysqli_query($connect, $query);


    if ($res === FALSE) {
        die(mysqli_error($connect)); // если ошибка, узнаем
    }


    // ПРОВЕРКА: кОЛИЧЕСТВО СТРОК затронутых последним INSERT, UPDATE, DELETE.
    if (mysqli_affected_rows($connect)) {
        return true;
    } else {
        return false;
    }
}


function get_id_employe()
{
    // SELECT `id` FROM `personal` LIMIT 1
    global $connect;

    // созд. запроса
    $query = "SELECT `id` FROM `personal` LIMIT 1";
    // отправка запроса
    $res = mysqli_query($connect, $query);
    // массив в который будет помещен ассоцюмассив(преобразованный отв.серв)
    $options = array();
    // ЦИКЛОМ ПОСТРОЧНО ЗАПИХИВАЕМ В МАССИВ И ВОЗВРОЩАЕМ 
    // ($row['id' чтобы у ассоц.массива были имена масивов масиввов в виде id, а не индекса)
    if ($res === FALSE) {
        die(mysqli_error($connect)); // если ошибка, узнаем
    }

    while ($row = mysqli_fetch_assoc($res)) {
        $options[$row['id']] = $row;
    }
    return $options;
}

/* ВЫВОД ДАННЫХ ПО ЗАКАЗАНЫМ УСЛУГАМ ДОМА */
function get_user_orders($_id_home)
{
    global $connect;

    // созд. запроса
    $query = "SELECT  orders.`id`, typet.`type`, orders.`phone`, home.`section`, home.`street`, home.`house`, home.`flat`, orders.`date`, orders.`date2` FROM `orders` JOIN home ON (home.id = orders.id_home) JOIN typet ON (typet.id = orders.id_typet) WHERE orders.id_home = '$_id_home'";
    // "SELECT  orders.`id`, typet.`type`, orders.`phone`, home.`section`, home.`street`, home.`house`, home.`flat`, personal.`surname`, orders.`date`, orders.`date2` FROM `orders` JOIN home ON (home.id = orders.id_home) JOIN personal ON (personal.id = orders.id_employee) JOIN typet ON (typet.id = orders.id_typet) WHERE orders.id_home = 24;";


    // отправка запроса
    $res = mysqli_query($connect, $query);
    // массив в который будет помещен ассоцюмассив(преобразованный отв.серв)
    $options = array();
    // ЦИКЛОМ ПОСТРОЧНО ЗАПИХИВАЕМ В МАССИВ И ВОЗВРОЩАЕМ 
    // ($row['id' чтобы у ассоц.массива были имена масивов масиввов в виде id, а не индекса)
    if ($res === FALSE) {
        die(mysqli_error($connect)); // если ошибка, узнаем
    }

    while ($row = mysqli_fetch_assoc($res)) {
        $options[$row['id']] = $row;
    }
    return $options;
    // 
}

function ava($id_user)
{

    global $connect;

    $User_id = $id_user;
    $path = 'uploads/' . time() . $_FILES['avaProfile']['name'];

    //если ошибка при загрузке изображения
    if (!move_uploaded_file($_FILES['avaProfile']['tmp_name'], $path)) {
        return false;
    }

    $query = "UPDATE `user` SET `avatar`='$path' WHERE `id` = '$User_id';";
    $res = mysqli_query($connect, $query);

    if ($res === FALSE) {
        die(mysqli_error($connect)); // если ошибка, узнаем
    }

    // ПРОВЕРКА: кОЛИЧЕСТВО СТРОК затронутых последним INSERT, UPDATE, DELETE.
    if (mysqli_affected_rows($connect)) {
        return $path;
    } else {
        return false;
    }
}
//---------------------------------------------- END <Логика PROFILE сайта> END ------------------------------------------------------
//---------------------------------------------- <Логика SERVICES страницы > ------------------------------------------------------


function get_listStatus($table)
{
    $table = $table;

    // обращение к глобалььной(не из фун) переменной-соединения
    global $connect;
    // созд. запроса
    $query = " SELECT * FROM `$table` WHERE `status` = 1";
    // отправка запроса
    $res = mysqli_query($connect, $query);
    // массив в который будет помещен ассоцюмассив(преобразованный отв.серв)
    $options = array();
    // ЦИКЛОМ ПОСТРОЧНО ЗАПИХИВАЕМ В МАССИВ И ВОЗВРОЩАЕМ 
    // ($row['id' чтобы у ассоц.массива были имена масивов масиввов в виде id, а не индекса)
    if ($res === FALSE) {
        die(mysqli_error($connect)); // если ошибка, узнаем
    }

    while ($row = mysqli_fetch_assoc($res)) {
        $options[$row['id']] = $row;
    }
    return $options;
}


//---------------------------------------------- <Логика NEWS страницы > ------------------------------------------------------


function get_listStatus_news()
{

    // обращение к глобалььной(не из фун) переменной-соединения surname
    global $connect;
    // созд. запроса (LIMIT УСТАНОВИЛ Т.К ЗАПРОС ВОЗВРАЩАЕТ БОЛЕЕ ОДНОЙ СТРОКИ - ОШИБКА)
    $query = "SELECT 
    news.`id`, 
    news.`header`, 
    news.`text`, 
    news.`content`, 
    news.`img`, 
    personal.surname, 
    news.`status`, 
    news.`period` 
FROM `news`
JOIN personal ON (personal.id = news.id_employee) WHERE `status` = 1;";
    // SELECT * FROM `$table`";
    // отправка запроса
    $res = mysqli_query($connect, $query);
    // массив в который будет помещен ассоцюмассив(преобразованный отв.серв)
    $options = array();
    // ЦИКЛОМ ПОСТРОЧНО ЗАПИХИВАЕМ В МАССИВ И ВОЗВРОЩАЕМ 
    // ($row['id' чтобы у ассоц.массива были имена масивов масиввов в виде id, а не индекса)
    if ($res === FALSE) {
        die(mysqli_error($connect)); // если ошибка, узнаем
    }

    while ($row = mysqli_fetch_assoc($res)) {
        $options[$row['id']] = $row;
    }
    return $options;
}
