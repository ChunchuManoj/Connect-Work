-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Jun 27, 2024 at 02:44 PM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `user`
--

-- --------------------------------------------------------

--
-- Table structure for table `contact_us`
--

CREATE TABLE `contact_us` (
  `id` int(100) NOT NULL,
  `name` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `subject` varchar(500) NOT NULL,
  `message` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `contact_us`
--

INSERT INTO `contact_us` (`id`, `name`, `email`, `subject`, `message`) VALUES
(13, 'manoj', 'example@gmail.com', 'problem', 'i am facing a problem.'),
(17, 'Yashvanth', 'yashvanth@gmail.com', 'problem', 'i am facing problem in loign into my account.'),
(18, 'Yashvanth', 'yashvanth123xf@gmail.com', 'problem', 'xdfsht'),
(19, 'chunchu prabhakar', 'example@gmail.com', 'problem', 'i have a probelm'),
(20, 'Chunchu Manoj', 'manoj123@gmail.com', 'hello every one', 'good evening.'),
(21, 'Chunchu Manoj', 'raju@gmail.com', 'problem', 'i facing problem in login.'),
(22, 'Yashvanth', 'example@gmail.com', 'problem', 'hello');

-- --------------------------------------------------------

--
-- Table structure for table `customers`
--

CREATE TABLE `customers` (
  `id` int(100) NOT NULL,
  `username` varchar(100) NOT NULL,
  `full_name` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(100) NOT NULL,
  `mobile_number` varchar(10) NOT NULL,
  `area` varchar(100) NOT NULL,
  `pin_code` int(6) NOT NULL,
  `profile_pic` varchar(100) NOT NULL,
  `created` timestamp NOT NULL DEFAULT current_timestamp(),
  `verify_token` varchar(100) NOT NULL,
  `verify_status` tinyint(2) NOT NULL DEFAULT 0 COMMENT '0=no,1=verified'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `customers`
--

INSERT INTO `customers` (`id`, `username`, `full_name`, `email`, `password`, `mobile_number`, `area`, `pin_code`, `profile_pic`, `created`, `verify_token`, `verify_status`) VALUES
(3, 'manoj kumar', 'Chunchu manoj', 'manoj123@gmail.com', '$2y$10$wN0CZ9xCatQHhlANd30hLOxNsMU6wV3vXKClBrXTMNVTM3A0xhVSu', '2147483647', 'uppal', 500039, 'download (3).jpeg', '2024-05-07 09:32:43', '', 1),
(4, 'prakash', 'chunchu prakash', 'prakash123@gmail.com', '$2y$10$Z8hOBhQB1B4S22O1dgVthuvE6oJrB9Wj4AHO7GQrOHjIyif6AEXNu', '2147483647', 'uppal', 500039, '', '2024-05-11 15:35:14', '', 0),
(8, 'prabhakar', 'chunchu prabhakar', 'prabhakar123@gmail.com', '$2y$10$Qibd2uFwrA0iFh1ui1WfP.8IM0OoHW6N.YfOQCL5TCGPp3sln9JjO', '9110750232', 'uppal', 500039, 'th.jpeg', '2024-05-13 08:03:25', '', 0),
(16, 'Chunchu Manoj ', 'raju nalla', 'example@gmail.com', '$2y$10$R25WVzQABO1TQC0yPCJtiOKty9.NUYoLsLQvkTtggFqIcbCs08p6m', '8367092993', 'uppal', 500039, 'download (4).jpeg', '2024-05-13 12:42:50', '6703236a47aa6272e98acae3b06c8adb', 1),
(18, 'manoj', 'chunchu prabhakar', 'example@gmail.com', '$2y$10$.RmTZezLpaKcxJ.RrgzAUOI4hMiWYvWPvLeP8KpYh0Ecyt.rX/Gua', '9110750156', 'boduppal', 500039, 'download (6).jpeg', '2024-05-15 05:47:34', '7241ac3eabaabbb945bc4833f13f7556', 1),
(20, 'shahi', 'Shashi d', 'example@gmail.com', '$2y$10$z4vhjMiLg0ZbDpU1pE3d8eTRmS1c/1UrKifs9pAtZ.5/voulovgd.', '7708967546', 'nagole', 500032, '', '2024-05-21 10:22:38', '1e258ff6063688925512c09d1acda759', 1),
(21, 'aditya', 'Aditya Singh', 'example@gmail.com', '$2y$10$N8DNcL6EtwmY/yGYe2KDdeYpx0HgUizoYpyii2L2T/CwGi47im/p.', '7842434222', 'Narapally', 500088, 'welding (1).jpg', '2024-05-23 08:53:45', '16ffea1d9f36e398428c40c3d4da0016', 0);

-- --------------------------------------------------------

--
-- Table structure for table `workers`
--

CREATE TABLE `workers` (
  `id` int(11) NOT NULL,
  `username` varchar(255) NOT NULL,
  `full_name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `mobile_number` varchar(10) NOT NULL,
  `address` varchar(255) NOT NULL,
  `area` varchar(255) NOT NULL,
  `pin_code` varchar(6) NOT NULL,
  `work_experience` varchar(255) NOT NULL,
  `description` text NOT NULL,
  `profile_pic` varchar(400) NOT NULL,
  `field` varchar(30) NOT NULL,
  `created` timestamp NOT NULL DEFAULT current_timestamp(),
  `latitude` float NOT NULL,
  `longitude` float NOT NULL,
  `verify_token` varchar(100) NOT NULL,
  `verify_status` tinyint(2) NOT NULL DEFAULT 0 COMMENT '0=not,1=verifyed'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `workers`
--

INSERT INTO `workers` (`id`, `username`, `full_name`, `email`, `password`, `mobile_number`, `address`, `area`, `pin_code`, `work_experience`, `description`, `profile_pic`, `field`, `created`, `latitude`, `longitude`, `verify_token`, `verify_status`) VALUES
(20, 'Manoj Varma', 'Manoj Varma', 'manojv@gmail.com', '$2y$10$mBUbdwfAP5Qo3/4SPIKMrOA9.6zamsY3asaNmun6/UFcRq6xy1hVm', '8367092999', 'uppal', 'beerappagadda', '500039', '4', 'I am a dedicated electrician with four years of experience in electrical installations and repairs. My expertise covers wiring, lighting systems, circuit breakers, and electrical troubleshooting. I prioritize safety and efficiency, ensuring all electrical work meets industry standards and client expectations.', 'mohan v pic.jpg', 'Electrician', '2024-05-06 15:30:57', 17.4059, 78.5638, '', 0),
(21, 'Ramesh yadav', 'Chintha Ramesh', 'ramesh123@gmail.com', '$2y$10$47J2rOluUeHOVSfg4mgKv.OU21sx6MxRZlI83pWI.6go7SwkmZON2', '7483749395', 'Secunderabad', 'ramanthapur', '500039', '5', 'I am committed to delivering high-quality cleaning services tailored to meet the specific needs of each client. My attention to detail, reliability, and dedication to maintaining a clean and pleasant environment have consistently resulted in high customer satisfaction. I strive to exceed expectations and provide a fresh and inviting atmosphere in every space I clean.', 'pic2.jpeg', 'Cleaner', '2024-05-06 15:30:57', 17.4008, 78.5383, '', 1),
(22, 'Ajay', 'Dogginani Ajay', 'ajay123@gmail.com', '$2y$10$4nGrTFckoSR2uJF28RnXzejdVr/obTUMtA3QWwH9ZwI6OQyknyxl.', '8293827394', 'hyderabad', 'uppal', '500039', '6', 'I am dedicated to delivering high-quality workmanship and exceptional customer service. My goal is to enhance the aesthetic appeal and value of your property through professional painting services. Whether it\'s a small room refresh or a large-scale renovation, I take pride in my work and strive for excellence in every project.', 'WhatsApp Image 2023-07-10 at 3.12.01 PM.jpeg', 'Painter', '2024-05-06 15:30:57', 17.3998, 78.5649, '', 0),
(23, 'Venu', 'Venu ramula', 'venua@gmail.com', '$2y$10$/ytyxun9aaOUTdMWTF4F4es8AtyPwI7xORi9yD.nW.Gp3.WobXR6a', '8293827394', 'hyderabad', 'nagole', '500039', '7', 'I am an experienced electrician with seven years in the field. I have worked on a variety of projects ranging from residential to commercial installations. My expertise includes wiring, troubleshooting electrical issues, and ensuring compliance with safety regulations. I am proficient in handling electrical equipment and tools and have a strong understanding of electrical systems. My focus is on delivering high-quality service and ensuring customer satisfaction.', 'WhatsApp Image 2023-08-14 at 18.19.59.jpg', 'Cleaner', '2024-05-06 15:30:57', 17.3777, 78.5625, '', 0),
(24, 'Sumanth', 'Sumanth Reddy', 'sumanthreddy@gmail.com', '$2y$10$cV.iP71wTuQHH6LSOisUG.vZOtBPenNzlwQU6DBNibFf3lSopMVBK', '8293827394', 'hyderabad', 'tarnaka', '500039', '5', 'I am a skilled plumber with five years of experience in the industry. I specialize in installing and repairing piping systems, fixtures, and other plumbing used for water distribution and wastewater disposal in residential, commercial, and industrial buildings. I am committed to delivering high-quality work and ensuring that all plumbing systems are functioning efficiently.', 'WhatsApp Image 2024-01-04 at 11.55.29 AM.jpeg', 'Plumber', '2024-05-06 15:30:57', 17.426, 78.5398, '', 0),
(25, 'Lakshmi Prasad', 'Lakshmi Prasad', 'akshmip@gmail.com', '$2y$10$jFWM7uwxFKwRTrK4rnvUAuvrRmpiNQDosIbUwbbaeztqyA81tvyTe', '8293827394', 'hyderabad', 'tarnaka', '500039', '10', 'I am a professional carpenter with a decade of experience in crafting, repairing, and installing wooden structures and fixtures. I have a keen eye for detail and take pride in creating high-quality woodwork. My projects range from furniture making to large-scale construction work. I strive to meet the unique needs of each client with precision and care.', 'WhatsApp Image 2024-04-16 at 3.28.48 PM.jpeg', 'Carpenter', '2024-05-06 15:30:57', 17.4733, 78.5761, '', 0),
(30, 'Rajesh Kumar', 'Rajesh Kumar', 'rajeshk@gmail.com', '$2y$10$l1gcPbnOtXby4hpxZM5kDe9WuqXfQLriSP5Wp8kcy.hDiEvhq9bVW', '9478946737', 'hyderabad', 'ecil', '500383', '6', 'I have been working as a professional painter for six years, specializing in both residential and commercial painting projects. My skills include surface preparation, mixing and matching paints, and applying paint, varnish, and other finishes. I am dedicated to enhancing the appearance of spaces with a meticulous and artistic touch.\n', 'WhatsApp Image 2024-01-29 at 5.07.06 PM (2).jpeg', 'Painter', '2024-05-06 15:30:57', 17.425, 78.5569, '', 0),
(31, 'gopal', 'venu gopal', 'gopal@gmail.com', '$2y$10$sIj4Mt3qxSMSj1CLOM.jNOvA1fUflCIH1gVAZJKeox0Rxg.2Ggkd6', '8376890865', 'hyderabad', 'boduppal', '500009', '5', 'My commitment to quality workmanship and customer satisfaction drives me to deliver reliable and efficient plumbing services. I prioritize safety and compliance with building codes and standards, ensuring that all work is done correctly and to the highest standards. Whether it\'s a minor repair or a major installation, I am dedicated to providing top-notch service and ensuring the functionality and reliability of your plumbing systems.', 'ele.jpg', 'Plumber', '2024-05-07 06:10:26', 17.4136, 78.5879, '', 0),
(33, 'raju', 'Ram venu', 'ramvenu@gmail.com', '$2y$10$SaduduHbCTq50tpARgAUhujFgpb0.HllNmxxvFdp9WUPkOhTAThbW', '9478946733', '5-78', 'ramanthapur', '508277', '4', 'rdd', 'ele1.jpg', 'Electrician', '2024-05-08 05:47:49', 3, 3, '', 1),
(41, 'Rames', 'Chunchu Manoj kumar', 'chunchumanoj@gmail.com', '$2y$10$DBgyb725l1DJbedRombhcegxXWotM6Y.j5513ZMuWMuCWeLxRg17u', '8367092997', '5-78', 'uppal', '508277', '1', 'hello', 'Picture1.jpg', 'Electrician', '2024-06-01 06:58:33', 17.4136, 78.5879, '4a259a0972bd0e3decd1ba9b93d9ef80', 1),
(42, 'ramulu', 'Ramulu s', 'example.@gmail.com', '$2y$10$45uP713CcCgajgMtZQrzI.3U8n/IihY2xEAFzNNyr1bYaQuK4HhFS', '8379748737', '5-78', 'tarnaka', '508277', '1', 'hello.', 'Picture4.jpg', 'Electrician', '2024-06-01 07:30:00', 17.4136, 78.5879, 'ee38639732cb32e35d14b123ac1c2dd8', 0);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `contact_us`
--
ALTER TABLE `contact_us`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `customers`
--
ALTER TABLE `customers`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `workers`
--
ALTER TABLE `workers`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `contact_us`
--
ALTER TABLE `contact_us`
  MODIFY `id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT for table `customers`
--
ALTER TABLE `customers`
  MODIFY `id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT for table `workers`
--
ALTER TABLE `workers`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=43;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
