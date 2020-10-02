-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Хост: 127.0.0.1:3306
-- Время создания: Июн 09 2020 г., 21:04
-- Версия сервера: 10.3.22-MariaDB
-- Версия PHP: 7.1.33

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- База данных: `myelectro`
--

-- --------------------------------------------------------

--
-- Структура таблицы `document`
--

CREATE TABLE `document` (
  `id` int(11) NOT NULL,
  `datedoc` date NOT NULL,
  `name` varchar(50) NOT NULL,
  `link` varchar(500) NOT NULL,
  `orderd` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Структура таблицы `electro`
--

CREATE TABLE `electro` (
  `id` int(11) NOT NULL,
  `id_home` int(11) DEFAULT NULL,
  `date` datetime DEFAULT NULL,
  `count` float DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Структура таблицы `home`
--

CREATE TABLE `home` (
  `id` int(11) NOT NULL,
  `id_user` int(11) DEFAULT NULL,
  `city` varchar(50) DEFAULT NULL,
  `section` varchar(100) DEFAULT NULL,
  `street` varchar(50) DEFAULT NULL,
  `house` int(4) DEFAULT NULL,
  `flat` int(4) DEFAULT NULL,
  `year` int(4) DEFAULT NULL,
  `floor` int(4) DEFAULT NULL,
  `area` int(4) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `home`
--

INSERT INTO `home` (`id`, `id_user`, `city`, `section`, `street`, `house`, `flat`, `year`, `floor`, `area`) VALUES
(10, 12, 'Краснодар', 'ЗИП – Завод измерительных приборов', 'Российскаяlog', 9, 8, 7, 6, 5),
(13, 13, 'Krasnodar', 'ФМР – Фестивальный', 'Red', 142, 37, 2014, 10, 90),
(14, 14, 'Краснодар', 'ЗИП – Завод измерительных приборов', 'Улица', 10, 10, 2020, 10, 100);

-- --------------------------------------------------------

--
-- Структура таблицы `news`
--

CREATE TABLE `news` (
  `id` int(11) NOT NULL,
  `img` varchar(300) DEFAULT NULL,
  `header` varchar(70) DEFAULT NULL,
  `text` varchar(250) DEFAULT NULL,
  `content` text DEFAULT NULL,
  `news` tinyint(1) DEFAULT NULL,
  `id_employee` int(11) DEFAULT NULL,
  `period` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Структура таблицы `orders`
--

CREATE TABLE `orders` (
  `id` int(11) NOT NULL,
  `date` date DEFAULT NULL,
  `date2` date DEFAULT NULL,
  `id_home` int(11) DEFAULT NULL,
  `city` varchar(30) DEFAULT NULL,
  `section` varchar(100) DEFAULT NULL,
  `street` varchar(50) DEFAULT NULL,
  `house` int(4) DEFAULT NULL,
  `flat` int(4) DEFAULT NULL,
  `phone` varchar(20) DEFAULT NULL,
  `idtypet` int(11) DEFAULT NULL,
  `id_employee` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Структура таблицы `personal`
--

CREATE TABLE `personal` (
  `id` int(11) NOT NULL,
  `first_name` varchar(20) DEFAULT NULL,
  `surname` varchar(20) DEFAULT NULL,
  `last_name` varchar(20) DEFAULT NULL,
  `vacant` varchar(50) DEFAULT NULL,
  `education` varchar(100) DEFAULT NULL,
  `experience` int(11) DEFAULT NULL,
  `telephone` varchar(20) DEFAULT NULL,
  `avatar` varchar(200) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Структура таблицы `typet`
--

CREATE TABLE `typet` (
  `id` int(11) NOT NULL,
  `type` varchar(100) DEFAULT NULL,
  `status` tinyint(1) DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `typet`
--

INSERT INTO `typet` (`id`, `type`, `status`) VALUES
(21, 'test this', 1),
(723, 'Установка и настройка прибора учёта электроэнергии 3', 1),
(797, 'test update !', 0),
(808, '321', 1);

-- --------------------------------------------------------

--
-- Структура таблицы `user`
--

CREATE TABLE `user` (
  `id` int(11) NOT NULL,
  `login` varchar(30) DEFAULT NULL,
  `password` varchar(1000) DEFAULT NULL,
  `surname` varchar(30) DEFAULT NULL,
  `first_name` varchar(30) DEFAULT NULL,
  `last_name` varchar(30) DEFAULT NULL,
  `email` varchar(30) DEFAULT NULL,
  `telephone` varchar(20) DEFAULT NULL,
  `avatar` varchar(200) DEFAULT NULL,
  `status` tinyint(1) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `user`
--

INSERT INTO `user` (`id`, `login`, `password`, `surname`, `first_name`, `last_name`, `email`, `telephone`, `avatar`, `status`) VALUES
(12, 'log4', '202cb962ac59075b964b07152d234b70', 'log1', 'log2', 'log3', 'log@log.ru', '89186726489', 'uploads/159025927035394.jpg', 1),
(13, 'admin', '202cb962ac59075b964b07152d234b70', 'Sorokin', 'Ilya', 'Pavlovich', 'ilya_sorokin_1996@list.ru', '89186726489', 'uploads/159112403420190916_002202.jpg', 1),
(14, 'Логин', '202cb962ac59075b964b07152d234b70', 'Фамилия', 'Имя', 'Отчество', 'e@e.ru', '89181234567', 'uploads/15914554125bf0d44efa8f6ba6d2e7832ed7fda8dd.jpg', 0);

--
-- Индексы сохранённых таблиц
--

--
-- Индексы таблицы `document`
--
ALTER TABLE `document`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `electro`
--
ALTER TABLE `electro`
  ADD PRIMARY KEY (`id`),
  ADD KEY `electro_ibfk_1` (`id_home`);

--
-- Индексы таблицы `home`
--
ALTER TABLE `home`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_home` (`id`),
  ADD KEY `id_home_2` (`id`),
  ADD KEY `home_ibfk_1` (`id_user`) USING BTREE;

--
-- Индексы таблицы `news`
--
ALTER TABLE `news`
  ADD PRIMARY KEY (`id`),
  ADD KEY `news_ibfk_1` (`id_employee`);

--
-- Индексы таблицы `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`id`),
  ADD KEY `orders_ibfk_1` (`id_home`),
  ADD KEY `orders_ibfk_2` (`idtypet`),
  ADD KEY `orders_ibfk_3` (`id_employee`);

--
-- Индексы таблицы `personal`
--
ALTER TABLE `personal`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_employee` (`id`),
  ADD KEY `id_employee_2` (`id`);

--
-- Индексы таблицы `typet`
--
ALTER TABLE `typet`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_typet` (`id`);

--
-- Индексы таблицы `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_user` (`id`);

--
-- AUTO_INCREMENT для сохранённых таблиц
--

--
-- AUTO_INCREMENT для таблицы `document`
--
ALTER TABLE `document`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT для таблицы `electro`
--
ALTER TABLE `electro`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT для таблицы `home`
--
ALTER TABLE `home`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT для таблицы `news`
--
ALTER TABLE `news`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT для таблицы `orders`
--
ALTER TABLE `orders`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT для таблицы `personal`
--
ALTER TABLE `personal`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT для таблицы `typet`
--
ALTER TABLE `typet`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=812;

--
-- AUTO_INCREMENT для таблицы `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- Ограничения внешнего ключа сохраненных таблиц
--

--
-- Ограничения внешнего ключа таблицы `electro`
--
ALTER TABLE `electro`
  ADD CONSTRAINT `electro_ibfk_1` FOREIGN KEY (`id_home`) REFERENCES `home` (`id`) ON UPDATE CASCADE;

--
-- Ограничения внешнего ключа таблицы `home`
--
ALTER TABLE `home`
  ADD CONSTRAINT `home_ibfk_1` FOREIGN KEY (`id_user`) REFERENCES `user` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ограничения внешнего ключа таблицы `news`
--
ALTER TABLE `news`
  ADD CONSTRAINT `news_ibfk_1` FOREIGN KEY (`id_employee`) REFERENCES `personal` (`id`) ON UPDATE CASCADE;

--
-- Ограничения внешнего ключа таблицы `orders`
--
ALTER TABLE `orders`
  ADD CONSTRAINT `orders_ibfk_1` FOREIGN KEY (`id_home`) REFERENCES `home` (`id`) ON UPDATE CASCADE,
  ADD CONSTRAINT `orders_ibfk_2` FOREIGN KEY (`idtypet`) REFERENCES `typet` (`id`) ON UPDATE CASCADE,
  ADD CONSTRAINT `orders_ibfk_3` FOREIGN KEY (`id_employee`) REFERENCES `personal` (`id`) ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
