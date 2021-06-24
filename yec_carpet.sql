-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Хост: localhost
-- Время создания: Июн 21 2021 г., 12:14
-- Версия сервера: 10.4.14-MariaDB
-- Версия PHP: 7.4.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- База данных: `yec_carpet`
--

-- --------------------------------------------------------

--
-- Структура таблицы `due_dates`
--

CREATE TABLE `due_dates` (
  `id` int(11) UNSIGNED NOT NULL,
  `name` varchar(11) DEFAULT NULL COMMENT 'muddatli to''lov nomi: 3 oy, 6 oy, 9 oy',
  `active` tinyint(1) DEFAULT NULL,
  `percent` int(11) DEFAULT NULL COMMENT 'necha %',
  `created_at` timestamp NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `due_dates`
--

INSERT INTO `due_dates` (`id`, `name`, `active`, `percent`, `created_at`, `updated_at`) VALUES
(1, '3 oy', 1, 10, '2021-06-08 14:01:28', '2021-06-11 16:55:34'),
(2, '6 oy', 1, 15, '2021-06-08 14:01:28', '2021-06-21 04:44:53'),
(3, '9 oy', 1, 20, '2021-06-08 14:01:52', '2021-06-21 04:44:54'),
(4, '12 oy', 1, 30, '2021-06-08 14:02:12', '2021-06-21 04:44:49');

-- --------------------------------------------------------

--
-- Структура таблицы `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `uuid` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `connection` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Структура таблицы `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Дамп данных таблицы `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2014_10_12_000000_create_users_table', 1),
(2, '2014_10_12_100000_create_password_resets_table', 1),
(3, '2019_08_19_000000_create_failed_jobs_table', 1),
(5, '2021_05_30_125830_migrate', 3);

-- --------------------------------------------------------

--
-- Структура таблицы `password_resets`
--

CREATE TABLE `password_resets` (
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Структура таблицы `products`
--

CREATE TABLE `products` (
  `id` int(11) UNSIGNED NOT NULL,
  `code` varchar(45) DEFAULT NULL,
  `name` varchar(255) DEFAULT NULL,
  `articul` varchar(45) DEFAULT NULL,
  `image` varchar(255) DEFAULT NULL,
  `price` varchar(50) DEFAULT NULL,
  `parent_id` int(11) DEFAULT NULL,
  `description` text DEFAULT NULL,
  `quality_id` varchar(30) DEFAULT NULL,
  `room_id` varchar(30) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT current_timestamp(),
  `changed` varchar(255) NOT NULL COMMENT 'current time',
  `updated_at` timestamp NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `products`
--

INSERT INTO `products` (`id`, `code`, `name`, `articul`, `image`, `price`, `parent_id`, `description`, `quality_id`, `room_id`, `created_at`, `changed`, `updated_at`) VALUES
(1, '007', 'N005A', '001', 'N005A1.jpg', '35000', NULL, NULL, '1', '1', '2021-06-19 14:18:46', '0', '2021-06-19 14:24:25'),
(2, 'N004C', 'N004C', 'N004C', 'product192983540.jpg', '500000', NULL, '', '1', '1;6', '2021-06-19 14:26:50', '1624112810', '2021-06-21 04:44:18');

-- --------------------------------------------------------

--
-- Структура таблицы `qualities`
--

CREATE TABLE `qualities` (
  `id` int(11) UNSIGNED NOT NULL,
  `name` varchar(100) NOT NULL,
  `image` varchar(255) NOT NULL,
  `changed` varchar(255) NOT NULL COMMENT 'curret time',
  `created_at` timestamp NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `qualities`
--

INSERT INTO `qualities` (`id`, `name`, `image`, `changed`, `created_at`, `updated_at`) VALUES
(1, 'Lotus', 'lotus.jpg', '0', '2021-06-19 14:16:53', '2021-06-19 14:16:53'),
(2, 'Afsona', 'quality1254485990.png', '1624114012', '2021-06-19 14:46:52', '2021-06-19 14:46:52'),
(3, 'Almira beige', 'quality1682979521.png', '1624114047', '2021-06-19 14:47:27', '2021-06-19 14:47:27'),
(4, 'Almira grey', 'quality796613646.jpg', '1624114647', '2021-06-19 14:47:45', '2021-06-19 14:57:27'),
(5, 'Barcelona', 'quality2001493050.jpg', '1624114703', '2021-06-19 14:48:01', '2021-06-19 14:58:23'),
(6, 'Flooring bardo', 'quality1943362169.jpg', '1624114755', '2021-06-19 14:48:21', '2021-06-19 14:59:15'),
(7, 'Flooring beige', 'quality622038105.jpg', '1624114768', '2021-06-19 14:48:45', '2021-06-19 14:59:28'),
(8, 'Golden', 'quality569141129.jpg', '1624114780', '2021-06-19 14:49:15', '2021-06-19 14:59:40'),
(9, 'Saten', 'quality2015879329.png', '1624114173', '2021-06-19 14:49:33', '2021-06-19 14:49:33'),
(10, 'Zegna', 'quality1792160068.jpg', '1624114812', '2021-06-19 14:49:48', '2021-06-19 15:00:12');

-- --------------------------------------------------------

--
-- Структура таблицы `rooms`
--

CREATE TABLE `rooms` (
  `id` int(11) UNSIGNED NOT NULL,
  `name` varchar(100) DEFAULT NULL,
  `image` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT current_timestamp(),
  `changed` varchar(255) NOT NULL COMMENT 'curret time',
  `updated_at` timestamp NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `rooms`
--

INSERT INTO `rooms` (`id`, `name`, `image`, `created_at`, `changed`, `updated_at`) VALUES
(1, 'Mexmonxona', 'room1678198687.png', '2021-06-19 14:16:16', '1624113777', '2021-06-19 14:42:57'),
(2, 'Oshxona', 'room363266010.png', '2021-06-19 14:31:02', '1624113062', '2021-06-19 14:31:02'),
(3, 'Bolalar xonasi', 'room2084453640.png', '2021-06-19 14:39:19', '1624113559', '2021-06-19 14:39:19'),
(4, 'Zal', 'room2046621136.png', '2021-06-19 14:39:41', '1624113581', '2021-06-19 14:39:41'),
(5, 'Yo\'lak', 'room1098046688.png', '2021-06-19 14:40:01', '1624113601', '2021-06-19 14:40:01'),
(6, 'Yotoqxona', 'room1004135354.png', '2021-06-19 14:40:36', '1624113636', '2021-06-19 14:40:36');

-- --------------------------------------------------------

--
-- Структура таблицы `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `first_name` varchar(45) COLLATE utf8mb4_unicode_ci NOT NULL,
  `last_name` varchar(45) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `username` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` varchar(45) COLLATE utf8mb4_unicode_ci NOT NULL,
  `phone` varchar(45) COLLATE utf8mb4_unicode_ci NOT NULL,
  `dob` varchar(45) COLLATE utf8mb4_unicode_ci NOT NULL COMMENT 'day of borthday',
  `address` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `gender` tinyint(4) NOT NULL,
  `created_at` timestamp NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Дамп данных таблицы `users`
--

INSERT INTO `users` (`id`, `first_name`, `last_name`, `email`, `email_verified_at`, `username`, `password`, `remember_token`, `status`, `phone`, `dob`, `address`, `gender`, `created_at`, `updated_at`) VALUES
(1, 'Ismoil', 'Maxmudov', 'test@gmail.com', NULL, 'ismoil', '$2y$10$aTua/yOmMej7m9qP4A.dWOhATh3152lr8kCSdiTN53Rqes6y.cPsO', 'PLg4jHnPUVyvc1myt47wbq1PoNG6h9l3J8wvMZpWTEweekRrQNbBWO8BSdKR', 'admin', '+998972087090', '1996-04-22', 'Dang\'ara tumani', 1, '2021-05-14 09:24:06', '2021-06-19 08:36:55'),
(3, 'Olimjon', 'Ergasher', 'olim@gmail.com', NULL, 'olimjon', '202cb962ac59075b964b07152d234b70', NULL, 'manager', '905062323', '', 'Kokon. Vogzal', 1, '2021-05-24 06:59:28', NULL),
(5, 'javohir', 'No\'monov', '', NULL, 'javohir', '12345', NULL, 'manager', '+998972080054', '24.06.2001', 'Alishe Navoiy 112', 1, NULL, NULL);

--
-- Индексы сохранённых таблиц
--

--
-- Индексы таблицы `due_dates`
--
ALTER TABLE `due_dates`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Индексы таблицы `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `password_resets`
--
ALTER TABLE `password_resets`
  ADD KEY `password_resets_email_index` (`email`);

--
-- Индексы таблицы `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `qualities`
--
ALTER TABLE `qualities`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `rooms`
--
ALTER TABLE `rooms`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- AUTO_INCREMENT для сохранённых таблиц
--

--
-- AUTO_INCREMENT для таблицы `due_dates`
--
ALTER TABLE `due_dates`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT для таблицы `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT для таблицы `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT для таблицы `products`
--
ALTER TABLE `products`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT для таблицы `qualities`
--
ALTER TABLE `qualities`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT для таблицы `rooms`
--
ALTER TABLE `rooms`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT для таблицы `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
