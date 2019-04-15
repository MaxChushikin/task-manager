-- phpMyAdmin SQL Dump
-- version 3.5.8.2
-- http://www.phpmyadmin.net
--
-- Хост: sql212.xenn.xyz
-- Время создания: Апр 14 2019 г., 20:52
-- Версия сервера: 5.6.41-84.1
-- Версия PHP: 5.3.3

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- База данных: `xnnx_23608526_task_manager`
--

-- --------------------------------------------------------

--
-- Структура таблицы `projects`
--

CREATE TABLE IF NOT EXISTS `projects` (
  `id` int(4) NOT NULL AUTO_INCREMENT,
  `name` varchar(256) NOT NULL,
  `user_id` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=4 ;

--
-- Дамп данных таблицы `projects`
--

INSERT INTO `projects` (`id`, `name`, `user_id`) VALUES
(1, 'For Ruby', 1),
(2, 'Project a', 0),
(3, 'Z New Project', 1);

-- --------------------------------------------------------

--
-- Структура таблицы `sessions`
--

CREATE TABLE IF NOT EXISTS `sessions` (
  `session_id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `date_added` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`session_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=16 ;

--
-- Дамп данных таблицы `sessions`
--

INSERT INTO `sessions` (`session_id`, `user_id`, `date_added`) VALUES
(1, 1, '2019-04-11 11:26:12'),
(2, 1, '2019-04-11 12:16:42'),
(3, 1, '2019-04-11 12:29:46'),
(4, 1, '2019-04-13 10:15:29'),
(5, 1, '2019-04-14 13:14:21'),
(6, 1, '2019-04-14 16:46:00'),
(7, 1, '2019-04-14 22:37:16'),
(8, 1, '2019-04-14 22:38:47'),
(9, 1, '2019-04-15 00:16:54'),
(10, 1, '2019-04-15 00:17:26'),
(11, 2, '2019-04-15 00:17:41'),
(12, 3, '2019-04-15 00:19:58'),
(13, 1, '2019-04-15 00:27:49'),
(14, 1, '2019-04-15 00:30:47'),
(15, 1, '2019-04-15 00:30:58');

-- --------------------------------------------------------

--
-- Структура таблицы `tasks`
--

CREATE TABLE IF NOT EXISTS `tasks` (
  `id` int(4) NOT NULL AUTO_INCREMENT,
  `name` varchar(512) NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '0',
  `priority` tinyint(2) NOT NULL DEFAULT '1',
  `projected` int(4) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=28 ;

--
-- Дамп данных таблицы `tasks`
--

INSERT INTO `tasks` (`id`, `name`, `status`, `priority`, `projected`) VALUES
(1, 'First task', 1, 2, 1),
(2, 'Second taskss', 1, 1, 1),
(6, '412341234', 0, 2, 2),
(10, 'Another task', 0, 2, 4),
(11, 'Another task', 0, 2, 4),
(12, 'Another task', 0, 2, 2),
(13, 'Another task', 1, 2, 3),
(14, 'five', 0, 2, 1),
(15, 'five', 1, 2, 1),
(16, 'five', 1, 2, 1),
(17, 'five', 1, 2, 1),
(18, 'five', 0, 2, 1),
(19, 'done', 1, 2, 1),
(20, 'done', 1, 2, 1),
(21, 'done', 1, 2, 1),
(22, 'not none', 0, 2, 1),
(23, 'not done', 1, 2, 1),
(24, 'not done', 1, 2, 1),
(25, 'five', 0, 2, 3),
(26, 'in defferent project', 0, 2, 3),
(27, 'in defferent project', 1, 2, 1);

-- --------------------------------------------------------

--
-- Структура таблицы `users`
--

CREATE TABLE IF NOT EXISTS `users` (
  `id` int(4) NOT NULL AUTO_INCREMENT,
  `login` varchar(32) NOT NULL,
  `password` varchar(60) NOT NULL,
  `date_added` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=4 ;

--
-- Дамп данных таблицы `users`
--

INSERT INTO `users` (`id`, `login`, `password`, `date_added`) VALUES
(1, 'demodemo', '$2y$10$kVHwEfmqB1kfg/W7TJfZWeGiu11XCHPAwkH8jLsqaeWDnG96tEeLG', '2019-04-14 20:21:48');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
