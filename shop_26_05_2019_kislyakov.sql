-- phpMyAdmin SQL Dump
-- version 4.9.0.1
-- https://www.phpmyadmin.net/
--
-- Хост: 127.0.0.1
-- Время создания: Сен 26 2019 г., 10:30
-- Версия сервера: 10.3.16-MariaDB
-- Версия PHP: 7.3.7

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- База данных: `shop_26_05_2019_kislyakov`
--
CREATE DATABASE IF NOT EXISTS `shop_26_05_2019_kislyakov` DEFAULT CHARACTER SET utf8 COLLATE utf8_general_ci;
USE `shop_26_05_2019_kislyakov`;

-- --------------------------------------------------------

--
-- Структура таблицы `catalog`
--

CREATE TABLE IF NOT EXISTS `catalog` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(200) NOT NULL,
  `price` int(11) NOT NULL,
  `text` text NOT NULL,
  `pic` varchar(100) NOT NULL,
  `creation_date` timestamp NOT NULL DEFAULT current_timestamp(),
  `category` int(3) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `catalog`
--

INSERT INTO `catalog` (`id`, `name`, `price`, `text`, `pic`, `creation_date`, `category`) VALUES
(1, 'Куртка синяя', 5400, 'Синяя кожаная куртка с рукавами', '1.jpg', '2019-09-08 10:25:14', 4),
(2, 'Кожаная куртка', 22500, '', '2.jpg', '2019-09-08 10:25:14', 4),
(3, 'Куртка с карманами', 9200, '', '3.png', '2019-09-08 10:27:45', 4),
(4, 'Куртка с капюшоном', 6100, '', '4.jpg', '2019-09-08 10:27:45', 4),
(5, 'Куртка Casual', 8800, '', '5.jpg', '2019-09-09 09:09:33', 4),
(6, 'Стильная кожаная куртка', 12800, '', '6.jpg', '2019-09-09 09:09:33', 4),
(7, 'Кеды серые', 2900, '', '7.jpg', '2019-09-09 09:11:05', 6),
(8, 'Кеды чёрные', 4500, '', '8.jpg', '2019-09-09 09:11:05', 6),
(9, 'Кеды Casual', 5900, '', '9.jpg', '2019-09-09 09:13:54', 6),
(10, 'Кеды всепогодные', 9200, '', '10.jpg', '2019-09-09 09:13:54', 6),
(11, 'Джинсы', 4800, '', '11.jpg', '2019-09-09 09:15:24', 5),
(12, 'Джинсы голубые', 4200, '', '12.jpg', '2019-09-09 09:15:24', 5);

-- --------------------------------------------------------

--
-- Структура таблицы `categories`
--

CREATE TABLE IF NOT EXISTS `categories` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `category` varchar(100) NOT NULL,
  `parent_id` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=15 DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `categories`
--

INSERT INTO `categories` (`id`, `category`, `parent_id`) VALUES
(1, 'Мужчинам', 0),
(2, 'Женщинам', 0),
(3, 'Детям', 0),
(4, 'Куртки', 1),
(5, 'Брюки', 1),
(6, 'Обувь', 1),
(7, 'Шубы', 2),
(8, 'Юбки', 2),
(9, 'Браслеты', 2),
(10, 'Маечки', 3),
(11, 'Шортики', 3),
(12, 'Гольфики', 3);

-- --------------------------------------------------------

--
-- Структура таблицы `nav`
--

CREATE TABLE IF NOT EXISTS `nav` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(50) NOT NULL,
  `href` varchar(250) NOT NULL,
  `id-tag` varchar(100) NOT NULL,
  `class` varchar(100) NOT NULL,
  `priority` int(11) NOT NULL,
  `active` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `nav`
--

INSERT INTO `nav` (`id`, `name`, `href`, `id-tag`, `class`, `priority`, `active`) VALUES
(1, 'Мужчинам', '/catalog/catalog.php#men', '#men', 'nav-link-men', 10, 1),
(2, 'Женщинам', '/catalog/catalog.php#women', '#women', 'nav-link-women', 20, 1),
(3, 'Детям', '/catalog/catalog.php#children', '#children', 'nav-link-children', 30, 1),
(4, 'Новинки', '/catalog/catalog.php#novelties', '#novelties', 'nav-link-novelties', 40, 1),
(5, 'О нас', '/catalog/catalog.php#about-us', '#about-us', 'nav-link-about-us', 50, 0);

-- --------------------------------------------------------

--
-- Структура таблицы `quantity`
--

CREATE TABLE IF NOT EXISTS `quantity` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `catalog_id` int(11) NOT NULL,
  `size_id` varchar(10) NOT NULL,
  `quantity` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `quantity`
--

INSERT INTO `quantity` (`id`, `catalog_id`, `size_id`, `quantity`) VALUES
(1, 1, '1', 15),
(2, 1, '2', 10);

-- --------------------------------------------------------

--
-- Структура таблицы `sizes`
--

CREATE TABLE IF NOT EXISTS `sizes` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `size` varchar(10) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `sizes`
--

INSERT INTO `sizes` (`id`, `size`) VALUES
(1, 'L'),
(2, 'XL'),
(3, 'XXL'),
(4, 'XXXL');

-- --------------------------------------------------------

--
-- Структура таблицы `users`
--

CREATE TABLE IF NOT EXISTS `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(100) NOT NULL,
  `surname` varchar(100) NOT NULL,
  `login` varchar(100) NOT NULL,
  `password` varchar(100) NOT NULL,
  `reg_date` datetime NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `users`
--

INSERT INTO `users` (`id`, `name`, `surname`, `login`, `password`, `reg_date`) VALUES
(1, 'Алексей', 'Соколов', 'alex', '1f32aa4c9a1d2ea010adcf2348166a04', '2019-09-15 12:14:47');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
