-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 20, 2022 at 08:40 PM
-- Server version: 10.4.21-MariaDB
-- PHP Version: 7.4.23

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `donation_donation`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `id` int(11) NOT NULL,
  `name` varchar(50) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(100) NOT NULL DEFAULT current_timestamp(),
  `created_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`id`, `name`, `email`, `password`, `created_at`) VALUES
(1, 'admin', 'admin@gmail.com', '$2y$10$eJVQpHOb9KenpcTn7u9mxemfZWdCNY9QTKap92dNt9MjoRry6oxbK', '2022-06-17 21:09:32');

-- --------------------------------------------------------

--
-- Table structure for table `donation`
--

CREATE TABLE `donation` (
  `id` int(11) NOT NULL,
  `phone` int(15) NOT NULL,
  `ammount` int(11) NOT NULL,
  `trxid` varchar(10) NOT NULL,
  `name` varchar(100) NOT NULL,
  `approved` int(11) NOT NULL,
  `created_at` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `donation`
--

INSERT INTO `donation` (`id`, `phone`, `ammount`, `trxid`, `name`, `approved`, `created_at`) VALUES
(1, 2345678, 500, '23456', 'Maksudul', 1, '2022-06-19 03:46:55'),
(3, 3333, 200, '345655', 'Maksudul', 1, '2022-06-19 03:47:45');

-- --------------------------------------------------------

--
-- Table structure for table `request`
--

CREATE TABLE `request` (
  `id` int(11) NOT NULL,
  `author_id` int(11) NOT NULL,
  `description` varchar(250) NOT NULL,
  `blood_group` varchar(5) NOT NULL,
  `quantity` int(2) NOT NULL,
  `date` date DEFAULT NULL,
  `contact` int(15) NOT NULL,
  `hospital` varchar(50) NOT NULL,
  `photo` varchar(200) NOT NULL,
  `response` int(2) NOT NULL,
  `completed` int(11) NOT NULL,
  `created_at` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `request`
--

INSERT INTO `request` (`id`, `author_id`, `description`, `blood_group`, `quantity`, `date`, `contact`, `hospital`, `photo`, `response`, `completed`, `created_at`) VALUES
(1, 1, 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Fuga cupiditate optio quas voluptates soluta ipsa, natus dolorem nulla dignissimos, sint unde aperiam, veniam est aspernatur maiores neque in nihil dolores!', 'B+', 1, '2022-06-21', 1919181716, 'General Hospital', 'patient-1.jpg', 0, 0, '2022-06-11 08:18:21'),
(2, 2, 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Fuga cupiditate optio quas voluptates soluta ipsa, natus dolorem nulla dignissimos, sint unde aperiam, veniam est aspernatur maiores neque in nihil dolores!', 'A+', 2, '2022-06-21', 1611121314, 'Central Hospital', 'patient-2.jpg', 0, 0, '2022-06-11 08:18:21'),
(3, 3, 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Fuga cupiditate optio quas voluptates soluta ipsa, natus dolorem nulla dignissimos, sint unde aperiam, veniam est aspernatur maiores neque in nihil dolores!', 'O+', 3, '2022-06-21', 1199887766, 'Punam Hospital', 'patient-3.jpg', 1, 0, '2022-06-11 08:21:57'),
(4, 1, 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Fuga cupiditate optio quas voluptates soluta ipsa, natus dolorem nulla dignissimos, sint unde aperiam, veniam est aspernatur maiores neque in nihil dolores!', 'B+', 1, '2022-06-21', 1919181716, 'General Hospital', 'patient-1.jpg', 0, 0, '2022-06-11 08:18:21'),
(5, 2, 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Fuga cupiditate optio quas voluptates soluta ipsa, natus dolorem nulla dignissimos, sint unde aperiam, veniam est aspernatur maiores neque in nihil dolores!', 'A+', 2, '2022-06-21', 1611121314, 'Central Hospital', 'patient-2.jpg', 0, 0, '2022-06-11 08:18:21'),
(6, 3, 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Fuga cupiditate optio quas voluptates soluta ipsa, natus dolorem nulla dignissimos, sint unde aperiam, veniam est aspernatur maiores neque in nihil dolores!', 'O+', 3, '2022-06-21', 1199887766, 'Punam Hospital', 'patient-3.jpg', 1, 0, '2022-06-11 08:21:57'),
(7, 1, 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Fuga cupiditate optio quas voluptates soluta ipsa, natus dolorem nulla dignissimos, sint unde aperiam, veniam est aspernatur maiores neque in nihil dolores!', 'B+', 1, '2022-06-21', 1919181716, 'General Hospital', 'patient-1.jpg', 0, 0, '2022-06-11 08:18:21'),
(8, 2, 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Fuga cupiditate optio quas voluptates soluta ipsa, natus dolorem nulla dignissimos, sint unde aperiam, veniam est aspernatur maiores neque in nihil dolores!', 'A+', 2, '2022-06-21', 1611121314, 'Central Hospital', 'patient-2.jpg', 0, 0, '2022-06-11 08:18:21'),
(9, 3, 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Fuga cupiditate optio quas voluptates soluta ipsa, natus dolorem nulla dignissimos, sint unde aperiam, veniam est aspernatur maiores neque in nihil dolores!', 'O+', 3, '2022-06-21', 1199887766, 'Punam Hospital', 'patient-3.jpg', 1, 0, '2022-06-11 08:21:57'),
(10, 1, 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Fuga cupiditate optio quas voluptates soluta ipsa, natus dolorem nulla dignissimos, sint unde aperiam, veniam est aspernatur maiores neque in nihil dolores!', 'B+', 1, '2022-06-21', 1919181716, 'General Hospital', 'patient-1.jpg', 0, 0, '2022-06-11 08:18:21'),
(11, 2, 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Fuga cupiditate optio quas voluptates soluta ipsa, natus dolorem nulla dignissimos, sint unde aperiam, veniam est aspernatur maiores neque in nihil dolores!', 'A+', 2, '2022-06-21', 1611121314, 'Central Hospital', 'patient-2.jpg', 0, 0, '2022-06-11 08:18:21'),
(12, 3, 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Fuga cupiditate optio quas voluptates soluta ipsa, natus dolorem nulla dignissimos, sint unde aperiam, veniam est aspernatur maiores neque in nihil dolores!', 'O+', 3, '2022-06-21', 1199887766, 'Punam Hospital', 'patient-3.jpg', 1, 0, '2022-06-11 08:21:57'),
(13, 1, 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Fuga cupiditate optio quas voluptates soluta ipsa, natus dolorem nulla dignissimos, sint unde aperiam, veniam est aspernatur maiores neque in nihil dolores!', 'B+', 1, '2022-06-21', 1919181716, 'General Hospital', 'patient-1.jpg', 0, 0, '2022-06-11 08:18:21'),
(14, 2, 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Fuga cupiditate optio quas voluptates soluta ipsa, natus dolorem nulla dignissimos, sint unde aperiam, veniam est aspernatur maiores neque in nihil dolores!', 'A+', 2, '2022-06-21', 1611121314, 'Central Hospital', 'patient-2.jpg', 0, 0, '2022-06-11 08:18:21'),
(15, 3, 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Fuga cupiditate optio quas voluptates soluta ipsa, natus dolorem nulla dignissimos, sint unde aperiam, veniam est aspernatur maiores neque in nihil dolores!', 'O+', 3, '2022-06-21', 1199887766, 'Punam Hospital', 'patient-3.jpg', 1, 0, '2022-06-11 08:21:57'),
(16, 1, 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Fuga cupiditate optio quas voluptates soluta ipsa, natus dolorem nulla dignissimos, sint unde aperiam, veniam est aspernatur maiores neque in nihil dolores!', 'B+', 1, '2022-06-21', 1919181716, 'General Hospital', 'patient-1.jpg', 0, 0, '2022-06-11 08:18:21'),
(17, 2, 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Fuga cupiditate optio quas voluptates soluta ipsa, natus dolorem nulla dignissimos, sint unde aperiam, veniam est aspernatur maiores neque in nihil dolores!', 'A+', 2, '2022-06-21', 1611121314, 'Central Hospital', 'patient-2.jpg', 0, 0, '2022-06-11 08:18:21'),
(18, 3, 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Fuga cupiditate optio quas voluptates soluta ipsa, natus dolorem nulla dignissimos, sint unde aperiam, veniam est aspernatur maiores neque in nihil dolores!', 'O+', 3, '2022-06-21', 1199887766, 'Punam Hospital', 'patient-3.jpg', 1, 0, '2022-06-11 08:21:57'),
(19, 1, 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Fuga cupiditate optio quas voluptates soluta ipsa, natus dolorem nulla dignissimos, sint unde aperiam, veniam est aspernatur maiores neque in nihil dolores!', 'B+', 1, '2022-06-21', 1919181716, 'General Hospital', 'patient-1.jpg', 0, 0, '2022-06-11 08:18:21'),
(20, 2, 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Fuga cupiditate optio quas voluptates soluta ipsa, natus dolorem nulla dignissimos, sint unde aperiam, veniam est aspernatur maiores neque in nihil dolores!', 'A+', 2, '2022-06-21', 1611121314, 'Central Hospital', 'patient-2.jpg', 0, 0, '2022-06-11 08:18:21'),
(21, 3, 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Fuga cupiditate optio quas voluptates soluta ipsa, natus dolorem nulla dignissimos, sint unde aperiam, veniam est aspernatur maiores neque in nihil dolores!', 'O+', 3, '2022-06-21', 1199887766, 'Punam Hospital', 'patient-3.jpg', 1, 0, '2022-06-11 08:21:57'),
(22, 1, 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Fuga cupiditate optio quas voluptates soluta ipsa, natus dolorem nulla dignissimos, sint unde aperiam, veniam est aspernatur maiores neque in nihil dolores!\"', 'B+', 1, '2022-06-21', 1919181716, 'General Hospital', '62af7dbc73ef0.jpg', 0, 0, '2022-06-11 08:18:21'),
(23, 2, 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Fuga cupiditate optio quas voluptates soluta ipsa, natus dolorem nulla dignissimos, sint unde aperiam, veniam est aspernatur maiores neque in nihil dolores!\"', 'A+', 2, '2022-06-21', 1811223344, 'Central Hospital', 'patient-2.jpg', 0, 0, '2022-06-11 08:18:21'),
(24, 3, 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Fuga cupiditate optio quas voluptates soluta ipsa, natus dolorem nulla dignissimos, sint unde aperiam, veniam est aspernatur maiores neque in nihil dolores!', 'O+', 3, '2022-06-21', 1199887766, 'Punam Hospital', 'patient-3.jpg', 1, 1, '2022-06-11 08:21:57'),
(27, 1, 'Thelasemia.', 'A-', 1, '2022-06-14', 1737844365, 'Jamalpur General Hospital', '62a56b7595a27.jpg', 0, 1, '2022-06-12 10:28:37');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `gender` varchar(10) NOT NULL,
  `blood_group` varchar(5) NOT NULL,
  `phone` varchar(15) NOT NULL,
  `bio` varchar(200) NOT NULL,
  `address` varchar(200) NOT NULL,
  `photo` varchar(200) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(60) NOT NULL,
  `total_donation` int(11) DEFAULT NULL,
  `last_donation` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id`, `name`, `gender`, `blood_group`, `phone`, `bio`, `address`, `photo`, `email`, `password`, `total_donation`, `last_donation`) VALUES
(1, 'Wasif Akanda', 'Male', 'O+', '01718-772173', 'Hi, I\'m Wasif Akanda. I live in Mymensingh. I love to donate blood. If you need any kind of help in the blood donation field, feel free to contact me. Thank you.\"\"', 'Shankipara, Mymensingh', '62af845a9d44a.jpg', 'wasif@gmail.com', '$2y$10$pUPyM8Z/dQcjGE4EiFtnQOz8MtwLdW0cbtQ0KgAaLoo4QHkgXUb26', 0, NULL),
(2, 'Falguni Shabnam', 'Female', 'A+', '01718-262061', 'Hi, I\'m Falguni. I live in Sherpur. I love to donate blood. If you need any kind of help in the blood donation field, feel free to contact me. Thank you.', 'Sherpur', 'falguni.jpg', 'falguni@gmail.com', '$2y$10$Wbrc8b.E2eBSDnx1fufAW.xiMHy1iBEsY2jFcsnbdxX/jkLyGLM4u', 0, NULL),
(3, 'Maksudul', 'Male', 'B+', '01716-685459', 'Hey, I\'m Saidul Mursalin. I live in Jamalpur. I love to donate blood. If you need any kind of help in the blood donation field, feel free to contact me. Thank you.', 'Jamalpur', 'monir.gif', 'monir@gmail.com', '$2y$10$Wbrc8b.E2eBSDnx1fufAW.xiMHy1iBEsY2jFcsnbdxX/jkLyGLM4u', 0, NULL),
(4, 'Abu Talha Apon', 'Male', 'B+', '111111111', '', 'Jamalpur', '', 'apon@gmail.com', '$2y$10$nGA6D4rdwEOrbL.q6DTDi.2kmlqEoPjm5bGtcC24Vjtc3m9008iBG', 0, NULL),
(6, 'Moin Khan', 'Male', 'A-', '7423479723', '', 'Sherpur, Mymensingh', '', 'moin@gmail.com', '$2y$10$buBohsH1kV7C9xteOPYVUuPIMKh5TtyVKEwVpOjdWj6CKgsf5xR72', 0, NULL);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `donation`
--
ALTER TABLE `donation`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `trxid` (`trxid`);

--
-- Indexes for table `request`
--
ALTER TABLE `request`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `donation`
--
ALTER TABLE `donation`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `request`
--
ALTER TABLE `request`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
