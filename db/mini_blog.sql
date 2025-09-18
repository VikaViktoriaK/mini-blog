-- phpMyAdmin SQL Dump
-- version 5.2.2
-- https://www.phpmyadmin.net/
--
-- Хост: MySQL-8.4
-- Время создания: Сен 18 2025 г., 13:08
-- Версия сервера: 8.4.4
-- Версия PHP: 8.4.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- База данных: `mini_blog`
--

-- --------------------------------------------------------

--
-- Структура таблицы `posts`
--

CREATE TABLE `posts` (
  `id` int UNSIGNED NOT NULL,
  `user_id` int UNSIGNED NOT NULL,
  `title` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `content` text COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Дамп данных таблицы `posts`
--

INSERT INTO `posts` (`id`, `user_id`, `title`, `content`) VALUES
(1, 1, 'My First Day with Yii2', 'Today I started working with the Yii2 framework. It feels powerful yet simple, and I am excited to build my first application with it.'),
(2, 1, 'Why I Love PHP', 'PHP has been my entry point into web development. Even though many say it is outdated, I still find it very flexible and easy to use.'),
(3, 2, 'Morning Routine Tips', 'I always start my day with a glass of water, a quick workout, and reading something inspirational. It sets the tone for the rest of the day.'),
(4, 2, 'Favorite Books This Year', 'This year I have read some amazing books. My top picks are \"Atomic Habits\" by James Clear and \"Deep Work\" by Cal Newport.'),
(5, 3, 'Learning JavaScript', 'JavaScript is a must-have skill for every developer. I am currently learning ES6 features and enjoying the process.'),
(6, 3, 'My Travel to Spain', 'Last summer I visited Spain. Barcelona and Madrid were full of life, culture, and delicious food. I cannot wait to go back.'),
(7, 4, 'Cooking Italian Pasta', 'I tried cooking authentic Italian pasta at home. It was simple but delicious. Fresh ingredients make a big difference!'),
(8, 4, 'Why I Enjoy Blogging', 'Blogging allows me to share my thoughts with the world. It helps me improve my writing and connect with like-minded people.'),
(9, 5, 'Running a Half Marathon', 'I never thought I could run 21 kilometers, but with proper training, I completed my first half marathon. It was an unforgettable experience.'),
(10, 5, 'Top 5 Coding Tips', '1. Write clean code. 2. Comment wisely. 3. Keep learning. 4. Test your work. 5. Do not reinvent the wheel.'),
(12, 1, 'Первый пост', 'Работает Изменен'),
(15, 4, 'Привет я Аня', 'Пароль работает\r\n'),
(16, 3, 'rem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt', 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it t\r\nLorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it tLorem Ipsum is simply dummy text of the printin');

-- --------------------------------------------------------

--
-- Структура таблицы `users`
--

CREATE TABLE `users` (
  `id` int UNSIGNED NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password_hash` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `auth_key` varchar(32) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Дамп данных таблицы `users`
--

INSERT INTO `users` (`id`, `email`, `password_hash`, `auth_key`) VALUES
(1, 'ivan@gmail.com', '$2y$13$cvh3ntWZvli7j74U0l43HO8.jU9bNS3ItodEqVvsMmniZrgO9/kEO', 'a1b2c3d4e5f60718293a4b5c6d7e8f90'),
(2, 'maria@gmail.com', '$2y$13$sp6p2jXI5rJGwkYC0KE9yuHtHZdZj6KcmbTGKs4pURrIxHlkun2ey', 'b2c3d4e5f60718293a4b5c6d7e8f90a1'),
(3, 'sergey@gmail.com', '$2y$13$5baHhoG4gtPOpHgaR5gL1.56IazIB5IcuPIJOcT0qlTBlJAW6xLWK', 'c3d4e5f60718293a4b5c6d7e8f90a1b2'),
(4, 'anna@gmail.com', '$2y$13$4AKspqReum6101r3lXUtDeW9aE/1ACH29ZQTopdB57XgdCZBp6IO6', 'd4e5f60718293a4b5c6d7e8f90a1b2c3'),
(5, 'dmitry@gmail.com', '$2y$13$WRrMSL7LspZTZBSoNuSsc..EavpZvyCEiHnBHg0RsTlaFMIVXnui6', 'e5f60718293a4b5c6d7e8f90a1b2c3d4');

--
-- Индексы сохранённых таблиц
--

--
-- Индексы таблицы `posts`
--
ALTER TABLE `posts`
  ADD PRIMARY KEY (`id`),
  ADD KEY `idx_posts_user_id` (`user_id`);

--
-- Индексы таблицы `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `uniq_users_email` (`email`);

--
-- AUTO_INCREMENT для сохранённых таблиц
--

--
-- AUTO_INCREMENT для таблицы `posts`
--
ALTER TABLE `posts`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT для таблицы `users`
--
ALTER TABLE `users`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- Ограничения внешнего ключа сохраненных таблиц
--

--
-- Ограничения внешнего ключа таблицы `posts`
--
ALTER TABLE `posts`
  ADD CONSTRAINT `fk_posts_user` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE RESTRICT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
