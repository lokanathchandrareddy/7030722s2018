-- phpMyAdmin SQL Dump
-- version 4.7.7
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Apr 30, 2018 at 01:01 PM
-- Server version: 5.6.39-cll-lve
-- PHP Version: 5.6.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `photogallery`
--

-- --------------------------------------------------------

--
-- Table structure for table `tbl_gallery`
--

CREATE TABLE `tbl_gallery` (
  `id` int(10) NOT NULL,
  `user_id` int(11) NOT NULL,
  `title` varchar(100) NOT NULL,
  `description` varchar(500) NOT NULL,
  `image` varchar(100) NOT NULL,
  `status` varchar(50) NOT NULL,
  `link` varchar(100) NOT NULL,
  `created_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_gallery`
--

INSERT INTO `tbl_gallery` (`id`, `user_id`, `title`, `description`, `image`, `status`, `link`, `created_date`) VALUES
(124, 141, 'Flowers', '', '5581525073391.jpg', 'Public', '', '2018-04-30 07:29:54');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `user_name` varchar(255) NOT NULL,
  `user_type` varchar(30) NOT NULL,
  `first_name` varchar(100) NOT NULL,
  `last_name` varchar(100) NOT NULL,
  `user_email` varchar(255) NOT NULL,
  `user_password` varchar(255) NOT NULL,
  `gender` varchar(255) NOT NULL,
  `locale` varchar(255) NOT NULL,
  `mobile_number` varchar(255) NOT NULL,
  `status` int(10) NOT NULL DEFAULT '0',
  `created_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_date` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `picture` varchar(255) NOT NULL,
  `link` varchar(255) NOT NULL,
  `oauth_provider` varchar(255) NOT NULL,
  `oauth_uid` varchar(100) NOT NULL,
  `fuid` varchar(200) NOT NULL,
  `hash` varchar(100) NOT NULL,
  `change_pwd_request` int(10) NOT NULL DEFAULT '0'
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `user_name`, `user_type`, `first_name`, `last_name`, `user_email`, `user_password`, `gender`, `locale`, `mobile_number`, `status`, `created_date`, `updated_date`, `picture`, `link`, `oauth_provider`, `oauth_uid`, `fuid`, `hash`, `change_pwd_request`) VALUES
(147, '', '', 'Lokanath', 'Reddy', 'Lokanath@gmail.com', 'd6832d85b5d9f75d44520c4cdc52e602', '', '', '', 1, '2018-04-30 13:57:49', '2018-04-27 08:27:49', 'user_avater.png', '', '', '', '', '', 0),
(121, 'admin', 'admin', 'Lokanatha', 'CReddy', 'admin@gmail.com', '75d23af433e0cea4c0e45a56dba18b30', '', '', '12345678', 1, '2018-04-30 06:42:46', '2018-04-30 01:12:46', '9951525069084.jpg', '', '', '', '', '', 0),
(148, '', '', 'test', 'test123', 'test123@gmail.com', 'fdc2831fc92a78a8c4c347751974c566', '', '', '896848432333', 1, '2018-04-27 14:00:45', '2018-04-27 08:30:30', '3541524837641.jpg', '', '', '', '', '', 0);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tbl_gallery`
--
ALTER TABLE `tbl_gallery`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tbl_gallery`
--
ALTER TABLE `tbl_gallery`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=125;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=161;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
