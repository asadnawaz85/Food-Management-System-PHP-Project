-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 08, 2024 at 05:27 PM
-- Server version: 10.4.27-MariaDB
-- PHP Version: 8.2.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `php_project`
--

-- --------------------------------------------------------

--
-- Table structure for table `food_items`
--

CREATE TABLE `food_items` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `price` int(200) NOT NULL,
  `status` varchar(200) NOT NULL DEFAULT 'Available',
  `stock` int(255) NOT NULL DEFAULT 30
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `food_items`
--

INSERT INTO `food_items` (`id`, `name`, `price`, `status`, `stock`) VALUES
(23, 'item1', 150, 'Not Available', 30),
(24, 'item2', 200, 'Available', 28),
(25, 'item3', 300, 'Available', 18),
(26, 'item4', 250, 'Available', 29),
(27, 'item5', 400, 'Available', 30),
(29, 'item 6', 350, 'Available', 30);

-- --------------------------------------------------------

--
-- Table structure for table `food_order`
--

CREATE TABLE `food_order` (
  `id` int(11) NOT NULL,
  `user_sid` int(25) NOT NULL,
  `user_name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `item_name` varchar(200) NOT NULL,
  `item_price` varchar(200) NOT NULL,
  `address` varchar(200) NOT NULL,
  `quantaty` int(11) NOT NULL,
  `phone` int(25) NOT NULL,
  `discription` varchar(255) NOT NULL,
  `status` varchar(200) NOT NULL DEFAULT 'Yet to be Delivered',
  `created_at` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `food_order`
--

INSERT INTO `food_order` (`id`, `user_sid`, `user_name`, `email`, `item_name`, `item_price`, `address`, `quantaty`, `phone`, `discription`, `status`, `created_at`) VALUES
(43, 3, 'Margin', 'margin@gmail.com', 'item1', '100', 'UK', 2, 12342423, 'NO Discription', 'Cancel by User', '2024-03-31 10:57:54'),
(44, 4, 'Asheno', 'ash@gmail.com', 'item4', '250', 'Austrelia', 1, 234453523, 'No Discription\r\n', 'Yet to be Delivered', '2024-03-31 11:00:27'),
(45, 5, 'Morgin', 'morgin@gmail.com', 'item 6', '350', 'Canada', 4, 2353563, 'No Discription', 'Yet to be Delivered', '2024-03-31 11:01:36'),
(46, 9, 'Morki', 'morli@gmail.com', 'item2', '200', 'UK', 2, 33424525, 'NO discription', 'Approved by Admin', '2024-03-31 11:08:48'),
(47, 9, 'Morli', 'morli@gmail.com', 'item3', '300', 'UK', 12, 1234234134, 'no', 'Yet to be Delivered', '2024-04-17 09:53:28');

-- --------------------------------------------------------

--
-- Table structure for table `registration`
--

CREATE TABLE `registration` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `phone` varchar(25) NOT NULL,
  `role` varchar(200) NOT NULL,
  `address` varchar(255) NOT NULL,
  `created_at` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `registration`
--

INSERT INTO `registration` (`id`, `name`, `email`, `password`, `phone`, `role`, `address`, `created_at`) VALUES
(1, 'Devin', 'abc@gmail.com', 'din123', '3243534322', 'User', 'Us', '2024-02-04 16:22:18'),
(3, 'Margin', 'margin@gmail.com', 'margin123', '32433254', 'User', 'UK', '2024-02-04 17:13:47'),
(4, 'Asheno', 'ash@gmail.com', 'ash123', '4536363', 'User', 'Austrelia', '2024-02-04 17:14:40'),
(5, 'Morgin', 'morgin@gmail.com', 'mori123', '425265', 'User', 'Canada', '2024-02-11 13:12:06'),
(6, 'Admin', 'admin@gmail.com', '112233', '2435641', 'Admin', 'USA', '2024-02-11 15:23:04'),
(7, 'Healson', 'hels@gmail.com', 'hals123', '8754656', 'User', 'Malishia', '2024-02-11 17:11:37'),
(9, 'Morli', 'morli@gmail.com', 'morli1234', '33442343142', 'User', 'UK', '2024-03-31 11:08:02');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `food_items`
--
ALTER TABLE `food_items`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `food_order`
--
ALTER TABLE `food_order`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `registration`
--
ALTER TABLE `registration`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `food_items`
--
ALTER TABLE `food_items`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=30;

--
-- AUTO_INCREMENT for table `food_order`
--
ALTER TABLE `food_order`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=48;

--
-- AUTO_INCREMENT for table `registration`
--
ALTER TABLE `registration`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
