-- phpMyAdmin SQL Dump
-- version 4.9.7
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Aug 07, 2021 at 10:45 AM
-- Server version: 5.7.32
-- PHP Version: 7.4.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `FREDwebtechnology`
--
CREATE DATABASE IF NOT EXISTS `FREDwebtechnology` DEFAULT CHARACTER SET utf8 COLLATE utf8_general_ci;
USE `FREDwebtechnology`;

-- --------------------------------------------------------

--
-- Table structure for table `Answer`
--

CREATE TABLE `Answer` (
  `id` int(11) NOT NULL,
  `support_id` int(11) NOT NULL,
  `admin_id` int(11) NOT NULL,
  `message` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `Cart`
--

CREATE TABLE `Cart` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `Cart_item`
--

CREATE TABLE `Cart_item` (
  `id` int(11) NOT NULL,
  `cart_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `quantity` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `Category`
--

CREATE TABLE `Category` (
  `id` int(11) NOT NULL,
  `name` varchar(50) NOT NULL,
  `description` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `City`
--

CREATE TABLE `City` (
  `id` int(11) NOT NULL,
  `name` varchar(50) NOT NULL,
  `region_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `Faq`
--

CREATE TABLE `Faq` (
  `id` int(11) NOT NULL,
  `title` varchar(50) NOT NULL,
  `message` text NOT NULL,
  `product_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `Manufacturer`
--

CREATE TABLE `Manufacturer` (
  `id` int(11) NOT NULL,
  `name` int(11) NOT NULL,
  `info` text NOT NULL,
  `site` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `Newsletter`
--

CREATE TABLE `Newsletter` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `category` int(11) DEFAULT NULL,
  `manufacturer` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `Orders`
--

CREATE TABLE `Orders` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `date_order` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `status` enum('Ordine ricevuto','In lavorazione','Spedito','In consegna','Consegnato') NOT NULL,
  `tracking_information` text,
  `stimate_delivery` int(11) NOT NULL,
  `shipment_user_info` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `Orders_items`
--

CREATE TABLE `Orders_items` (
  `id` int(11) NOT NULL,
  `order_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `quantity` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `Payments`
--

CREATE TABLE `Payments` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `credit_card_number` varchar(16) DEFAULT NULL,
  `cvv` int(3) DEFAULT NULL,
  `expiration` varchar(5) DEFAULT NULL,
  `paypal` tinyint(1) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `Product`
--

CREATE TABLE `Product` (
  `id` int(11) NOT NULL,
  `name` varchar(50) NOT NULL,
  `description` text NOT NULL,
  `price` double NOT NULL,
  `images` text NOT NULL,
  `manufacturer_id` int(11) NOT NULL,
  `category_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `Region`
--

CREATE TABLE `Region` (
  `id` int(11) NOT NULL,
  `name` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `Region`
--

INSERT INTO `Region` (`id`, `name`) VALUES
(1, 'Liguria'),
(2, 'Piemonte'),
(3, 'Valle d\'Aosta'),
(4, 'Lombardia'),
(5, 'Trentino Alto Adige'),
(6, 'Veneto'),
(7, 'Friuli Venezia Giulia'),
(8, 'Emilia Romagna'),
(9, 'Toscana'),
(10, 'Marche'),
(11, 'Umbria'),
(12, 'Lazio'),
(13, 'Abruzzo'),
(14, 'Molise'),
(15, 'Campania'),
(16, 'Basilicata'),
(17, 'Puglia'),
(18, 'Calabria'),
(19, 'Sicilia'),
(20, 'Sardegna');

INSERT INTO `City` (`id`, `name`, `region_id`) VALUES
(1, 'Agrigento', 19),
	(2, 'Alessandria', 2),
	(3, 'Ancona', 10),
	(4, 'Arezzo', 9),
	(5, 'Ascoli Piceno',10),
	(6, 'Asti', 2),
	(7, 'Avellino', 15),
	(8, 'Bari', 17),
	(9, 'Barletta-Andria-Trani', 17),
	(10, 'Belluno', 6),
	(11, 'Benevento', 15),
	(12, 'Bergamo', 4),
	(13, 'Biella', 2),
	(14, 'Bologna', 8),
	(15, 'Bolzano', 5),
	(16, 'Brescia', 4),
	(17, 'Brindisi', 17),
	(18, 'Cagliari', 20),
	(19, 'Caltanissetta', 19),
	(20, 'Campobasso', 14),
	(21, 'Carbonia-Iglesias', 20),
	(22, 'Caserta', 15),
	(23, 'Catania', 19),
	(24, 'Catanzaro', 18),
	(25, 'Chieti', 13),
	(26, 'Como', 4),
	(27, 'Cosenza', 18),
	(28, 'Cremona', 4),
	(29, 'Crotone', 18),
	(30, 'Cuneo', 2),
	(31, 'Enna', 19),
	(32, 'Fermo', 10),
	(33, 'Ferrara', 8),
	(34, 'Firenze', 9),
	(35, 'Foggia', 17),
	(36, 'Forli-Cesena', 8),
	(37, 'Frosinone', 12),
	(38, 'Genova', 1),
	(39, 'Gorizia', 7),
	(40, 'Grosseto', 9),
	(41, 'Imperia', 1),
	(42, 'Isernia', 14),
	(43, 'L\'Aquila', 13),
	(44, 'La Spezia', 1),
	(45, 'Latina', 12),
	(46, 'Lecce', 17),
	(47, 'Lecco', 4),
	(48, 'Livorno', 9),
	(49, 'Lodi', 4),
	(50, 'Lucca', 9),
	(51, 'Macerata', 10),
	(52, 'Mantova', 4),
	(53, 'Massa e Carrara', 9),
	(54, 'Matera', 16),
	(55, 'Medio Campidano', 20),
	(56, 'Messina', 19),
	(57, 'Milano', 4),
	(58, 'Modena', 8),
	(59, 'Monza e Brianza', 4),
	(60, 'Napoli', 15),
	(61, 'Novara', 2),
	(62, 'Nuoro', 20),
	(63, 'Ogliastra', 20),
	(64, 'Olbia-Tempio', 20),
	(65, 'Oristano', 20),
	(66, 'Padova', 6),
	(67, 'Palermo', 19),
	(68, 'Parma', 8),
	(69, 'Pavia', 4),
	(70, 'Perugia', 11),
	(71, 'Pesaro e Urbino', 10),
	(72, 'Pescara', 13),
	(73, 'Piacenza', 8),
	(74, 'Pisa', 9),
	(75, 'Pistoia', 9),
	(76, 'Pordenone', 7),
	(77, 'Potenza', 16),
	(78, 'Prato', 9),
	(79, 'Ragusa', 19),
	(80, 'Ravenna', 8),
	(81, 'Reggio Calabria', 18),
	(82, 'Reggio Emilia', 8),
	(83, 'Rieti', 12),
	(84, 'Rimini', 8),
	(85, 'Roma', 12),
	(86, 'Rovigo', 6),
	(87, 'Salerno', 15),
	(88, 'Sassari', 20),
	(89, 'Savona', 1),
	(90, 'Siena', 9),
	(91, 'Siracusa', 19),
	(92, 'Sondrio', 4),
	(93, 'Taranto', 17),
	(94, 'Teramo', 13),
	(95, 'Terni', 11),
	(96, 'Torino', 2),
	(97, 'Trapani', 19),
	(98, 'Trento', 5),
	(99, 'Treviso', 6),
  (100, 'Trieste', 7),
	(101, 'Udine', 7),
	(102, 'Aosta', 3),
	(103, 'Varese', 4),
	(104, 'Venezia', 6),
	(105, 'Verbano-Cusio-Ossola', 2),
	(106, 'Vercelli', 2),
	(107, 'Verona', 6),
	(108, 'Vibo Valentia', 18),
	(109, 'Vicenza', 6),
	(110, 'Viterbo', 12);

-- --------------------------------------------------------

--
-- Table structure for table `Review`
--

CREATE TABLE `Review` (
  `id` int(11) NOT NULL,
  `title` varchar(50) NOT NULL,
  `message` text NOT NULL,
  `vote` enum('1','2','3','4','5') NOT NULL,
  `user_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `Shipment_information`
--

CREATE TABLE `Shipment_information` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `region` int(11) NOT NULL,
  `city` int(11) NOT NULL,
  `code` int(5) NOT NULL,
  `address` varchar(70) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `Support`
--

CREATE TABLE `Support` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '0',
  `message` text NOT NULL,
  `order_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `User`
--

CREATE TABLE `User` (
  `id` int(11) NOT NULL,
  `name` varchar(50) NOT NULL,
  `surname` varchar(70) NOT NULL,
  `email` varchar(70) NOT NULL,
  `password` varchar(33) NOT NULL,
  `user_type` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `User_type`
--

CREATE TABLE `User_type` (
  `id` int(11) NOT NULL,
  `type` enum('Regular','Admin') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `User_type`
--

INSERT INTO `User_type` (`id`, `type`) VALUES
(1, 'Regular'),
(2, 'Admin');

-- --------------------------------------------------------

--
-- Table structure for table `Wishlist`
--

CREATE TABLE `Wishlist` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `Answer`
--
ALTER TABLE `Answer`
  ADD PRIMARY KEY (`id`),
  ADD KEY `admin_id` (`admin_id`),
  ADD KEY `support_id` (`support_id`);

--
-- Indexes for table `Cart`
--
ALTER TABLE `Cart`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `Cart_item`
--
ALTER TABLE `Cart_item`
  ADD PRIMARY KEY (`id`),
  ADD KEY `product_id` (`product_id`),
  ADD KEY `cart_id` (`cart_id`);

--
-- Indexes for table `Category`
--
ALTER TABLE `Category`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `City`
--
ALTER TABLE `City`
  ADD PRIMARY KEY (`id`),
  ADD KEY `region_id` (`region_id`);

--
-- Indexes for table `Faq`
--
ALTER TABLE `Faq`
  ADD PRIMARY KEY (`id`),
  ADD KEY `product_id` (`product_id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `Manufacturer`
--
ALTER TABLE `Manufacturer`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `Newsletter`
--
ALTER TABLE `Newsletter`
  ADD PRIMARY KEY (`id`),
  ADD KEY `manufacturer` (`manufacturer`),
  ADD KEY `category` (`category`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `Orders`
--
ALTER TABLE `Orders`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `shipment_user_info` (`shipment_user_info`);

--
-- Indexes for table `Orders_items`
--
ALTER TABLE `Orders_items`
  ADD KEY `order_id` (`order_id`),
  ADD KEY `product_id` (`product_id`);

--
-- Indexes for table `Payments`
--
ALTER TABLE `Payments`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `Product`
--
ALTER TABLE `Product`
  ADD PRIMARY KEY (`id`),
  ADD KEY `manufacturer_id` (`manufacturer_id`),
  ADD KEY `category_id` (`category_id`);

--
-- Indexes for table `Region`
--
ALTER TABLE `Region`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `Review`
--
ALTER TABLE `Review`
  ADD PRIMARY KEY (`id`),
  ADD KEY `product_id` (`product_id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `Shipment_information`
--
ALTER TABLE `Shipment_information`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `region` (`region`),
  ADD KEY `city` (`city`);

--
-- Indexes for table `Support`
--
ALTER TABLE `Support`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `User`
--
ALTER TABLE `User`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_type` (`user_type`);

--
-- Indexes for table `User_type`
--
ALTER TABLE `User_type`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `Wishlist`
--
ALTER TABLE `Wishlist`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `product_id` (`product_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `Answer`
--
ALTER TABLE `Answer`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `Cart`
--
ALTER TABLE `Cart`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `Cart_item`
--
ALTER TABLE `Cart_item`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `Category`
--
ALTER TABLE `Category`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `City`
--
ALTER TABLE `City`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `Faq`
--
ALTER TABLE `Faq`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `Manufacturer`
--
ALTER TABLE `Manufacturer`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `Newsletter`
--
ALTER TABLE `Newsletter`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `Orders`
--
ALTER TABLE `Orders`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `Payments`
--
ALTER TABLE `Payments`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `Product`
--
ALTER TABLE `Product`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `Region`
--
ALTER TABLE `Region`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `Review`
--
ALTER TABLE `Review`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `Shipment_information`
--
ALTER TABLE `Shipment_information`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `Support`
--
ALTER TABLE `Support`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `User`
--
ALTER TABLE `User`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `User_type`
--
ALTER TABLE `User_type`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `Answer`
--
ALTER TABLE `Answer`
  ADD CONSTRAINT `answer_ibfk_1` FOREIGN KEY (`admin_id`) REFERENCES `User` (`id`),
  ADD CONSTRAINT `answer_ibfk_2` FOREIGN KEY (`support_id`) REFERENCES `Support` (`id`);

--
-- Constraints for table `Cart`
--
ALTER TABLE `Cart`
  ADD CONSTRAINT `cart_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `User` (`id`);

--
-- Constraints for table `Cart_item`
--
ALTER TABLE `Cart_item`
  ADD CONSTRAINT `cart_item_ibfk_1` FOREIGN KEY (`product_id`) REFERENCES `Product` (`id`),
  ADD CONSTRAINT `cart_item_ibfk_2` FOREIGN KEY (`cart_id`) REFERENCES `Cart` (`id`);

--
-- Constraints for table `City`
--
ALTER TABLE `City`
  ADD CONSTRAINT `city_ibfk_1` FOREIGN KEY (`region_id`) REFERENCES `Region` (`id`);

--
-- Constraints for table `Faq`
--
ALTER TABLE `Faq`
  ADD CONSTRAINT `faq_ibfk_1` FOREIGN KEY (`product_id`) REFERENCES `Product` (`id`),
  ADD CONSTRAINT `faq_ibfk_2` FOREIGN KEY (`user_id`) REFERENCES `User` (`id`);

--
-- Constraints for table `Newsletter`
--
ALTER TABLE `Newsletter`
  ADD CONSTRAINT `newsletter_ibfk_1` FOREIGN KEY (`manufacturer`) REFERENCES `Manufacturer` (`id`),
  ADD CONSTRAINT `newsletter_ibfk_2` FOREIGN KEY (`category`) REFERENCES `Category` (`id`),
  ADD CONSTRAINT `newsletter_ibfk_3` FOREIGN KEY (`user_id`) REFERENCES `User` (`id`);

--
-- Constraints for table `Orders`
--
ALTER TABLE `Orders`
  ADD CONSTRAINT `orders_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `User` (`id`),
  ADD CONSTRAINT `orders_ibfk_2` FOREIGN KEY (`shipment_user_info`) REFERENCES `Shipment_information` (`id`);

--
-- Constraints for table `Orders_items`
--
ALTER TABLE `Orders_items`
  ADD CONSTRAINT `orders_items_ibfk_1` FOREIGN KEY (`order_id`) REFERENCES `Orders` (`id`),
  ADD CONSTRAINT `orders_items_ibfk_2` FOREIGN KEY (`product_id`) REFERENCES `Product` (`id`);

--
-- Constraints for table `Payments`
--
ALTER TABLE `Payments`
  ADD CONSTRAINT `payments_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `User` (`id`);

--
-- Constraints for table `Product`
--
ALTER TABLE `Product`
  ADD CONSTRAINT `product_ibfk_1` FOREIGN KEY (`manufacturer_id`) REFERENCES `Manufacturer` (`id`),
  ADD CONSTRAINT `product_ibfk_2` FOREIGN KEY (`category_id`) REFERENCES `Category` (`id`);

--
-- Constraints for table `Review`
--
ALTER TABLE `Review`
  ADD CONSTRAINT `review_ibfk_1` FOREIGN KEY (`product_id`) REFERENCES `Product` (`id`),
  ADD CONSTRAINT `review_ibfk_2` FOREIGN KEY (`user_id`) REFERENCES `User` (`id`);

--
-- Constraints for table `Shipment_information`
--
ALTER TABLE `Shipment_information`
  ADD CONSTRAINT `shipment_information_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `User` (`id`),
  ADD CONSTRAINT `shipment_information_ibfk_2` FOREIGN KEY (`region`) REFERENCES `Region` (`id`),
  ADD CONSTRAINT `shipment_information_ibfk_3` FOREIGN KEY (`city`) REFERENCES `City` (`id`);

--
-- Constraints for table `Support`
--
ALTER TABLE `Support`
  ADD CONSTRAINT `support_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `User` (`id`);

--
-- Constraints for table `User`
--
ALTER TABLE `User`
  ADD CONSTRAINT `user_ibfk_1` FOREIGN KEY (`user_type`) REFERENCES `User_type` (`id`);

--
-- Constraints for table `Wishlist`
--
ALTER TABLE `Wishlist`
  ADD CONSTRAINT `wishlist_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `User` (`id`),
  ADD CONSTRAINT `wishlist_ibfk_2` FOREIGN KEY (`product_id`) REFERENCES `Product` (`id`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
