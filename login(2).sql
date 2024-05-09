-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 04, 2024 at 01:21 PM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.0.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `login`
--

-- --------------------------------------------------------

--
-- Table structure for table `cart`
--

CREATE TABLE `cart` (
  `id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `quantity` int(11) DEFAULT 1,
  `session_id` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `cart`
--

INSERT INTO `cart` (`id`, `product_id`, `quantity`, `session_id`) VALUES
(81, 4, 1, 'er14n8ft6kqe02fu7aukg1vs0v'),
(83, 4, 1, 'tvk99373ijq7f99on78bvpltj8'),
(93, 8, 1, 'v7afb1810hapeqdjrenjge6bs8'),
(94, 4, 1, 'v7afb1810hapeqdjrenjge6bs8'),
(98, 4, 1, 'u4fh57iqbud35s1a0o36683f1l'),
(103, 4, 1, 'ofmlermj2v6r8j6fgabfmi2ld2'),
(104, 5, 1, 'ofmlermj2v6r8j6fgabfmi2ld2'),
(114, 37, 1, 'f0jtf4mech4o8gbbdacomrtr5f'),
(121, 42, 2, 'uhgl1imudivalepj5hkbgq0st9'),
(122, 41, 1, 'uhgl1imudivalepj5hkbgq0st9'),
(123, 45, 1, 'uhgl1imudivalepj5hkbgq0st9'),
(124, 44, 1, 'uhgl1imudivalepj5hkbgq0st9');

-- --------------------------------------------------------

--
-- Table structure for table `message`
--

CREATE TABLE `message` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `subject` varchar(255) NOT NULL,
  `message` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `message`
--

INSERT INTO `message` (`id`, `name`, `email`, `subject`, `message`) VALUES
(1, 'haha', 'haha@gmail.com', 'hahah', 'hahaha'),
(2, 'prince', 'prince@gmail.com', 'QCU', 'tangina mo qcu magpa asych kana ang init putangina mo tinatamad ako pumasok at the same time nakakalungkot di ko makikita baby ko'),
(3, 'zoey', 'zoey@gmail.com', 'yasuo', 'hasagi, soryegeton'),
(4, 'hehe', 'hehe@gmail.com', 'guitar', 'asdfsadfs'),
(5, '', '', '', ''),
(6, 'prince', 'prince@gmail.com', 'guitars', 'asdfasd'),
(7, 'asdf', 'asdf@gmail.com', 'gfd', 'dsfgsdfg'),
(8, 'helol', 'prince@gmail.com', 'gfsd', 'asdfs'),
(9, 'helol', 'prince@gmail.com', 'gfsd', 'asdfs');

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `id` int(11) NOT NULL,
  `customer_name` varchar(255) NOT NULL,
  `address` text NOT NULL,
  `phone` varchar(15) NOT NULL,
  `total` decimal(10,2) NOT NULL,
  `order_status` enum('pending','completed') DEFAULT 'pending',
  `order_date` timestamp NOT NULL DEFAULT current_timestamp(),
  `session_id` varchar(255) DEFAULT NULL,
  `user_id` int(11) DEFAULT NULL,
  `product_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`id`, `customer_name`, `address`, `phone`, `total`, `order_status`, `order_date`, `session_id`, `user_id`, `product_id`) VALUES
(43, 'sadf', 'asdf', '12312', 50.00, 'pending', '2024-05-04 09:01:27', 'ce605g4rqtsglj6c2cb615hgbo', 8, NULL),
(44, 'asd', 'hahaha', '123', 250.00, 'pending', '2024-05-04 09:25:07', 'ce605g4rqtsglj6c2cb615hgbo', 19, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `price` decimal(10,2) NOT NULL,
  `image` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`id`, `name`, `price`, `image`) VALUES
(58, 'Niggaz in japan', 50.00, '429452653_413500874416334_961983098260262696_n.jpg'),
(59, 'Pakboy sa olfu', 100.00, '434048935_1385774985475977_5404611461814144353_n.jpg'),
(60, 'Bestlink Enjoyer', 50.00, '382443693_626966079333553_7139967055066242110_n.jpg'),
(61, 'sinaksak ang lolo', 100.00, '434073405_276086608881564_8685173233537520588_n.jpg'),
(62, 'Binaril ang lolo', 100.00, '439772333_478386811184709_97457674451884039_n.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL,
  `role` enum('admin','customer') DEFAULT 'customer',
  `first_name` varchar(255) DEFAULT NULL,
  `last_name` varchar(255) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `contact_number` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `password`, `role`, `first_name`, `last_name`, `email`, `contact_number`) VALUES
(1, 'mia', '$2y$10$gd8A/IPHdsmaEs21tX7NI.meX3OFFFBz/CTOiXXThEBRe5eVY43Qi', 'customer', 'mia', 'mia', 'mia@gmail.com', '121'),
(2, 'admin', 'admin', 'admin', 'admin', 'admin', 'admin@gmail.com', '123'),
(3, 'lol', '$2y$10$Mo8NsvyOvq0xQy8105pNmOtxKGT4Po4xmOxhF9WYV9311Mg3mV4KW', 'customer', 'ewan', 'ewan', 'ewan@gmail.com', '123423'),
(4, 'upp', '$2y$10$8mNCup3Fpqu5iFptZv.1sO4EAhup8cGHmnB2hchbMcRs4FDwnQmkm', 'customer', 'upp', 'upp', 'upp@gmail.com', '123'),
(5, 'asda', '$2y$10$A3QSx5qboaCLxqFKm3gdqeCBfSnuAPY.anT3AZA/sotmhceqNc/KC', 'customer', 'asdfsd', 'asdasd', 's@gmail.com', '12312'),
(6, 'haha', '$2y$10$847nyjAiUL1uUFrj8p2/eODAux.7KKuWGYMqR0jPTFsEEy/Jx2ZBa', 'customer', 'haha', 'haha', 'haha@gmail.com', '123123'),
(15, 'sad', 'sad', 'customer', 'sad', 'sad', 'sad@gmail.com', '123'),
(19, 'eh', 'eh', 'customer', 'eh', 'eh', 'eh@gmail.com', '123'),
(20, 'elu', 'elu', 'customer', 'elu', 'elu', 'papetsevilla12@gmail.com', '0123');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `cart`
--
ALTER TABLE `cart`
  ADD PRIMARY KEY (`id`),
  ADD KEY `product_id` (`product_id`);

--
-- Indexes for table `message`
--
ALTER TABLE `message`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD KEY `username` (`username`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `cart`
--
ALTER TABLE `cart`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=172;

--
-- AUTO_INCREMENT for table `message`
--
ALTER TABLE `message`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=46;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=64;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
