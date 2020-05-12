-- phpMyAdmin SQL Dump
-- version 4.9.0.1
-- https://www.phpmyadmin.net/
--
-- Хост: 127.0.0.1:3306
-- Время создания: Май 12 2020 г., 19:22
-- Версия сервера: 10.3.13-MariaDB-log
-- Версия PHP: 7.3.9

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- База данных: `mybase`
--

-- --------------------------------------------------------

--
-- Структура таблицы `users`
--

CREATE TABLE `users` (
  `id` int(10) UNSIGNED NOT NULL,
  `user_name` varchar(40) DEFAULT NULL,
  `user_surname` varchar(40) DEFAULT NULL,
  `user_thirdname` varchar(40) DEFAULT NULL,
  `user_age` int(100) DEFAULT NULL,
  `email` varchar(40) DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL,
  `photo` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `users`
--

INSERT INTO `users` (`id`, `user_name`, `user_surname`, `user_thirdname`, `user_age`, `email`, `password`, `photo`) VALUES
(1, 'Стас', 'Васильев', 'Васильевич', 40, '123@mail.ru', '$2y$10$1dtgtabm44MetHXDGRgW5.hXAxd3mffhfnY/3uSyITFXvqNR0m/J2', '1589278637__profilecat.jpeg'),
(2, 'петров', 'Сидор', 'Иваныч', 54, 'qwerty1@mail.ru', '$2y$10$VmqcRhcAhWYuRCGf9JQz1.t4jy6uJbc21/LsPWeXRncCBwxksLQce', '1589278420_s1200.jpg'),
(3, 'Пётр', 'Иванвов', 'Иванович', 10, 'asd@mail.ru', '$2y$10$SrLhf2xIEqG/SCv7yDkt0OjlpPtWJTAyUe8xPcwwDxH4EjGt4ql8O', NULL);

--
-- Индексы сохранённых таблиц
--

--
-- Индексы таблицы `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT для сохранённых таблиц
--

--
-- AUTO_INCREMENT для таблицы `users`
--
ALTER TABLE `users`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
