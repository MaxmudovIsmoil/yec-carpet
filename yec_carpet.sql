-- phpMyAdmin SQL Dump
-- version 5.0.4
-- https://www.phpmyadmin.net/
--
-- Хост: 127.0.0.1
-- Время создания: Июн 03 2021 г., 10:29
-- Версия сервера: 10.4.17-MariaDB
-- Версия PHP: 7.4.14

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
  `price` int(11) DEFAULT NULL,
  `parent_id` int(11) DEFAULT NULL,
  `description` text DEFAULT NULL,
  `quality_id` int(11) DEFAULT NULL,
  `room_id` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT current_timestamp(),
  `changed` tinyint(1) NOT NULL COMMENT '0 - bazadan tortilgan\r\n1 - tortish kerak',
  `updated_at` timestamp NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `products`
--

INSERT INTO `products` (`id`, `code`, `name`, `articul`, `image`, `price`, `parent_id`, `description`, `quality_id`, `room_id`, `created_at`, `changed`, `updated_at`) VALUES
(1, '007', 'Afsona', '123', 'yulak.png', 450000000, 1, 'test', 1, 1, '2021-05-29 07:23:47', 0, '2021-05-31 05:38:17'),
(2, '008', 'Golden', '001', 'mehmonxona.png.png', 1230000000, 1, NULL, 1, 2, '2021-05-29 07:24:54', 0, '2021-05-31 05:36:56'),
(3, '009', 'sdsds', '002', 'bolalar_xonasi.png', 81300000, 1, NULL, 2, 3, '2021-05-29 07:25:37', 0, '2021-05-31 05:36:07'),
(4, '009', 'tet', '007', 'yulak.png', 263500000, 1, NULL, 2, 4, '2021-05-29 07:25:42', 0, '2021-05-31 05:38:09'),
(5, '009', 'tet', '003', 'yotoqxona.png', 47500000, 1, NULL, 2, 3, '2021-05-29 07:25:49', 0, '2021-05-31 05:37:50'),
(6, '004', 'ZAten', '2222', 'yulak.png', 321321000, 1, NULL, 1, 1, '2021-05-29 07:46:31', 0, '2021-05-31 05:38:40'),
(7, '004', 'Zegna', '1212', 'yulak.png', 123321000, 1, NULL, 1, 2, '2021-05-29 07:46:36', 0, '2021-05-31 05:38:43'),
(8, '004', 'Barcelona', '0126', 'zal.png', 123321000, 1, NULL, 3, 1, '2021-05-29 07:46:43', 0, '2021-05-31 05:38:53'),
(9, '004', 'Lotus', '0014', 'mehmonxona.png', 123321000, 1, NULL, 1, 1, '2021-05-29 07:46:48', 0, '2021-05-31 05:39:13'),
(10, 'M1', 'Olmaf', '123', 'product357748422.png', 123, NULL, NULL, NULL, NULL, '2021-05-31 16:12:50', 0, '2021-05-31 16:12:50'),
(11, 'M1', 'Olmaf', '123', 'product1035403490.png', 123, NULL, NULL, NULL, 2, '2021-05-31 16:14:30', 0, '2021-05-31 16:14:30'),
(12, 'M1', 'Olmaf', '123', 'product428830406.png', 123, NULL, NULL, NULL, 2, '2021-05-31 16:14:33', 0, '2021-05-31 16:14:33'),
(13, '91664', 'Olma', '123', 'product435091851.png', 123, NULL, NULL, NULL, 1, '2021-05-31 16:16:55', 0, '2021-05-31 16:16:55'),
(14, 'M1', 'Ismoil Maxmudov', 'test', 'product1857160339.png', 500000, NULL, NULL, NULL, 1, '2021-05-31 16:18:42', 0, '2021-05-31 16:18:42'),
(15, '91664', 'Olma', '123', 'product600156597.png', 123, NULL, NULL, NULL, 3, '2021-05-31 16:36:57', 0, '2021-05-31 16:36:57'),
(16, 'M1', 'Ismoil Maxmudov', '123', 'product999725088.png', 500000, NULL, NULL, NULL, 3, '2021-05-31 16:47:41', 0, '2021-05-31 16:47:41'),
(17, '91664', 'salom', '123', 'product1775508125.jpg', 500000, NULL, NULL, NULL, 1, '2021-06-01 05:14:44', 0, '2021-06-01 05:14:44'),
(18, 'M123', 'Salom boy', 'S0013', 'product56337471.png', 500000, NULL, NULL, NULL, 1, '2021-06-01 10:18:50', 0, '2021-06-01 10:18:50');

-- --------------------------------------------------------

--
-- Структура таблицы `qualities`
--

CREATE TABLE `qualities` (
  `id` int(11) UNSIGNED NOT NULL,
  `name` varchar(100) NOT NULL,
  `description` text DEFAULT NULL,
  `image` varchar(255) NOT NULL,
  `changed` tinyint(1) NOT NULL COMMENT '0 - bazadan tortilgan\r\n1 - tortish kerak',
  `created_at` timestamp NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `qualities`
--

INSERT INTO `qualities` (`id`, `name`, `description`, `image`, `changed`, `created_at`, `updated_at`) VALUES
(2, 'afsona', NULL, 'afsona_collection.png', 0, NULL, '2021-05-30 14:02:53'),
(3, 'almira beige', NULL, 'almira_beige_collection.png', 0, NULL, '2021-05-30 14:02:53'),
(6, 'almira grey', NULL, 'almira_grey_collection.png', 0, NULL, '2021-05-30 14:02:53'),
(7, 'barcelona', NULL, 'barcelona_collection.png', 0, NULL, '2021-05-30 14:02:53'),
(10, 'flooring ba', NULL, 'flooring_ba_collection.png', 0, NULL, '2021-05-30 14:02:53'),
(12, 'flooring be', NULL, 'flooring_be_collection.png', 0, NULL, '2021-05-30 14:02:53'),
(13, 'golden', NULL, 'golden_collection.png', 0, NULL, '2021-05-30 14:02:53'),
(14, 'lotus', NULL, 'lotus.jpg', 0, NULL, '2021-05-30 14:02:53'),
(15, 'saten', NULL, 'saten_collection.png', 0, NULL, '2021-05-30 14:02:53'),
(16, 'zegna', NULL, 'zegna.jpg', 0, NULL, '2021-05-30 14:02:53'),
(17, 'Olmalar', NULL, 'quality211469922.png', 0, '2021-05-31 13:19:02', '2021-05-31 13:41:39'),
(18, '123', NULL, 'quality1438766059.png', 0, '2021-05-31 13:25:54', '2021-05-31 13:29:14');

-- --------------------------------------------------------

--
-- Структура таблицы `rooms`
--

CREATE TABLE `rooms` (
  `id` int(11) UNSIGNED NOT NULL,
  `name` varchar(100) DEFAULT NULL,
  `image` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT current_timestamp(),
  `changed` tinyint(1) NOT NULL DEFAULT 0 COMMENT '0 - bazadan tortilgan.\r\n1 - tortish kerak.',
  `updated_at` timestamp NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `rooms`
--

INSERT INTO `rooms` (`id`, `name`, `image`, `created_at`, `changed`, `updated_at`) VALUES
(1, 'Olmalar', 'room1594914652.png', NULL, 0, '2021-05-31 09:10:18'),
(2, 'salom123', 'room1197945928.png', NULL, 0, '2021-05-31 08:35:47'),
(3, 'Yotoqxona', 'yotoqxona.png', NULL, 0, NULL),
(8, 'Bolalar xonasi', 'bolalar_xonasi.png', NULL, 0, NULL),
(14, 'Zal uchun', 'room134066938.png', NULL, 0, '2021-06-02 05:32:36');

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
(1, 'Ismoil', 'Maxmudov', 'test@gmail.com', NULL, 'ismoil', '$2y$10$b57SQSRH/XoS6vZ1mwUG0uKYUrQUdOPqNMzqyV8gjXUacUSCbWqhK', 'gjRGsejX4xncsxNdob5fkGLijqLCngRHiGNfxIrgDX0HlsnUNI3WPrDIXw33', 'admin', '+998972087090', '1996-04-22', 'Dang\'ara tumani', 1, '2021-05-14 09:24:06', '2021-05-14 09:24:06'),
(3, 'Olimjon', 'Ergasher', 'olim@gmail.com', NULL, 'olimjon', '202cb962ac59075b964b07152d234b70', NULL, 'manager', '905062323', '', 'Kokon. Vogzal', 1, '2021-05-24 06:59:28', NULL),
(4, 'Ismoil', 'Maxmudov', 'test12@gmia.com', NULL, 'ismoil1', '123456', NULL, 'manager', '(94) 556-83-86', 'fsdfsd', 'asdasd', 1, NULL, NULL),
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
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT;

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
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT для таблицы `qualities`
--
ALTER TABLE `qualities`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT для таблицы `rooms`
--
ALTER TABLE `rooms`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT для таблицы `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
